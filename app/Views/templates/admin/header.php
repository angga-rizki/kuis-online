<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Admin - <?= esc($title); ?></title>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/../assets/bootstrap-4.5.0-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>/../assets/fa/css/solid.min.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>/../assets/fa/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/../assets/DataTables/datatables.css">
        <script src="<?= base_url(); ?>/../assets/jquery-3.5.1.min.js"></script>
        <script src="<?= base_url(); ?>/../assets/bootstrap-4.5.0-dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" charset="utf8" src="<?= base_url(); ?>/../assets/DataTables/datatables.js"></script>
    </head>

    <body>
        <style>
            body {
                position: relative;
                min-height: 100vh;
                padding-bottom: 40px;
            }
            .wrapper {
                padding-left: 230px;
            }
        </style>
        <aside class="position-fixed bg-dark overflow-auto border-right border-white" style="top: 0; left: 0; bottom: 0; padding-bottom: 40px; width: 230px;">
            <nav class="navbar-dark">
                <a class="navbar-brand d-block px-3 mx-0 mb-2 font-weight-bold" href="<?= site_url('admin') ?>">Hi, <?= esc($nama) ?>!</a>
                <div id="link">
                    <a class="nav-item nav-link btn-outline-light" href="<?= site_url('admin') ?>">
                        <i class="fa fa-home"></i>
                        Home
                    </a>
                    <a class="nav-item nav-link btn-outline-light" href="<?= site_url('admin/user') ?>">
                        <i class="fa fa-user"></i>
                        User
                    </a>
                    <a class="nav-item nav-link btn-outline-light" href="<?= site_url('admin/quis') ?>">
                        <i class="fa fa-book"></i>
                        Quis
                    </a>
                    <a class="nav-item nav-link btn-outline-light" href="<?= site_url('admin/soal') ?>">
                        <i class="fa fa-list-alt"></i>
                        Soal
                    </a>
                    <a class="nav-item nav-link btn-outline-light" href="<?= site_url('admin/history') ?>">
                        <i class="fa fa-history"></i>
                        History
                    </a>                    
                    <a class="nav-item nav-link btn-outline-light" href="<?= site_url('admin/gambar') ?>">
                        <i class="fa fa-picture-o"></i>
                        Gambar
                    </a>
                </div>

                <a class="nav-item btn btn-outline-danger font-weight-bold d-block mx-auto my-3" href="<?= site_url('auth/logout') ?>" style="width: 200px;">
                    <i class="fa fa-sign-out"></i>
                    Logout
                </a>

            </nav>
        </aside>
        <div class="wrapper">
