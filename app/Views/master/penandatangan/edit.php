<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $titlebar ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('penandatangan') ?>">Penandatangan</a></li>
                        <li class=" breadcrumb-item active">Tambah Penandatangan</li>
                    </ol>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title ?></h3>
                        </div>
                        <form action="<?= base_url('penandatangan/update/' . $data['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama<span class="text-danger">*</span></label>
                                    <input name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" autocomplete="off" value="<?= (old('nama')) ? old('nama') : $data['nama']; ?>">
                                    <span class="error invalid-feedback"> <?= $validation->getError('nama'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan<span class="text-danger">*</span></label>
                                    <select name="jabatan" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : ''; ?>">
                                        <option value="<?= $data['jabatan'] ?>"><?= (old('jabatan')) ? old('jabatan') : $data['jabatan'] ?></option>
                                        <option value="Ketua PKK">Ketua PKK</option>
                                        <option value="Sekretaris PKK">Sekretaris PKK</option>
                                          <option value="Ketua Pokja">Ketua Pokja</option>
                                        <option value="Sekretaris Pokja">Sekretaris Pokja</option>
                                    </select>
                                    <span class="error invalid-feedback"> <?= $validation->getError('jabatan'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Scan TTD<span class="text-danger">*</span></label>
                                    <div class="col-md-4">
                                        <img src="<?= base_url('media/ttd/' . $data['ttd']) ?>" alt="image profile" width="80px" class="img-thumbnail rounded img-preview">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="ttd" class="custom-file-input <?= ($validation->hasError('ttd')) ? 'has-error' : ''; ?>" id="foto" onchange="previewImg();" accept=".png, .jpg, .jpeg">
                                                <label class="custom-file-label">Pilih File</label>
                                            </div>
                                        </div>
                                        <span class="text-danger text-sm"> <?= $validation->getError('ttd'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>