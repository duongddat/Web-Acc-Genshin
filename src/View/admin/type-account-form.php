<?php ob_start(); ?>

<div class="row d-flex justify-content-center">
    <div class="col-md-9">
        <div class="card mb-5">
            <div class="card-header">
                <span class="fs-5 fw-bolder">Chỉnh sửa thông tin loại account</span>
            </div>
            <div class="card-body">
                <form action="/admin/type-account-form/<?= $type['loaiacc_id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="loaiacc" class="form-label">Loại account</label>
                        <input type="text" class="form-control" id="loaiacc" name="loaiacc" value="<?= $type['loaiacc'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Ảnh:</label>
                        <img src="/public/asset/imgType/<?= $type['img'] != null ? $type['img'] : 'momo-upload-api-211129134518-637737903186897335.webp' ?>" alt="Ảnh mẫu" class="d-block h-50 w-50 rounded">
                        <input type="file" class="form-control mt-3" id="img" name="img">
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-success" type="submit" value="Chỉnh sửa account">
                        <a href="/admin/type-account-list" class="btn btn-danger">Danh sách loại accounts</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>