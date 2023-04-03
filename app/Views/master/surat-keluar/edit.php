<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $titlebar ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php if (session()->get('level') == '2') { ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('data-surat-keluar') ?>">Daftar Surat Keluar</a></li>
                        <?php } else { ?>
                            <li class="breadcrumb-item"><a href="<?= base_url('surat-keluar') ?>">Daftar Surat Keluar</a></li>
                        <?php } ?>
                        <li class=" breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title ?></h3>
                        </div>
                        <form action="<?= base_url('surat-keluar/update/' . $data['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="<?= $data['id']; ?>">
                            <div class="card-body p-0">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <div class="step" data-target="#rincian">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Rincian Surat</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#isi">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Isi Surat</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#tujuan">
                                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                                <span class="bs-stepper-circle">3</span>
                                                <span class="bs-stepper-label">Tujuan</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content">
                                        <div id="rincian" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor Surat<span class="text-danger">*</span></label>
                                                            <input name="nosurat" type="text" class="form-control <?= ($validation->hasError('nosurat')) ? 'is-invalid' : ''; ?>" autocomplete="off" value="<?= (old('nosurat')) ? old('nosurat') : $data['no_surat']; ?>">
                                                            <span class="error invalid-feedback"> <?= $validation->getError('nosurat'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Kategori Surat<span class="text-danger">*</span></label>
                                                            <select name="kategori" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>">
                                                                <option value="<?= $data['kategori_surat'] ?>"><?= (old('kategori')) ? old('kategori') : $data['kategori_surat'] ?></option>
                                                                <option value="Undangan">Undangan</option>
                                                                <!-- <option value="Biasa">Biasa</option>
                                                                <option value="Pengumuman">Pengumuman</option>
                                                                <option value="Pemberitahuan">Pemberitahuan</option>
                                                                <option value="Panggilan">Panggilan</option>
                                                                <option value="Pengantar">Pengantar</option>
                                                                <option value="Edaran">Edaran</option> -->
                                                            </select>
                                                            <span class="error invalid-feedback"> <?= $validation->getError('kategori'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Sifat Surat<span class="text-danger">*</span></label>
                                                            <select name="sifat" class="form-control <?= ($validation->hasError('sifat')) ? 'is-invalid' : ''; ?>">
                                                                <option value="<?= $data['sifat_surat'] ?>"><?= (old('sifat')) ? old('sifat') : $data['sifat_surat'] ?></option>
                                                                <option value="Amat Segera">Amat Segera</option>
                                                                <option value="Biasa">Biasa</option>
                                                                <option value="Penting">Penting</option>
                                                                <option value="Segera">Segera</option>
                                                                <option value="Sangat Biasa">Sangat Biasa</option>
                                                                <option value="Rahasia">Rahasia</option>
                                                            </select>
                                                            <span class="error invalid-feedback"> <?= $validation->getError('sifat'); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Perihal<span class="text-danger">*</span></label>
                                                            <textarea name="perihal" class="form-control <?= ($validation->hasError('perihal')) ? 'is-invalid' : ''; ?>" rows="5" autocomplete="off" placeholder="Tulis Perihal ..."><?= (old('perihal')) ? old('perihal') : $data['perihal'] ?></textarea>
                                                            <span class="error invalid-feedback"> <?= $validation->getError('perihal'); ?></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Penandatangan<span class="text-danger">*</span></label>
                                                            <select name="penandatangan" class="form-control select2bs4 <?= ($validation->hasError('penandatangan')) ? 'is-invalid' : ''; ?>" style="width: 100%;">
                                                                <?php foreach ($ttd as $r) : ?>
                                                                    <option value="<?= $r['id'] ?>" <?= $r['id'] == $data['penandatangan'] ? 'selected' : '' ?>><?= $r['jabatan'] ?> (<?= $r['nama'] ?>)</option>
                                                                <?php endforeach ?>
                                                            </select>
                                                            <span class="error invalid-feedback"> <?= $validation->getError('penandatangan'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="btn btn-primary" onclick="stepper.next()">Next</a>
                                        </div>
                                        <div id="isi" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                            <div class="form-group">
                                                <label>Isi<span class="text-danger">*</span></label>
                                                <textarea name="isi" id="editor" class="form-control <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>" autocomplete="off"><?= (old('isi')) ? old('isi') : $data['isi'] ?></textarea>
                                                <span class="error invalid-feedback"> <?= $validation->getError('isi'); ?></span>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Jumlah Lampiran</label>
                                                    <input name="jlhlampiran" type="text" class="form-control <?= ($validation->hasError('jlhlampiran')) ? 'is-invalid' : ''; ?>" autocomplete="off" value="<?= (old('jlhlampiran')) ? old('jlhlampiran') : $data['jlh_lampiran'] ?>">
                                                    <span class="error invalid-feedback"> <?= $validation->getError('jlhlampiran'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Satuan</label>
                                                    <select name="satuan" class="form-control <?= ($validation->hasError('satuan')) ? 'is-invalid' : ''; ?>">
                                                        <option value="<?= $data['satuan'] ?>"><?= (old('satuan')) ? old('satuan') : $data['satuan'] ?></option>
                                                        <option value="Lembar">Lembar</option>
                                                        <option value="Bundel">Bundel</option>
                                                        <option value="Set">Set</option>
                                                    </select>
                                                    <span class="error invalid-feedback"> <?= $validation->getError('satuan'); ?></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Lampiran<small>(*Opsional)</small></label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="file_lampiran" class="custom-file-input <?= ($validation->hasError('file_lampiran')) ? 'is-invalid' : ''; ?>">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <span class="text-danger text-sm"> <?= $validation->getError('file_lampiran'); ?></span>
                                                </div>
                                            </div>
                                            <a class="btn btn-primary mt-2" onclick="stepper.previous()">Previous</a>
                                            <a class="btn btn-primary mt-2" onclick="stepper.next()">Next</a>
                                        </div>
                                        <div id="tujuan" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Tujuan<span class="text-danger">*</span></label>
                                                    <select name="tujuan" class="form-control <?= ($validation->hasError('tujuan')) ? 'is-invalid' : ''; ?>">
                                                        <option value="<?= $data['tujuan'] ?>"><?= (old('tujuan')) ? old('tujuan') : $data['tujuan'] ?></option>
                                                        <option value="all">Semua Pokja</option>
                                                        <option value="Pokja I/Anggota">Pokja I/Anggota</option>
                                                        <option value="Pokja II/Anggota">Pokja II/Anggota</option>
                                                        <option value="Pokja III/Anggota">Pokja III/Anggota</option>
                                                        <option value="Pokja IV/Anggota">Pokja IV/Anggota</option>
                                                    </select>
                                                    <span class="error invalid-feedback"> <?= $validation->getError('tujuan'); ?></span>
                                                </div>
                                                <a class="btn btn-primary" onclick="stepper.previous()">Previous</a>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>