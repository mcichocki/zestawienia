<?php

namespace App\Controller;

use App\Repository\RokZestawieniowyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DefaultController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function userRoles()
    {
        $roles = $this->security->getUser()->getRoles()[0];
        return $roles;
    }

    /**
     * @Route("/", name="redirect_route")
     */
    public function index()
    {
        $role = $this->userRoles();

        switch($role) 
        {
            case "ROLE_WORKER":
                return $this->redirectToRoute('worker_index');
            case "ROLE_SUPERVISOR": 
                return $this->redirectToRoute('supervisor_index');
            case "ROLE_MANAGER": 
                return $this->redirectToRoute('manager_index');
            case "ROLE_ADMIN":
                return $this->redirectToRoute('admin_index');
            case "ROLE_SUPER_ADMIN":
                return $this->redirectToRoute('su_admin');
        }
        return '';
    }

    /**
     * @Route("/settings/default", name="settings_default")
     */
    public function settingsDefault(RokZestawieniowyRepository $rokZestawieniowyRepository)
    {
        $rok = ($rokZestawieniowyRepository->getRokZestawieniowy()) ? $rokZestawieniowyRepository->getRokZestawieniowy()->getRok() : "b.d.";
        return $this->json($rok);
    }

    /**
     * @Route("/search", name="search_default")
     */
    public function search(Request $request)
    {
        $search = $request->request->get('search');
//        dump($search);

        return $this->render("defaults/search.html.twig");
    }
}
