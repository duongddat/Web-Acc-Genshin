<?php ob_start(); ?>

<div class="row d-flex justify-content-center">
    <div class="col-md-9">
        <div class="card mb-5">
            <div class="card-header">
                <span class="fs-5 fw-bolder">Thêm account</span>
            </div>
            <div class="card-body">
                <form action="/admin/account-create" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <input type="number" class="form-control" id="level" name="level" required>
                    </div>
                    <div class="mb-3">
                        <label for="area" class="form-label">Khu vực:</label>
                        <select class="form-select" aria-label="Default select example" name="area" id="area">
                            <option selected>--Chọn khu vực--</option>
                            <option value="Asia">Asia</option>
                            <option value="America">America</option>
                            <option value="Europe">Europe</option>
                            <option value="TW,HK,MO">TW,HK,MO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amountChar" class="form-label">Số lượng tướng:</label>
                        <input type="number" class="form-control" id="amountChar" name="amountChar" required>
                    </div>
                    <div class="mb-3">
                        <label for="amountWeapon" class="form-label">Số lượng vũ khí:</label>
                        <input type="number" class="form-control" id="amountWeapon" name="amountWeapon" required>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Ảnh:</label>
                        <input type="file" class="form-control" id="img" name="img" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Giá:</label>
                        <input type="text" class="form-control" id="cost" name="cost" required>
                    </div>
                    <div class="mb-3">
                        <label for="typeAcc" class="form-label">Loại account:</label>
                        <select class="form-select" aria-label="Default select example" name="typeAcc" id="typeAcc">
                            <option selected>--Chọn loại account--</option>
                            <?php foreach ($types as $type) : ?>
                                <option value="<?= $type["loaiacc_id"] ?>"><?= $type["loaiacc"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taikhoan" class="form-label">Tài khoản:</label>
                        <input type="text" class="form-control" id="taikhoan" name="taikhoan" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-success" type="submit" value="Tạo account">
                        <a href="/admin/account-list" class="btn btn-danger">Danh sách accounts</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>