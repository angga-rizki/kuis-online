<style>
    .container a {
        max-width: 400px;
        display: block;
        font-weight: bold;
    }
</style>
<div class="container border border-dark rounded font-weight-bold text-lg text-center" style="max-width: 700px;">
    <h2 class="font-weight-bold my-4"><i class="fa fa-book"></i> Quis</h2>
    <?php if (!empty($quis) && is_array($quis)) : ?>
        <?php foreach ($quis as $quis_item): ?>
            <a class="btn btn-lg btn-outline-success text-capitalize mx-auto my-3" href="<?= site_url('quis/') . $quis_item->kode_quis ?>">
                <?= esc($quis_item->nama_quis) ?>
            </a>
        <?php endforeach; ?>
    <?php else : ?>

        <h4 class="text-center text-danger font-weight-bold my-5">Tidak ada quis ditemukan</h4>

    <?php endif ?>
    <a class="btn btn-lg btn-outline-danger mx-auto mb-4" href="<?= site_url('history') ?>" style="margin-top: 80px;">
        <i class="fa fa-history"></i>
        History
    </a>    
</div>
