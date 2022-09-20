<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Create Product</h2>
            <p>Products created here will be published to the store.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <h3>Enter Product Details</h3>
            <form class="mt-4" action="<?= build_route("product-save") ?>" method="POST">
                <div class="mb-4">
                    <label for="productName" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" required minlength="5" class="form-control" id="productName">
                </div>
                <div class="mb-4">
                    <label for="productDescription" class="form-label">Description <span class="text-danger">*</span></label>
                    <input type="text" name="description" required minlength="10" class="form-control" id="productDescription">
                </div>
                <div class="mb-4">
                    <label for="productPrice" class="form-label">Price (LKR) <span class="text-danger">*</span></label>
                    <input type="text" name="price" required min="200" class="form-control" id="productPrice">
                </div>
                <div class="mb-4">
                    <label for="productQuantity" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" required min="1" value="5" class="form-control" id="productQuantity">
                </div>
                <div class="mb-4">
                    <label for="productImage" class="form-label">Image URL <span class="text-danger">*</span></label>
                    <input type="text" name="image_url" required min="10" class="form-control" id="productImage">
                </div>
                <div class="mb-4">
                    <label for="productImage" class="form-label">Download Link <span class="text-danger">*</span></label>
                    <input type="text" name="download_link" required min="10" class="form-control" id="productImage">
                </div>
                <div class="mb-4">
                    <label for="productCategory" class="form-label">Product Category <span class="text-danger">*</span></label>
                    <select id="productCategory" name="category_id" class="form-select">
                        <?php if ((isset($categories) && count($categories) >= 0)) : ?>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->get_id() ?>"><?= $category->get_name() ?></option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option>Please create some categories</option>
                        <?php endif; ?>
                    </select>
                </div>
                <button type="submit" class="mt-3 btn btn-outline-dark">Create product</button>
            </form>
        </div>

        <div class="col-lg-6 align-items-center d-flex">
            <div class="card mx-auto border-0 shadow" style="width: 20rem;">
                <img id="productPreviewImage" src="https://i.ibb.co/Tb78qnR/Screenshot-2022-08-14-at-9-22-45-PM.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 id="productPreviewName" class="card-title">Grade 10 History Past Papers</h5>
                    <p id="productPreviewDescription" class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p id="productPriceText" class="card-text fw-bold">LKR 1200</p>
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