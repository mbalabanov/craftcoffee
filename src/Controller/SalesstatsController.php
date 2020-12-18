<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\OrderedProduct;
use App\Entity\Product;

/**
 * @Route("/admin")
 */
class SalesstatsController extends AbstractController
{
    /**
     * @Route("/salesstats", name="salesstats")
     */
    public function index(): Response
    {
/*
        $products1 = $this->getDoctrine()
        ->getRepository(OrderedProduct::class)
        ->findAll();
*/

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy([], ['productId' => 'ASC']);

        $product_count = $this->getDoctrine()->getRepository(OrderedProduct::class)->createQueryBuilder('n')
            ->select( "count(IDENTITY (n.product))", "IDENTITY (n.product)")
            ->groupBy("n.product")
            ->getQuery()
            ->getResult();

        $currentshoppingcart = "";

        return $this->render('salesstats/index.html.twig', [
            'orderedproducts' => $product_count,
            'products' => $products,
            'currentshoppingcart' => $currentshoppingcart,
        ]);

    }
}
