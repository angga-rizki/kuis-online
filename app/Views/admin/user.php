<style>
    .table td {
        vertical-align: middle;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="editModalLabel">Tambah / Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" action="<?= site_url('admin/saveuser'); ?>" method="post">
                <div class="modal-body">
                    <input id="id" class="reset" name="id" type="hidden">
                    <div class="form-group">
                        <label for="username" class="form-l"><i class="fa fa-user"></i> Username</label>
                        <input id="username" type="text" name="username" class="form-control" maxlength="12" required="">
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fa fa-key"></i> Password</label>
                        <input id="password" type="text" name="password" class="form-control" maxlength="12" required="">
                    </div>

                    <div class="form-group">
                        <label for="nama"><i class="fa fa-id-card-o"></i> Nama</label>
                        <input id="nama" type="text" name="nama" class="form-control" maxlength="50" required="">
                    </div>

                    <div class="form-group">
                        <label for="type"><i class="fa fa-users"></i> Type</label>
                        <div id="type" class="form-control">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="userRadio" type="radio" name="type" value="user" required="">
                                <label class="form-check-label" for="userRadio">User</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" id="adminRadio" type="radio" name="type" value="admin" required="">
                                <label class="form-check-label" for="adminRadio">Admin</label>
                            </div>
                        </div>
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
    <div class="font-weight-bold">
        <nav>
            <div class="nav nav-tabs" id="userTab" role="tablist">
                <a class="nav-item nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-contols="user" aria-selected="true">User</a>
                <a class="nav-item nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
            </div>
        </nav>
    </div>

    <button type="button" class="btn btn-success my-3 font-weight-bold" data-toggle="modal" data-target="#editModal" data-id=""><i class="fa fa-plus"></i> Tambah</button>

    <div class="tab-content" id="userTabContent">

        <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
            <?php if (!empty($user) && is_array($user)) : ?>
                <?php $no = 1; ?>     
                <table class="table table-bordered table-striped table-hover" style="width:100%;">
                    <thead style="white-space: nowrap;">
                        <tr>
                            <th>No</th>
                            <th><i class="fa fa-user"></i> Username</th>
                            <th><i class="fa fa-key"></i> Password</th>
                            <th><i class="fa fa-id-card-o"></i> Nama</th>
                            <th><i class="fa fa-users"></i> Type</th>
                            <th><i class="fa fa-level-up"></i> Level</th>
                            <th><i class="fa fa-edit"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap;">
                        <?php foreach ($user as $user_item): ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= esc($user_item->username); ?></td>
                                <td><?= esc($user_item->password); ?></td>
                                <td><?= esc($user_item->nama); ?></td>
                                <td><?= esc($user_item->type); ?></td>
                                <td><?= esc($user_item->level); ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#editModal" data-id="<?= $user_item->username; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <a href="<?= site_url('admin/deleteuser/' . $user_item->username); ?>" class="btn btn-danger font-weight-bold"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>

                <h4 class="text-center text-danger font-weight-bold m-3">Tidak ada user ditemukan</h4>

            <?php endif ?>
        </div>

        <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
            <?php if (!empty($admin) && is_array($admin)) : ?>
                <?php $no = 1; ?>
                <table class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead style="white-space: nowrap;">
                        <tr>
                            <th>No</th>
                            <th><i class="fa fa-user"></i> Username</th>
                            <th><i class="fa fa-key"></i> Password</th>
                            <th><i class="fa fa-id-card-o"></i> Nama</th>
                            <th><i class="fa fa-users"></i> Type</th>
                            <th><i class="fa fa-level-up"></i> Level</th>
                            <th><i class="fa fa-edit"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="white-space: nowrap;">
                        <?php foreach ($admin as $admin_item): ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= esc($admin_item->username); ?></td>
                                <td><?= esc($admin_item->password); ?></td>
                                <td><?= esc($admin_item->nama); ?></td>
                                <td><?= esc($admin_item->type); ?></td>
                                <td><?= esc($admin_item->level); ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#editModal" data-id="<?= $admin_item->username; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <a href="<?= site_url('admin/deleteuser/' . $admin_item->username); ?>" class="btn btn-danger font-weight-bold"><i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>

                <h4 class="text-center text-danger font-weight-bold m-3">Tidak ada user ditemukan</h4>

            <?php endif ?>
        </div>
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

    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        var username = password = nama = "";
        var type = level = "radio"; //"radio" cuma placeholder

        if (id !== "") {
            username = event.relatedTarget.closest('tr').cells[1].innerHTML;
            password = event.relatedTarget.closest('tr').cells[2].innerHTML;
            nama = event.relatedTarget.closest('tr').cells[3].innerHTML;
            type = event.relatedTarget.closest('tr').cells[4].innerHTML;
            level = event.relatedTarget.closest('tr').cells[5].innerHTML;

            $('#id').val(id);
            $('#username').val(username);
            $('#password').val(password);
            $('#nama').val(nama);
            $('#' + type + 'Radio').prop('checked', true);
            $('#' + level).prop('checked', true);
        }
    });

    $('#editModal').on('hidden.bs.modal', function () {
        $('.reset').val("");
        $('#formEdit')[0].reset();
    });

    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $.fn.dataTable.tables({visible: true, api: true}).columns.adjust();
        });
        
        $('.table').DataTable({
            "scrollX": true,
            "ordering": false
        });
    });
</script>