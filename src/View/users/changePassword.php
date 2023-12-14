<?php ob_start(); ?>
<h1 class="guide__title">Đổi mật khẩu</h1>

<div class="row d-flex justify-content-center">
    <div class="col-md-6">
        <div class="card card-customer">
            <div class="card-body">
                <form action="/auth/changePassword" method="post">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu cũ:</label>
                        <input type="password" class="form-control" id="password" name="password" required>

                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Mật khẩu mới:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Mật khẩu mới:</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
                    </div>

                    <div class="text-end mb-3">
                        <input type="text" class="visually-hidden" name="user_id" value="<?= isset($user['user_id']) ? $user['user_id'] : '' ?>">
                        <input class="btn btn-success" type="submit" value="Đổi mật khẩu">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>