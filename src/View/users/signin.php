<?php ob_start(); ?>
<h1 class="guide__title">Đăng nhập</h1>

<div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card card-customer">
            <div class="card-body">
                <form action="/auth/validate" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>

                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="text-end mb-3">
                        <a class="btn btn-opa" href="/user/register">Đăng ký</a>
                        <input class="btn" type="submit" value="Đăng nhập">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>