<?php
$pageTitle = 'Login | Fav Countries';
require_once('includes/public_header.php')
?>

<main class="row overflow-auto justify-content-center">
    <div class="col-md-4 pt-4">
        <div class="card p-4 border border-primary">
            <div class="card-body">
                <h3>Login</h3>
                <div class="my-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" class="form-control " id="loginEmail" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword">
                </div>
                <div class="mb-3">
                    <div class="alert alert-danger none" id="loginDangerAlert"></div>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-block btn-outline-primary" id="loginBtn">
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once('includes/public_footer.php')
?>