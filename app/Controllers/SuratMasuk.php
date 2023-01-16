<?php

namespace App\Controllers;

use App\Models\SuratMasukModel;
use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Config\Config;
use CodeIgniter\HTTP\RequestInterface;

class SuratMasuk extends BaseController
{
    protected $suratmasukModel;
    protected $userModel;
    public function __construct()
    {
        $this->suratmasukModel = new SuratMasukModel();
        $this->userModel = new UserModel();
    }
    public function data()
    {
        $surat = $this->suratmasukModel->findAll();
        $data = array(
            'title' => 'Surat Masuk',
            'data' => $surat,
            'isi' => 'master/surat-masuk/data'
        );

        return view('layout/wrapper', $data);
    }
    public function add()
    {
        $data = array(
            'titlebar' => 'Surat Masuk',
            'title' => 'Tambah Surat Masuk',
            'isi' => 'master/surat-masuk/add',
            'validation' => \Config\Services::validation()
        );
        return view('layout/wrapper', $data);
    }
    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'nosurat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Surat harus diisi.',
                ]
            ],
            'sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sifat Surat harus dipilih.',
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Surat harus dipilih.',
                ]
            ],
            'perihal' => [
                'rules' => 'required|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Perihal harus diisi.',
                    'alpha_numeric_punct' => 'Perihal berisi karakter yang tidak didukung.'
                ]
            ],
            'asal' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Asal Surat harus diisi.',
                    'alpha_space' => 'Asal Surat hanya huruf dan spasi.',
                ]
            ],
            'file_surat' => [
                'rules' => 'uploaded[file_surat]|mime_in[file_surat,application/pdf]|max_size[file_surat,2000]',
                'errors' => [
                    'uploaded' => 'File Surat harus diupload.',
                    'mime_in' => 'Extension file yang diperbolehkan .pdf',
                    'max_size' => 'Ukuran File maksimal 2MB.'
                ]
            ],
            'lampiran' => [
                'rules' => 'mime_in[lampiran,application/pdf]|max_size[lampiran,2000]',
                'errors' => [
                    'mime_in' => 'Extension file yang diperbolehkan .pdf',
                    'max_size' => 'Ukuran File maksimal 2MB.'
                ]
            ],
        ])) {
            return redirect()->to('/tambah-surat-masuk')->withInput();
        }
        $surat   = $this->request->getFile('file_surat');
        $lampiran   = $this->request->getFile('lampiran');
        if ($lampiran->getError() == 4) {
            $fileNamelampiran = null;
        } else {
            $fileNamelampiran = $lampiran->getRandomName();
            $lampiran->move(ROOTPATH . 'public/media/lampiran/', $fileNamelampiran);
        }
        $fileNamesurat = $surat->getRandomName();
        $surat->move(ROOTPATH . 'public/media/surat-masuk/', $fileNamesurat);
        $data = [
            'id_user'        => session()->get('id'),
            'no_surat'       => $this->request->getPost('nosurat'),
            'sifat_surat'    => $this->request->getPost('sifat'),
            'kategori_surat' => $this->request->getPost('kategori'),
            'perihal'        => $this->request->getPost('perihal'),
            'asal_surat'     => $this->request->getPost('asal'),
            'file'           => $fileNamesurat,
            'lampiran'       => $fileNamelampiran,
            'pokja'          => session()->get('pokja'),
        ];
        $this->suratmasukModel->save($data);
        session()->setFlashdata('m', 'Data berhasil disimpan');
        return redirect()->to(base_url('surat-masuk'));
    }

    public function delete($id)
    {
        // Drop file
        $data = $this->suratmasukModel->where('id =', $id)->first();
        $surat = $data['file'];
        $lampiran = $data['lampiran'];
        if (file_exists(ROOTPATH . 'public/media/surat-masuk/' . $surat)) {
            unlink(ROOTPATH . 'public/media/surat-masuk/' . $surat);
        }
        if (file_exists(ROOTPATH . 'public/media/lampiran/' . $lampiran)) {
            if ($lampiran != null) {
                unlink(ROOTPATH . 'public/media/lampiran/' . $lampiran);
            }
        }
        $this->suratmasukModel->delete($id);
        session()->setFlashdata('m', 'Data berhasil dihapus');
        return redirect()->to(base_url('surat-masuk'));
    }

    public function edit($id)
    {
        $ids = session()->get('id');
        $data = array(
            'titlebar' => 'Surat Masuk',
            'title' => 'Edit Surat Masuk',
            'isi' => 'master/surat-masuk/edit',
            'validation' => \Config\Services::validation(),
            'data' => $this->suratmasukModel->where('id =', $id)->where('id_user =', $ids)->first(),
        );
        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        //Validasi input
        if (!$this->validate([
            'nosurat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Surat harus diisi.',
                ]
            ],
            'sifat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sifat Surat harus dipilih.',
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Surat harus dipilih.',
                ]
            ],
            'perihal' => [
                'rules' => 'required|alpha_numeric_punct',
                'errors' => [
                    'required' => 'Perihal harus diisi.',
                    'alpha_numeric_punct' => 'Perihal berisi karakter yang tidak didukung.'
                ]
            ],
            'asal' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Asal Surat harus diisi.',
                    'alpha_space' => 'Asal Surat hanya huruf dan spasi.',
                ]
            ],
            'file_surat' => [
                'rules' => 'mime_in[file_surat,application/pdf]|max_size[file_surat,2000]',
                'errors' => [
                    'mime_in' => 'Extension file yang diperbolehkan .pdf',
                    'max_size' => 'Ukuran File maksimal 2MB.'
                ]
            ],
            'lampiran' => [
                'rules' => 'mime_in[lampiran,application/pdf]|max_size[lampiran,2000]',
                'errors' => [
                    'mime_in' => 'Extension file yang diperbolehkan .pdf',
                    'max_size' => 'Ukuran File maksimal 2MB.'
                ]
            ],
        ])) {
            return redirect()->to(base_url('surat-masuk/edit/' . $this->request->getPost('id')))->withInput();
        }
        $surat   = $this->request->getFile('file_surat');
        $lampiran   = $this->request->getFile('lampiran');
        if ($surat->getError() == 4) {
            $r = $this->suratmasukModel->find($id);
            $fileNamesurat = $r['file'];
        } else {
            $fileNamesurat = $surat->getRandomName();
            //move file
            $surat->move(ROOTPATH . 'public/media/surat-masuk/', $fileNamesurat);
            //if file found then replace file
            $f = $this->suratmasukModel->find($id);
            $replacesurat = $f['file'];
            if (file_exists(ROOTPATH . 'public/media/surat-masuk/' . $replacesurat)) {
                unlink(ROOTPATH . 'public/media/surat-masuk/' . $replacesurat);
            }
        }
        if ($lampiran->getError() == 4) {
            $r = $this->suratmasukModel->find($id);
            $fileNamelampiran = $r['lampiran'];
        } else {
            $fileNamelampiran = $lampiran->getRandomName();
            //move file
            $lampiran->move(ROOTPATH . 'public/media/lampiran/', $fileNamelampiran);
            //if file found then replace file
            $f = $this->suratmasukModel->find($id);
            $replacelampiran = $f['lampiran'];
            if (file_exists(ROOTPATH . 'public/media/lampiran/' . $replacelampiran)) {
                if ($replacelampiran != null) {
                    unlink(ROOTPATH . 'public/media/lampiran/' . $replacelampiran);
                }
            }
        }
        $data = [
            'id'             => $id,
            'no_surat'       => $this->request->getPost('nosurat'),
            'sifat_surat'    => $this->request->getPost('sifat'),
            'kategori_surat' => $this->request->getPost('kategori'),
            'perihal'        => $this->request->getPost('perihal'),
            'asal_surat'     => $this->request->getPost('asal'),
            'file'           => $fileNamesurat,
            'lampiran'       => $fileNamelampiran,
        ];
        $this->suratmasukModel->save($data);
        session()->setFlashdata('m', 'Data berhasil diupdate');
        return redirect()->to(base_url('surat-masuk'));
    }
    public function detail($id)
    {
        $detail = $this->userModel->join('mod_surat_masuk', 'mod_surat_masuk.id_user = mod_user.id', 'left')->where('mod_surat_masuk.id =', $id)->first();
        $data = array(
            'title' => 'Detail Surat Masuk',
            'data' => $detail,
            'isi' => 'master/surat-masuk/detail',
        );
        return view('layout/wrapper', $data);
    }
}
