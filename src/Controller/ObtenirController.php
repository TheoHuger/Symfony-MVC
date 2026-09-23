<?php

namespace App\Controller;

use App\Entity\Obtenir;
use App\Form\ObtenirType;
use App\Repository\ObtenirRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/obtenir')]
final class ObtenirController extends AbstractController
{
    #[Route(name: 'app_obtenir_index', methods: ['GET'])]
    public function index(ObtenirRepository $obtenirRepository): Response
    {
        return $this->render('obtenir/index.html.twig', [
            'obtenirs' => $obtenirRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_obtenir_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $obtenir = new Obtenir();
        $form = $this->createForm(ObtenirType::class, $obtenir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($obtenir);
            $entityManager->flush();

            return $this->redirectToRoute('app_obtenir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('obtenir/new.html.twig', [
            'obtenir' => $obtenir,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_obtenir_show', methods: ['GET'])]
    public function show(Obtenir $obtenir): Response
    {
        return $this->render('obtenir/show.html.twig', [
            'obtenir' => $obtenir,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_obtenir_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Obtenir $obtenir, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ObtenirType::class, $obtenir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_obtenir_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('obtenir/edit.html.twig', [
            'obtenir' => $obtenir,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_obtenir_delete', methods: ['POST'])]
    public function delete(Request $request, Obtenir $obtenir, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$obtenir->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($obtenir);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_obtenir_index', [], Response::HTTP_SEE_OTHER);
    }
}
