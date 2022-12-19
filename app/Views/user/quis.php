<div class="container border border-dark rounded" style="max-width: 700px;">    
    <?php if (!empty($soal) && is_array($soal)) : ?>
        <?php $no = 1; ?>

        <h3 class="font-weight-bold text-center text-capitalize my-4"><i class="fa fa-book"></i> <?= $quis->nama_quis; ?></h3>

        <form action="<?= site_url('hasil'); ?>" method="post">

            <input name="kode_quis" type="hidden" value="<?= $quis->kode_quis; ?>" required="">

            <?php foreach ($soal as $soal_item) : ?>
                <div class="soal m-3" style="font-size: 20px;">
                    <input name="nomor[]" type="hidden" value="<?= $no; ?>" required="">
                    <input name="id_soal<?= $no; ?>" type="hidden" value="<?= $soal_item->id; ?>" required="">

                    <div class="pertanyaan font-weight-bold mb-2"><?= $no; ?>. <?= ucfirst(esc($soal_item->pertanyaan)); ?></div>

                    <div class="jawaban ml-4">
                        <div class="jawaban_a">
                            <input class="mr-1" id="a<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="a" required="">
                            <label for="a<?= $no; ?>"><?= ucfirst(esc($soal_item->jawaban_a)); ?></label>
                        </div>
                        <div class="jawaban_b">
                            <input class="mr-1" id="b<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="b" required="">
                            <label for="b<?= $no; ?>"><?= ucfirst(esc($soal_item->jawaban_b)); ?></label>
                        </div>
                        <div class="jawaban_c">
                            <input class="mr-1" id="c<?= $no; ?>" type="radio" name="jawaban<?= $no; ?>" value="c" required="">
                            <label for="c<?= $no; ?>"><?= ucfirst(esc($soal_item->jawaban_c)); ?></label>
                        </div>
                    </div>

                </div>
                <?php $no++; ?>
            <?php endforeach; ?>

            <button class="btn btn-lg btn-success font-weight-bold d-block mx-auto my-4" type="submit"><i class="fa fa-check"></i> Selesai</button>
        </form>

    <?php else : ?>

        <h4 class="text-center text-danger font-weight-bold my-5">Tidak ada soal ditemukan</h4>

    <?php endif ?>


</div>