<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username"><?= $data['nama'] ?></h3>
                                <h5 class="widget-user-desc"><?= $data['pokja'] ?></h5>
                            </div>
                            <div class="widget-user-image">
                                <?php if ($data['foto'] == null) { ?>
                                    <img src="<?= base_url('/media/fotouser/' . 'blank.png') ?>" class="img-circle elevation-2" alt="User Avatar">
                                <?php } else { ?>
                                    <img src="<?= base_url('/media/fotouser/' . session()->get('foto')) ?>" class="img-circle elevation-2" alt="User Avatar">
                                <?php } ?>
                            </div>
                            <div class="card-footer mt-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-user"></i> Profil Saya
                                        <a href="<?= base_url('my-profil/edit/' . $data['id']) ?>" class="btn btn-info btn-xs float-right">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col mt-4">
                                <h6><b>Nama</b></h6>
                                <span><?= $data['nama'] ?></span>
                                <h6 class="mt-2"><b>Email</b></h6>
                                <span><?= $data['email'] ?></span>
                                <h6 class="mt-2"><b>Username</b></h6>
                                <span><?= $data['username'] ?></span>
                                <h6 class="mt-2"><b>Nomor Handphone</b></h6>
                                <span><?= $data['nohp'] ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if (session()->get('level') == '1') { ?>
                        <div class="col-md-4">
                        </div>
                        <?php if (!empty($settings) && is_array($settings)) : ?>
                            <div class="col-md-8">
                                <div class="invoice p-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-user"></i> Profil Instansi
                                                <a href="<?= base_url('setting-profil/edit/' . $settings['id']) ?>" class="btn btn-info btn-xs float-right">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 invoice-col mt-4">
                                        <h6><b>Nama Desa</b></h6>
                                        <span><?= $settings['nama_desa'] ?></span>
                                        <h6 class="mt-2"><b>Kecamatan</b></h6>
                                        <span><?= $settings['nama_kecamatan'] ?></span>
                                        <h6 class="mt-2"><b>Alamat</b></h6>
                                        <span><?= $settings['alamat'] ?></span>
                                        <h6 class="mt-2"><b>Kode Pos</b></h6>
                                        <span><?= $settings['kode_pos'] ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="col-md-8">
                                <div class="invoice p-3 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fas fa-home"></i> Profil Instansi
                                                <a href="<?= base_url('setting-profil/add') ?>" class="btn btn-warning btn-xs float-right">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table>
                                            <h6>
                                                <center><i>Profil belum disetting . . .</i></center>
                                            </h6>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>