<?php ob_start(); ?>
<div class="container-white">
    <h4>User List</h4>
    <a href="/admin/create-new-user" class="btn btn-primary mt-2 mb-2">Add User</a>
    <div class="card table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row">

                            <a href="/admin/show-user/<?= $user['user_id'] ?>">
                                <?= $user['user_id'] ?>
                            </a>
                        </th>
                        <td> <?= $user['taikhoan'] ?></td>
                        <td> <?= $user['hoten'] ?></td>
                        <td> <?= $user['gmail'] ?></td>
                        <td>
                            <a href="/admin/update-user-info/<?= $user['user_id'] ?>">Edit</a>
                            | <a href="/admin/delete-user/<?= $user['user_id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php
                if (count($users) == 0) {
                ?>
                    <tr>
                        <td colspan="7" class="mt-2">
                            <p class="text-center">Danh sách user rống!!! Hãy thêm mới user ngay~</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>