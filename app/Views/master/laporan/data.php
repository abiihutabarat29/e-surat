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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="swal" data-swal="<?= session()->getFlashdata('m'); ?>"></div>
                        <div class="card-header">
                            <a href="<?= base_url('tambah-laporan-kegiatan') ?>" class="btn btn-info btn-xs">
                                <i class="fa fa-plus-circle"></i>&nbsp;Tambah
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th>Judul</th>
                                        <th style="width: 20%">Tanggal Kegiatan</th>
                                        <th style="width: 20%">Dokumentasi Kegiatan</th>
                                        <th style="width: 10%">
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($data as $key => $r) : ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $r['judul']; ?></td>
                                            <td><?= format_indo($r['tgl_kegiatan']); ?></td>
                                            <td>
                                                <center>
                                                    <?php if ($r['foto_kegiatan'] == null) { ?>
                                                        <img src="<?= base_url('/media/foto-kegiatan/' . 'camera.png') ?>" width="100px" height="50px" class="img rounded">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('/media/foto-kegiatan/' . $r['foto_kegiatan']) ?>" width="100px" height="50px" class="img rounded">
                                                    <?php } ?>
                                                </center>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <center>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu">
                                                                <?php if (session()->get('level') == '4') { ?>
                                                                    <a class="dropdown-item" href="<?= base_url('laporan-kegiatan/detail/' . $r['id']) ?>">Detail</a>
                                                                    <a class="dropdown-item" href="#" data-toggle='modal' data-target='#activateModalDelete<?= $r['id'] ?>'>Delete</a>
                                                                <?php } else { ?>
                                                                    <a class="dropdown-item" href="<?= base_url('laporan-kegiatan/detail/' . $r['id']) ?>">Detail</a>
                                                                    <?php if (session()->get('level') == '3' && $r['pokja'] == (session()->get('pokja'))) { ?>
                                                                        <a class="dropdown-item" href="<?= base_url('laporan-kegiatan/edit/' . $r['id']) ?>">Edit</a>
                                                                        <a class="dropdown-item" href="#" data-toggle='modal' data-target='#activateModalDelete<?= $r['id'] ?>'>Delete</a>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </div>
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
    <form action="<?= base_url('laporan-kegiatan/' . $r['id']); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal fade" id="activateModalDelete<?= $r['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apa kamu yakin ingin menghapus data <span class="text-danger"><?= $r['judul'] ?></span> ini secara permanen ???
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