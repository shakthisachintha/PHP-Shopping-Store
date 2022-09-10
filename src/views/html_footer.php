</div>
<?php if ((isset($_SESSION['error']) && $_SESSION['error'] === true) || (isset($_SESSION['success']) && $_SESSION['success'] === true)) : ?>
    <!-- Error Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <?php if ((isset($_SESSION['error']) && $_SESSION['error'] === true)) : ?>
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Ooops!</h5>
                    <?php endif; ?>
                    <?php if ((isset($_SESSION['success']) && $_SESSION['success'] === true)) : ?>
                        <h5 class="modal-title text-success" id="exampleModalLabel">Whola!</h5>
                    <?php endif; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ((isset($_SESSION['error']) && $_SESSION['error'] === true)) : ?>
                        <?php foreach ($_SESSION['errors'] as $key => $error) : ?>
                            <p class="text-danger"><?= $error ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if ((isset($_SESSION['success']) && $_SESSION['success'] === true)) : ?>
                        <p class="text-success"><?= $_SESSION['success_message'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const myModalAlternative = new bootstrap.Modal('#exampleModal');
        myModalAlternative.toggle();
    </script>
<?php endif; ?>
</body>

</html>