<?php

namespace App\Controller;

use App\Entity\OrderedProduct;
use App\Entity\ShoppingCart;
use App\Entity\Product;

use App\Form\ShoppingCartType;

use Symfony\Component\Security\Core\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubmittedOrderController extends AbstractController
{

    private $security;

    /**
     * @Route("/submitted/order", name="submitted_order")
     */
    public function index(Security $security): Response
    {
        /* Get the user that is currently logged in */
        $this->security = $security;
        $currentuser = $this->security->getUser();

        /* Get active/pending shopping cart for logged in user */
        $currentshoppingcart = $this->getDoctrine()
            ->getRepository(ShoppingCart::class)
            ->findOneBy(
                ['status' => 'pending', 'user' => $currentuser]
        );

        $productsincart = $this->getDoctrine()
            ->getRepository(OrderedProduct::class)
            ->findBy(['shoppingCart' => $currentshoppingcart]);

        return $this->render('submitted_order/index.html.twig', [
            'currentshoppingcart' => $currentshoppingcart,
            'products_in_cart' => $productsincart,
        ]);
    }


    
}
