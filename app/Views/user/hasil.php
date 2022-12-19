<style>
    #nilai {
        display: inline-block;
        text-align: center;
        padding: 10px 80px;
        font-weight: bold;
        font-size: 100px;
        color: #00cc33;
        border: 5px solid #00cc33;
        border-radius: 20px;
    }
</style>

<!-- Alert -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/../assets/css/alert.css">
<div id="alertContainer">
    <div id="suksesAlert" class="alert alert-success">
        <?php
        if (session()->has('message')) {
            echo session()->getFlashdata('message');
        }
        ?>
        <span class="close fa fa-remove mx-3"></span>
        <div class="clearfix"></div>
    </div>
    <div id="errorAlert" class="alert alert-danger">
        <?php
        if (session()->has('message')) {
            echo session()->getFlashdata('message');
        }
        ?>
        <span class="close fa fa-remove mx-3"></span>
        <div class="clearfix"></div>
    </div>
</div>
<!-- End Alert -->

<div class="container border border-dark rounded text-center" style="max-width: 700px; padding: 30px;">
    <h1 class="font-weight-bold text-center text-capitalize mb-3"><i class="fa fa-star"></i> Nilai</h1>
    <div id="nilai" class="mb-3">
        <?php
        if (!isset($nilai) || !isset($score) || !isset($total_soal)) {
            $nilai = 0;
            $score = 0;
            $total_soal = 0;
        }
        ?>

        <?= $nilai ?>
        <h3 class="font-weight-bold"><?= $score . ' / ' . $total_soal ?></h3>
    </div>
    <a class="btn btn-lg btn-danger font-weight-bold d-block mx-auto mt-5" href="<?= site_url('home'); ?>" style="width: 150px;">
        <i class="fa fa-check font-weight-bold"></i> OK
    </a>

    <hr class="mt-5 mb-4">
    <div id="data_soal" class="text-left">
        <?php if (!empty($soal) && is_array($soal)) : ?>
            <?php $no = 1; ?>

            <form>
                <?php foreach ($soal as $soal_item) : ?>
                    <div class="soal mt-3 mx-3" style="font-size: 20px;">

                        <div class="pertanyaan font-weight-bold mb-2"><?= $no; ?>. <?= ucfirst(esc($soal_item->pertanyaan)); ?></div>

                        <div class="jawaban ml-4">
                            <div class="jawaban_a">
                                <?php if ($jawaban[$soal_item->id] == 'a') : ?>
                                    <input class="mr-1 bg-info" id="a<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="a" checked="" disabled="">
                                <?php else : ?>
                                    <input class="mr-1" id="a<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="a" disabled="">
                                <?php endif; ?>

                                <label for="a<?= $no; ?>"><?= ucfirst(esc($soal_item->jawaban_a)); ?></label>

                                <?php if ($jawaban_benar[$soal_item->id] == 'a') : ?>
                                    <i class="fa fa-check ml-1" style="color: #00cc33;"></i>
                                <?php endif; ?>
                            </div>
                            <div class="jawaban_b">
                                <?php if ($jawaban[$soal_item->id] == 'b') : ?>
                                    <input class="mr-1" id="b<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="b" disabled="" checked="">
                                <?php else : ?>
                                    <input class="mr-1" id="b<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="b" disabled="">
                                <?php endif; ?>

                                <label for="b<?= $no; ?>"><?= ucfirst(esc($soal_item->jawaban_b)); ?></label>

                                <?php if ($jawaban_benar[$soal_item->id] == 'b') : ?>
                                    <i class="fa fa-check ml-1" style="color: #00cc33;"></i>
                                <?php endif; ?>
                            </div>
                            <div class="jawaban_c">
                                <?php if ($jawaban[$soal_item->id] == 'c') : ?>
                                    <input class="mr-1" id="c<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="c" disabled="" checked="">
                                <?php else : ?>
                                    <input class="mr-1" id="c<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="c" disabled="">
                                <?php endif; ?>

                                <label for="c<?= $no; ?>"><?= ucfirst(esc($soal_item->jawaban_c)); ?></label>

                                <?php if ($jawaban_benar[$soal_item->id] == 'c') : ?>
                                <i class="fa fa-check ml-1" style="color: #00cc33;"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $no++; ?>
                    </div>
                <?php endforeach; ?>
            </form>
        <?php else : ?>

            <h4 class="text-center text-danger font-weight-bold my-5">Tidak ada soal ditemukan</h4>

        <?php endif ?>
    </div>
</div>

<script>
    var alertSukses = document.getElementById("suksesAlert");
    var alertError = document.getElementById("errorAlert");
    var alertContainer = document.getElementById("alertContainer");
    var close = document.getElementsByClassName("close");
    var status = "<?php
        if (session()->has('message')) {
            echo session()->getFlashdata('status');
        }
        ?>";

    function hideAlert() {
        var delay = 2000;
        setTimeout(function () {
            $("#alertContainer").hide(1000, function () {
            });
        }, delay);
    }

    function closeAlert() {
        $("#alertContainer").hide(1000, function () {
            alertContainer.style.display = "none";
        });
    }

    if (status == "sukses") {
        alertSukses.style.display = "block";
        hideAlert();
    }
    if (status == "error") {
        alertError.style.display = "block";
        hideAlert();
    }

    for (var i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            closeAlert();
        };
    }
</script>