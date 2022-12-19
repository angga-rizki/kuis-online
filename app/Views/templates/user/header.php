<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Quis Online - <?= ucwords(esc($title)); ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/../assets/bootstrap-4.5.0-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/../assets/fa/css/solid.min.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>/../assets/fa/css/font-awesome.min.css" />
        <script src="<?= base_url(); ?>/../assets/jquery-3.5.1.min.js"></script>
        <script src="<?= base_url(); ?>/../assets/bootstrap-4.5.0-dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <style>
            body {
                position: relative;
                min-height: 100vh;
                padding-bottom: 40px;
            }
            .wrapper {
                padding: 30px;
            }
            .navbar {
                white-space: nowrap;
            }
        </style>

        <!-- Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold" id="editModalLabel">Upload Foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEdit" action="<?= site_url('admin/savegambar'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input id="id" name="id" type="hidden">
                            <div class="form-group">
                                <label for="file_gambar"><i class="fa fa-picture-o"></i> Foto</label>
                                <input id="file_gambar" type="file" name="file_gambar" class="form-control" required="">
                            </div>

                            <input id="deskripsi" type="hidden" name="deskripsi" class="form-control" maxlength="100" required="" value="<?= 'foto_' . $user->username ?>">
                            <input id="from" type="hidden" name="from" class="form-control" maxlength="4" required="" value="user">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark px-4 text-light">

            <div class="dropdown">
                <a class="dropdown-toggle text-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#" style="text-decoration: none;">
                    <?php if (is_file('../assets/picture/' . $user->foto)) : ?>
                    <img class="rounded-circle" src="<?= base_url() ?>/../assets/picture/<?= $user->foto; ?>" width="37.85" height="35">
                    <?php else: ?>
                        <i class="fa fa-user bg-light rounded-circle text-dark" style="font-size: 25px;padding: 5px 10px;"></i>
                    <?php endif; ?>                    
                </a>
                <div class="dropdown-menu">
                    <button type="button" class="dropdown-item font-weight-bold" data-toggle="modal" data-target="#uploadModal" data-id=""><i class="fa fa-upload"></i> Upload Foto</button>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item font-weight-bold" href="<?= site_url('auth/logout') ?>" style="color: #dc3545;">
                        <i class="fa fa-sign-out"></i>
                        Logout
                    </a>
                </div>
            </div>
            <div class="navbar-nav">
                <a class="nav-item nav-link ml-3" href="<?= site_url('home'); ?>"><h5 class="font-weight-bold"><i class="fa fa-home"></i> Home</h5></a>
            </div>

            <div class="navbar-collapse collapse">
                <h5 class="navbar-text font-weight-bold text-light mx-auto"><?= esc($user->nama) ?></h5>
            </div>

            <h4 class="navbar-text font-weight-bold"><i class="fa fa-level-up"></i> <em><?= esc($user->level) ?></em></h4>
        </nav>
        <div class="wrapper">