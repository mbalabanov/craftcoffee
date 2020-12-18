<?php

namespace App\Controller;

use App\Entity\OrderedProduct;
use App\Entity\ShoppingCart;
use App\Entity\Product;
use App\Entity\User;

use App\Form\ShoppingCartType;
use App\Form\OrderedProductType;

use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ordered/product")
 */
class OrderedProductController extends AbstractController
{
    private $security;
    /**
     * @Route("/", name="ordered_product_index", methods={"GET"})
     */
    public function index(Security $security): Response
    {
        $orderedProducts = $this->getDoctrine()
            ->getRepository(OrderedProduct::class)
            ->findAll();

        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);
    
        return $this->render('ordered_product/index.html.twig', [
            'ordered_products' => $orderedProducts,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/new", name="ordered_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $orderedProduct = new OrderedProduct();
        $form = $this->createForm(OrderedProductType::class, $orderedProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orderedProduct);
            $entityManager->flush();

            return $this->redirectToRoute('ordered_product_index');
        }

        return $this->render('ordered_product/new.html.twig', [
            'ordered_product' => $orderedProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{orderedProductId}", name="ordered_product_show", methods={"GET"})
     */
    public function show(Security $security, OrderedProduct $orderedProduct): Response
    {
        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);
    
        return $this->render('ordered_product/show.html.twig', [
            'ordered_product' => $orderedProduct,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{orderedProductId}/edit", name="ordered_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OrderedProduct $orderedProduct): Response
    {
        $form = $this->createForm(OrderedProductType::class, $orderedProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ordered_product_index');
        }

        return $this->render('ordered_product/edit.html.twig', [
            'ordered_product' => $orderedProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{orderedProductId}", name="ordered_product_delete", methods={"DELETE"})
     */
    public function delete(Security $security, Request $request, OrderedProduct $orderedProduct): Response
    {      
        // Variables needed for calculation 
        $orderedProducts = $this -> getDoctrine() -> getRepository(OrderedProduct::class)->find($orderedProduct);
        $currentshoppingCart = $this -> getDoctrine() -> getRepository(ShoppingCart::class)->findOneByshoppingCartId($orderedProducts -> getShoppingCart());
        $product = $this -> getDoctrine() -> getRepository(Product::class)->findOneByproductId($orderedProduct -> getProduct());

        // Total sum calculation
        if($product->getDiscountedPrice()){
            $deductedPrice = $product->getDiscountedPrice();
        } else {
            $deductedPrice = $product->getPrice();
        }
        $newTotalPrice = ($currentshoppingCart-> getTotalPrice()) - $deductedPrice;
        $currentshoppingCart -> setTotalPrice($newTotalPrice);

        //Total amount of products increased about 1
        $amount = $product->getQuantityOnStock() + 1;
        $product -> setQuantityOnStock($amount);

        //Delete item from Ordered_product
        if ($this->isCsrfTokenValid('delete'.$orderedProduct->getOrderedProductId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orderedProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('shopping_cart_index');
    }
}
