<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Sign Up With Past Papers Shop</h2>
            <p>Create an account or login an existing account to enjoy shopping with us.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6 pr-5">
            <h3>Register</h3>
            <form class="mt-4" action="<?=build_route("register")?>" method="POST">
                <div class="mb-3">
                    <label for="registerName" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" required minlength="5" class="form-control" id="registerName">
                </div>
                <div class="mb-3">
                    <label for="registerEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="registerEmail" aria-describedby="regEmailHelp">
                    <div id="regEmailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="registerPasswordOne" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="registerPasswordOne">
                </div>
                <div class="mb-3">
                    <label for="registerPasswordTwo" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="registerPasswordTwo">
                </div>
                <div class="mb-3">
                    <label for="registerAddress" class="form-label">Postal Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="registerAddress" rows="3" aria-describedby="registerAddressHelp"></textarea>
                    <div id="registerAddressHelp" class="form-text">We need this to deliver your packages.</div>
                </div>
                <button type="submit" class="mt-3 btn btn-outline-dark">Register</button>
            </form>
        </div>
        <div class="col-lg-6 border-left pl-5">
            <h3>Login</h3>
            <form class="mt-4" action="<?=build_route("login")?>" method="POST">
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="loginEmail">
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="loginPassword">
                </div>
                <div class="row align-items-center">
                    <div class="col">
                        <button type="submit" class="mt-3 btn btn-outline-dark">Login</button>
                    </div>
                    <div class="col text-right">
                        <a href="<?=build_route("forgot-password")?>" class="mt-3 d-block text-primary" style="text-decoration: none">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>