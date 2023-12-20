<?php ob_start(); ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-9">
        <div class="card mb-5">
            <div class="card-header">
                <span class="fs-5 fw-bolder"> Thêm mới user</span>
            </div>
            <div class="card-body">
                <form action="/admin/create-new-user" method="post">
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
                        <input class="btn btn-success" type="submit" value="Thêm user">
                        <a href="/admin/user-list" class="btn btn-danger">Danh sách accounts</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>