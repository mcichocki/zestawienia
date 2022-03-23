<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends AbstractController
{
    /**
     * @Route("/docs/v1e/excel/{id}", name="docs_v1e_excel")
     */
    public function zestawienieExcel($id)
    {

    }

    /**
     * @Route("/generate-month-excel/{id}", name="generate_month_excel")
     */
    public function exportToMonthExcel($id)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $sheet->setTitle("My First Worksheet");

        $writer = new Xlsx($spreadsheet);

        $fileName = 'my_first_excel_symfony4.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/generate-year-excel/{id}", name="generate_year_excel")
     */
    public function exportToYearExcel($id)
    {

    }

    /**
     * @Route("/generate-group-excel/{id}", name="generate_group_excel")
     */
    public function exportToGroupExcel($id)
    {

    }
}