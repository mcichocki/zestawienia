<?php

namespace App\Controller;

use App\Entity\ImportFile;
use League\Csv\Reader;
use App\Entity\Jednostka;
use App\Form\ImportFileType;
use App\Repository\DzielnicaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadController extends AbstractController
{
    private $dzielnicaRepository;

    public function __construct(DzielnicaRepository $dzielnicaRepository)
    {
        $this->dzielnicaRepository = $dzielnicaRepository;
    }

    /**
     * @Route("/upload/csv", name="upload_csv")
     */
    public function uploadCSV(Request $request, SluggerInterface $slugger)
    {
        $file = new ImportFile();
        $form = $this->createForm(ImportFileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file_CSV = $form->get('plik')->getData();           

            if($file_CSV) {
                $originalFilename = pathinfo($file_CSV->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file_CSV->guessExtension();

                try {
                    $x = $file_CSV->move(
                        $this->getParameter('file_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $file->setPlik($newFilename);
                
                $entityManager = $this->getDoctrine()->getManager();


                $reader = Reader::createFromPath($this->getParameter('file_directory')."/".$newFilename);
                
                $reader->setDelimiter(',');
                $reader->setHeaderOffset(0);
                $results = $reader->getRecords();

                foreach ($results as $row) {
                    $jednostka = new Jednostka();
                    $jednostka->setNazwa($row['jdn_nazwa']);
                    $jednostka->setUlica($row['jdn_ulica']);
                    $jednostka->setNumer($row['jdn_nr_bud']);
                    $jednostka->setKodPocztowy($row['jdn_kod_pocztowy']);
                    $jednostka->setIdentyfikator((int)$row['jdn_id']);
                    $jednostka->setMiasto("Warszawa");
                    $jednostka->setNazwaPelna($row['jdn_nazwa_pelna']);
                    $jednostka->setSymbol($row['jdn_symbol']);
                    $jdn = ($row['jdn_jdn_id'] == "NULL") ? null : (int)$row['jdn_jdn_id'];  
                    $dn = $this->dzielnicaRepository->findOneBy(['identyfikator' => $jdn]);
                    $new = ($dn) ? $dn : null;
                    $jednostka->setUrzadID($jdn);
                    $jednostka->setDzielnica($new);
                    $entityManager->persist($jednostka);
                }          
                $entityManager->flush();
            }

            $this->addFlash('success', 'Dane zostały zaimportowane pomyślnie!');
            return $this->redirectToRoute("redirect_route");
        }

        return $this->render("uploads/csv.html.twig", [
            'form' => $form->createView()
        ]);
    }
}