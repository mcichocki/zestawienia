<?php

namespace App\Service\PDFs;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UnitPdfFile extends AbstractController
{
    public function generateUnitPDF($formularz)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('defaults/pdf.html.twig', [
            'formularz' => $formularz
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Stan Mienia - ".$formularz->getJednostka()->getNazwa()." (".$formularz->getRokZestawieniowy()->getRok().")".".pdf", [
            "Attachment" => true
        ]);
    }
}