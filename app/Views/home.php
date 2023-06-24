<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard
                        <?php if (session()->get('level') == '1') {
                            echo "Administrator Desa" . " " . $namaInstansi;
                        } elseif (session()->get('level') == '2') {
                            echo "Sekretaris PKK" . " " . $namaInstansi;
                        } elseif (session()->get('level') == '4') {
                            echo "Administrator Kabupaten";
                        } elseif (session()->get('level') == '3') { ?>
                            <?= session()->get('pokja'); ?> <?= $namaInstansi ?>
                        <?php } ?>
                    </h1>
                    <h6><?= $appname; ?></h6>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?= $users ?></h3>
                            <p>Account Users</p>
                        </div>
                        <div class="icon">
                            <i class="ionicons ion-ios-people"></i>
                        </div>
                        <?php if (session()->get('level') == '1') { ?>
                            <a href="<?= base_url('data-user') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer">Users</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="small-box bg-fuchsia">
                        <div class="inner">
                            <h3><?= $sekretariat ?></h3>
                            <p>Sekretariat</p>
                        </div>
                        <div class="icon">
                            <i class="ionicons ion-email-unread"></i>
                        </div>
                        <?php if (session()->get('level') == '1') { ?>
                            <a href="<?= base_url('surat-masuk') ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer">Surat Masuk</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $pokjaI ?></h3>
                            <p>POKJA I</p>
                        </div>
                        <div class="icon">
                            <i class="ionicons ion-email-unread"></i>
                        </div>
                        <?php if (session()->get('level') == '1') { ?>
                            <a href="<?= base_url('surat-masuk') ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer">Surat Masuk</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $pokjaII ?></h3>
                            <p>POKJA II</p>
                        </div>
                        <div class="icon">
                            <i class="ionicons ion-email-unread"></i>
                        </div>
                        <?php if (session()->get('level') == '1') { ?>
                            <a href="<?= base_url('surat-masuk') ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer">Surat Masuk</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3><?= $pokjaIII ?></h3>
                            <p>POKJA III</p>
                        </div>
                        <div class="icon">
                            <i class="ionicons ion-email-unread"></i>
                        </div>
                        <?php if (session()->get('level') == '1') { ?>
                            <a href="<?= base_url('surat-masuk') ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer">Surat Masuk</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?= $pokjaIV ?></h3>
                            <p>POKJA IV</p>
                        </div>
                        <div class="icon">
                            <i class="ionicons ion-email-unread"></i>
                        </div>
                        <?php if (session()->get('level') == '1') { ?>
                            <a href="<?= base_url('surat-masuk') ?>" class="small-box-footer">Selengkapnya<i class="fas fa-arrow-circle-right"></i></a>
                        <?php } else { ?>
                            <a href="#" class="small-box-footer">Surat Masuk</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>