<?php

namespace App\Controller;

use App\Entity\Uzytkownik;
use App\Form\UzytkownikType;
use App\Service\Permissions\User;
use App\Repository\UzytkownikRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UzytkownikController extends AbstractController
{
    use User;

    private $em;
    private $uzytkownikRepository;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $em, UzytkownikRepository $uzytkownikRepository, UserPasswordHasherInterface $passwordHasher)
    {
        $this->em = $em;
        $this->uzytkownikRepository = $uzytkownikRepository;
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @Route("/uzytkownicy/index", name="uzytkownicy_index")
     */
    public function index()
    {
        return $this->render("uzytkownicy/index.html.twig");
    }

    /**
     * @Route("/uzytkownicy/view/{id}", name="uzytkownicy_view")
     */
    public function view($id)
    {
        $user = $this->uzytkownikRepository->find($id);
        return $this->render("uzytkownicy/view.html.twig", [
            'uzytkownik' => $user
        ]);
    }

    /**
     * @Route("/uzytkownicy/create", name="uzytkownicy_create")
     */
    public function create(Request $request)
    {
        $uzytkownik = new Uzytkownik();
    
        $form = $this->createForm(UzytkownikType::class, $uzytkownik, [
            'state' => 'create'
        ]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $uzytkownik = $form->getData();

            if($uzytkownik->getCzyDomenowy() == 0)
                $uzytkownik->setPassword($this->passwordHasher->hashPassword($uzytkownik, '1234'));
            else
                $uzytkownik->setPassword($this->passwordHasher->hashPassword($uzytkownik, 'F0xGr23x03ab2'));
            
            $this->em->persist($uzytkownik);
            $this->em->flush();

            $this->addFlash("success", "Dodano uzytkownika do bazy danych!");
            return $this->redirectToRoute('uzytkownicy_index');
        }

        return $this->render("uzytkownicy/create.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/uzytkownicy/edit/{id}", name="uzytkownicy_edit")
     */
    public function edit(Request $request, $id)
    {   
        $uzytkownik = $this->em->getRepository(Uzytkownik::class)->find($id);

        $form = $this->createForm(UzytkownikType::class, $uzytkownik, [
            'state' => 'edit'
        ]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $uzytkownik = $form->getData();

            if($uzytkownik->getCzyDomenowy() == 0) 
                $uzytkownik->setPassword($this->passwordHasher->hashPassword($uzytkownik, '1234'));
            else
                $uzytkownik->setPassword($this->passwordHasher->hashPassword($uzytkownik, 'F0xGr23x03ab2'));
            
            $this->em->persist($uzytkownik);
            $this->em->flush();

            $this->addFlash("success", "Edycja użytkownika przebiegła pomyślnie!");
            return $this->redirectToRoute('uzytkownicy_index');
        }

        return $this->render("uzytkownicy/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/_api/get/uzytkownicy", name="api_users")
     */
    public function apiUsers(): Response
    {
        $users = $this->uzytkownikRepository->findAll();
        $array = [];
        
        for($i=0; $i<count($users); $i++) {
            $usr = [];
            $usr['id'][] = $users[$i]->getId();
            $usr['imie'][] = $users[$i]->getImie();
            $usr['nazwisko'][] = $users[$i]->getNazwisko();
            $usr['login'][] = $users[$i]->getLogin();
            $usr['rola'][] = $this->getNameofRole($users[$i]->getRoles()[0]);
            $usr['dzielnica'][] = (!is_null($users[$i]->getDzielnica())) ? $users[$i]->getDzielnica()->getNazwa() : "Brak danych";
            $usr['status'][] = $this->getStringOfActivity($users[$i]->getStatus());
            $array[] = $usr;

        }
        return $this->json(["data" => $array]);
    }

    /**
     * @Route("/uzytkownicy/disable-account", name="uzytkownicy_disable")
     */
    public function disableAccount(Request $request)
    {
        $id = $request->request->get('id');
        $user = $this->uzytkownikRepository->find($id);
        $user->setStatus(0);
        $this->em->persist($user);
        $this->em->flush();

        return $this->json([
            'message' => "Konto użytkownika zostało wyłączone."
        ]);
    }
}
