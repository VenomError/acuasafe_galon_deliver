<?php

set_layout('auth');
set_title('Login');
guest_only();
?>

<div class="card">

    <!-- Logo -->
    <div class="card-header py-4 text-center bg-primary">
        <a href="/">
            <span><img src="../assets/images/logo-2.png" alt="logo" height="22"></span>
        </a>
    </div>

    <div class="card-body p-4">

        <div class="text-center w-75 m-auto">
            <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
            <p class="text-muted mb-4">Enter your email address and password</p>
        </div>

        <form action="../../action/login.php" method="post">

            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email address</label>
                <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" name="email">
            </div>

            <div class="mb-3">
                <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a>
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>

            <div class="mb-3 mb-0 text-center">
                <button class="btn btn-primary" type="submit"> Log In </button>
            </div>

        </form>
    </div>
</div>
<!-- end card -->

<div class="row mt-3">
    <div class="col-12 text-center">
        <p class="text-muted">Don't have an account? <a href="/auth/register" class="text-muted ms-1"><b>Sign Up</b></a></p>
    </div> <!-- end col -->
</div>
<!-- end row -->