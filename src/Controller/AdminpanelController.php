<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\ShoppingCart;

use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminpanelController extends AbstractController
{

    private $security;

    /**
     * @Route("/adminpanel", name="adminpanel")
     */
    public function index(Security $security): Response
    {

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy([], ['userId' => 'ASC']);

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findBy([], ['productId' => 'ASC']);

        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);

        return $this->render('adminpanel/index.html.twig', [
            'users' => $users,
            'products' => $products,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/setadmin/{userId}", name="setadmin", methods={"GET"})
     */
    public function setadmin(User $user): Response
    {
        $user->setRoles(['ROLE_ADMIN']);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
    
        return $this->redirectToRoute('adminpanel');
    }

    /**
     * @Route("/setstandard/{userId}", name="setstandard", methods={"GET"})
     */
    public function setstandard(User $user): Response
    {
        $user->setRoles([]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('adminpanel');
    }

    /**
     * @Route("/setenabled/{userId}", name="setenabled", methods={"GET"})
     */
    public function setenabled(User $user): Response
    {
        $user->setEnabled(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('adminpanel');
    }

    /**
     * @Route("/setdisabled/{userId}", name="setdisabled", methods={"GET"})
     */
    public function setdisabled(User $user): Response
    {
        $user->setEnabled(0);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('adminpanel');
    }

    /**
     * @Route("/enableproduct/{product}", name="enableproduct", methods={"GET"})
     */
    public function enableproduct(Product $product): Response
    {

        $product->setEnabled(1);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('adminpanel');
    }

    /**
     * @Route("/disableproduct/{product}", name="disableproduct", methods={"GET"})
     */
    public function disableproduct(Product $product): Response
    {

        $product->setEnabled(0);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->redirectToRoute('adminpanel');
    }

}
