<?php ob_start(); ?>
<h1>Nạp Tiền</h1>
<div class="card-body">
    <div class="row">
        <div class="col-12 col-lg-6">
            <h3 class="text-center">Nhập thẻ</h3>
            <form method="post" action="/auth/naptien">
                <div class="form-group">
                    <label class="form-label">Nhà mạng</label>
                    <select name="card_network" class="form-control" required="">
                        <option value="1">Viettel - Khuyên dùng</option>
                        <option value="2">Mobifone</option>
                        <option value="3">Vinaphone</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Mệnh giá</label>
                    <select name="sotien" class="form-control" required="">
                        <optgroup label="Chọn cẩn thận. Sai sẽ bị phạt"></optgroup>
                        <option value="">Chọn mệnh giá</option>
                        <option value="10000">10,000 </option>
                        <option value="20000">20,000 </option>
                        <option value="30000">30,000 </option>
                        <option value="50000">50,000 </option>
                        <option value="100000">100,000 </option>
                        <option value="200000">200,000 </option>
                        <option value="300000">300,000 </option>
                        <option value="500000">500,000 </option>
                        <option value="1000000">1,000,000 </option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-6 mt-2">
                        <label>Seri thẻ</label>
                        <div class="input-group row">
                            <input name="card_seri" type="number" class="form-control concave " value="" placeholder="Điền seri của thẻ cào">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mt-2">
                        <label>Mã thẻ</label>
                        <div class="input-group row">
                            <input name="card_pin" type="number" class="form-control concave " value="" placeholder="Điền mã của thẻ cào">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mt-4 text-center">
                        <input type="text" class="visually-hidden" name="user_id" value="<?= isset($user['user_id']) ? $user['user_id'] : '' ?>">
                        <button type="submit" name="submit" value="submit" class="btn btn-pretty" style="background-color: yellow;">Yêu cầu nạp</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-6">
            <h3 class="text-center">Hướng dẫn</h3>
            <p>
                <font color="#ff0000"><b>Lưu ý!!!</b> Vui lòng chọn đúng mệnh giá, sai là mất thẻ.<br>Ưu tiên nạp Thẻ Viettel ít lỗi và xử lí nhanh<br><br><br><br></font>
            </p>
        </div>
    </div>
    <?php $content = ob_get_clean(); ?>
    <?php include(__DIR__ . '/../../../templates/layout.php'); ?>