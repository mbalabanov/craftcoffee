<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SpecialOffers;
use App\Form\SpecialOffersType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class SpecialOffersController extends AbstractController
{
    /**
     * @Route("/", name="special_offers_index", methods={"GET"})
     */
    public function index(): Response
    {
        $specialOffers = $this->getDoctrine()
            ->getRepository(SpecialOffers::class)
            ->findAll();
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(['enabled' => '1'], ['productId' => 'ASC', ], 2);
        // dd($specialOffers);
        $currentshoppingcart = NULL;
        return $this->render('special_offers/index.html.twig', [
            'special_offers' => $specialOffers,
            'products' => $products,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/new", name="special_offers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specialOffer = new SpecialOffers();
        $form = $this->createForm(SpecialOffersType::class, $specialOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialOffer);
            $entityManager->flush();

            return $this->redirectToRoute('special_offers_index');
        }

        $currentshoppingcart = NULL;
        return $this->render('special_offers/new.html.twig', [
            'special_offer' => $specialOffer,
            'form' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{specialOfferId}", name="special_offers_show", methods={"GET"})
     */
    public function show(SpecialOffers $specialOffer): Response
    {
        return $this->render('special_offers/show.html.twig', [
            'special_offer' => $specialOffer,
        ]);
    }

    /**
     * @Route("/{specialOfferId}/edit", name="special_offers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SpecialOffers $specialOffer): Response
    {
        $form = $this->createForm(SpecialOffersType::class, $specialOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('special_offers_index');
        }

        $currentshoppingcart = 0;
        
        return $this->render('special_offers/edit.html.twig', [
            'special_offer' => $specialOffer,
            'form' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{specialOfferId}", name="special_offers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SpecialOffers $specialOffer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialOffer->getSpecialOfferId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specialOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('special_offers_index');
    }
}
