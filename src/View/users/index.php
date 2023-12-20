<?php ob_start(); ?>
<p class="title-home">Shop mua bán nick game top 1 Việt Nam</p>
<div class="gt">
    <div class="nt">
        <p class="list-nt">Top nạp tiền</p>
        <ul class="list-nt">
            <?php $id = 1;
            foreach ($allusers as $user) : ?>
                <li><?php echo $id++ . '. ' . $user['hoten'] . '-' . $user['Tongsotien'] . 'VNĐ' ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <iframe class="iframe" src="https://www.youtube.com/embed/NToeiWqGmuU">
    </iframe>
</div>
<p class="title-home">Shop Acc GenShin Uy Tín</p>
<div class="container-lg">
    <div class="row mb-5">
        <?php foreach ($typeaccs as $typeacc) : ?>
            <article class="col-lg-3 col-md-6">
                <div class="genshin-product">
                    <div class="wrapper product-wrapper">
                        <a href="">
                            <img class="img-banner" src="https://shopgenshin24h.com/files/13/images/2023-07-16/acc-vip-w9.webp">
                        </a>
                        <h2 class="note__title">
                            <?php echo $typeacc['loaiacc'] ?>
                        </h2>
                        <div class="row g-0 info-line">
                            <?php foreach ($slaccs as $slacc) : ?>
                                <?php if ($slacc['loaiacc_id'] == $typeacc['loaiacc_id']) : ?>
                                    <section class="row g-0 text-center">
                                        <label class="text-muted">Số tài khoản</label>
                                        <span class="more-detail fs-4"><?php echo $slacc['Tongsoacc'] ?></span>
                                    </section>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                        <div class="row g-0 info-line">
                            <section class="row g-0 text-center">
                                <label class="text-muted">Đã bán</label>
                                <span class="more-detail fs-4"><?php echo $typeacc['Tongsoban'] ?></span>
                            </section>
                        </div>
                        <div class="genshin-product-footer">
                            <div class="hr-product mt-1 mb-1"></div>
                            <a href="/user/<?php echo str_replace(' ', '', strtolower($typeacc['loaiacc'])) ?>"><button class="btn-pretty mb-2">Khám Phá</button></a>
                        </div>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>