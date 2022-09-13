<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Checkout</h2>
            <p>Complete your order here, select a delivery method and complete the payment.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6 pe-5">
            <h3>Order Details</h3>
            <?php if (count($shoppingCart->get_products()) > 0) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($shoppingCart->get_products() as $index => $data) : ?>
                            <tr>
                                <th scope="row"><?= $index + 1 ?></td>
                                <td><?= $data['product']->get_name() ?></td>
                                <td>1</td>
                                <td>LKR <?= $data['product']->get_price() ?></td>
                                <td><a href="<?= build_route_get('cart-remove-product', ['product_id' => $data['product']->get_id()]) ?>" class="text-danger text-decoration-none"><i class="bi bi-x-circle"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="fw-bold">Total amount</td>
                            <td colspan="2" class="fw-bold">LKR <?= $total ?></td>
                        </tr>
                    </tfoot>
                </table>
            <?php else : ?>
                <p class="text-secondary">Your shopping cart is empty, add some products to complete the checkout.</p>
            <?php endif; ?>

            <?php if (count($shoppingCart->get_products()) > 0) : ?>
                <form class="mt-4" action="<?= build_route("checkout-payment") ?>" method="POST">
                    <div class="mb-4">
                        <label for="orderType" class="form-label">Select delivery method <span class="text-danger">*</span></label>
                        <select id="orderType" name="order_type" class="form-select">
                            <option value="online">Online Download</option>
                            <option value="delivery">Deliver by Post</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <label for="productCategory" class="form-label">Select payment method <span class="text-danger">*</span></label>
                        <br>
                        <input value="card" type="radio" class="btn-check" name="payment_method" id="card-payment" autocomplete="off" checked>
                        <label class="btn btn-outline-dark" for="card-payment">Card Payment <i class="bi bi-credit-card-2-back"></i></label>

                        <input value="cod" type="radio" class="btn-check" name="payment_method" id="cod-delivery" autocomplete="off">
                        <label class="btn btn-outline-dark ms-2" for="cod-delivery">Cash on Delivery <i class="bi bi-cash-coin"></i></label>
                    </div>
                    <button type="submit" class="mt-4 btn w-100 btn-outline-dark">Proceed to Payment</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="col-lg-6 border-start ps-5">
            <form id="address_form" class="d-none" class="mt-4" action="" method="post">
                <div class="mb-3">
                    <label for="registerAddress" class="form-label">Delivery address <span class="text-danger">*</span></label>
                    <input type="text" name="user_id" hidden value="<?= $authService->get_current_user()->get_id() ?>">
                    <textarea class="form-control text-start" name="address" id="registerAddress" rows="3" aria-describedby="registerAddressHelp">
                        <?= trim($authService->get_current_user()->get_address(), " ") ?>
                    </textarea>
                    <div id="registerAddressHelp" class="form-text">We will courier your order to this address.</div>
                </div>
                <button type="submit" class="mt-3 btn btn-outline-dark">Update address</button>
            </form>
        </div>

    </div>
</div>

<script>
    document.getElementById("productCategory").addEventListener("input", (event) => {
        console.log();
        if (event.target.value === "delivery")
            document.getElementById("address_form").classList.remove("d-none");

        if (event.target.value === "online")
            document.getElementById("address_form").classList.add("d-none");
    });
</script>