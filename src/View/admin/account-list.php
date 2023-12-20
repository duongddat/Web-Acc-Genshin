<?php ob_start(); ?>
<div class="container-white">
    <h4>Account List</h4>
    <a href="/admin/account-create" class="btn btn-primary mt-2 mb-2">Add Account</a>
    <div class="card table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cấp độ</th>
                    <th scope="col">Khu vực</th>
                    <th scope="col">Số lượng tướng</th>
                    <th scope="col">Số lượng vũ khí</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $account) : ?>
                    <tr>
                        <th scope="row">

                            <a href="/admin/account-detail/<?= $account['acc_id'] ?>">
                                <?= $account['acc_id'] ?>
                            </a>
                        </th>
                        <td> <?= $account['level'] ?></td>
                        <td> <?= $account['khuvuc'] ?></td>
                        <td> <?= $account['soluongtuong'] ?></td>
                        <td> <?= $account['soluongvukhi'] ?></td>
                        <td> <?= $account['gia'] ?></td>
                        <td>
                            <a href="/admin/account-form/<?= $account['acc_id'] ?>">Edit</a>
                            | <a href="/admin/account-delete/<?= $account['acc_id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php
                if (count($accounts) == 0) {
                ?>
                    <tr>
                        <td colspan="7" class="mt-2">
                            <p class="text-center">Danh sách account rống!!! Hãy thêm mới account ngay~</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>