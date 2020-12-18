<?php

namespace App\Controller;

use App\Entity\OrderedProduct;
use App\Entity\ShoppingCart;
use App\Entity\Product;

use App\Form\ShoppingCartType;

use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Doctrine\ORM\Query;

/**
 * @Route("/shoppingcart")
 */
class ShoppingCartController extends AbstractController
{

    private $security;

    /**
     * @Route("/", name="shopping_cart_index", methods={"GET"})
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

        /* Get all ordered items in this shopping cart */
        $productsincart = $this->getDoctrine()
            ->getRepository(OrderedProduct::class)
            ->findBy(['shoppingCart' => $currentshoppingcart]);


        // $cartId = $currentshoppingcart->getShoppingCartId();
        // $product_count = $this->getDoctrine()->getRepository(OrderedProduct::class)
        //     ->createQueryBuilder('n')
        //     ->select("count(n.orderedProductId)","IDENTITY (n.product)")
        //     ->where("n.shoppingCart= :cartId")
        //     ->setParameter('cartId',$cartId)
        //     ->groupBy("n.product")
        //     ->getQuery()
        //     ->getResult();
        //  dd($product_count); 
        
        return $this->render('shopping_cart/index.html.twig', [
            'currentuser' => $currentuser,
            'currentshoppingcart' => $currentshoppingcart,
            'products_in_cart' => $productsincart,
            // 'product_count' => $product_count,
        ]);
    }

    /**
     * @Route("/{shoppingCartId}", name="shopping_cart_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ShoppingCart $shoppingCart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingCart->getShoppingCartId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shoppingCart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shopping_cart_index');
    }


}
