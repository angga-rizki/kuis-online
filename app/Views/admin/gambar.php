<style>
    #gambar td {
        vertical-align: middle;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="editModalLabel">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" action="<?= site_url('admin/savegambar'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input id="id" name="id" type="hidden">
                    <div class="form-group">
                        <label for="file_gambar"><i class="fa fa-picture-o"></i> Gambar</label>
                        <input id="file_gambar" type="file" name="file_gambar" class="form-control" required="">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi"><i class="fa fa-list-alt"></i> Deskripsi</label>
                        <input id="deskripsi" type="text" name="deskripsi" class="form-control" maxlength="100" required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

    <button type="button" class="btn btn-success mb-3 font-weight-bold" data-toggle="modal" data-target="#uploadModal" data-id=""><i class="fa fa-plus"></i> Tambah</button>

    <div id="gambar">
        <?php if (!empty($gambar) && is_array($gambar)) : ?>
            <?php $no = 1; ?>      
            <table class="table table-bordered table-striped table-hover" style="width:100%;">
                <thead style="white-space: nowrap;">
                    <tr>
                        <th>No</th>
                        <th><i class="fa fa-picture-o"></i> Gambar</th>
                        <th><i class="fa fa-id-badge"></i> ID</th>                            
                        <th><i class="fa fa-list-alt"></i> Deskripsi</th>
                        <th><i class="fa fa-id-card-o"></i> Nama File</th>
                        <th><i class="fa fa-plus"></i> Ukuran</th>
                        <th><i class="fa fa-file"></i> Tipe File</th>
                        <th><i class="fa fa-edit"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody style="white-space: nowrap;">
                    <?php foreach ($gambar as $gambar_item): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><img src="<?= base_url() . '/../assets/picture/' . $gambar_item->nama_file; ?>" width='100' height='100'></td>
                            <td><?= esc($gambar_item->id); ?></td>
                            <td><?= esc($gambar_item->deskripsi); ?></td>
                            <td><?= esc($gambar_item->nama_file); ?></td>
                            <td><?= esc($gambar_item->ukuran_file); ?> kB</td>
                            <td><?= esc($gambar_item->tipe_file); ?></td>
                            <td>
                                <a href="<?= site_url('admin/deletegambar/' . $gambar_item->id); ?>" class="btn btn-danger font-weight-bold"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>

            <h4 class="text-center text-danger font-weight-bold m-3">Tidak ada daftar gambar ditemukan</h4>

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