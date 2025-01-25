<?php

namespace App\Utils;
use Dompdf\Dompdf;
use Dompdf\Options;


//require 'vendor/autoload.php';


class DompdfUtil {
    public static function generatePDFSell($htmlContent, $data) {
        // Initialize Dompdf with options
        $filename = $data['filename'];
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $htmlContent = str_replace('{{ fechaGeneracion }}', $data['fechaGeneracion'], $htmlContent);
        $htmlContent = str_replace('{{ fechaInicio }}', $data['fechaInicio'], $htmlContent);
        $htmlContent = str_replace('{{ fechaFin }}', $data['fechaFin'], $htmlContent);
        $htmlContent = str_replace('{{ cantidadVentas }}', $data['cantidadVentas'], $htmlContent);
        $htmlContent = str_replace('{{ totalVentas }}', $data['totalVentas'], $htmlContent);
        $htmlContent = str_replace('{{ tablaContenido }}', $data['tablaContenido'], $htmlContent);
        // Load HTML content
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, array("Attachment" => true));
    }
}
?>