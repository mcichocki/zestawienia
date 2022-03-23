<?php

namespace App\Service;

use App\Entity\Formularz;
use App\Entity\Grupa;
use App\Entity\Korekta;
use App\Entity\Podgrupa;
use App\Entity\Podsumowanie;
use App\Entity\RokZestawieniowy;
use App\Entity\Zestawienie;

class ZestawienieService extends BaseService
{
    public function renderDataToView($id)
    {
        return $this->getEntityManager()->getRepository(Formularz::class)->find($id);
    }

    public function getPodgrupy()
    {
        return $this->getEntityManager()->getRepository(Podgrupa::class)->findByPodgrupaActivated();
    }

    public function getGrupy()
    {
        return $this->getEntityManager()->getRepository(Grupa::class)->getGroupsByStatus();
    }

    public function getRokZestawieniowy()
    {
        return $this->getEntityManager()->getRepository(RokZestawieniowy::class)->findOneBy(array('status' => 1));
    }

    public function displayToDoForms()
    {
        $formularze = [];

        switch($this->getRole())
        {
            case "ROLE_WORKER":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsToDoForWorker($this->getUser());
                break;
            case "ROLE_SUPERVISOR":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsToDoForSupervisor($this->getUser());
                break;
            case "ROLE_MANAGER":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsToDoForManager($this->getUser());
                break;
        }
        return $formularze;
    }

    public function displayInAcceptForms()
    {
        $formularze = [];

        switch($this->getRole())
        {
            case "ROLE_WORKER":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsInAcceptForWorker($this->getUser());
                break;
            case "ROLE_SUPERVISOR":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsInAcceptForSupervisor($this->getUser());
                break;
            case "ROLE_MANAGER":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsInAcceptForManager($this->getUser());
                break;
        }
        return $formularze;
    }

    public function displayDoneForms()
    {
        $formularze = [];

        switch($this->getRole())
        {
            case "ROLE_WORKER":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsDoneForWorker($this->getUser());
                break;
            case "ROLE_SUPERVISOR":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsDoneForSupervisor($this->getUser());
                break;
            case "ROLE_MANAGER":
                $formularze = $this->getEntityManager()->getRepository(Formularz::class)->findFormsDoneForManager($this->getUser());
                break;
        }
        return $formularze;
    }

    public function findZestawienie($formularz, $podgrupa)
    {
        $data = [];

         $podsumowanie = $this->getEntityManager()->getRepository(Podsumowanie::class)->findOneby(['formularz' => $formularz]);
         $zestawienie = $this->getEntityManager()->getRepository(Zestawienie::class)->findOneBy([
            'formularz' => $formularz,
            'podgrupa'  => $podgrupa
        ]);

        return $data = [
            'zestawienie' => $zestawienie,
            'podsumowanie' => $podsumowanie
        ];
    }

    public function zapiszKorekte($request)
    {
        $formularz_id = $request->request->get('formularz');
        $podgrupa_id = $request->request->get('podgrupa');
        $wartosc_podgrupy = $request->request->get('wartosc_podgrupy');
        $wartosc_zestawienia = $request->request->get('wartosc_zestawienia');
        $nowa_wartosc = $request->request->get('nowa_wartosc');
        $komentarz = $request->request->get('komentarz');
        $nowa_suma = $request->request->get('nowa_suma');


        $formularz = $this->getEntityManager()->getRepository(Formularz::class)->find($formularz_id);
        $zestawienie = $this->getEntityManager()->getRepository(Zestawienie::class)->findOneBy([
            'formularz' => $formularz_id,
            'podgrupa'  => $podgrupa_id
        ]);

        $korekta = new Korekta();
        $korekta->setFormularz($formularz);
        $korekta->setAktualnaWartosc($wartosc_podgrupy);
        $korekta->setNowaWartosc($nowa_wartosc);
        $korekta->setZestawienie($zestawienie);
        $korekta->setInformacja($komentarz);
        $korekta->setWeryfikujacy($this->getUser());
        $korekta->setSuma($wartosc_zestawienia);
        $korekta->setNowaSuma($nowa_suma);
        $this->getEntityManager()->persist($korekta);
        $zestawienie->setKorekta($korekta);
        $this->getEntityManager()->persist($zestawienie);
        $this->getEntityManager()->flush();
    }

    public function usunKorekte($request)
    {
        $id = $request->request->get("korekta");
        $korekta = $this->getEntityManager()->getRepository(Korekta::class)->find($id);
        $zestawienie = $this->getEntityManager()->getRepository(Zestawienie::class)->findOneBy([
            'korekta' => $korekta
        ]);
        $zestawienie->setKorekta(NULL);
        $this->getEntityManager()->persist($zestawienie);
        $this->getEntityManager()->remove($korekta);
        $this->getEntityManager()->flush();
    }

}