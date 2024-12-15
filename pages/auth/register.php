<?php

set_layout('auth');
set_title('Register');
guest_only();
?>
<div class="card">
    <!-- Logo-->
    <div class="card-header py-4 text-center bg-primary">
        <a href="/">
            <span><img src="../assets/images/logo-2.png" alt="logo" height="22"></span>

        </a>
    </div>

    <div class="card-body p-4">

        <div class="text-center w-75 m-auto">
            <h4 class="text-dark-50 text-center mt-0 fw-bold">Free Sign Up</h4>
            <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute </p>
        </div>



        <form action="../../action/register.php" method="post">

            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required name="name">
            </div>

            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email address</label>
                <input class="form-control" type="email" id="emailaddress" required placeholder="Enter your email" name="email">
            </div>

            <div class="mb-3">
                <label for="phoneInput" class="form-label">Phone</label>
                <input class="form-control" type="tel" id="phoneInput" required placeholder="Enter your number phone" name="phone">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" name="password">
                    <div class="input-group-text" data-password="false">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>

            <div class="mb-3 text-center">
                <button class="btn btn-primary" type="submit"> Sign Up </button>
            </div>

        </form>
    </div> <!-- end card-body -->
</div>
<!-- end card -->

<div class="row mt-3">
    <div class="col-12 text-center">
        <p class="text-muted">Already have account? <a href="/auth/login" class="text-muted ms-1"><b>Log In</b></a></p>
    </div> <!-- end col-->
</div>
<!-- end row -->