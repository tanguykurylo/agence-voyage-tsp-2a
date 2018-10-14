<?php

namespace App\Controller;

use App\Entity\Circuit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Controleur FrontOfficeHome
 * @Route("/")
 */
class FrontofficeHomeController extends Controller
{
    /**
     * @Route("/home", name="frontoffice_home")
     */
    public function index()
    {   
        $em = $this->getDoctrine()->getManager();
        $circuits = $em->getRepository(Circuit::class)->findAll();
        dump($circuits);
        $programmedCircuits = [];
        foreach ($circuits as $circuit){
            if($circuit->isProgrammed()){
                array_push($programmedCircuits, $circuit);
            }
        }
        return $this->render('front/home.html.twig', [
            'circuits' => $programmedCircuits, 
        ]);
    }

    /**
     * Finds and displays a circuit entity.
     *
     * @Route("/circuit/{id}", name="front_circuit_show")
     */
    public function circuitShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository(Circuit::class)->find($id);
        if(!$circuit || !$circuit->isProgrammed()){
            throw new NotFoundHttpException("Page not found");
        }
        dump($circuit);
        return $this->render('front/circuit_show.html.twig', [
            'circuit' => $circuit,
        ]);
    }
}
