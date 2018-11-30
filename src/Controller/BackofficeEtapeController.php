<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Form\EtapeType;
use App\Repository\EtapeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/etape")
 */
class BackofficeEtapeController extends AbstractController
{
    /**
     * @Route("/", name="back/etape_index", methods="GET")
     */
    public function index(EtapeRepository $etapeRepository): Response
    {
        return $this->render('back/etape/index.html.twig', ['etapes' => $etapeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="back/etape_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $etape = new Etape();
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etape);
            $em->flush();

            return $this->redirectToRoute('back/etape_index');
        }

        return $this->render('back/etape/new.html.twig', [
            'etape' => $etape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back/etape_show", methods="GET")
     */
    public function show(Etape $etape): Response
    {
        return $this->render('back/etape/show.html.twig', ['etape' => $etape]);
    }

    /**
     * @Route("/{id}/edit", name="back/etape_edit", methods="GET|POST")
     */
    public function edit(Request $request, Etape $etape): Response
    {
        $form = $this->createForm(EtapeType::class, $etape);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back/etape_edit', ['id' => $etape->getId()]);
        }

        return $this->render('back/etape/edit.html.twig', [
            'etape' => $etape,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="back/etape_delete", methods="DELETE")
     */
    public function delete(Request $request, Etape $etape): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etape->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etape);
            $em->flush();
        }

        return $this->redirectToRoute('back/etape_index');
    }
}
