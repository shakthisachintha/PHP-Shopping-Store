<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><?= SITE_NAME ?></h1>
        <p class="col-md-8 fs-4"><?= SITE_DESCRIPTION_MAIN ?></p>
        <a class="btn btn-dark btn-lg" href="<?=build_route('shop')?>" >Shop Online...</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <hr>
    </div>
</div>

<div class="row mt-2">
    <div class="col text-center">
        <h2>Product Gallery</h2>
        <p>Explore our newly published latest products</p>
    </div>
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
                        <p class="card-text fw-bold">LKR <?= $product->get_price() ?></p>
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
                                <div class="col-4"><a href="<?= build_route_get("product-view", ['product_id' => $product->get_id()]) ?>" class="btn btn-sm btn-outline-danger">Edit <i class="bi bi-pencil-square"></i></a></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($index == 2) break; ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-muted">No products found...</p>
    <?php endif; ?>
</div>

<div class="row mt-5">
    <div class="col p-2 text-center">
    <a  class="btn btn-outline-dark btn-lg" href="<?=build_route('shop')?>">Shop More</a>
    </div>
</div>