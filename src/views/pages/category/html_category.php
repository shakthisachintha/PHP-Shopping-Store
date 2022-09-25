<div class="container p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Categories</h2>
            <p>All active products categories are listed here.</p>
        </div>

        <div class="col align-items-center d-flex">
            <a class="btn ms-auto btn-outline-dark" href="<?= build_route("category-create") ?>">Create new + </i></a>
        </div>

    </div>

    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>

    <div class="row g-5">
        <div class="col">
            <?php if ((isset($new_categories) && count($new_categories) >= 0)) : ?>
                <p class="small text-muted">Note: Inorder to delete a category it should not contain any products.</p>
                <?php foreach ($new_categories as $category) : ?>
                    <div class="p-3 my-5 border">
                        <h5><?= ucwords($category->get_name()) ?>&nbsp; <a href="<?= build_route_get('category-view', ["category_id" => $category->get_id()]) ?>"><i class="bi bi-pencil-square"></i></a></h5>
                        <?php if (count($category->get_products()) > 0) : ?>
                            <?php foreach ($category->get_products() as $prd) : ?>
                                <a class="" href="<?= build_route_get("product-view", ['product_id' => $prd->get_id()]) ?>"><span class="badge p-2 px-3 m-2 fw-light rounded-pill bg-primary"><?= $prd->get_name() ?></span></a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <a class="" href="<?= build_route_get("category-delete", ['category_id' => $category->get_id()]) ?>"><span class="badge p-2 px-3 m-2 fw-light rounded-pill bg-danger">Delete Category</span></a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-muted">You don't have any categories created!</p>
            <?php endif; ?>
        </div>
    </div>
</div>