<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use App\Repository\MedecinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medecin")
 */
class MedecinController extends Controller
{
    /**
     * @Route("/", name="medecin_index", methods="GET")
     */
    public function index(MedecinRepository $medecinRepository): Response
    {
        return $this->render('medecin/index.html.twig', ['medecins' => $medecinRepository->findAll()]);
    }

    /**
     * @Route("/new", name="medecin_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $medecin = new Medecin();
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medecin);
            $em->flush();

            return $this->redirectToRoute('medecin_index');
        }

        return $this->render('medecin/new.html.twig', [
            'medecin' => $medecin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medecin_show", methods="GET")
     */
    public function show(Medecin $medecin): Response
    {
        return $this->render('medecin/show.html.twig', ['medecin' => $medecin]);
    }

    /**
     * @Route("/{id}/edit", name="medecin_edit", methods="GET|POST")
     */
    public function edit(Request $request, Medecin $medecin): Response
    {
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medecin_edit', ['id' => $medecin->getId()]);
        }

        return $this->render('medecin/edit.html.twig', [
            'medecin' => $medecin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medecin_delete", methods="DELETE")
     */
    public function delete(Request $request, Medecin $medecin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medecin->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($medecin);
            $em->flush();
        }

        return $this->redirectToRoute('medecin_index');
    }
}
