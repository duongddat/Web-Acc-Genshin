<?php ob_start(); ?>
<div class="container-white">
    <h4>Quản lý Nạp Tiền</h4>
    <div class="row">
        <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable no-footer dtr-inline" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting">ID</th>.
                        <th class="sorting">Tài Khoản</th>
                        <th class="sorting">Họ Tên</th>
                        <th class="sorting">Số Tiền Nạp</th>
                        <th class="sorting">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $a) : ?>
                        <tr>
                            <td><?= $a['lichsu_id']; ?></td>
                            <td><?= $a['taikhoan']; ?></td>
                            <td><?= $a['hoten']; ?></td>
                            <td><?= $a['sotiennap']; ?></td>
                            <td><?= $a['ngaynap']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tbody>
                    <?php if (count($accounts) == 0) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="6" class="dataTables_empty">Bạn Chưa Nạp Lần Đầu</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>