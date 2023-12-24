<?php ob_start(); ?>
<?php
$uri = $_SERVER['REQUEST_URI'];
$uri = basename($uri);
?>
<link rel="stylesheet" href="../../../public/css/main.css">
<div class="detail">
    <div class="info_detail">
        <div class="row g-0 info-line">
            <section class="col text-detail text-center"><label>AR level: </label><?php echo $account['level'] ?> </section>
            <section class="col text-detail text-center text-uppercase"><label>Khu Vực: </label><?php echo $account['khuvuc'] ?></section>
            <section class="col text-detail text-center"><label>Tướng: </label> <?php echo $account['soluongtuong'] ?> </section>
        </div>

        <img class="img-detail rounded" src="../../../public/asset/img/<?php echo $account['img'] ?>" alt="">
    </div>
    <div class="buy-detail">
        <p>Price: <?php echo $account['gia'] ?></p>
        <form method="post" action="/auth/muaacc">
            <input type="text" name="acc_id" value=<?= $account['acc_id'] ?> class="visually-hidden">
            <input type="text" name="sotien" value=<?= $account['gia'] ?> class="visually-hidden">
            <input class="btn-buy" type="submit" value="Mua">
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '../../../../templates/layout.php'); ?>