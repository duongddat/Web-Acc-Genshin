<?php ob_start(); ?>
<div class="row d-flex justify-content-center">
    <div class="col-md-9">
        <div class="card mb-5">
            <div class="card-header">
                <span class="fs-5 fw-bolder">Xem chi tiết</span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['hoten'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['gmail'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="sotien" class="form-label">Số tiền:</label>
                    <input type="number" class="form-control" id="sotien" name="sotien" value="<?= $user['sotien'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['taikhoan'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $user['matkhau'] ?>" disabled>
                </div>
                <div class="mb-3">
                    <a href="/admin/user-list" class="btn btn-danger">Danh sách accounts</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>