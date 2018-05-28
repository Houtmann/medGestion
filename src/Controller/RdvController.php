<?php

namespace App\Controller;

use App\Entity\Rdv;
use App\Form\RdvType;
use App\Repository\RDVRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rdv")
 */
class RdvController extends Controller
{
    /**
     * @Route("/", name="rdv_index", methods="GET")
     */
    public function index(RDVRepository $rDVRepository): Response
    {
        return $this->render('rdv/index.html.twig', ['rdvs' => $rDVRepository->findAll()]);
    }

    /**
     * @Route("/new", name="rdv_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $rdv = new Rdv();
        $form = $this->createForm(RdvType::class, $rdv);
        $form->handleRequest($request);
        $form->getErrors(true);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rdv);
            $em->flush();


            return $this->redirectToRoute('rdv_index');
        } else {
            $errors = $form->getErrors(true);
            return $this->render('rdv/new.html.twig', [
                'rdv' => $rdv,
                'form' => $form->createView(),
                'errors' => $errors]);

        }


        return $this->render('rdv/new.html.twig', [
            'rdv' => $rdv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rdv_show", methods="GET")
     */
    public function show(Rdv $rdv): Response
    {
        return $this->render('rdv/show.html.twig', ['rdv' => $rdv]);
    }

    /**
     * @Route("/{id}/edit", name="rdv_edit", methods="GET|POST")
     */
    public function edit(Request $request, Rdv $rdv): Response
    {
        $form = $this->createForm(RdvType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rdv_edit', ['id' => $rdv->getId()]);
        }

        return $this->render('rdv/edit.html.twig', [
            'rdv' => $rdv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rdv_delete", methods="DELETE")
     */
    public function delete(Request $request, Rdv $rdv): Response
    {
        if ($this->isCsrfTokenValid('delete' . $rdv->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rdv);
            $em->flush();
        }

        return $this->redirectToRoute('rdv_index');
    }
}
