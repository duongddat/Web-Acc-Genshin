<?php ob_start(); ?>

<div class="row d-flex justify-content-center">
    <div class="col-md-9">
        <div class="card mb-5">
            <div class="card-header">
                <span class="fs-5 fw-bolder">Thêm account</span>
            </div>
            <div class="card-body">
                <form action="/admin/type-account-create" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="loaiacc" class="form-label">Loại account</label>
                        <input type="text" class="form-control" id="loaiacc" name="loaiacc" required>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Ảnh:</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                    <div class="mb-3 mt-3">
                        <input class="btn btn-success" type="submit" value="Tạo account">
                        <a href="/admin/type-account-list" class="btn btn-danger">Danh sách loại accounts</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>