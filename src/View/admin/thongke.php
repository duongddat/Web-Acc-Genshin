<?php ob_start(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
    $tong= $tk['tong'];
    $daban=$tk['damua'];
    $chuaban=$tong-$daban;
    $soLieuDaBan = $daban;
    $soLieuChuaBan = $chuaban;
    $phantram=($daban/$tong)*100;
    ?>
<div class="container">  
    <div class="card">
    <p class="card-text">Tổng Doanh Thu</p>
    <div class="card-body">
        <div style=" height: 300px;display: flex; justify-content: center; align-items: center;">
            <canvas  id="myPieChart" width="250" height="250"></canvas>
        </div>
        <p class="card-text">Đã Bán: <?=$phantram?> %</p>
        <p class="card-text">Tổng Doanh Thu Có Được: <?=$tk['TongSoTien'];?> VND</p>
        <p class="card-text">Số Acc Đã Bán: <?=$daban;?> Acc</p>
        <p class="card-text">Số Acc Chưa Bán: <?=$chuaban;?> Acc</p>
    </div>

    

    <script>
        // Dữ liệu về đã bán và chưa bán từ PHP
        var data = {
            labels: ['Đã bán', 'Chưa bán'],
            datasets: [{
                data: [<?php echo $soLieuDaBan; ?>, <?php echo $soLieuChuaBan; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Thiết lập biểu đồ hình tròn
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                // Cấu hình thêm nếu cần
            }
        });
    </script>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($accounts as $index => $a) :
            if ($a['TongSoLuong'] != 0) {
                $soLieuDaBan = $a['TongSoLuongDamua1'];
                $soLieuChuaBan = $a['TongSoLuong'] - $a['TongSoLuongDamua1'];
                $phantram=($a['TongSoLuongDamua1']/$a['TongSoLuong'])*100;
        ?>
        <div class="col">
            <div class="card">
            <p class="card-text">Loại <?php echo $a['TenLoai']; ?> Đã Bán : <?php echo $phantram ?> %</p>
                <div class="card-body">
                    <div style="height: 300px; display: flex; justify-content: center; align-items: center;">
                        <canvas id="myPieChart<?php echo $index; ?>" width="250" height="250"></canvas>
                    </div>
                    <p class="card-text">Tổng Doanh Thu: <?php echo $a['TongTien']; ?> VND</p>
                    <p class="card-text">Số Acc Đã Bán: <?php echo$soLieuDaBan; ?> acc</p>
                    <p class="card-text">Số Acc Chưa Bán: <?php echo$soLieuChuaBan; ?> acc</p>
                    <script>
                        // Function to create chart
                        function createChart<?php echo $index; ?>() {
                            var data<?php echo $index; ?> = {
                                labels: ['Đã bán', 'Chưa bán'],
                                datasets: [{
                                    data: [<?php echo $soLieuDaBan; ?>, <?php echo $soLieuChuaBan; ?>],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.5)',
                                        'rgba(54, 162, 235, 0.5)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            // Chart creation
                            var ctx<?php echo $index; ?> = document.getElementById('myPieChart<?php echo $index; ?>').getContext('2d');
                            var myPieChart<?php echo $index; ?> = new Chart(ctx<?php echo $index; ?>, {
                                type: 'pie',
                                data: data<?php echo $index; ?>,
                                options: {
                                    // Additional configurations if needed
                                }
                            });
                        }
                        createChart<?php echo $index; ?>();
                    </script>
                </div>
            </div>
        </div>
        <?php }
        endforeach; ?>
    </div>
</div>
<div class="container-white">
    <h4>Danh Sách Hóa Đơn</h4>
    <div class="row">
        <div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable no-footer dtr-inline" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting">ID</th>
                        <th class="sorting">ID Acc</th>
                        <th class="sorting">Giá</th>
                        <th class="sorting">Ngày Mua</th>
                        <th class="sorting">Tài Khoản Mua</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hd as $b) : ?>
                        <tr>
                            <td><?= $b['hoadon_id']; ?></td>
                            <td>
                                <a href="/admin/account-detail/<?= $b['acc_id'] ?>">
                                    <?= $b['acc_id'] ?>
                                </a>
                            </td>
                            <td><?= $b['gia']; ?></td>
                            <td><?= $b['ngaytao']; ?></td>
                            <td><?= $b['taikhoan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tbody>
                    <?php if (count($hd) == 0) { ?>
                        <tr class="odd">
                            <td valign="top" colspan="6" class="dataTables_empty">Chưa Có Giao Dịch</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>
