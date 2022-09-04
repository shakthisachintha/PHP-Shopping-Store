<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Create Category</h2>
            <p>Categories created here will availble on product creation page to be assinged to proudcts.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <h3>Enter Category Details</h3>
            <form class="mt-4" action="<?= build_route("category-save") ?>" method="POST">
                <div class="mb-4">
                    <label for="categoryName" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" required minlength="5" class="form-control" id="categoryName">
                </div>
                <button type="submit" class="mt-3 btn btn-outline-dark">Create category</button>
            </form>
        </div>


    </div>
</div>