<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Order Details</h2>
            <p>Details of your placed order (Order ID: <?= $order->get_id() ?>) is displayed here.</p>
            <hr>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6 pe-5">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Order ID</td>
                        <td><?= $order->get_id() ?></td>
                    </tr>
                    <tr>
                        <td>Order Amount</td>
                        <td>LKR <?= $order->get_amount() ?></td>
                    </tr>

                    <tr>
                        <td>Payment Method</td>
                        <td><?= ucfirst($order->get_payment_method()->value) ?></td>
                    </tr>

                    <tr>
                        <td>Payment Status</td>
                        <td><?= ucfirst($order->get_payment_status()->value) ?></td>
                    </tr>

                    <tr>
                        <td>Order Status</td>
                        <td><?= ucfirst($order->get_status()->value) ?></td>
                    </tr>

                    <tr>
                        <td>Order Type</td>
                        <td><?= ucfirst($order->get_type()->value) ?>
                            <?php if ($order->get_type() === OrderType::Online && $order->get_payment_status() === PaymentStatus::Complete) : ?>
                                <small class="text-muted"><br>You can download the books now.</small>
                            <?php endif; ?>
                            <?php if ($order->get_type() === OrderType::Delivery && $order->get_payment_status() === PaymentStatus::Complete) : ?>
                                <small class="text-muted text-wrap"><br>Order will be delivered to your account address.</small>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php if ($order->get_type() === OrderType::Delivery) : ?>
                        <tr>
                            <td>Delivery Address</td>
                            <td class="text-break"><?= $order->get_user()->get_address() ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if ($authService->is_admin()) : ?>
                <h5 class="mt-5 mb-3">Admin Functions</h5>
                <?php if ($order->get_type() === OrderType::Delivery) : ?>
                    <?php if ($order->get_payment_status() === PaymentStatus::Complete) : ?>
                        <?php if ($order->get_status() === OrderStatus::Shipped) : ?>
                            <p>This order is shipped.</p>
                        <?php else : ?>
                            <a href="<?= build_route_get('mark-shipped', ['order_id' => $order->get_id()]) ?>" class="btn btn-outline-success">Mark as shipped</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <p class="text-muted">Payment for the order is not completed.</p>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-6">
            <?php if (count($order->get_products()) > 0) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <?php if ($order->get_type() === OrderType::Online) : ?>
                                <th></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order->get_products() as $index => $data) : ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></td>
                                <td><?= $data->get_name() ?></td>
                                <td>1</td>
                                <td>LKR <?= $data->get_price() ?></td>
                                <?php if ($order->get_payment_status() === PaymentStatus::Complete && $order->get_type() === OrderType::Online) : ?>
                                    <td><a target="new" href="<?= build_route_get('order-download', ['product_id' => $data->get_id()]) ?>" class="text-success text-decoration-none"><i class="bi bi-download"></i></a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3" class="fw-bold">Total amount</td>
                            <td colspan="2" class="fw-bold">LKR <?= $order->get_amount()  ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php else : ?>
                <p class="text-secondary">You don't have any products in this order.</p>
            <?php endif; ?>
        </div>
    </div>
</div>