<?php

namespace App\Controller;

use App\Entity\Formularz;
use App\Entity\Korekta;
use App\Entity\Podgrupa;
use App\Entity\Podsumowanie;
use App\Entity\Builder;
use App\Form\FormularzType;
use App\Form\BuilderType;

use App\Repository\CzatRepository;
use App\Repository\FormularzRepository;
use App\Repository\JednostkaRepository;
use App\Repository\PodgrupaRepository;

use App\Repository\WiadomoscRepository;
use App\Repository\ZestawienieRepository;

use App\Service\FormularzService;
use App\Service\PrzeliczanieService;
use App\Service\ZestawienieService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ZestawienieController extends AbstractController
{
    private $zestawienieService;
    private $security;
    private $jednostkaRepository;
    private $formularzRepository;
    private $entityManager;
    private $formularzService;

    public function __construct(
        FormularzService $formularzService,
        Security $security,
        EntityManagerInterface $entityManager,
        JednostkaRepository $jednostkaRepository,
        FormularzRepository $formularzRepository,
        ZestawienieService $zestawienieService
    )
    {
        $this->zestawienieService = $zestawienieService;
        $this->security = $security;
        $this->security = $security;
        $this->jednostkaRepository = $jednostkaRepository;
        $this->formularzRepository = $formularzRepository;
        $this->entityManager = $entityManager;
        $this->formularzService = $formularzService;
    }

    /**
     * @Route("/zestawienia/todo", name="zestawienia_todo")
     */
    public function todo()
    {
        $formularze = $this->zestawienieService->displayToDoForms();
        return $this->render("zestawienie/todo.html.twig", [
            'formularze' => $formularze
        ]);
    }

    /**
     * @Route("/zestawienie/dashboard/{id}", name="zestawienie_dashboard")
     */
    public function dashboard($id)
    {
        $formularz = $this->formularzService->getFormularz($id);
        $korekty   = $this->formularzService->getKorekty($formularz);
        $archiwum  = $this->formularzService->getArchiwum($formularz);
        $grupy     = $this->formularzService->getGrupy();
        $podgrupy = $this->formularzService->getPodgrupyDlaKorekt($id);

        return $this->render("zestawienie/dashboard.html.twig", [
            'formularz' => $formularz,
            'korekty' => $korekty,
            'archiwum' => $archiwum,
            'grupy' => $grupy,
            'podgrupy' => $podgrupy,
            'zakladka' => "dashboard"
        ]);
    }

    /**
     * @Route("/zestawienie/dashboard/{id}/messages", name="zestawienie_dashboard_messages")
     */
    public function messages($id)
    {
        $formularz = $this->formularzService->getFormularz($id);
        $korekty   = $this->formularzService->getKorekty($formularz);
        $archiwum  = $this->formularzService->getArchiwum($formularz);
        $grupy     = $this->formularzService->getGrupy();
        $podgrupy = $this->formularzService->getPodgrupyDlaKorekt($id);

        return $this->render("zestawienie/dashboard/v2/messages.html.twig", [
            'formularz' => $formularz,
            'korekty' => $korekty,
            'archiwum' => $archiwum,
            'grupy' => $grupy,
            'podgrupy' => $podgrupy,
            'zakladka' => "messages"
        ]);
    }

    /**
     * @Route("/zestawienie/item/message/{id}", name="zestawienie_dashboard_message_box")
     */
    public function messageBox($id, CzatRepository $czatRepository, WiadomoscRepository $wiadomoscRepository)
    {
        $chat = $czatRepository->findOneBy(['identyfikator' => $id]);
//        $messages = $wiadomoscRepository->findBy([
//
//        ]);


        $formularz = $this->formularzService->getFormularz(6);
//        $korekty   = $this->formularzService->getKorekty($formularz);
//        $archiwum  = $this->formularzService->getArchiwum($formularz);
//        $grupy     = $this->formularzService->getGrupy();
//        $podgrupy = $this->formularzService->getPodgrupyDlaKorekt($id);

        return $this->render("zestawienie/dashboard/v2/message_box.html.twig", [
            'formularz' => $formularz,
        ]);
    }

    /**
     * @Route("/zestawienie/dashboard/{id}/corrects", name="zestawienie_dashboard_corrects")
     */
    public function corrects($id)
    {
        $formularz = $this->formularzService->getFormularz($id);
        $korekty   = $this->formularzService->getKorekty($formularz);
        $archiwum  = $this->formularzService->getArchiwum($formularz);
        $grupy     = $this->formularzService->getGrupy();
        $podgrupy = $this->formularzService->getPodgrupyDlaKorekt($id);

        return $this->render("zestawienie/dashboard/v2/corrects.html.twig", [
            'formularz' => $formularz,
            'korekty' => $korekty,
            'archiwum' => $archiwum,
            'grupy' => $grupy,
            'podgrupy' => $podgrupy,
            'zakladka' => "corrects"
        ]);
    }

    /**
     * @Route("/zestawienie/dashboard/{id}/history", name="zestawienie_dashboard_history")
     */
    public function history($id)
    {
        $formularz = $this->formularzService->getFormularz($id);
        $korekty   = $this->formularzService->getKorekty($formularz);
        $archiwum  = $this->formularzService->getArchiwum($formularz);
        $grupy     = $this->formularzService->getGrupy();
        $podgrupy = $this->formularzService->getPodgrupyDlaKorekt($id);

        return $this->render("zestawienie/dashboard/v2/history.html.twig", [
            'formularz' => $formularz,
            'korekty' => $korekty,
            'archiwum' => $archiwum,
            'grupy' => $grupy,
            'podgrupy' => $podgrupy,
            'zakladka' => "history"
        ]);
    }

    /**
     * @Route("/zestawienie/dashboard/{id}/settings", name="zestawienie_dashboard_settings")
     */
    public function settings($id)
    {
        $formularz = $this->formularzService->getFormularz($id);
        $korekty   = $this->formularzService->getKorekty($formularz);
        $archiwum  = $this->formularzService->getArchiwum($formularz);
        $grupy     = $this->formularzService->getGrupy();
        $podgrupy = $this->formularzService->getPodgrupyDlaKorekt($id);

        return $this->render("zestawienie/dashboard/v2/settings.html.twig", [
            'formularz' => $formularz,
            'korekty' => $korekty,
            'archiwum' => $archiwum,
            'grupy' => $grupy,
            'podgrupy' => $podgrupy,
            'zakladka' => "settings"
        ]);
    }

    /**
     * @Route("/zestawienia/dashboards/{form}/{id}", name="zestawienia_dashboards")
     */
    public function zestawieniaArchiwum($form, $id)
    {
        $jednostka  = $this->jednostkaRepository->find($id);
        $formularze = $this->formularzRepository->findBy(['jednostka' => $jednostka], ['rokZestawieniowy' => 'DESC']);

        return $this->render("zestawienie/archiwum.html.twig", [
            'id' => $id,
            'jednostka' => $jednostka,
            'formularze' => $formularze,
            'form' => $form
        ]);
    }

    /**
     * @Route("/zestawienie/create", name="zestawienie_create")
     */
    public function create(Request $request)
    {
        $formularz = new Formularz();
        $form = $this->createForm(FormularzType::class, $formularz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formularz = $form->getData();
            $this->zestawienieService->save($formularz);
            $this->zestawienieService->delay(2);
            $this->addFlash("success", "Wygenerowano nowe zestawienie!");
            return $this->redirectToRoute('zestawienie_estimate', ['id' => $formularz->getId()]);
        }

        return $this->render("zestawienie/create.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/zestawienie/estimates/{id}", name="zestawienie_estimate")
     */
    public function estimate(Request $request, $id, ZestawienieRepository $zestawienieRepository, PodgrupaRepository $podgrupaRepository)
    {
        $formularz = $this->formularzService->getFormularz($id);
        $zestawienia = $zestawienieRepository->findByTableOfGroups($formularz);

        $podgrupy = $this->getDoctrine()->getRepository(Podgrupa::class)->findBy(['status' => 1], ['kolejnosc' => 'ASC']);
        $podsumowanie =  $this->getDoctrine()->getRepository(Podsumowanie::class)->findOneBy([
            'formularz' => $formularz
        ]);

        $builder = new Builder();
        for($i=0; $i < count($zestawienia['zestawienia']); $i++) {
            $builder->getZestawienia()->add($zestawienia['zestawienia'][$i]);
        }
        $builder->getPodsumowanie()->add($podsumowanie);
        $factory = $this->createForm(BuilderType::class, $builder);
        $factory->handleRequest($request);

        if ($factory->isSubmitted() && $factory->isValid()) {
            $builder = $factory->getData();

            foreach($builder as $build) {
                $this->entityManager->persist($build->getDane());
            }
            $this->entityManager->flush();

            $this->addFlash("success", "Dane zostały zapisane poprawnie.");
            return $this->redirectToRoute('zestawienie_dashboard', ['id' => $formularz->getId()]);
        }

        return $this->render("zestawienie/estimate.html.twig", [
            'formularz' => $formularz,
            'form' => $factory->createView(),
            'podgrupa' => $podgrupaRepository->findByPodgrupaActivated(),
            'podgrupy' => count($podgrupy)
        ]);
    }

    /**
     * @Route("/zestawienia/progress", name="zestawienia_progress")
     */
    public function progress()
    {
        $formularze = $this->zestawienieService->displayInAcceptForms();
        return $this->render("zestawienie/progress.html.twig", [
            'formularze' => $formularze
        ]);
    }

    /**
     * @Route("/zestawienia/done", name="zestawienia_done")
     */
    public function done()
    {
        $formularze = $this->zestawienieService->displayDoneForms();
        return $this->render("zestawienie/done.html.twig", [
            'formularze' => $formularze
        ]);
    }

    /**
     * @Route("/zestawienie/delete/{id}", name="zestawienie_delete")
     */
    public function delete($id)
    {
        $formularz = $this->getDoctrine()->getRepository(Formularz::class)->find($id);
        $this->zestawienieService->remove($formularz);
        return $this->json(["message" => "Formularz został usunięty"]);
    }

    /**
     * @Route("/zestawienie/get-item/kikum/{id}", name="zestawienie_get_item_kikum")
     */
    public function getItemFromKikum($id)
    {
        return $this->json(["message" => "Zestawienie dla podgrupy zostało załadowane"]);
    }

    /**
    * @Route("/zestawienie/math-calc-all", name="zestawienie_math_calc_all")
    */
    public function przeliczZestawienie(Request $request, PrzeliczanieService $przeliczanieService)
    {
        $data = $przeliczanieService->przeliczCalosc($request);

        return $this->json([
            "data" => $data,
            "message" => "Przeliczono dane dla wszystkich podgrup."
        ]);
    }

    /**
     * @Route("/zestawienie/korekta/get", name="get_korekta")
     */
    public function getKorekta(Request $request)
    {
        $data = [];

        $formularz = $request->request->get('formularz');
        $podgrupa  = $request->request->get('podgrupa');

        if($podgrupa !== "0") {
            $dane = $this->zestawienieService->findZestawienie($formularz, $podgrupa);
            $data['podgrupa'] = $dane['zestawienie']->getWartoscRokZestawieniowy();
            $data['wartosc'] = $dane['podsumowanie']->getSumaRokBiezacy();
        }

        return $this->json([
            "data" => $data,
            "message" => "Dane zostały poprawnie załadowane"
        ]);
    }

    /**
     * @Route("/zestawienie/korekta/post", name="post_korekta")
     */
    public function postKorekta(Request $request)
    {
        $this->zestawienieService->zapiszKorekte($request);
        return $this->json([
            "message" => "Dane zostały poprawnie zapisane"
        ]);
    }

    /**
     * @Route("/zestawienie/korekta/delete", name="delete_korekta")
     */
    public function deleteKorekta(Request $request)
    {
        $this->zestawienieService->usunKorekte($request);


        return $this->json([
            "message" => "Korekta została usunięta z bazy"
        ]);
    }


}