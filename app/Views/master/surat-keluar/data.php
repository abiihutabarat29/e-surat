<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="swal" data-swal="<?= session()->getFlashdata('m'); ?>"></div>
                        <div class="swalErr" data-swal="<?= session()->getFlashdata('err'); ?>"></div>
                        <?php if (session()->get('level') == '3' or session()->get('level') == '2') { ?>
                            <div class="card-header">
                                <a href="<?= base_url('tambah-surat-keluar') ?>" class="btn btn-info btn-xs">
                                    <i class="fa fa-plus-circle"></i>&nbsp;Tambah
                                </a>
                            </div>
                        <?php } ?>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 15%">Nomor Surat</th>
                                        <th style="width: 10%">Sifat</th>
                                        <th style="width: 40%">Perihal</th>
                                        <th style="width: 20%">Tujuan</th>
                                        <th style="width: 10%">
                                            <center>Created</center>
                                        </th>
                                        <th style="width: 5%">
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($data as $key => $r) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $r['no_surat']; ?></td>
                                            <td><?= $r['sifat_surat']; ?></td>
                                            <td><?= $r['perihal']; ?></td>
                                            <td>
                                                <?php if ($r['tujuan'] == 'all') {
                                                    echo 'Semua Pokja';
                                                } else {
                                                    echo $r['tujuan'];
                                                } ?>
                                            </td>
                                            <td><?= format_tanggal($r['created_at']); ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <?php if (session()->get('level') == '4') { ?>
                                                                <a class="dropdown-item" href="<?= base_url('surat-keluar/detail/' . $r['id']) ?>">Detail</a>
                                                                <a class="dropdown-item" href="<?= base_url('surat-keluar-kabupaten/print/' . $r['id']) ?>" target="_blank">Print</a>
                                                            <?php } else { ?>
                                                                <a class="dropdown-item" href="<?= base_url('surat-keluar/detail/' . $r['id']) ?>">Detail</a>
                                                                <a class="dropdown-item" href="<?= base_url('surat-keluar/print/' . $r['id']) ?>" target="_blank">Print</a>
                                                                <?php if (session()->get('level') == '3' && $r['pokja'] == (session()->get('pokja'))) { ?>
                                                                    <a class="dropdown-item" href="<?= base_url('surat-keluar/edit/' . $r['id']) ?>">Edit</a>
                                                                    <a class="dropdown-item" href="#" data-toggle='modal' data-target='#activateModalDeleteSk<?= $r['id'] ?>'>Delete</a>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal -->
<?php foreach ($data as $r) { ?>
    <form action="<?= base_url('surat-keluar/' . $r['id']); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal fade" id="activateModalDeleteSk<?= $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apa kamu yakin ingin menghapus surat dengan nomor <span class="text-danger"><?= $r['no_surat'] ?></span> ini secara permanen ???
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-default btn-sm" type="button" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-sm">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>