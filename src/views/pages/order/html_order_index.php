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
                        <td><?= $order->get_payment_method()->value ?></td>
                    </tr>

                    <tr>
                        <td>Payment Status</td>
                        <td><?= $order->get_payment_status()->value ?></td>
                    </tr>

                    <tr>
                        <td>Order Status</td>
                        <td><?= $order->get_status()->value ?></td>
                    </tr>

                    <tr>
                        <td>Order Type</td>
                        <td><?= $order->get_type()->value ?></td>
                    </tr>
                </tbody>
            </table>
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
                                <?php if ($order->get_type() === OrderType::Online) : ?>
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
                <p class="text-secondary">Your shopping cart is empty, add some products to complete the checkout.</p>
            <?php endif; ?>
        </div>
    </div>
</div>