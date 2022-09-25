<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Order Details</h2>
            <p>Details of your placed orders are displayed here.</p>
            <hr>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-12">
            <?php if ((isset($orders) && count($orders) > 0)) : ?>
                <?php foreach ($orders as $index => $order) : ?>
                    <div class="mb-3 p-3 border">
                        <div class="row">
                            <div class="col-lg"><span class="fw-bold">Order</span> #<?= $index + 1 ?></div>
                            <div class="col-lg"><span class="fw-bold">Amount:</span> LKR <?= $order->get_amount() ?></div>
                            <div class="col-lg"><span class="fw-bold">Order Status:</span> <?= ucfirst($order->get_status()->value) ?></div>
                            <div class="col-lg"><span class="fw-bold">Payment Status:</span> <?= ucfirst($order->get_payment_status()->value) ?></div>
                            <div class="col-lg text-center">
                                <a href="<?= build_route_get('orders', ["order_id" => $order->get_id()]) ?>"><i class="bi bi-eye-fill"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-muted">You have not placed any orders yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>