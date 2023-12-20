<?php ob_start(); ?>
<div class="container-white">
    <h4>Danh Sách Acc Đã Mua</h4>
    <div class="row">
        <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable no-footer dtr-inline" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting">ID</th>
                        <th class="sorting">ID Acc</th>
                        <th class="sorting">Giá</th>
                        <th class="sorting">Ngày Mua</th>
                        <th class="sorting">Tài Khoản</th>
                        <th class="sorting">Mật Khẩu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $a) : ?>
                        <tr>
                            <td><?= $a['hoadon_id']; ?></td>
                            <td><?= $a['acc_id']; ?></td>
                            <td><?= $a['gia']; ?></td>
                            <td><?= $a['ngaytao']; ?></td>
                            <td><?= $a['taikhoan']; ?></td>
                            <td><?= $a['matkhau']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tbody>
                    <?php if (count($accounts) == 0) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="6" class="dataTables_empty">Bạn Chưa Thực Hiện Giao Dịch</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>