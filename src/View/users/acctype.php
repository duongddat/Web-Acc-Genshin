<?php ob_start(); ?>
<?php
$uri = $_SERVER['REQUEST_URI'];
$uri = basename($uri);
$decodedUri = urldecode($uri);
?>
<link rel="stylesheet" href="../../../public/css/main.css">
<p class="title-home">NickGame <strong><?php echo $decodedUri ?><strong></p>
<div class="row">
    <div class="col-12 col-lg-3 search-zone">
        <section id="search-form" class="search-frm p-4 pb-5">
            <p class="text-center ms-text h5 m-2">Tìm kiếm</p>
            <form method="POST" action="/user/search/<?php echo $decodedUri ?>">
                <div class="col-12 mt-3">
                    <label class="form-label">AR</label>
                    <input class="form-control concave" type="number" name="level" value="" placeholder="Nhập AR thấp nhất" fdprocessedid="igbsyf">
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label">Giá
                    </label>
                    <select required class="form-control select2 select2-hidden-accessible" name="price" data-select2-id="5" tabindex="-1" aria-hidden="true">
                        <option value="">Chọn giá</option>
                        <option value="50000">50k</option>
                        <option value="100000">100k</option>
                        <option value="500000">500k</option>
                        <option value="1000000">1 triệu</option>
                        <option value="5000000">5 triệu</option>
                        <option value="10000000">10 triệu</option>
                    </select>
                    <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="6" style="width: 203px;">
                        <span class="selection">
                            <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-price-77-container">
                                <span class="select2-selection__rendered" id="select2-price-77-container" role="textbox" aria-readonly="true" title="Chọn giá">
                                    Chọn giá
                                </span>
                                <span class="select2-selection__arrow" role="presentation">
                                    <b role="presentation"></b>
                                </span>
                            </span>
                        </span>
                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                </div>
                <div class="row">
                    <div class="col-6 mt-3">
                        <label class="form-label">Server</label>
                        <select required class="form-control" name="acc_server" fdprocessedid="dvgca3">
                            <option value="allserver">Chọn Server</option>
                            <option value="Asia">Asia</option>
                            <option value="America">America</option>
                            <option value="Europe">Europe</option>
                            <option value="TW,HK,MO">TW,HK,MO</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button name="search" value="search" type="submit" class="col-8 form-control btn btn-warning text-white font-weight-bold"><i class="fab fa-searchengin ml-2"></i> Tìm kiếm
                    </button>
                </div>
            </form>
        </section>
    </div>
    <div class="col-lg-9  mt-4 mt-lg-0">
        <div class="row">
            <?php if ($accounts->num_rows > 0) { ?>
                <?php foreach ($accounts as $account) : ?>
                    <article class="col-md-6 col-lg-4">
                        <div class="genshin-product">
                            <div class="product-code"><?php echo '#' . $account['acc_id']; ?></div>
                            <div class="wrapper product-wrapper">
                                <div class="ribbon-wrapper ribbon-lg">
                                    <div class="ribbon bg-warning text-lg">
                                        <?php echo $account['gia'] ?><sub>đ</sub>
                                    </div>
                                </div>
                                <a href="/user/acc-detail/<?php echo $account['acc_id'] ?>">
                                    <img class="img-banner" src="../../../public/asset/img/<?php echo $account['img'] ?>" alt="">
                                </a>
                                <div class="row g-0 info-line">
                                    <section class="col text-center"><label>AR level</label><?php echo $account['level'] ?> </section>
                                    <section class="col text-center text-uppercase"><label>Khu Vực
                                        </label><?php echo $account['khuvuc'] ?></section>
                                    <section class="col text-center"><label>Tướng:</label> <?php echo $account['soluongtuong'] ?> </section>
                                </div>
                                <div class="hr-product"></div>
                                <div class="row g-0 info-line">
                                </div>
                                <div class="hr-product"></div>
                                <div class="row g-0 info-line">
                                    <section class="row g-0 text-center">
                                        <label class="col-12 pb-2">Vũ khí
                                            : <?php echo $account['soluongvukhi'] ?></label>
                                        <span class="col hero-details">
                                            <i class="hero-icon" style="background-image: url('style/images/genshin/weapons/haran-geppaku-futsu.png')" data-toggle="tooltip" title="" data-original-title="haran-geppaku-futsu"></i>
                                        </span>
                                    </section>
                                </div>
                                <div class="btn-ct-footer">
                                    <form method="post" action="/auth/muaacc">
                                        <input type="text" name="acc_id" value=<?= $account['acc_id'] ?> class="visually-hidden">
                                        <input type="text" name="sotien" value=<?= $account['gia'] ?> class="visually-hidden">
                                        <input class="btn-ct btn-pretty mb-2" type="submit" value="Mua">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php } else { ?>
                <p class="text-center">Không tài khoản phù hợp!!!</p>
            <?php } ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>