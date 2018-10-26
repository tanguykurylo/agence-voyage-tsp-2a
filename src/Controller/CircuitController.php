<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/circuit")
 */
class CircuitController extends AbstractController
{
    /**
     * @Route("/", name="circuit_index", methods="GET")
     */
    public function index(CircuitRepository $circuitRepository): Response
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
     * @Route("/{id}", name="circuit_show", methods="GET")
     */
    public function circuitShow($id)
    {
        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository(Circuit::class)->find($id);
        if(!$circuit || !$circuit->isProgrammed()){
            throw new NotFoundHttpException("Page not found");
        }
        dump($circuit);
        return $this->render('circuit/show.html.twig', [
            'circuit' => $circuit,
        ]);
    }
}
