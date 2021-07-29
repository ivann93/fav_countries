<?php
$pageTitle = 'Signup | Fav Countries';
require_once('includes/public_header.php')
?>

<main class="row overflow-auto justify-content-center">
    <div class="col-md-4 pt-4">
        <div class="card p-4 border border-primary">
            <div class="card-body">
                <h3>Signup</h3>
                <div class="my-3">
                    <input type="text" class="form-control " id="signupName" placeholder="Name">
                </div>
                <div class="my-3">
                    <input type="email" class="form-control " id="signupEmail" placeholder="Email">
                </div>
                <div class="my-3">
                    <select class="form-control " id="signupGender" placeholder="Gender">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Male">Female</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="signupPassword" placeholder="Password">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="signupConfirmPassword" placeholder="Confirm Password">
                </div>
                <div class="mb-3">
                    <div class="alert alert-danger none" id="signupDangerAlert"></div>
                </div>
                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-block btn-outline-primary" id="signupBtn">
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once('includes/public_footer.php')
?>