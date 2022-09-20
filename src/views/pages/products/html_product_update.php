<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Update Product</h2>
            <p>Product updates will be published to the store.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <h3>Enter Product Details</h3>
            <form class="mt-4" action="<?= build_route("product-update") ?>" method="POST">
                <input type="hidden" name="product_id" value="<?= $product->get_id() ?>">
                <div class="mb-4">
                    <label for="productName" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $product->get_name() ?>" name="name" required minlength="5" class="form-control" id="productName">
                </div>
                <div class="mb-4">
                    <label for="productDescription" class="form-label">Description <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $product->get_description() ?>" name="description" required minlength="10" class="form-control" id="productDescription">
                </div>
                <div class="mb-4">
                    <label for="productPrice" class="form-label">Price (LKR)<span class="text-danger">*</span></label>
                    <input type="text" value="<?= $product->get_price() ?>" name="price" required min="200" class="form-control" id="productPrice">
                </div>
                <div class="mb-4">
                    <label for="productQuantity" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                    <input type="number" value="<?= $product->get_quantity() ?>" name="quantity" required min="1" value="5" class="form-control" id="productQuantity">
                </div>
                <div class="mb-4">
                    <label for="productImage" class="form-label">Image URL <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $product->get_image() ?>" name="image_url" required min="10" class="form-control" id="productImage">
                </div>
                <div class="mb-4">
                    <label for="productDownloadLink" class="form-label">Download Link <span class="text-danger">*</span></label>
                    <input type="text" value="<?= $product->get_downloadLink() ?>" name="download_link" required min="10" class="form-control" id="productDownloadLink">
                </div>
                <div class="mb-4">
                    <label for="productCategory" class="form-label">Product Category <span class="text-danger">*</span></label>
                    <select id="productCategory" name="category_id" class="form-select">
                        <?php if ((isset($categories) && count($categories) >= 0)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <option <?= $product->get_category()->get_id() === $category->get_id() ? "selected" : "" ?> value="<?= $category->get_id() ?>"><?= $category->get_name() ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option>Please create some categories</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="row justify-content-between">

                    <div class="col-4">
                        <button type="submit" class="mt-3 btn btn-outline-dark">Update Product</button>
                    </div>
                    <div class="col-4">
                        <!-- Button trigger delete modal -->
                        <button type="button" class="mt-3 float-end btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete">
                            Delete Product
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6 align-items-center d-flex">
            <div class="card mx-auto border-0 shadow" style="width: 20rem;">
                <img id="productPreviewImage" src="<?= $product->get_image() ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 id="productPreviewName" class="card-title"><?= $product->get_name() ?></h5>
                    <p id="productPreviewDescription" class="card-text"><?= $product->get_description() ?></p>
                    <p id="productPriceText" class="card-text fw-bold">LKR <?= $product->get_price() ?></p>
                    <div class="row justify-content-between">
                        <div class="col-7"> <a href="#" disabled class="btn disabled btn-sm btn-outline-success">Added to cart <i class="bi bi-bag-check-fill"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("productName").addEventListener("input", (event) => {
        document.getElementById("productPreviewName").innerText = event.target.value;
    });

    document.getElementById("productDescription").addEventListener("input", (event) => {
        document.getElementById("productPreviewDescription").innerText = event.target.value;
    });

    document.getElementById("productImage").addEventListener("input", (event) => {
        document.getElementById("productPreviewImage").src = event.target.value;
    });
    
    document.getElementById("productPrice").addEventListener("input", (event) => {
        document.getElementById("productPriceText").innerText = `LKR ${event.target.value}`;
    });
</script>

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Delete product?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the product "<?= $product->get_name() ?>" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="<?= build_route_get('product-delete', ["product_id" => $product->get_id()]) ?>" class="btn btn-outline-danger">Yes delete</a>
            </div>
        </div>
    </div>
</div>