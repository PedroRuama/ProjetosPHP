<?php
include __DIR__ . '/src/Layouts/NFe/NFeJSON.php';
include __DIR__ . '/src/NSSuite.php';

$NSSuite = new NSSuite;
$NFeJSON = new NFeJSON;
$nfe = new NFe;
$infNFe = new InfNFe;
$ide = new Ide;
$emit = new Emit;
$enderEmit = new EnderEmit;
$dest = new Dest;
$enderDest = new EnderDest;
$det = array();
$detAux = new Det;
$det[] = $detAux;
$prod = new Prod;
$imposto = new Imposto;
$icms = new ICMS;
$icmssn102 = new ICMSSN102;
$ipi = new IPI;
$ipint = new IPINT;
$pis = new PIS;
$pisAliq = new PISAliq;
$cofins = new COFINS;
$cofinsAliq = new COFINSAliq;
$total = new Total;
$icmsTot = new IcmsTot;
$transp = new Transp;
$pag = new Pag;
$detPag = array();
$detPagAux = new Detpag;
$detPag[] = $detPagAux;
$infAdic = new InfAdic;

$NFeJSON->NFe = $nfe;
$nfe->infNFe = $infNFe;
$infNFe->versao = "4.00";

$infNFe->ide = $ide;
$ide->cUF = "43";
$ide->cNF = "";
$ide->natOp = "VENDA A PRAZO - SEM VALOR FISCAL";
$ide->mod = "55";
$ide->serie = "99";
$ide->nNF = "12";
$ide->dhEmi = "2022-07-20T14:13:00-03:00";
$ide->tpNF = "1";
$ide->idDest = "1";
$ide->cMunFG = "4305108";
$ide->tpImp = "1";
$ide->tpEmis = "1";
$ide->cDV = "6";
$ide->tpAmb = "2";
$ide->finNFe = "1";
$ide->indFinal = "0";
$ide->indPres = "0";
$ide->indIntermed = "0";
$ide->procEmi = "0";
$ide->verProc = "4.00";

$infNFe->emit = $emit;
$emit->CNPJ = "07364617000135";
$emit->xNome = "NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL";
$emit->IE = "017108078";
$emit->CRT = "1";
 
// $emit->enderEmit = $enderEmit;
$enderEmit->xLgr = "Rua Bento Osvaldo Trisch";
$enderEmit->nro = "777";
$enderEmit->xCpl = "CX POSTAL 91";
$enderEmit->xBairro = "Pendanсino";
$enderEmit->cMun = "4305109";
$enderEmit->xMun = "Caxias do Sul";
$enderEmit->UF = "RS";
$enderEmit->CEP = "95460000";
$enderEmit->fone = "5432202000";

$infNFe->dest = $dest;
$dest->CNPJ = "07364617000135";
$dest->xNome = "NF-E EMITIDA EM AMBIENTE DE HOMOLOGACAO - SEM VALOR FISCAL";
$dest->IE = "017108078";
$dest->indIEDest = "1";
$dest->email = "fernando.konflanz@nstecnologia.com.br";

$dest->enderDest = $enderDest;
$enderDest->xLgr = "AV ANTONIO DURO";
$enderDest->nro = "0";
$enderDest->xBairro = "OLARIA";
$enderDest->cMun = "4303509";
$enderDest->xMun = "Camaquã";
$enderDest->UF = "RS";
$enderDest->CEP = "96180000";
$enderDest->cPais = "1058";
$enderDest->xPais = "BRASIL";


$infNFe->det = $det;
$detAux->nItem = 1;
$detAux->prod = $prod;
$prod->cEAN = "SEM GTIN";
$prod->cEANTrib = "SEM GTIN";
$prod->cProd = "123456789";
$prod->xProd = "COCA-COLA LT 250 ML";
$prod->NCM = "22021000";
$prod->CEST = "0300100";
$prod->CFOP = "5101";
$prod->uCom = "UN";
$prod->qCom = "1.0000";
$prod->vUnCom = "3.00";
$prod->vProd = "3.00";
$prod->uTrib = "UN";
$prod->qTrib = "1.0000";
$prod->vUnTrib = "3.00";
$prod->indTot = "1";
$prod->nItemPed = "0";

$detAux->imposto = $imposto;

$imposto->ICMS = $icms;
$icms->ICMSSN102 = $icmssn102;
$icmssn102->orig = "0";
$icmssn102->CSOSN = "102";

$imposto->IPI = $ipi;
$ipi->cEnq = "999";
$ipi->IPINT = $ipint;
$ipint->CST = "53";

$imposto->PIS = $pis;
$pis->PISAliq = $pisAliq;
$pisAliq->CST = "01";
$pisAliq->vBC = "3.00";
$pisAliq->pPIS = "1.65";
$pisAliq->vPIS = "0.05";

$imposto->COFINS = $cofins;
$cofins->COFINSAliq = $cofinsAliq;
$cofinsAliq->CST = "01";
$cofinsAliq->vBC = "3.00";
$cofinsAliq->pCOFINS = "7.00";
$cofinsAliq->vCOFINS = "0.21";

$infNFe->total = $total;
$icmsTot->vBC = "0.00";
$icmsTot->vICMS = "0.00";
$icmsTot->vICMSDeson = "0.00";
$icmsTot->vFCPUFDest = "0.00";
$icmsTot->vICMSUFDest = "0.00";
$icmsTot->vICMSUFRemet = "0.00";
$icmsTot->vFCP = "0.00";
$icmsTot->vBCST = "0.00";
$icmsTot->vST = "0.00";
$icmsTot->vFCPST = "0.00";
$icmsTot->vFCPSTRet = "0.00";
$icmsTot->vProd = "3.00";
$icmsTot->vFrete = "0.00";
$icmsTot->vSeg = "0.00";
$icmsTot->vDesc = "0.00";
$icmsTot->vII = "0.00";
$icmsTot->vIPI = "0.00";
$icmsTot->vIPIDevol = "0.00";
$icmsTot->vPIS = "0.05";
$icmsTot->vCOFINS = "0.21";
$icmsTot->vOutro = "0.00";
$icmsTot->vNF = "3.00";
$icmsTot->vTotTrib = "0.00";

$total->ICMSTot = $icmsTot;
$infNFe->transp = $transp;
$transp->modFrete = "9";
$infNFe->pag = $pag;
$pag->detPag = $detPag;
$detPagAux->tPag = "16";
$detPagAux->vPag = "5.00";
$detPag[1] = $detPagAux;

$pag->vTroco = "2.00";

$infNFe->infAdic = $infAdic;
$infAdic->infCpl = "DESCONTO PIS 8,61 COFINS 6,86 LEI 11.196 DE 21/11/2005";

$conteudo = json_encode($NFeJSON, JSON_UNESCAPED_UNICODE);
$tpConteudo = "json";
$cnpjEmit = "87364617000135";
$tpDown = "XP";
$tpAmb = "2";
$caminho = "./Notas";
$exibeNaTela = true;

$retorno = $NSSuite->emitirNFeSincrono($conteudo, $tpConteudo, $cnpjEmit, $tpDown, $tpAmb, $caminho, $exibeNaTela);
// echo "<script type='javascript'>alert('Email enviado com sucesso!') ";
$retorno = json_decode($retorno, true);
var_dump($retorno);


?> 