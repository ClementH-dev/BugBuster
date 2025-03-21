<?php

namespace App\Controller;

use App\Entity\PvRecettage;
use App\Form\PvRecettageType;
use App\Repository\PvRecettageRepository;
use App\Service\PdfGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pv/recettage')]
final class PvRecettageController extends AbstractController
{
    #[Route(name: 'app_pv_recettage_index', methods: ['GET'])]
    public function index(PvRecettageRepository $pvRecettageRepository): Response
    {
        $pvRecettages = $pvRecettageRepository->findAll();
        
        $pvParents = [];
        foreach ($pvRecettages as $pv) {
            if ($pvRecettageRepository->findExistingVersion($pv)) {
                $pvParents[] = $pv->getId();
            }
        }
        return $this->render('pv_recettage/index.html.twig', [
           'pv_recettages' => $pvRecettages,
           'pvParents' => $pvParents, 
        ]);
    }

    #[Route('/new', name: 'app_pv_recettage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, PdfGenerator $pdfGenerator): Response
    {
        $pvRecettage = new PvRecettage();
        $form = $this->createForm(PvRecettageType::class, $pvRecettage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pvRecettage->setVersion(1);
            $pvRecettage->setGeneratedAt(new \DateTimeImmutable());
            $entityManager->persist($pvRecettage);
            $entityManager->flush();
            $lastId = $pvRecettage->getId();

            $pdfPath = $pdfGenerator->generatePdf('pv_recettage/pdf.html.twig', [
                'pv' => $pvRecettage
            ], 'pv_recettage_' . $lastId. '.pdf');
            $pvRecettage->setPdfUrl('/pdfs/pv_recettage_' . $lastId . '.pdf');
 
             $entityManager->persist($pvRecettage);
             $entityManager->flush();

            return $this->redirectToRoute('app_pv_recettage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pv_recettage/new.html.twig', [
            'pv_recettage' => $pvRecettage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pv_recettage_show', methods: ['GET'])]
    public function show(PvRecettage $pvRecettage): Response
    {
        return $this->render('pv_recettage/show.html.twig', [
            'pv_recettage' => $pvRecettage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pv_recettage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PvRecettage $pvRecettage, EntityManagerInterface $entityManager, PvRecettageRepository $pvRecettageRepository, PdfGenerator $pdfGenerator): Response
    {
        // Vérifier si un PV existe déjà avec cet ancêtre
        $existingPv = $pvRecettageRepository->findExistingVersion($pvRecettage);

        if ($existingPv) {
            return $this->redirectToRoute('app_pv_recettage_index');
        }
        $newPv = new PvRecettage();
        $newPv->setVersion($pvRecettage->getVersion() + 1);
        
        // Bind ancien champs
        $newPv->setGeneratedAt(new \DateTimeImmutable());
        $newPv->addPvRecettage($pvRecettage);
        $newPv->setName($pvRecettage->getName());
        $newPv->setTechnicalEnvironment($pvRecettage->getTechnicalEnvironment());
        $newPv->setCriticalPoints($pvRecettage->getCriticalPoints());
        $newPv->setConsequences($pvRecettage->getConsequences());
        $newPv->setActionPlan($pvRecettage->getActionPlan());
        $newPv->setConlusion($pvRecettage->getConlusion());
    
        // 🛠 Copier les tests associés
        foreach ($pvRecettage->getTests() as $test) {
            $newPv->addTest($test);
        }
    
        $form = $this->createForm(PvRecettageType::class, $newPv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newPv);
            $entityManager->flush();
           $lastId = $newPv->getId();
            // Générer le PDF
           $pdfPath = $pdfGenerator->generatePdf('pv_recettage/pdf.html.twig', [
               'pv' => $newPv
           ], 'pv_recettage_' . $lastId . '.pdf');
           $newPv->setPdfUrl('/pdfs/pv_recettage_' . $lastId . '.pdf');


            $entityManager->persist($newPv);
            $entityManager->flush();

            return $this->redirectToRoute('app_pv_recettage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pv_recettage/edit.html.twig', [
            'pv_recettage' => $pvRecettage,
            'form' => $form,
        ]);
    }

}
