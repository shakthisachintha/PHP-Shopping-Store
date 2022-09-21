<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Hi! <?= ucwords($user->get_name()) ?></h2>
            <p>This is your account details page, you can edit your details details here.</p>
            <hr>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-6 pe-5">
            <h3>Account Details</h3>
            <form class="mt-4" action="<?= build_route("register") ?>" method="POST">
                <div class="mb-3">
                    <label for="registerName" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" required minlength="5" value="<?= ucwords($user->get_name()) ?>" class="form-control" id="registerName">
                </div>
                <div class="mb-3">
                    <label for="registerEmail" class="form-label">Email address </label>
                    <input type="email" readonly disabled name="email" value="<?= $user->get_email() ?>" class="form-control" id="registerEmail" aria-describedby="regEmailHelp">
                </div>
                <div class="mb-3">
                    <label for="registerAddress" class="form-label">Postal Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" id="registerAddress" rows="3" aria-describedby="registerAddressHelp">
                        <?= $user->get_address() ?>
                    </textarea>
                    <div id="registerAddressHelp" class="form-text">We need this to deliver your packages.</div>
                </div>
                <button type="submit" class="mt-3 btn btn-outline-dark">Save Details</button>
            </form>
        </div>

        <div class="col-lg-6 border-start ps-5">
            <h3>Update Password</h3>
            <form class="mt-4" method="POST">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label">Current Password <span class="text-danger">*</span></label>
                    <input type="password" required name="current_password" class="form-control" id="currentPassword">
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password <span class="text-danger">*</span></label>
                    <input type="password" required name="new_password" class="form-control" id="newPassword">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" required class="form-control" id="confirmPassword">
                    <div id="confirmPasswordHelp" class="form-text d-none text-danger">Passwords does not match</div>
                </div>
                <button type="submit" disabled id="btnPwUpdateSubmit" class="mt-3 btn btn-outline-dark">Update Password</button>
                <form>
        </div>
    </div>
</div>

<script>
    document.getElementById("confirmPassword").addEventListener("input", (event) => {
        if (document.getElementById("newPassword").value != event.target.value) {
            document.getElementById("confirmPasswordHelp").classList.remove("d-none");
            document.getElementById("btnPwUpdateSubmit").setAttribute('disabled', '');
        } else {
            document.getElementById("confirmPasswordHelp").classList.add("d-none");
            document.getElementById("btnPwUpdateSubmit").removeAttribute('disabled', '');
        }
    });
</script>