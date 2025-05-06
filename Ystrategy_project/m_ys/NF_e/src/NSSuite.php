<?php

require('./src/Compartilhados/Endpoints.php');
require('./src/Compartilhados/Parametros.php');
require('./src/Compartilhados/Genericos.php');



// require '../vendor/autoload.php';
// use Dompdf\Dompdf;

foreach (glob('./src/Requisicoes/_Genericos/*.php') as $filename) {
    include_once($filename);
}
require('./src/Requisicoes/BPe/ConsStatusProcessamentoReqBPe.php');
require('./src/Requisicoes/BPe/DownloadReqBPe.php');
require('./src/Requisicoes/BPe/NaoEmbReqBPe.php');
require('./src/Requisicoes/CTe/ConsStatusProcessamentoReqCTe.php');
require('./src/Requisicoes/CTe/DownloadReqCTe.php');
require('./src/Requisicoes/CTe/InfGTVReqCTe.php');
require('./src/Requisicoes/MDFe/ConsStatusProcessamentoReqMDFe.php');
require('./src/Requisicoes/MDFe/DownloadReqMDFe.php');
require('./src/Requisicoes/NFCe/DownloadReqNFCe.php');
require('./src\Requisicoes\NFCe\DownloadReqNFCeCont.php');
require('./src/Requisicoes/NFCe/Impressao.php');
require('./src/Requisicoes/NFe/ConsStatusProcessamentoReqNFe.php');
require('./src/Requisicoes/NFe/DownloadReqNFe.php');

require('./src/Retornos/BPe/EmitirSincronoRetBPe.php');
require('./src/Retornos/CTe/EmitirSincronoRetCTe.php');
require('./src/Retornos/MDFe/EmitirSincronoRetMDFe.php');
require('./src/Retornos/NFCe/EmitirSincronoRetNFCe.php');
require('./src/Retornos/NFe/EmitirSincronoRetNFe.php');

class NSSuite
{

    private $token;
    private $parametros;
    private $endpoints;
    private $genericos;

    public function __construct()
    {
        $this->parametros = new Parametros(1);
        $this->endpoints = new Endpoints;
        $this->genericos = new Genericos;
        $this->token = 'SEU_TOKEN_AQUI';
    }


    private function enviaConteudoParaAPI($conteudoAEnviar, $url, $tpConteudo)
    {
        
        //Inicializa cURL para uma URL->
        $ch = curl_init($url);

        //Marca que vai enviar por POST(1=SIM)->
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        //Passa um json para o campo de envio POST->
        curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);

        //Marca como tipo de arquivo enviado json
        if ($tpConteudo == 'json')
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-AUTH-TOKEN: ' . $this->token));
        else if ($tpConteudo == 'xml')
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', 'X-AUTH-TOKEN: ' . $this->token));
        else
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain', 'X-AUTH-TOKEN: ' . $this->token));

