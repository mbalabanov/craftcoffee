<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderedProduct
 *
 * @ORM\Table(name="ordered_product", indexes={@ORM\Index(name="Shopping Cart Relationship", columns={"shopping_cart_id"}), @ORM\Index(name="Product Relationship", columns={"product_id"})})
 * @ORM\Entity
 */
class OrderedProduct
{
    /**
     * @var int
     *
     * @ORM\Column(name="ordered_product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderedProductId;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $product;

    /**
     * @var \ShoppingCart
     *
     * @ORM\ManyToOne(targetEntity="ShoppingCart")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shopping_cart_id", referencedColumnName="shopping_cart_id")
     * })
     */
    private $shoppingCart;

    public function getOrderedProductId(): ?int
    {
        return $this->orderedProductId;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getShoppingCart(): ?ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(?ShoppingCart $shoppingCart): self
    {
        $this->shoppingCart = $shoppingCart;

        return $this;
    }


}
