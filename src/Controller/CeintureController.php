<?php

namespace App\Controller;

use App\Entity\Ceinture;
use App\Form\CeintureType;
use App\Repository\CeintureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ceinture')]
final class CeintureController extends AbstractController
{
    #[Route(name: 'app_ceinture_index', methods: ['GET'])]
    public function index(CeintureRepository $ceintureRepository): Response
    {
        return $this->render('ceinture/index.html.twig', [
            'ceintures' => $ceintureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ceinture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ceinture = new Ceinture();
        $form = $this->createForm(CeintureType::class, $ceinture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ceinture);
            $entityManager->flush();

            return $this->redirectToRoute('app_ceinture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ceinture/new.html.twig', [
            'ceinture' => $ceinture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ceinture_show', methods: ['GET'])]
    public function show(Ceinture $ceinture): Response
    {
        return $this->render('ceinture/show.html.twig', [
            'ceinture' => $ceinture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ceinture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ceinture $ceinture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CeintureType::class, $ceinture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ceinture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ceinture/edit.html.twig', [
            'ceinture' => $ceinture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ceinture_delete', methods: ['POST'])]
    public function delete(Request $request, Ceinture $ceinture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ceinture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ceinture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ceinture_index', [], Response::HTTP_SEE_OTHER);
    }
}
