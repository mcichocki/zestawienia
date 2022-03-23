<?php

namespace App\Controller;

use App\Repository\FormularzRepository;
use App\Service\PDFs\UnitPdfFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{

    /**
     * @Route("/docs/v1p/pdf/{id}", name="docs_v1p_pdf")
     */
    public function docsPDF($id, UnitPdfFile $pdfFile, FormularzRepository $formularzRepository)
    {
        $formularz = $formularzRepository->exportPDF($id);
        $pdfFile->generateUnitPDF($formularz);
        return new Response(null, 204);
    }
}