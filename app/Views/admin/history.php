<style>
    #container td {
        vertical-align: middle;
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

<div class="container-fluid p-3">

    <div id="container">
        <?php if (!empty($history) && is_array($history)) : ?>
            <?php $no = 1; ?>      
            <table class="table table-bordered table-striped table-hover" style="width:100%;">
                <thead style="white-space: nowrap;">
                    <tr>
                        <th>No</th>
                        <th><i class="fa fa-id-badge"></i> ID</th>
                        <th><i class="fa fa-user"></i> Username</th>                            
                        <th><i class="fa fa-id-card-o"></i> Nama Quis</th>
                        <th><i class="fa fa-level-up"></i> Level</th>
                        <th><i class="fa fa-calendar"></i> Tanggal</th>
                        <th><i class="fa fa-clock-o"></i> Jam</th>
                        <th><i class="fa fa-star"></i> Hasil</th>
                        <th><i class="fa fa-edit"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $history_item): ?>
                        <?php $tanggal = date_create($history_item->tanggal) ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= esc($history_item->id); ?></td>
                            <td><?= esc($history_item->username); ?></td>
                            <td><?= esc($history_item->nama_quis); ?></td>
                            <td><?= esc($history_item->level); ?></td>
                            <td><?= esc(date_format($tanggal, 'd/m/Y')); ?></td>
                            <td><?= esc(date_format($tanggal, 'H:i')); ?></td>
                            <td><?= esc($history_item->hasil); ?></td>
                            <td>
                                <a href="<?= site_url('admin/deletehistory/' . $history_item->id); ?>" class="btn btn-danger font-weight-bold"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>

            <h4 class="text-center text-danger font-weight-bold m-3">Tidak ada history ditemukan</h4>

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

    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });

        $('.table').DataTable({
            "scrollX": true,
            "ordering": false
        });
    });
</script>