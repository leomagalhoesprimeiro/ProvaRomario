<?php

namespace App\Controller;

use App\Entity\Professor;
use App\Form\ProfessorType;
use App\Repository\ProfessorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professor")
 */
class ProfessorController extends AbstractController
{
    /**
     * @Route("/", name="professor_index", methods={"GET"})
     */
    public function index(ProfessorRepository $professorRepository): Response
    {
        return $this->render('professor/index.html.twig', [
            'professors' => $professorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="professor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $professor = new Professor();
        $form = $this->createForm(ProfessorType::class, $professor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professor);
            $entityManager->flush();

            return $this->redirectToRoute('professor_index');
        }

        return $this->render('professor/new.html.twig', [
            'professor' => $professor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professor_show", methods={"GET"})
     */
    public function show(Professor $professor): Response
    {
        return $this->render('professor/show.html.twig', [
            'professor' => $professor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="professor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Professor $professor): Response
    {
        $form = $this->createForm(ProfessorType::class, $professor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('professor_index');
        }

        return $this->render('professor/edit.html.twig', [
            'professor' => $professor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Professor $professor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($professor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('professor_index');
    }

    /**
     * @Route("/shp/{n}", name="professor_n", methods={"GET"})
     */
public function showProf(ProfessorRepository $Professor, $nome): Response{
        $res= $Professor->findByNome();
        return new JsonResponse($res);



}
}
