<?php ob_start(); ?>

<h1 class="guide__title">Đăng ký</h1>

<div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card card-customer">
            <div class="card-body">
                <form action="/user/create" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="configPassword" class="form-label">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control" id="configPassword" name="configPassword" required>
                    </div>
                    <div class="text-end mb-3">
                        <a class="btn btn-light" href="/user/signin">Đăng nhập</a>
                        <input class="btn btn-success" type="submit" value="Đăng ký">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>