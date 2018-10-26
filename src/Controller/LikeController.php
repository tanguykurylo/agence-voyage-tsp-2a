<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    /**
     * @Route("/like/{circuitID}", name="like", methods="GET")
     */
    public function like()
    {
        $likes = $this->get('session')->get('likes');
    }
}
