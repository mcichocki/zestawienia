<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReactController extends AbstractController
{
    /**
     * @Route("/react/app", name="react_app")
     */
    public function reactApp()
    {
        return $this->render("react/react_app.html.twig");
    }

    public function getData()
    {
        $data = [
            [
                "imie" => "jan",
                "nazwisko" => "kowalski",
                "wiek" => 24
            ],
            [
                "imie" => "michał",
                "nazwisko" => "wiśniewski",
                "wiek" => 46
            ]
        ];
        return $this->json($data, 200);
    }

    /**
     * @Route("/react/api-users/post", name="react_api_users_post")
     */
    public function postApiUsersData(Request $request)
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        $firstName = $data['firstName'];
        $lastName  = $data['lastName'];
        $os_system = $data['sysOp'];

        $datas = [
            [
                'id' => 1,
                'firstName' => "Janek",
                'lastName' => 'Wiśniewski',
                'sysOp' => 'windows'
            ],
            [
                'id' => 2,
                'firstName' => "Marcin",
                'lastName' => 'Wojdat',
                'sysOp' => 'linux'
            ],
            [
                'id' => 3,
                'firstName' => "Robert",
                'lastName' => 'Patos',
                'sysOp' => 'macos'
            ],
        ];

        $datas[] = [
            'id' => 4,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'sysOp' => $os_system
        ];

        return $this->json($datas);
    }

    /**
     * @Route("/react/api-users/get", name="react_api_users_get")
     */
    public function getApiUsersData()
    {
        $datas = [
            [
                'id' => 1,
                'firstName' => "Janek 1",
                'lastName' => 'Wiśniewski',
                'sysOp' => 'windows'
            ],
            [
                'id' => 2,
                'firstName' => "Marcin 1",
                'lastName' => 'Wojdat',
                'sysOp' => 'linux'
            ],
            [
                'id' => 3,
                'firstName' => "Robert 1",
                'lastName' => 'Patos',
                'sysOp' => 'macos'
            ],
        ];

        return $this->json($datas);
    }
}