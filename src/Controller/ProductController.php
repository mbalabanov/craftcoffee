<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ShoppingCart;
use App\Entity\OrderedProduct;
use App\Entity\User;
use App\Form\ProductType;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\SearchformType;

use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{

    private $security;

    /**
     * @Route("/", name="product_index", methods={"GET","POST"})
     */
    public function index(Security $security, Request $request): Response
    {

        $form = $this->createForm(SearchformType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchFormData = $form->getData();
            $searchterm = $searchFormData['searchterm'];

            return $this->redirect('/product/search/'.$searchterm);
        }

        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);

        $filter = "all";

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(['enabled' => '1'], ['name' => 'ASC']);

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'productfilter' => $filter,
            'searchform' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }
        $currentshoppingcart = NULL;
        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{productId}", name="product_show", methods={"GET"})
     */
    public function show(Security $security, Product $product): Response
    {
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(['product'=>$product, 'type'=>'Comment']);

        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'comments' => $comments,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{productId}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index');
        }

        $currentshoppingcart = NULL;
        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{productId}/buy", name="product_buy", methods={"GET","POST"})
     */
    public function addToShoppingCart(Request $request, Product $product, Security $security): Response
    {

        /* Get current item from product table */
        $ordereditem = $this->getDoctrine()->getRepository(Product::class)->find($product);

        /* Get currently logged in user from from security */
        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findBy(['user' => $currentuser,'status'=>'pending']);

        /* Check if shopping cart already exists (add items) or create new cart (and add items) */
        if ($this->getDoctrine()->getRepository(ShoppingCart::class)->findBy(['user' => $currentuser,'status'=>'pending'])) {

            /* Get this user's shopping cart */
            $currentcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);

            /* Find the right items and insert them into the ordered items table */
            $orderedproduct = new OrderedProduct;
            $orderedproduct -> setProduct($ordereditem);
            $orderedproduct -> setShoppingCart($currentcart);
            $em = $this ->getDoctrine()->getManager();
            $em->persist($orderedproduct);
            $em->flush();

            /* Check if there is a discounted price and calculate the new total price of the shopping cart */
            if ($ordereditem -> getDiscountedPrice()) {
                $newtotalprice = ($currentcart -> getTotalPrice()) + ($ordereditem -> getDiscountedPrice());
                $currentcart -> setTotalPrice($newtotalprice);
            } else {
                $newtotalprice = ($currentcart -> getTotalPrice()) + ($ordereditem -> getPrice());
                $currentcart -> setTotalPrice($newtotalprice);
            }

            /* Update the shopping cart with the new total price */
            $em = $this ->getDoctrine()->getManager();
            $em->persist($currentcart);
            $em->flush();

        } else {

            $newcarttotalprice = 0;

            /* Check if there is a discounted price */
            if ($ordereditem -> getDiscountedPrice()) {
                $newcarttotalprice = $ordereditem -> getDiscountedPrice();
            } else {
                $newcarttotalprice = $ordereditem -> getPrice();
            }

            /* Create new shopping cart (because this user does not yet have a pending cart) */
            $newshoppingcart = new ShoppingCart;
            $now = new \DateTime('now');
            $newshoppingcart -> setTotalPrice($newcarttotalprice);  
            $newshoppingcart -> setDate($now);
            $newshoppingcart -> setStatus('pending');
            $newshoppingcart -> setUser($currentuser);
            $em = $this -> getDoctrine()-> getManager();
            $em->persist($newshoppingcart);
            $em->flush();

            /* Get this user's new shopping cart */
            $currentcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);
           
            /* Find the right items and insert them into the ordered items table */
            $orderedproduct = new OrderedProduct;
            $orderedproduct -> setProduct($ordereditem);
            $orderedproduct -> setShoppingCart($currentcart);
            $em = $this ->getDoctrine()->getManager();
            $em->persist($orderedproduct);
            $em->flush();
        };
        
        //Total amount of products decreased about 1
        $amount=$ordereditem->getQuantityOnStock() - 1;  
        $ordereditem->setQuantityOnStock($amount);
        $em = $this ->getDoctrine()->getManager();
        $em->persist($ordereditem);
        $em->flush();

        return $this->redirectToRoute('shopping_cart_index');
    }

    /**
     * @Route("/filter/{productCategory}", name="filter", methods={"GET", "POST"})
     */
    public function filter($productCategory, Request $request): Response
    {

        $form = $this->createForm(SearchformType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchFormData = $form->getData();
            $searchterm = $searchFormData['searchterm'];

            return $this->redirect('/product/search/'.$searchterm);
        }

        $filter = 'filtered';
        $category = $productCategory;
        $products = $this -> getDoctrine() -> getRepository(Product::class) -> findBy(array('category'=>$productCategory, 'enabled'=>1));
        $currentshoppingcart = NULL;
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'productfilter' => $filter,
            'category' => $category,
            'searchform' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/search/{productname}", name="search", methods={"GET", "POST"})
     */
    public function search($productname, Request $request): Response
    {

        $form = $this->createForm(SearchformType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchFormData = $form->getData();
            $searchterm = $searchFormData['searchterm'];

            return $this->redirect('/product/search/'.$searchterm);
        }

        $filter = "filtered";

        $products = $this -> getDoctrine() -> getRepository(Product::class) -> createQueryBuilder('p')
            -> where('p.name LIKE :val')
            -> setParameter('val', '%'.$productname.'%')
            -> getQuery()
            -> getResult();

        $currentshoppingcart = NULL;
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'productfilter' => $filter,
            'category' => $productname,
            'searchform' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }
    
}
