<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Sign Up With <?=SITE_NAME?></h2>
            <p>Create an account or login an existing account to enjoy shopping with us.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6 pe-5">
            <h3>Register</h3>
            <form class="mt-4" action="<?= build_route("register") ?>" method="POST">
                <div class="mb-3">
                    <label for="registerName" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" required minlength="5" class="form-control" id="registerName">
                </div>
                <div class="mb-3">
                    <label for="registerEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" name="email" required class="form-control" id="registerEmail" aria-describedby="regEmailHelp">
                    <div id="regEmailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="registerPasswordOne" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" required minlength="5" name="password" class="form-control" id="registerPasswordOne">
                </div>
                <div class="mb-3">
                    <label for="registerPasswordTwo" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" required minlength="5" class="form-control" id="registerPasswordTwo">
                    <div id="registerPasswordTwoHelp" class="form-text d-none text-danger">Passwords does not match</div>
                </div>
                <div class="mb-3">
                    <label for="registerAddress" class="form-label">Postal Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" required minlength="15" name="address" id="registerAddress" rows="3" aria-describedby="registerAddressHelp"></textarea>
                    <div id="registerAddressHelp" class="form-text">We need this to deliver your packages.</div>
                </div>
                <button type="submit" id="btnRegSubmit" disabled class="mt-3 btn btn-outline-dark">Register</button>
            </form>
        </div>
        <div class="col-lg-6 border-start ps-5">
            <h3>Login</h3>
            <form class="mt-4" action="<?= build_route("login") ?>" method="POST">
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" name="email" required class="form-control" id="loginEmail">
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" required name="password" class="form-control" id="loginPassword">
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <button type="submit" class="mt-3 btn btn-outline-dark">Login</button>
                    </div>
                    <div class="col text-right">
                        <a href="<?= build_route("forgot-password") ?>" class="mt-3 d-block text-primary" style="text-decoration: none">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("registerPasswordTwo").addEventListener("input", (event) => {
        if (document.getElementById("registerPasswordOne").value != event.target.value) {
            document.getElementById("registerPasswordTwoHelp").classList.remove("d-none");
            document.getElementById("btnRegSubmit").setAttribute('disabled', '');
        } else {
            document.getElementById("registerPasswordTwoHelp").classList.add("d-none");
            document.getElementById("btnRegSubmit").removeAttribute('disabled', '');
        }
    });
</script>