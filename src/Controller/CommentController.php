<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Product;
use App\Entity\ShoppingCart;
use App\Entity\User;
use Symfony\Component\Security\Core\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="comment_index", methods={"GET"})
     */
    public function index(Security $security): Response
    {
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAll();

        $this->security = $security;
        $currentuser = $this->security->getUser();
        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/new/{productId}", name="comment_new", methods={"GET","POST"})
     */
    public function new(Request $request, Product $product, Security $security): Response
    {

        /* Get the user that is currently logged in */
        $this->security = $security;
        $currentuser = $this->security->getUser();

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($currentuser);
            $comment->setProduct($product);
            $comment->setType('Comment');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            $currentproductid = $product -> getProductId();

            return $this->redirectToRoute('product_show', ['productId' => $currentproductid]);
        }

        $currentshoppingcart = $this->getDoctrine()->getRepository(ShoppingCart::class)->findOneBy(['user' => $currentuser,'status'=>'pending']);

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'productname' => $product,
            'form' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{commentId}", name="comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        $currentshoppingcart = NULL;
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{commentId}/edit", name="comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminpanel');
        }

        $currentshoppingcart = NULL;
        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    /**
     * @Route("/{commentId}", name="comment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getCommentId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
