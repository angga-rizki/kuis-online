<style>
    #infoContainer {
        text-align: center;
    }
    #infoContainer a {
        text-decoration: none;
    }
    .info {
        line-height: 180px;
        width: 300px;
        height: 200px;
        margin: 40px;
        display: inline-block;
        font-size: 80px;
        font-weight: bold;
        text-align: center;
        color: white;
    }
</style>

<div id="infoContainer">
    <a class="info border border-0 bg-success rounded p-2 btn btn-outline-success" href="<?= site_url('admin/user') ?>" title="Jumlah User">
        <i class="fa fa-user"></i>
        <?= esc($jumlah_user); ?>        
    </a>
    <a class="info border border-0 bg-danger rounded p-2 btn btn-outline-danger" href="<?= site_url('admin/history') ?>" title="Jumlah History">
        <i class="fa fa-history"></i>
        <?= esc($jumlah_history); ?>
    </a>
    <a class="info border border-0 bg-primary rounded p-2 btn btn-outline-primary" href="<?= site_url('admin/quis') ?>" title="Jumlah Quis">
        <i class="fa fa-book"></i>
        <?= esc($jumlah_quis); ?>
    </a>
    <a class="info border border-0 bg-warning rounded p-2 btn btn-outline-warning" href="<?= site_url('admin/soal') ?>" title="Jumlah Soal">
        <i class="fa fa-list-alt"></i>
        <?= esc($jumlah_soal); ?>
    </a>
</div>
