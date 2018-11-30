<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends AbstractController
{
    /**
     * @Route("/like/{circuitID}", name="like", methods="GET")
     */
    public function like($circuitID)
    {
        $likes = $this->get('session')->get('likes');
        if($likes == NULL){
            $this->get('session')->set('likes', []);
            $likes = $this->get('session')->get('likes');
        }
        if (! in_array($circuitID, $likes) ) 
        {
            $likes[] = $circuitID;
        }
        else
        {
            $likes = array_diff($likes, array($circuitID));
        }
        $this->get('session')->set('likes',$likes);
        return $this->redirectToRoute('circuit_index');
    }
}
