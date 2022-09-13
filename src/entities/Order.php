<?php
include_once(__DIR__ . '/Product.php');
include_once(__DIR__ . '/User.php');
include_once(__DIR__ . '/BaseEntity.php');

class Order extends BaseEntity
{
    protected OrderStatus $status = OrderStatus::New;
    protected float $amount;
    protected OrderType $type = OrderType::Online;
    protected User $user;
    protected PaymentMethod $payment_method = PaymentMethod::Card;
    protected array $products = array();
    protected string $tableName = 'orders';

    function __construct()
    {
        parent::__construct();
    }

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

    function set_products(array $products): void {
        $this->products = $products;
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

    function attributes_to_array(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'status' => $this->status->value,
            'type' => $this->type->value,
            'user_id' => $this->user->id,
            'payment_method' => $this->payment_method->value,
        ];
    }

    protected function extended_store_db_func(): bool
    {
        foreach ($this->products as $product) {
            $pd_arr = ["product_id"=>$product->id, "order_id"=>$this->id];
            $res = $this->databaseService->create_record("order_product", $pd_arr);
            if (!$res) return false;
        }
        return true;
    }
}

enum OrderStatus: string
{
    case New = 'new';
    case Shipped = 'shipped';
    case Completed = 'completed';
}

enum OrderType: string
{
    case Online = 'online';
    case Delivery = 'delivery';
}

enum PaymentMethod: string
{
    case CashOnDelivery = 'cod';
    case Card = 'card';
}
