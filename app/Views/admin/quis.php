<style>
    #quis td {
        vertical-align: middle;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="quisModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="editModalLabel">Tambah / Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" action="<?= site_url('admin/savequis'); ?>" method="post" enctype="multipart/form-data">
                <input id="soal_di_delete" class="reset" name="soal_di_delete" type="hidden" value="">
                <div class="modal-body">
                    <input id="id_quis" name="id_quis" type="hidden" value="">
                    <div class="form-group">
                        <label for="kode_quis"><i class="fa fa-book"></i> Kode Quis</label>
                        <input id="kode_quis" type="text" name="kode_quis" class="form-control" maxlength="20" required="">
                    </div>

                    <div class="form-group">
                        <label for="nama_quis"><i class="fa fa-id-card-o"></i> Nama Quis</label>
                        <input id="nama_quis" type="text" name="nama_quis" class="form-control" maxlength="20" required="">
                    </div>

                    <div class="form-group">
                        <label for="level"><i class="fa fa-level-up"></i> Level</label>
                        <div id="level" class="form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="newbie" type="radio" name="level" value="newbie" required="">
                                <label class="form-check-label" for="newbie">Newbie</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="advance" type="radio" name="level" value="advance" required="">
                                <label class="form-check-label" for="advance">Advance</label>
                            </div>
                        </div>
                    </div>

                    <div id="soal">
                        <h5 class="font-weight-bold mb-3"><i class="fa fa-list-alt"></i> Soal</h5>
                        <div class="soal">
                            <input id="id_soal_1" class="reset" name="id_soal_1" type="hidden" value="">
                            <input id="nomor_soal_1" type="hidden" name="nomor_soal[]" value="1">
                            <div class="form-row mb-2">                                
                                <label for="soal_1" class="col-form-label">1.</label>
                                <div class="col-10">
                                    <input id="soal_1" type="text" name="soal_1" class="form-control" maxlength="255" required="">
                                </div>
                                <div class="col">
                                    <button type="button" id="tambahSoal" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="form-row align-items-center mb-2 ml-4">
                                <label for="jawab_a1" class="col-form-label">A.</label> 
                                <div class="col-8">
                                    <input id="jawab_a1" type="text" name="jawab_a1" class="form-control" maxlength="255" required="">
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" id="a1" type="radio" name="jawaban_benar1" value="a" required="">
                                        <label class="form-check-label" for="a1"><i class="fa fa-check"></i></label>
                                    </div>                            
                                </div>
                            </div>

                            <div class="form-row align-items-center mb-2 ml-4">
                                <label for="jawab_b1" class="col-form-label">B.</label> 
                                <div class="col-8">
                                    <input id="jawab_b1" type="text" name="jawab_b1" class="form-control" maxlength="255" required="">                            
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" id="b1" type="radio" name="jawaban_benar1" value="b" required="">
                                        <label class="form-check-label" for="b1"><i class="fa fa-check"></i></label>
                                    </div>                            
                                </div>
                            </div>

                            <div class="form-row align-items-center mb-2 ml-4">
                                <label for="jawab_c1" class="col-form-label">C.</label> 
                                <div class="col-8">
                                    <input id="jawab_c1" type="text" name="jawab_c1" class="form-control" maxlength="255" required="">                            
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" id="c1" type="radio" name="jawaban_benar1" value="c" required="">
                                        <label class="form-check-label" for="c1"><i class="fa fa-check"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <button type="button" class="btn btn-success mb-3 font-weight-bold" data-toggle="modal" data-target="#quisModal" data-id=""><i class="fa fa-plus"></i> Tambah</button>

    <div id="quis">
        <?php if (!empty($quis) && is_array($quis)) : ?>
            <?php $no = 1; ?>     
            <table class="table table-bordered table-striped table-hover" style="width:100%;">
                <thead style="white-space: nowrap;">
                    <tr>
                        <th>No</th>
                        <th><i class="fa fa-book"></i> Kode Quis</th>
                        <th><i class="fa fa-id-card-o"></i> Nama Quis</th>                            
                        <th><i class="fa fa-plus"></i> Jumlah Soal</th>
                        <th><i class="fa fa-level-up"></i> Level</th>
                        <th><i class="fa fa-edit"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody style="white-space: nowrap;">
                    <?php foreach ($quis as $quis_item): ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= esc($quis_item->kode_quis); ?></td>
                            <td><?= esc($quis_item->nama_quis); ?></td>
                            <td><?= esc($quis_item->jumlah_soal); ?></td>
                            <td><?= esc($quis_item->level); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#quisModal" data-id="<?= $quis_item->kode_quis; ?>"><i class="fa fa-edit"></i> Edit</button>
                                <a href="<?= site_url('admin/deletequis/' . $quis_item->kode_quis); ?>" class="btn btn-danger font-weight-bold"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>

            <h4 class="text-center text-danger font-weight-bold m-3">Tidak ada quis ditemukan</h4>

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

    var nomor_soal = 2;
    function append(id_soal = "", pertanyaan = "", jawaban_a = "", jawaban_b = "", jawaban_c = "", jawaban_benar = "") {
        $('#soal').append(
                '<div class="soal append">' +
                '<input id="id_soal_' + nomor_soal + '" name="id_soal_' + nomor_soal + '" type="hidden" value="' + id_soal + '">' +
                '<input type="hidden" name="nomor_soal[]" value="' + nomor_soal + '">' +
                '<div class="form-row mb-2">' +
                '<label for="soal_' + nomor_soal + '" class="col-form-label">' + nomor_soal + '. </label>' +
                '<div class="col-10">' +
                '<input id="soal_' + nomor_soal + '" type="text" name="soal_' + nomor_soal + '" class="form-control" maxlength="255" required="" value="' + pertanyaan + '">' +
                '</div>' +
                '<div class="col">' +
                '<button type="button" class="hapusSoal btn btn-danger" data-id="' + id_soal + '"><i class="fa fa-trash"></i></button>' +
                '</div>' +
                '</div>' +
                '<div class="form-row align-items-center mb-2 ml-4">' +
                '<label for="jawab_a' + nomor_soal + '" class="col-form-label">A.</label>' +
                '<div class="col-8">' +
                '<input id="jawab_a' + nomor_soal + '" type="text" name="jawab_a' + nomor_soal + '" class="form-control" maxlength="255" required="" value="' + jawaban_a + '">' +
                '</div>' +
                '<div class="col">' +
                '<div class="form-check">' +
                '<input class="form-check-input" id="a' + nomor_soal + '" type="radio" name="jawaban_benar' + nomor_soal + '" value="a" required="">' +
                '<label class="form-check-label" for="a' + nomor_soal + '"><i class="fa fa-check"></i></label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-row align-items-center mb-2 ml-4">' +
                '<label for="jawab_b' + nomor_soal + '" class="col-form-label">B.</label>' +
                '<div class="col-8">' +
                '<input id="jawab_b' + nomor_soal + '" type="text" name="jawab_b' + nomor_soal + '" class="form-control" maxlength="255" required="" value="' + jawaban_b + '">' +
                '</div>' +
                '<div class="col">' +
                '<div class="form-check">' +
                '<input class="form-check-input" id="b' + nomor_soal + '" type="radio" name="jawaban_benar' + nomor_soal + '" value="b" required="">' +
                '<label class="form-check-label" for="b' + nomor_soal + '"><i class="fa fa-check"></i></label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="form-row align-items-center mb-2 ml-4">' +
                '<label for="jawab_c' + nomor_soal + '" class="col-form-label">C.</label>' +
                '<div class="col-8">' +
                '<input id="jawab_c' + nomor_soal + '" type="text" name="jawab_c' + nomor_soal + '" class="form-control" maxlength="255" required="" value="' + jawaban_c + '">' +
                '</div>' +
                '<div class="col">' +
                '<div class="form-check">' +
                '<input class="form-check-input" id="c' + nomor_soal + '" type="radio" name="jawaban_benar' + nomor_soal + '" value="c" required="">' +
                '<label class="form-check-label" for="c' + nomor_soal + '"><i class="fa fa-check"></i></label>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
                );
        $('#' + jawaban_benar + nomor_soal).prop('checked', true);
        nomor_soal++;
    }

    $('#tambahSoal').on('click', function () {
        append();
    });

    var soal_di_delete = [];
    $('form').delegate('.hapusSoal', 'click', function (event) {
        $(this).closest('.append').remove();

        var id_soal = $(this).data('id');
        soal_di_delete.push(id_soal);
        $('#soal_di_delete').val(soal_di_delete);
    });

    $('#quisModal').on('show.bs.modal', function (event) {
        $('#nomor_soal_1').val('1');
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_quis = button.data('id'); // Extract info from data-* attributes

        if (id_quis !== "") {
            $.ajax({
                url: '<?= site_url('admin/getquisdata') ?>',
                method: 'get',
                data: {kode_quis: id_quis},
                dataType: 'json'
            }).done(function (data) {
                $('#id_soal_1').val(data[0].id);
                $('#soal_1').val(data[0].pertanyaan);
                $('#jawab_a1').val(data[0].jawaban_a);
                $('#jawab_b1').val(data[0].jawaban_b);
                $('#jawab_c1').val(data[0].jawaban_c);
                $('#' + data[0].jawaban_benar + '1').prop('checked', true);

                for (var i = 1; i < data.length; i++) { //i = 1, mulai dari data ke-2
                    append(data[i].id, data[i].pertanyaan, data[i].jawaban_a, data[i].jawaban_b, data[i].jawaban_c, data[i].jawaban_benar);
                }
            });

            var kode_quis = event.relatedTarget.closest('tr').cells[1].innerHTML;
            var nama_quis = event.relatedTarget.closest('tr').cells[2].innerHTML;
            var level = event.relatedTarget.closest('tr').cells[4].innerHTML;

            $('#id_quis').val(id_quis);
            $('#kode_quis').val(kode_quis);
            $('#nama_quis').val(nama_quis);
            $('#' + level).prop('checked', true);
        }
    });

    $('#quisModal').on('hidden.bs.modal', function () {
        $('#formEdit').find('.append').remove();
        $('.reset').val("");
        $('#formEdit')[0].reset();
        nomor_soal = 2;
        soal_di_delete = [];
    });
    
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