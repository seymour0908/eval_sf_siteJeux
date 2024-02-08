<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Jeu;
use App\Form\JeuType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class JeuController extends AbstractController
{
    #[Route('/jeu', name: 'app_jeu')]
    public function index(): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
        ]);
    }
        // creation d'une fonction pour crer un nouveau jeu
    #[Route('/jeu/new', name: 'jeu_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $jeu = new Jeu();
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jeu);
            $entityManager->flush();

            // Redirection ou affichage d'un message de succès
            return $this->redirectToRoute('jeu_success');
        }

        return $this->render('jeu/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
