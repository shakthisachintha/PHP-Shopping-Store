<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fs-3" href="<?= build_route("") ?>"><?= SITE_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ps-3">
                    <a class="nav-link active" aria-current="page" href="<?= build_route("") ?>">Home</a>
                </li>
                <li class="nav-item ps-3">
                    <a class="nav-link" href="#">Shop</a>
                </li>
                <li class="nav-item ps-3">
                    <a class="nav-link" href="#">Grades</a>
                </li>
                <li class="nav-item ps-3 dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu mt-3">
                        <li><a class="dropdown-item" href="<?= build_route("products") ?>">Products</a></li>
                        <li><a class="dropdown-item" href="<?= build_route("category-create") ?>">Categories</a></li>
                        <li><a class="dropdown-item" href="#">Orders</a></li>
                    </ul>
                </li>


                <li class="nav-item ps-3 dropdown">
                    <!-- <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="text-info bi bi-cart"></i>
                    </a> -->
                    <a type="button" class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="text-info bi bi-cart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge badge-sm rounded-pill bg-danger">
                            <?= count($shoppingCart->get_products()) ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2 mt-3" style="width:23rem !important">
                        <?php if (count($shoppingCart->get_products()) > 0) : ?>
                            <li>
                                <table style="font-size:small;table-layout:auto !important" class="table w-100 fw-bold">
                                    <?php foreach ($shoppingCart->get_products() as $data) : ?>
                                        <tr>
                                            <td><img style="width:3rem" src="<?= $data['product']->get_image() ?>" alt="..."></td>
                                            <td><?= $data['product']->get_name() ?></td>
                                            <td>LKR <?= $data['product']->get_price() ?></td>
                                            <td><a href="<?= build_route_get('cart-remove-product', ['product_id' => $data['product']->get_id()]) ?>" class="text-danger text-decoration-none"><i class="bi bi-x-circle"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </li>
                        <?php else : ?>
                            <li><a class="dropdown-item text-center disabled" href="#">Cart is empty!</a></li>
                        <?php endif; ?>
                        <?php if (count($shoppingCart->get_products()) > 0) : ?>
                            <li>
                                <a class="btn btn-outline-dark w-100 btn-sm" href="<?= build_route("checkout") ?>">Checkout <i class="bi bi-cart-check"></i></a>
                            </li>
                            <li>
                                <a class="mt-2 btn btn-outline-secondary w-100 btn-sm" href="<?= build_route("cart-clear") ?>">Clear cart <i class="bi bi-box-arrow-in-right"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="nav-item ps-3 dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="text-light bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-3">

                        <?php if ($authService->is_logged()) : ?>
                            <li><a class="dropdown-item" href="<?= build_route("user-account") ?>"><i class="bi bi-person-lines-fill"></i> Account</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= build_route("logout") ?>"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        <?php else : ?>
                            <li><a class="dropdown-item" href="<?= build_route("auth") ?>"><i class="bi bi-box-arrow-in-right"></i> Login/Register</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>