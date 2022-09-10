<div class="container p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Product</h2>
            <p>All active products are listed here.</p>
        </div>

        <?php if ($authService->is_admin()) : ?>
            <div class="col align-items-center d-flex">
                <a class="btn ms-auto btn-outline-dark" href="<?= build_route("product-create") ?>">Create new + </i></a>
            </div>
        <?php endif; ?>

    </div>

    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>

    <div class="row gy-5 pt-5">
        <?php if ((isset($products) && count($products) >= 0)) : ?>
            <?php foreach ($products as $index => $product) : ?>
                <div class="col">
                    <div class="card <?= $index % 3 === 0 ? "me-auto" : "" ?> <?= $index % 3 === 1 ? "mx-auto" : "" ?> <?= $index % 3 === 2 ? "ms-auto" : "" ?> border-0 shadow" style="width: 20rem;">
                        <img src="<?= $product->get_image() ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product->get_name() ?></h5>
                            <p class="card-text"><?= $product->get_description() ?></p>
                            <div class="row justify-content-between">
                                <?php if ($shoppingCart->contains_product($product->get_id())) : ?>
                                    <div class="col-7"><a href="<?= build_route_get('cart-remove-product', ['product_id' => $product->get_id()]) ?>" class="btn btn-sm btn-outline-secondary">Remove from cart <i class="bi bi-bag-dash-fill"></i></a></div>
                                <?php else : ?>
                                    <div class="col-7">
                                        <?php if (!$authService->is_logged()) : ?>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Please login first!">
                                                <button class="btn btn-sm btn-outline-dark" type="button" disabled>Add to cart <i class="bi bi-bag-plus"></i></button>
                                            </span>
                                        <?php else : ?>
                                            <a href="<?= build_route_get('cart-add-product', ['product_id' => $product->get_id()]) ?>" class="btn btn-sm btn-outline-dark">Add to cart <i class="bi bi-bag-plus"></i></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($authService->is_admin()) : ?>
                                    <div class="col-4"><a href="#" class="btn btn-sm btn-outline-danger">Edit <i class="bi bi-pencil-square"></i></a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-muted">No products found...</p>
        <?php endif; ?>
    </div>
</div>

<?php if (!$authService->is_logged()) : ?>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
<?php endif; ?>