<?php

namespace App\Controller;

use App\Entity\Projeto;
use App\Form\ProjetoType;
use App\Repository\ProjetoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projeto")
 */
class ProjetoController extends AbstractController
{
    /**
     * @Route("/", name="projeto_index", methods={"GET"})
     */
    public function index(ProjetoRepository $projetoRepository): Response
    {
        return $this->render('projeto/index.html.twig', [
            'projetos' => $projetoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="projeto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $projeto = new Projeto();
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projeto);
            $entityManager->flush();

            return $this->redirectToRoute('projeto_index');
        }

        return $this->render('projeto/new.html.twig', [
            'projeto' => $projeto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projeto_show", methods={"GET"})
     */
    public function show(Projeto $projeto): Response
    {
        return $this->render('projeto/show.html.twig', [
            'projeto' => $projeto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="projeto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Projeto $projeto): Response
    {
        $form = $this->createForm(ProjetoType::class, $projeto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projeto_index');
        }

        return $this->render('projeto/edit.html.twig', [
            'projeto' => $projeto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projeto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Projeto $projeto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projeto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projeto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projeto_index');
    }


}