        //Marca que vai receber string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Inicia a conexao
        $result = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'Erro na comunicacao: ' . '<br>';
            echo '<br>';
            echo '<pre>';
            var_dump(curl_getinfo($ch));
            echo '</pre>';
            echo '<br>';
            var_dump(curl_error($ch));
        }

        //Fecha a conexao
        curl_close($ch);

        return json_decode($result, true);
    }


    public function encerrarDocumento($modelo, $encerrarReq)
    {
        switch ($modelo) {
            case '58':
                $urlEncerramento = $this->endpoints->MDFeEncerramento;
                break;

            default:
                throw new Exception('Não definido endpoint de encerramento para o modelo ' . $modelo);
        }

        $json = json_encode((array) $encerrarReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[ENCERRAMENTO_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlEncerramento, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[ENCERRAMENTO_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function encerrarDocumentoESalvar($modelo, $encerrarReq, $downloadEventoReq, $caminho, $chave, $exibeNaTela)
    {
        $resposta = $this->encerrarDocumento($modelo, $encerrarReq);
        $status = $resposta['status'];

        if ($status == 200) {
            $respostaDownloadEvento = $this->downloadEventoESalvar($modelo, $downloadEventoReq, $caminho, $chave, '', $exibeNaTela);
        }

        return $resposta;
    }



    // Metodos especificos de NFe
    public function emitirNFeSincrono($conteudo, $tpConteudo, $CNPJ, $tpDown, $tpAmb, $caminho, $exibeNaTela)
    {

        $modelo = '55';
        $statusEnvio = null;
        $statusConsulta = null;
        $statusDownload = null;
        $motivo = null;
        $nsNRec = null;
        $chNFe = null;
        $cStat = null;
        $nProt = null;

        $this->genericos->gravarLinhaLog($modelo, '[EMISSAO_SINCRONA_INICIO]');

        $resposta = $this->emitirDocumento($modelo, $conteudo, $tpConteudo);
        $statusEnvio = $resposta['status'];

        if ($statusEnvio == 200 || $statusEnvio == -6) {
            $this->genericos->gravarLinhaLog($modelo, '[DOCUMENTO EMITIDO]');
            $nsNRec = $resposta['nsNRec'];

            // É necessário aguardar alguns milisegundos antes de consultar o status de processamento
            sleep($this->parametros->TEMPO_ESPERA);

            $consStatusProcessamentoReqNFe = new ConsStatusProcessamentoReqNFe();
            $consStatusProcessamentoReqNFe->CNPJ = $CNPJ;
            $consStatusProcessamentoReqNFe->nsNRec = $nsNRec;
            $consStatusProcessamentoReqNFe->tpAmb = $tpAmb;

            $resposta = $this->consultarStatusProcessamento($modelo, $consStatusProcessamentoReqNFe);
            $statusConsulta = $resposta['status'];
            $this->genericos->gravarLinhaLog($modelo, $statusConsulta);

            // Testa se a consulta foi feita com sucesso (200)
            if ($statusConsulta == 200) {

                $cStat = $resposta['cStat'];

                if ($cStat == 100 || $cStat == 150) {

                    $chNFe = $resposta['chNFe'];
                    $nProt = $resposta['nProt'];
                    $motivo = $resposta['xMotivo'];

                    $downloadReqNFe = new DownloadReqNFe();
                    $downloadReqNFe->chNFe = $chNFe;
                    $downloadReqNFe->tpAmb = $tpAmb;
                    $downloadReqNFe->tpDown = $tpDown;

                    $resposta = $this->downloadDocumentoESalvar($modelo, $downloadReqNFe, $caminho, $chNFe . '-NFe', $exibeNaTela);
                    $statusDownload = $resposta['status'];

                    if ($statusDownload != 200) $motivo = $resposta['motivo'];
                } else {
                    $motivo = $resposta['xMotivo'];
                    $chNFe = $resposta['chNFe'];
                }
            } else if ($statusConsulta == -2) {

                $cStat = $resposta['cStat'];
                $motivo = $resposta['erro']['xMotivo'];
            } else {
                $motivo = $resposta['motivo'];
            }
        } else if ($statusEnvio == -7) {

            $motivo = $resposta['motivo'];
            $nsNRec = $resposta['nsNRec'];
        } else if ($statusEnvio == -4 || $statusEnvio == -2) {

            $motivo = $resposta['motivo'];
            $erros = $resposta['erros'];
        } else if ($statusEnvio == -999 || $statusEnvio == -5) {

            $motivo = $resposta['erro']['xMotivo'];
        } else {
            try {
                $motivo = $resposta['motivo'];
            } catch (Exception $ex) {
                $motivo = $resposta;
            }
        }

        $emitirSincronoRetNFe = new EmitirSincronoRetNFe();
        $emitirSincronoRetNFe->statusEnvio = $statusEnvio;
        $emitirSincronoRetNFe->statusConsulta = $statusConsulta;
        $emitirSincronoRetNFe->statusDownload = $statusDownload;
        $emitirSincronoRetNFe->cStat = $cStat;
        $emitirSincronoRetNFe->chNFe = $chNFe;
        $emitirSincronoRetNFe->nProt = $nProt;
        $emitirSincronoRetNFe->motivo = $motivo;
        $emitirSincronoRetNFe->nsNRec = $nsNRec;
        $emitirSincronoRetNFe->erros = $erros;

        $emitirSincronoRetNFe = array_filter((array) $emitirSincronoRetNFe);

        $retorno = json_encode($emitirSincronoRetNFe, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[JSON_RETORNO]');
        $this->genericos->gravarLinhaLog($modelo, $retorno);
        $this->genericos->gravarLinhaLog($modelo, '[EMISSAO_SINCRONA_FIM]');

        return $retorno;
    }

    // Métodos genéricos, compartilhados entre diversas funções
    public function emitirDocumento($modelo, $conteudo, $tpConteudo)
    {


        $this->genericos->gravarLinhaLog($modelo, '[FUN - EMITIRDOC]');
        $diretorioXML = __DIR__ . '/Notas/';
        if (!file_exists($diretorioXML)) {
            mkdir($diretorioXML, 0777, true);
        }

        // Nome do arquivo XML (pode usar timestamp ou chave única para evitar sobrescrever)
        $nomeArquivo = $diretorioXML . 'nfe_' . time() . '.xml';

        // Gera o XML com base no conteúdo (ajuste conforme a estrutura necessária)
        $xmlGerado = $this->gerarXML($conteudo, $tpConteudo);

        // Salva o XML no disco
        file_put_contents($nomeArquivo, $xmlGerado);

        $this->genericos->gravarLinhaLog($modelo, '[XML_GERADO]');
        // $this->genericos->gravarLinhaLog($modelo, $xmlGerado);

        // Retorna o caminho do arquivo XML gerado
        return [
            'status' => 200,
            'arquivoXML' => $nomeArquivo,
            'mensagem' => 'XML gerado localmente com sucesso.',
        ];
    }

    public function gerarXML($conteudo, $tpConteudo)
    {
        $this->genericos->gravarLinhaLog($modelo, '[FUN - GERARXML]');
        // Inicializa o XML com a tag raiz <NFe>
        $xml = new SimpleXMLElement('

        <NFe xmlns="http://www.portalfiscal.inf.br/nfe">
            <infNFe versao="4.00" Id="NFeXXXXXXXXX">
                <!-- Identificação da Nota Fiscal -->
                <ide>
                    <cUF>35</cUF> <!-- Código da UF do Emitente -->
                    <cNF>12345678</cNF> <!-- Código Numérico -->
                    <natOp>Venda de Mercadorias</natOp> <!-- Natureza da Operação -->
                    <mod>55</mod> <!-- Modelo da NF-e -->
                    <serie>1</serie> <!-- Série da NF -->
                    <nNF>12345</nNF> <!-- Número da NF -->
                    <dhEmi>2024-12-28T12:00:00-03:00</dhEmi> <!-- Data e Hora de Emissão -->
                    <tpNF>1</tpNF> <!-- Tipo de Operação: 1=Entrada, 2=Saída -->
                    <idDest>1</idDest> <!-- Identificador de Destino: 1=Interno -->
                    <cMunFG>3550308</cMunFG> <!-- Código do Município do Emitente -->
                    <tpImp>1</tpImp> <!-- Tipo de Impressão DANFE -->
                    <tpEmis>1</tpEmis> <!-- Tipo de Emissão -->
                    <cDV>3</cDV> <!-- Dígito Verificador da Chave de Acesso -->
                    <tpAmb>2</tpAmb> <!-- Ambiente: 1=Produção, 2=Homologação -->
                    <finNFe>1</finNFe> <!-- Finalidade: 1=Normal -->
                    <indFinal>1</indFinal> <!-- Consumidor Final: 1=Sim -->
                    <indPres>1</indPres> <!-- Indicador de Presença: 1=Presencial -->
                    <procEmi>0</procEmi> <!-- Processo de Emissão -->
                    <verProc>1.0</verProc> <!-- Versão do Processo -->
                </ide>

                <!-- Emitente -->
                <emit>
                    <CNPJ>12345678000195</CNPJ>
                    <xNome>Empresa Emitente LTDA</xNome>
                    <xFant>Nome Fantasia</xFant>
                    <enderEmit>
                        <xLgr>Rua A</xLgr>
                        <nro>123</nro>
                        <xBairro>Centro</xBairro>
                        <cMun>3550308</cMun>
                        <xMun>São Paulo</xMun>
                        <UF>SP</UF>
                        <CEP>01001000</CEP>
                        <cPais>1058</cPais>
                        <xPais>Brasil</xPais>
                        <fone>11987654321</fone>
                    </enderEmit>
                    <IE>1234567890</IE>
                    <CRT>3</CRT> <!-- Código de Regime Tributário -->
                </emit>

                <!-- Destinatário -->
                <dest>
                    <CNPJ>98765432000123</CNPJ>
                    <xNome>Cliente LTDA</xNome>
                    <enderDest>
                        <xLgr>Rua B</xLgr>
                        <nro>456</nro>
                        <xBairro>Centro</xBairro>
                        <cMun>3550308</cMun>
                        <xMun>São Paulo</xMun>
                        <UF>SP</UF>
                        <CEP>01002000</CEP>
                        <cPais>1058</cPais>
                        <xPais>Brasil</xPais>
                        <fone>11912345678</fone>
                    </enderDest>
                    <indIEDest>1</indIEDest> <!-- Contribuinte de ICMS -->
                </dest>

                <!-- Detalhes dos Produtos -->
                <det nItem="1">
                    <prod>
                        <cProd>001</cProd>
                        <cEAN>7891234567890</cEAN>
                        <xProd>Produto Exemplo</xProd>
                        <NCM>12345678</NCM>
                        <CFOP>5102</CFOP>
                        <uCom>UN</uCom>
                        <qCom>10.0000</qCom>
                        <vUnCom>5.00</vUnCom>
                        <vProd>50.00</vProd>
                        <cEANTrib>7891234567890</cEANTrib>
                        <uTrib>UN</uTrib>
                        <qTrib>10.0000</qTrib>
                        <vUnTrib>5.00</vUnTrib>
                        <indTot>1</indTot>
                    </prod>
                    <imposto>
                        <ICMS>
                            <ICMS00>
                                <orig>0</orig>
                                <CST>00</CST>
                                <modBC>3</modBC>
                                <vBC>50.00</vBC>
                                <pICMS>18.00</pICMS>
                                <vICMS>9.00</vICMS>
                            </ICMS00>
                        </ICMS>
                        <PIS>
                            <PISAliq>
                                <CST>01</CST>
                                <vBC>50.00</vBC>
                                <pPIS>1.65</pPIS>
                                <vPIS>0.83</vPIS>
                            </PISAliq>
                        </PIS>
                        <COFINS>
                            <COFINSAliq>
                                <CST>01</CST>
                                <vBC>50.00</vBC>
                                <pCOFINS>7.60</pCOFINS>
                                <vCOFINS>3.80</vCOFINS>
                            </COFINSAliq>
                        </COFINS>
                    </imposto>
                </det>

                <!-- Total da Nota -->
                <total>
                    <ICMSTot>
                        <vBC>50.00</vBC>
                        <vICMS>9.00</vICMS>
                        <vICMSDeson>0.00</vICMSDeson>
                        <vFCP>0.00</vFCP>
                        <vBCST>0.00</vBCST>
                        <vST>0.00</vST>
                        <vFCPST>0.00</vFCPST>
                        <vFCPSTRet>0.00</vFCPSTRet>
                        <vProd>50.00</vProd>
                        <vFrete>0.00</vFrete>
                        <vSeg>0.00</vSeg>
                        <vDesc>0.00</vDesc>
                        <vII>0.00</vII>
                        <vIPI>0.00</vIPI>
                        <vPIS>0.83</vPIS>
                        <vCOFINS>3.80</vCOFINS>
                        <vOutro>0.00</vOutro>
                        <vNF>50.00</vNF>
                    </ICMSTot>
                </total>

                <!-- Transporte -->
                <transp>
                    <modFrete>9</modFrete>
                </transp>

                <!-- Pagamento -->
                <pag>
                    <detPag>
                        <indPag>0</indPag>
                        <tPag>01</tPag>
                        <vPag>50.00</vPag>
                    </detPag>
                </pag>

                <!-- Informações Adicionais -->
                <infAdic>
                    <infCpl>Informações complementares da nota.</infCpl>
                </infAdic>
            </infNFe>
        </NFe>
        ');

        // Função recursiva para adicionar elementos ao XML
        $this->adicionarNoXML($xml, $conteudo);

        // Retorna o XML formatado
        return $xml->asXML();
    }

    private function adicionarNoXML(SimpleXMLElement $xml, $dados)
    {
        $this->genericos->gravarLinhaLog($modelo, '[FUN - ADDXML]');
        foreach ($dados as $chave => $valor) {
            if (is_array($valor)) {
                // Para arrays, cria uma nova tag e processa recursivamente
                if (array_keys($valor) === range(0, count($valor) - 1)) {
                    // Se for um array indexado, cria múltiplas tags com o mesmo nome
                    foreach ($valor as $item) {
                        $this->adicionarNoXML($xml->addChild($chave), $item);
                    }
                } else {
                    $this->adicionarNoXML($xml->addChild($chave), $valor);
                }
            } elseif (is_object($valor)) {
                // Para objetos, processa como arrays
                $this->adicionarNoXML($xml->addChild($chave), (array)$valor);
            } else {
                // Adiciona o valor simples
                $xml->addChild($chave, htmlspecialchars($valor));
            }
        }
    }



    // function xmlParaPDF($xmlPath, $outputPdfPath)
    // {
    //     // Verifica se o arquivo XML existe
    //     if (!file_exists($xmlPath)) {
    //         throw new Exception("Arquivo XML não encontrado: $xmlPath");
    //     }

    //     // Carrega o XML
    //     $xmlContent = file_get_contents($xmlPath);

    //     // Converte o XML para uma estrutura legível (HTML)
    //     $xml = new SimpleXMLElement($xmlContent);
    //     $htmlContent = '<h1>Nota Fiscal Eletrônica (NFe)</h1>';
    //     $htmlContent .= formatarXMLParaHTML($xml);

    //     // Instancia o Dompdf
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml($htmlContent);
    //     $dompdf->setPaper('A4', 'portrait'); // Tamanho e orientação do PDF
    //     $dompdf->render();

    //     // Salva o PDF no caminho especificado
    //     file_put_contents($outputPdfPath, $dompdf->output());

    //     // Exibe o PDF no navegador (opcional)
    //     header('Content-Type: application/pdf');
    //     echo $dompdf->output();
    // }

    // function formatarXMLParaHTML(SimpleXMLElement $xml, $level = 0)
    // {
    //     $html = '';
    //     foreach ($xml as $key => $value) {
    //         $padding = str_repeat('&nbsp;', $level * 4); // Recuo para aninhamento visual
    //         if ($value->count()) {
    //             // Elemento com filhos
    //             $html .= "<div>{$padding}<strong>{$key}</strong>:</div>";
    //             $html .= formatarXMLParaHTML($value, $level + 1);
    //         } else {
    //             // Elemento sem filhos
    //             $html .= "<div>{$padding}<strong>{$key}</strong>: " . htmlspecialchars((string)$value) . "</div>";
    //         }
    //     }
    //     return $html;
    // }

    // // Caminhos do XML e PDF
    // $xmlPath = __DIR__ . '/Notas/nfe_123456789.xml';
    // $outputPdfPath = __DIR__ . '/Notas/nfe_123456789.pdf';

    // // Chama a função para gerar o PDF
    // try {
    //     xmlParaPDF($xmlPath, $outputPdfPath);
    //     echo "PDF gerado com sucesso em: $outputPdfPath";
    // } catch (Exception $e) {
    //     echo "Erro ao gerar PDF: " . $e->getMessage();
    // }














    public function emitirDocumentoEmContingencia($modelo, $conteudo, $tpConteudo)
    {

        switch ($modelo) {

            case '65':
                $urlEnvio = $this->endpoints->NFCeEnvioEmContingencia;
                break;

            default:
                throw new Exception('Não definido endpoint de envio para o modelo ' . $modelo);
        }

        $this->genericos->gravarLinhaLog($modelo, '[ENVIA_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $conteudo);

        $resposta = $this->enviaConteudoParaAPI($conteudo, $urlEnvio, $tpConteudo);

        $this->genericos->gravarLinhaLog($modelo, '[ENVIA_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function consultarStatusProcessamento($modelo, $consStatusProcessamentoReq)
    {
        switch ($modelo) {
            case '63':
                $urlConsulta = $this->endpoints->BPeConsStatusProcessamento;
                break;

            case '57':
                $urlConsulta = $this->endpoints->CTeConsStatusProcessamento;
                break;

            case '58':
                $urlConsulta = $this->endpoints->MDFeConsStatusProcessamento;
                break;

            case '55':
                $urlConsulta = $this->endpoints->NFeConsStatusProcessamento;
                break;

            default:
                throw new Exception('Não definido endpoint de consulta para o modelo ' . $modelo);
        }

        $json = json_encode((array) $consStatusProcessamentoReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[CONSULTA_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        // $resposta = $this->enviaConteudoParaAPI($json, $urlConsulta, 'json');

        // $this->genericos->gravarLinhaLog($modelo, '[CONSULTA_RESPOSTA]');
        // $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));
        return [
            'status' => 200,
            'cStat' => 100,
            
        ];
    }

    public function downloadDocumento($modelo, $downloadReq)
    {
        switch ($modelo) {
            case '63':
                $urlDownload = $this->endpoints->BPeDownload;
                break;

            case '57':
                $urlDownload = $this->endpoints->CTeDownload;
                break;

            case '58':
                $urlDownload = $this->endpoints->MDFeDownload;
                break;

            case '65':
                $urlDownload = $this->endpoints->NFCeDownload;
                break;

            case '55':
                $urlDownload = $this->endpoints->NFeDownload;
                break;

            default:
                throw new Exception('Não definido endpoint de Download para o modelo ' . $modelo);
        }

        $json = json_encode((array) $downloadReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[DOWNLOAD_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlDownload, 'json');
        $status = $resposta['status'];

        if (($status != 200) || ($status != 100)) {
            $this->genericos->gravarLinhaLog($modelo, '[DOWNLOAD_RESPOSTA]');
            $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));
        } else {
            $this->genericos->gravarLinhaLog($modelo, '[DOWNLOAD_STATUS]');
            $this->genericos->gravarLinhaLog($modelo, $status);
        }
        return $resposta;
    }

    public function downloadDocumentoEmContingencia($downloadReqNFCe)
    {

        $urlDownload = $this->endpoints->NFCeDownloadEmContingencia;

        $json = json_encode((array) $downloadReqNFCe, JSON_UNESCAPED_UNICODE);

        $resposta = $this->enviaConteudoParaAPI($json, $urlDownload, 'json');

        return $resposta;
    }


    public function downloadDocumentoESalvar($modelo, $downloadReq, $caminho, $nome, $exibeNaTela)
    {

        $resposta = $this->downloadDocumento($modelo, $downloadReq);
        $status = $resposta['status'];
        if (($status == 200) || ($status == 100)) {
            try {
                if (strlen($caminho) > 0) if (!file_exists($caminho)) mkdir($caminho, 0777, true);
                if (substr($caminho, -1) != '/') $caminho = $caminho . '/';
            } catch (Exception $e) {
                $this->genericos->gravarLinhaLog($modelo, '[CRIA_DIRETORIO] ' + $caminho);
                $this->genericos->gravarLinhaLog($modelo, $e->getMessage());
                throw new Exception('Exceção capturada: ' + $e->getMessage());
            }

            if ($modelo != '65') {

                if (strpos(strtoupper($downloadReq->tpDown), 'X') >= 0) {
                    $xml = $resposta['xml'];
                    $this->genericos->salvaXML($xml, $caminho, $nome);
                }
                if (strpos(strtoupper($downloadReq->tpDown), 'P') >= 0) {
                    $pdf = $resposta['pdf'];
                    $this->genericos->salvaPDF($pdf, $caminho, $nome);

                    if ($exibeNaTela) {
                        $this->genericos->exibirNaTela($caminho, $nome);
                    }
                }
            } else {

                $xml = $resposta['nfeProc']['xml'];
                $this->genericos->salvaXML($xml, $caminho, $nome);

                $pdf = $resposta['pdf'];
                $this->genericos->salvaPDF($pdf, $caminho, $nome);

                if ($exibeNaTela) {
                    $this->genericos->exibirNaTela($caminho, $nome);
                }
            }
        }
        return $resposta;
    }

    public function downloadDocumentoEmContingenciaESalvar($downloadReqNFCe, $caminho, $nome, $exibeNaTela)
    {

        $resposta = $this->downloadDocumentoEmContingencia($downloadReqNFCe);

        $pdf = $resposta['pdf'];
        $this->genericos->salvaPDF($pdf, $caminho, $nome);

        if ($exibeNaTela) {
            $this->genericos->exibirNaTela($caminho, $nome);
        }

        return $resposta;
    }

    public function downloadEvento($modelo, $downloadEventoReq)
    {
        switch ($modelo) {
            case '63':
                $urlDownloadEvento = $this->endpoints->BPeDownloadEvento;
                break;

            case '57':
                $urlDownloadEvento = $this->endpoints->CTeDownloadEvento;
                break;

            case '58':
                $urlDownloadEvento = $this->endpoints->MDFeDownloadEvento;
                break;

            case '65':
                $urlDownloadEvento = $this->endpoints->NFCeDownload;
                break;

            case '55':
                $urlDownloadEvento = $this->endpoints->NFeDownloadEvento;
                break;

            default:
                throw new Exception('Não definido endpoint de download de evento para o modelo ' + $modelo);
        }

        $json = json_encode((array) $downloadEventoReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[DOWNLOAD_EVENTO_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlDownloadEvento, 'json');
        $status = $resposta['status'];

        if (($status != 200) || ($status != 100)) {
            $this->genericos->gravarLinhaLog($modelo, '[DOWNLOAD_EVENTO_RESPOSTA]');
            $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));
        } else {
            $this->genericos->gravarLinhaLog($modelo, '[DOWNLOAD_EVENTO_STATUS]');
            $this->genericos->gravarLinhaLog($modelo, $status);
        }

        return $resposta;
    }

    public function downloadEventoESalvar($modelo, $downloadEventoReq, $caminho, $chave, $nSeqEvento, $exibeNaTela)
    {
        $tpEventoSalvar = '';
        $resposta = $this->downloadEvento($modelo, $downloadEventoReq);
        $status = $resposta['status'];
        if ($status == 200 || $status == 100) {
            try {
                if (!empty($caminho) && !file_exists($caminho)) {
                    mkdir($caminho, 0777, true);
                }
                if (substr($caminho, -1) != '/') {
                    $caminho = $caminho . '/';
                }
            } catch (Exception $ex) {
                $this->genericos->gravarLinhaLog($modelo, '[CRIA_DIRETORIO] ' . $caminho);
                $this->genericos->gravarLinhaLog($modelo, $ex->getMessage());
                throw new Exception('Exceção capturada: ' . $ex->getMessage());
            }

            if (strcasecmp($downloadEventoReq->tpEvento, 'CANC') === 0) {
                $tpEventoSalvar = '110111';
            } else if (strcasecmp($downloadEventoReq->tpEvento, 'ENC') === 0) {
                $tpEventoSalvar = '110110';
            } else {
                $tpEventoSalvar = '110115';
            }

            $nome = $tpEventoSalvar . $chave . $nSeqEvento . '-procEven';

            if ($modelo != 65) {
                // Verifica quais arquivos deve salvar
                if (strpos(strtoupper($downloadEventoReq->tpDown), 'X') !== false) {
                    if (isset($resposta['xml']) && !empty($resposta['xml'])) {
                        $this->genericos->salvaXML($resposta['xml'], $caminho, $nome);
                    }
                }
                if (strpos(strtoupper($downloadEventoReq->tpDown), 'P') !== false) {
                    if (isset($resposta['pdf']) && !empty($resposta['pdf'])) {
                        $this->genericos->salvaPDF($resposta['pdf'], $caminho, $nome);
                        if ($exibeNaTela) {
                            $this->genericos->exibirNaTela($caminho, $nome);
                        }
                    }
                }
            } else {
                if (isset($resposta['nfeProc']['xml']) && !empty($resposta['nfeProc']['xml'])) {
                    $this->genericos->salvaXML($resposta['nfeProc']['xml'], $caminho, $nome);
                }
                if (isset($resposta['pdfCancelamento']) && !empty($resposta['pdfCancelamento'])) {
                    $this->genericos->salvaPDF($resposta['pdfCancelamento'], $caminho, $nome);
                    if ($exibeNaTela) {
                        $this->genericos->exibirNaTela($caminho, $nome);
                    }
                }
            }
        }
        return $resposta;
    }


    public function downloadGeral($modelo, $downloadReq, $downloadEventoReq, $caminho, $chave, $nome, $nSeqEvento, $exibeNaTela)
    {

        $respostaDownloadDocumento = $this->downloadDocumentoESalvar($modelo, $downloadReq, $caminho, $nome, $exibeNaTela);

        $respostaDownloadEvento = $this->downloadEventoESalvar($modelo, $downloadEventoReq, $caminho, $chave, $nSeqEvento, $exibeNaTela);

        return array($respostaDownloadDocumento, $respostaDownloadEvento);
    }

    public function cancelarDocumento($modelo, $cancelarReq)
    {
        switch ($modelo) {

            case '63':
                $urlCancelamento = $this->endpoints->BPeCancelamento;
                break;

            case '67':
                $urlCancelamento = $this->endpoints->CTeCancelamento;
                break;

            case '58':
                $urlCancelamento = $this->endpoints->MDFeCancelamento;
                break;

            case '65':
                $urlCancelamento = $this->endpoints->NFCeCancelamento;
                break;

            case '55':
                $urlCancelamento = $this->endpoints->NFeCancelamento;
                break;

            default:
                throw new Exception('Não definido endpoint de cancelamento para o modelo ' . $modelo);
        }

        $json = json_encode((array) $cancelarReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[CANCELAMENTO_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlCancelamento, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[CANCELAMENTO_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function cancelarDocumentoESalvar($modelo, $cancelarReq, $downloadEventoReq, $caminho, $chave, $exibeNaTela)
    {
        $resposta = $this->cancelarDocumento($modelo, $cancelarReq);
        $status = $resposta['status'];
        if ($status == 200 || $status == 135) {
            $cStat = $resposta['retEvento']['cStat'];
            if ($cStat == 135) {
                $respostaDownloadEvento = $this->downloadEventoESalvar($modelo, $downloadEventoReq, $caminho, $chave, '1', $exibeNaTela);
            }
        }

        return $resposta;
    }

    public function corrigirDocumento($modelo, $corrigirReq)
    {

        switch ($modelo) {
            case '57':
            case '67':
                $urlCCe = $this->endpoints->CTeCCe;
                break;

            case '55':
                $urlCCe = $this->endpoints->NFeCCe;
                break;

            default:
                throw new Exception('Não definido endpoint de carta de correção para o modelo ' . $modelo);
        }

        $json = json_encode((array) $corrigirReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[CCE_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlCCe, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[CCE_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function corrigirDocumentoESalvar($modelo, $corrigirReq, $downloadEventoReq, $caminho, $chave, $nSeqEvento, $exibeNaTela)
    {
        $resposta = $this->corrigirDocumento($modelo, $corrigirReq);
        $status = $resposta['status'];

        if ($status == 200) {
            $respostaDownloadEvento = $this->downloadEventoESalvar($modelo, $downloadEventoReq, $caminho, $chave, $nSeqEvento, $exibeNaTela);
        }
        return $resposta;
    }

    public function inutilizarNumeracao($modelo, $inutilizarReq)
    {

        switch ($modelo) {

            case '57':
                $urlInutilizacao = $this->endpoints->CTeInutilizacao;
                break;

            case '65':
                $urlInutilizacao = $this->endpoints->NFCeInutilizacao;
                break;

            case '55':
                $urlInutilizacao = $this->endpoints->NFeInutilizacao;
                break;

            default:
                throw new Exception('Não definido endpoint de inutilização para o modelo ' . $modelo);
        }

        $json = json_encode((array) $inutilizarReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[INUTILIZAR_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlInutilizacao, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[INUTILIZAR_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function inutilizarNumeracaoESalvar($modelo, $inutilizarReq, $caminho)
    {
        $resposta = $this->inutilizarNumeracao($modelo, $inutilizarReq);
        $status = $resposta['status'];
        $xml = null;

        if ($status == 102 || $status == 200) {

            $cStat = $resposta['retornoInutNFe']['cStat'];

            if ($cStat == 102) {

                switch ($modelo) {

                    case '57':
                        $xml = $resposta['retornoInutCTe']['xmlInut'];
                        $chave = $resposta['retornoInutCTe']['chave'];
                        $nome = $chave . '-inutCTe';
                        break;

                    case '65':
                        $xml = $resposta['retInutNFe']['xml'];
                        $chave = $resposta['retInutNFe']['chave'];
                        $nome = $chave . '-inutNFCe';
                        break;

                    case '55':
                        $xml = $resposta['retornoInutNFe']['xmlInut'];
                        $chave = $resposta['retornoInutNFe']['chave'];
                        $nome = $chave . '-inutNFe';
                        break;

                    default:
                        throw new Exception('Nao existe inutilização para este modelo ' . $modelo);
                }
            }
        } else {
            echo 'Ocorreu um erro ao inutilizar a numeração, veja o retorno da API para mais informações';
        }

        if ($xml != null) {
            if (strlen($caminho) > 0) if (!file_exists($caminho)) mkdir($caminho, true, 0777);
            if (substr($caminho, -1) != '/') $caminho = $caminho . '/';
            $this->genericos->salvaXML($xml, $caminho, $nome);
        }

        return $resposta;
    }

    public function consultarCadastroContribuinte($modelo, $consCadReq)
    {

        switch ($modelo) {
            case '57':
                $urlConsCad = $this->endpoints->CTeConsCad;
                break;

            case '55':
                $urlConsCad = $this->endpoints->NFeConsCad;
                break;

            default:
                throw new Exception('Não definido endpoint de consulta de cadastro para o modelo ' . $modelo);
        }

        $json = json_encode((array) $consCadReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[CONS_CAD_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlConsCad, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[CONS_CAD_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function consultarSituacaoDocumento($modelo, $consSitReq)
    {
        switch ($modelo) {
            case '63':
                $urlConsSit = $this->endpoints->BPeConsSit;
                break;

            case '57':
            case '67':
                $urlConsSit = $this->endpoints->CTeConsSit;
                break;

            case '58':
                $urlConsSit = $this->endpoints->MDFeConsSit;
                break;

            case '65':
                $urlConsSit = $this->endpoints->NFCeConsSit;
                break;

            case '55':
                $urlConsSit = $this->endpoints->NFeConsSit;
                break;

            default:
                throw new Exception('Não definido endpoint de consulta de situação para o modelo ' . $modelo);
        }

        $json = json_encode((array) $consSitReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[CONS_SIT_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlConsSit, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[CONS_SIT_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function listarNSNRecs($modelo, $listarNSNRecReq)
    {

        switch ($modelo) {
            case '57':
            case '67':
                $urlListarNSNRecs = $this->endpoints->CTeListarNSNRecs;
                break;

            case '58':
                $urlListarNSNRecs = $this->endpoints->MDFeListarNSNRecs;
                break;

            case '55':
                $urlListarNSNRecs = $this->endpoints->NFeListarNSNRecs;
                break;

            default:
                throw new Exception('Não definido endpoint de listagem de nsNRec para o modelo ' . $modelo);
        }

        $json = json_encode((array) $listarNSNRecReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[LISTAR_NSNRECS_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlListarNSNRecs, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[LISTAR_NSNRECS_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }

    public function enviarEmailDocumento($modelo, $enviarEmailReq)
    {
        switch ($modelo) {
            case '65':
                $urlEnviarEmail = $this->endpoints->NFCeEnvioEmail;
                break;

            case '55':
                $urlEnviarEmail = $this->endpoints->NFeEnvioEmail;
                break;

            default:
                throw new Exception('Não definido endpoint de envio de e-mail para o modelo ' . $modelo);
        }

        $json = json_encode((array) $enviarEmailReq, JSON_UNESCAPED_UNICODE);

        $this->genericos->gravarLinhaLog($modelo, '[ENVIO_EMAIL_DADOS]');
        $this->genericos->gravarLinhaLog($modelo, $json);

        $resposta = $this->enviaConteudoParaAPI($json, $urlEnviarEmail, 'json');

        $this->genericos->gravarLinhaLog($modelo, '[ENVIO_EMAIL_RESPOSTA]');
        $this->genericos->gravarLinhaLog($modelo, json_encode($resposta));

        return $resposta;
    }
}
