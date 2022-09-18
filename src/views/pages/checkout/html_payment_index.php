<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Mock Payment Gateway</h2>
            <p>This is a test payment gateway, you can either complete the payment or cancel the transaction.</p>
            <hr>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6 pe-5">
            <p>Order ID: <?= $order->get_id() ?></p>
            <p>Order Amount: LKR <?= $order->get_amount() ?> </p>
        </div>
    </div>

    <div class="row">
        <div class="col-2 ">
            <form action="<?= build_route("payment-status") ?>" method="post">
                <input type="hidden" name="order_id" value="<?= $order->get_id() ?>">
                <input type="hidden" value="incomplete" name="payment_status">
                <button class="btn btn-outline-danger" type="submit">Cancel the Payment</button>
            </form>
        </div>
        <div class="col-3">
            <form action="<?= build_route("payment-status") ?>" method="post">
                <input type="hidden" name="order_id" value="<?= $order->get_id() ?>">
                <input type="hidden" value="complete" name="payment_status">
                <button class="btn btn-outline-success" type="submit">Complete the Payment</button>
            </form>
        </div>

    </div>
</div>