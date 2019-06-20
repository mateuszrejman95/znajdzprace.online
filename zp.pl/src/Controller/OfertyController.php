<?php

namespace App\Controller;

use App\Entity\Kategoria;
use App\Entity\Miasto;
use App\Entity\Oferta;
use App\Entity\Wojewodztwo;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * Class OfertyController
 * @package App\Controller
 * @ IsGranted("ROLE_ADMIN")
 */
class OfertyController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $ofertaManager;
    private $manager;
    private $session;

    /**
     * OfertyController constructor.
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->ofertaManager = $manager->getRepository(Oferta::class);
        $this->manager = $manager;

    }


    /**
     * @Route("/oferty", name="oferty")
     */
    public function showAll()
    {
        $oferty = $this->ofertaManager->findAll();
        //dd($oferty);
        return $this->render('oferty/index.html.twig', [
            'controller_name' => 'OfertyController',
            'oferty' => $oferty,
            'komunikat' => "",
        ]);
    }

    /**
     * @Route("/oferta/{id_oferta}", name="app_oferta")
     */
    public function showOffer ($id_oferta)
    {
        $oferta = $this->ofertaManager->find($id_oferta);

       // dd($oferta);
        return $this->render('oferty/oferta.html.twig', [
            'controller_name' => 'OfertaController',
            'oferta' => $oferta,
        ]);
    }

    /**
     * @Route("/oferty/city/{id_city}", name="app_oferta_by_city")
     */
    public function showByCity($id_city)
    {
        $cm = $this->manager->getRepository(Miasto::class);
        $city = $cm->find($id_city);
        $oferty = $city->getOferty();
        //dd($oferty);
        return $this->render('oferty/index.html.twig', [
            'controller_name' => 'OfertyController',
            'oferty' => $oferty,
            'komunikat' => 'Oferty dla miasta '.$city->getNazwa(),
        ]);
    }

    /**
     * @Route("/oferty/category/{id_category}", name="app_oferta_by_category")
     */
    public function showByCategory($id_category)
    {
        $cm = $this->manager->getRepository(Kategoria::class);
        $category = $cm->find($id_category);
        $oferty = $category->getOferty();
        //dd($oferty);
        return $this->render('oferty/index.html.twig', [
            'controller_name' => 'OfertyController',
            'oferty' => $oferty,
            'komunikat' => 'Oferty dla kategorii '.$category->getNazwa(),
        ]);
    }

    /**
     * @Route("/admin/oferty", name="app_admin_oferty")
     *
     */
    public function adminOferty()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $oferty = $this->ofertaManager->findAll();
        //dd($oferty);
        return $this->render('oferty/index.html.twig', [
            'controller_name' => 'OfertyController',
            'oferty' => $oferty,
            'komunikat' => 'Zarządzaj ofertami'
        ]);
    }

    /**
     * @Route("/oferty/addOferta", name="add_oferta")
     */

    public function addOferta(Request $request)
        {
            if ($request->isMethod('POST')) {
                $oferta = new Oferta();
                $oferta -> setAktywna(true);
                $oferta -> setDataDodania(new \DateTime('now'));
                $oferta -> setTresc($request->request->get('tresc'));
                //$oferta -> setTytul('tytul');
                $oferta -> setTytul($request -> request ->get('tytul'));
                $oferta -> setUzytkownik($this -> getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($oferta);
                $em -> flush();
                return $this -> render('oferty/addSucces.html.twig');
            }
            $repo = $this->getDoctrine()->getRepository(Wojewodztwo::class);
            $wojewodztwa = $repo->findAll();
            $repom = $this->getDoctrine()->getRepository(Miasto::class);
            $miasta = $repom->findByWojewodztwo($wojewodztwa [0]);
            return $this->render('oferty/addOferta.html.twig', [ 'wojewodztwa'=>$wojewodztwa, 'miasta'=>$miasta ]);

        }

    /**
     * @Route("/oferty/getmiasta/{woj}", name="get_miasta")
     */
        public function getMiasta(Request $request, Wojewodztwo $woj){
            $repo = $this->getDoctrine()->getRepository(Miasto::class);
            $miasta = $repo->findByWojewodztwo($woj);
           $result = '';
           if(count($miasta)){
               foreach ($miasta as $miasto){
                   $id_miasta = $miasto -> getId();
                   $nazwa = $miasto -> getNazwa();
                   $result .= "<option value='$id_miasta'>$nazwa</option>
            ";

               }
           }
           return new Response($result);
        }

}
