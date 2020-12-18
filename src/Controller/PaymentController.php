<?php

namespace App\Controller;

use App\Entity\OrderedProduct;
use App\Entity\ShoppingCart;
use App\Entity\Product;

use App\Form\ShoppingCartType;

use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    private $security;

    /**
     * @Route("/payment", name="payment")
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

        return $this->render('payment/index.html.twig', [
            'currentshoppingcart' => $currentshoppingcart,
        ]);
    }

    
    /**
     * @Route("/{shoppingCartId}/payment", name="submitted_order_pay", methods={"GET"})
     */
    public function submittedOrderPay(Security $security, Request $request, \Swift_Mailer $mailer): Response
    {
        /* Get the user that is currently logged in */
        $this->security = $security;
        $currentuser = $this->security->getUser();

        /* Get active/submitted shopping cart for logged in user */
        $currentshoppingcart = $this->getDoctrine()
            ->getRepository(ShoppingCart::class)
            ->findOneBy(
                ['status' => 'pending', 'user' => $currentuser]
        );

        /* Get all ordered items in this shopping cart */
        $productsincart = $this->getDoctrine()
            ->getRepository(OrderedProduct::class)
            ->findBy(['shoppingCart' => $currentshoppingcart]);

        $productText = "";

        foreach ($productsincart as $cartproduct) {
            $prodname = $cartproduct->getProduct()->getName();
            $prodprice = $cartproduct->getProduct()->getPrice();
            $proddiscounted = $cartproduct->getProduct()->getDiscountedPrice();

            if($proddiscounted > 0) {
                $productText .= '* '.$prodname.' - € '.$proddiscounted.'.00 (discounted)<br/>';
            } else {
                $productText .= '* '.$prodname.' - € '.$prodprice.'.00<br/>';
            }
        }

        $totalpriceforemail = $currentshoppingcart -> getTotalPrice();
        $useremail = $currentuser -> getEmail();
        $userfirstname = $currentuser -> getFirstname();
        $userlastname = $currentuser -> getLastname();

        $message = (new \Swift_Message('Your Order at Craft Coffee'))
            ->setFrom('sendinatorizer@gmail.com')
            ->setTo($useremail)
            ->setBody(
                '<p>Dear '. $userfirstname .' '. $userlastname .'.</p>
                <p>Thank you for your order at Craft Coffee.</p>
                <p>Your order details are:</p><p>'. $productText .'</p>
                <p>The total amount is <strong>€ '. $totalpriceforemail .'.00</strong></p>
                <p>We will dispatch it as soon as possible.</p>
                <p>Yours sincerely,<br>
                <em>The Craft Coffee Team</em></p>', 'text/html'
            );

        $mailer->send($message);

        $this->addFlash('success', 'Thank you for your order. An order confirmation has been sent to your email address!');

        // Status of order is changed back to pending
        $currentshoppingcart -> setStatus('payment_complete');
        $em = $this ->getDoctrine()->getManager();
        $em->persist($currentshoppingcart);
        $em->flush();

        return $this->redirectToRoute('product_index');
    }

}
