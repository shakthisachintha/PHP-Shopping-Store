<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Update Category "<?= $category->get_name() ?>"</h2>
            <p>You can update only the category name, to change the category products you may update the category from products.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6">
            <h3>Enter Category Details</h3>
            <form class="mt-4" action="<?= build_route("category-update") ?>" method="POST">
                <div class="mb-4">
                    <input type="hidden" name="category_id" value="<?= $category->get_id() ?>">
                    <label for="categoryName" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" required value="<?= $category->get_name() ?>" minlength="5" class="form-control" id="categoryName">
                </div>
                <button type="submit" class="mt-3 btn btn-outline-dark">Update category</button>
            </form>
        </div>
    </div>
</div>