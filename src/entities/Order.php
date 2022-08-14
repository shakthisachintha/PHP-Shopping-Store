<?php
include_once("./Product.php");
include_once("./User.php");
include_once("./BaseEntity.php");

class Order extends BaseEntity
{
    private OrderStatus $status;
    private float $amount;
    private OrderType $type;
    private User $user;
    private PaymentMethod $paymentMethod;
    private array $products = array();

    function set_status(OrderStatus $status): void
    {
        $this->status = $status;
    }

    function set_amount(float $amount): void
    {
        $this->amount = $amount;
    }

    function set_type(Ordertype $type): void
    {
        $this->type = $type;
    }

    function set_user(User $user): void
    {
        $this->user = $user;
    }

    function set_payment_method(PaymentMethod $payment_method): void
    {
        $this->paymentMethod = $payment_method;
    }

    function get_status(): OrderStatus
    {
        return $this->status;
    }

    function get_amount(): float
    {
        return $this->amount;
    }

    function get_type(): OrderType
    {
        return $this->type;
    }

    function get_user(): User
    {
        return $this->user;
    }

    function get_payment_method(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    function add_products(Product $product): void
    {
        array_push($this->products, $product);
    }

    function get_products(): array
    {
        return $this->products;
    }

    function deleteProduct(Product $product): void
    {
        $pos = array_search($product, $this->products);
        if ($pos !== false) {
            unset($this->products[$pos]);
        }
    }
}

enum OrderStatus
{
    case New;
    case Shipped;
    case Completed;
}

enum OrderType
{
    case Online;
    case Delivery;
}

enum PaymentMethod
{
    case CashOnDelivery;
    case Card;
}
