<?php

namespace App\Controller;

use App\Entity\ShoppingCart;
use App\Entity\Product;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class InventoryController extends AbstractController
{
    /**
     * @Route("/inventory", name="inventory")
     */
    public function index(Security $security): Response
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy([], ['quantityOnStock' => 'ASC']);
        
        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);


        return $this->render('inventory/index.html.twig', [
            'products' => $products,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }
}
