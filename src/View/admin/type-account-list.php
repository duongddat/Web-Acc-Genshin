<?php ob_start(); ?>
<div class="container-white">
    <h4>Type Account List</h4>
    <a href="/admin/type-account-create" class="btn btn-primary mt-2 mb-2">Add Type Account</a>
    <div class="card table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Loại account</th>
                    <th scope="col">Control</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types as $type) : ?>
                    <tr>
                        <th scope="row">

                            <a href="/admin/type-account-detail/<?= $type['loaiacc_id'] ?>">
                                <?= $type['loaiacc_id'] ?>
                            </a>
                        </th>
                        <td> <?= $type['loaiacc'] ?></td>
                        <td>
                            <a href="/admin/type-account-form/<?= $type['loaiacc_id'] ?>">Edit</a>
                            | <a href="/admin/type-account-delete/<?= $type['loaiacc_id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php
                if (count($types) == 0) {
                ?>
                    <tr>
                        <td colspan="3" class="mt-2">
                            <p class="text-center">Danh sách loại account rỗng!!! Hãy thêm mới loại account ngay~</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>