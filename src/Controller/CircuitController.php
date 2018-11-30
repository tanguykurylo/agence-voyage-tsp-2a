<?php

namespace App\Controller;

use App\Entity\Circuit;
use App\Form\CircuitType;
use App\Repository\CircuitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        $programmedCircuits = [];
        foreach ($circuits as $circuit){
            if($circuit->isProgrammed()){
                array_push($programmedCircuits, $circuit);
            }
        }
        $likes = $this->get('session')->get('likes');
        if($likes == NULL){
            $this->get('session')->set('likes', []);
            $likes = $this->get('session')->get('likes');
        }
        
        return $this->render('front/circuits.html.twig', [
            'circuits' => $programmedCircuits, 
            'likes' => $likes
        ]);
    }

    /**
     * @Route("/{id}", name="circuit_show")
     * @Method("GET")
     **/
    public function circuitShow(Circuit $circuit)
    {
        if(!$circuit || !$circuit->isProgrammed()){
            throw new NotFoundHttpException("Page not found");
        }
        dump($circuit);
        return $this->render('front/circuit_show.html.twig', [
            'circuit' => $circuit,
        ]);
    }
}
