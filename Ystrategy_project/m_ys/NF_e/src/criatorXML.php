<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

function xmlParaPDF($xmlPath, $outputPdfPath)
{
    // Verifica se o arquivo XML existe
    if (!file_exists($xmlPath)) {
        throw new Exception("Arquivo XML não encontrado: $xmlPath");
    }

    // Carrega o XML
    $xmlContent = file_get_contents($xmlPath);

    // Converte o XML para uma estrutura legível (HTML)
    $xml = new SimpleXMLElement($xmlContent);
    $htmlContent = '<h1>Nota Fiscal Eletrônica (NFe)</h1>';
    $htmlContent .= formatarXMLParaHTML($xml);

    // Instancia o Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'portrait'); // Tamanho e orientação do PDF
    $dompdf->render();

    // Salva o PDF no caminho especificado
    file_put_contents($outputPdfPath, $dompdf->output());

    // Exibe o PDF no navegador (opcional)
    header('Content-Type: application/pdf');
    echo $dompdf->output();
}

function formatarXMLParaHTML(SimpleXMLElement $xml, $level = 0)
{
    $html = '';
    foreach ($xml as $key => $value) {
        $padding = str_repeat('&nbsp;', $level * 4); // Recuo para aninhamento visual
        if ($value->count()) {
            // Elemento com filhos
            $html .= "<div>{$padding}<strong>{$key}</strong>:</div>";
            $html .= formatarXMLParaHTML($value, $level + 1);
        } else {
            // Elemento sem filhos
            $html .= "<div>{$padding}<strong>{$key}</strong>: " . htmlspecialchars((string)$value) . "</div>";
        }
    }
    return $html;
}

// Caminhos do XML e PDF
$xmlPath = __DIR__ . '/Notas/nfe_123456789.xml';
$outputPdfPath = __DIR__ . '/Notas/nfe_123456789.pdf';

// Chama a função para gerar o PDF
try {
    xmlParaPDF($xmlPath, $outputPdfPath);
    echo "PDF gerado com sucesso em: $outputPdfPath";
} catch (Exception $e) {
    echo "Erro ao gerar PDF: " . $e->getMessage();
}
?>