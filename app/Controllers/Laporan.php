<?php

namespace App\Controllers;

use App\Models\laporanModel;
use App\Models\UserModel;
use CodeIgniter\Config\Config;
use TCPDF;

class Laporan extends BaseController
{
    protected $laporanModel;
    protected $userModel;
    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
        $this->userModel = new UserModel();
    }
    public function data()
    {
        $ids = session()->get('id');
        $idd = session()->get('id_desa');
        $lap = $this->laporanModel->where('id_user =', $ids)->where('id_desa', $idd)->findAll();
        $data = array(
            'title' => 'Laporan Kegiatan',
            'data' => $lap,
            'isi' => 'master/laporan/data'
        );
        return view('layout/wrapper', $data);
    }
    public function datadesa()
    {
        $lap = $this->laporanModel->where('id_desa !=', 0)->findAll();
        $data = array(
            'title' => 'Laporan Kegiatan',
            'data' => $lap,
            'isi' => 'master/laporan/data'
        );
        return view('layout/wrapper', $data);
    }
    public function datakab()
    {
        $idd = session()->get('id_desa');
        $lap = $this->laporanModel->where('id_desa =', 0)->findAll();
        $data = array(
            'title' => 'Laporan Kegiatan',
            'data' => $lap,
            'isi' => 'master/laporan/data'
        );
        return view('layout/wrapper', $data);
    }
    public function datalaporan()
    {
        $idd = session()->get('id_desa');
        $laporan = $this->laporanModel->where('id_desa', $idd)->findAll();
        $data = array(
            'title' => 'Laporan Kegiatan',
            'data' => $laporan,
            'isi' => 'master/laporan/datalaporan'
        );

        return view('layout/wrapper', $data);
    }
    public function add()
    {
        $data = array(
            'titlebar' => 'Laporan Kegiatan',
            'title' => 'Tambah Laporan Kegiatan',
            'isi' => 'master/laporan/add',
            'validation' => \Config\Services::validation()
        );
        return view('layout/wrapper', $data);
    }
    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Judul tidak boleh kosong.',
                    'alpha_space' => 'Judul harus huruf dan spasi.'
                ]
            ],
            'manfaat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Manfaat dan Tujuan harus diisi.',
                ]
            ],
            'sasaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sasaran dan Capaian harus diisi.',
                ]
            ],
            'tglk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Kegiatan harus diisi.',
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg]|max_size[foto,500]',
                'errors' => [
                    'uploaded' => 'Foto Kegiatan harus diupload.',
                    'mime_in' => 'File extention hanya jpg, jpeg.',
                    'is_image' => 'Upload hanya file foto.',
                    'max_size' => 'Ukuran gambar maksimal 500kb.'
                ]
            ],
        ])) {
            return redirect()->to('/tambah-laporan-kegiatan')->withInput();
        }
        $file_foto   = $this->request->getFile('foto');
        $fileNamefoto = $file_foto->getRandomName();
        $file_foto->move(ROOTPATH . 'public/media/foto-kegiatan/', $fileNamefoto);
        $data = [
            'id_user'       => session()->get('id'),
            'id_desa'       => session()->get('id_desa'),
            'judul'         => $this->request->getPost('judul'),
            'manfaat'       => $this->request->getPost('manfaat'),
            'sasaran'       => $this->request->getPost('sasaran'),
            'tgl_kegiatan'  => $this->request->getPost('tglk'),
            'foto_kegiatan' => $fileNamefoto,
            'pokja'         => session()->get('pokja'),
        ];
        $this->laporanModel->save($data);
        session()->setFlashdata('m', 'Data berhasil disimpan');
        return redirect()->to(base_url('laporan-kegiatan'));
    }
    public function delete($id)
    {
        $data = $this->laporanModel->find($id);
        $file_foto = $data['foto_kegiatan'];
        if (file_exists(ROOTPATH . 'public/media/foto-kegiatan/' . $file_foto)) {
            unlink(ROOTPATH . 'public/media/foto-kegiatan/' . $file_foto);
        }
        $this->laporanModel->delete($id);
        if (session()->get('level') == 1) {
            session()->setFlashdata('m', 'Data berhasil dihapus');
            return redirect()->to(base_url('data-laporan-kegiatan'));
        } else {
            session()->setFlashdata('m', 'Data berhasil dihapus');
            return redirect()->to(base_url('laporan-kegiatan'));
        }
    }
    public function edit($id)
    {
        $ids = session()->get('id');
        $idd = session()->get('id_desa');
        $data = array(
            'titlebar' => 'Laporan Kegiatan',
            'title' => 'Edit Laporan Kegiatan',
            'isi' => 'master/laporan/edit',
            'validation' => \Config\Services::validation(),
            'data' => $this->laporanModel->where('id', $id)->where('id_user =', $ids)->where('id_desa', $idd)->first(),
        );
        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        //Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Judul tidak boleh kosong.',
                    'alpha_space' => 'Judul harus huruf dan spasi.'
                ]
            ],
            'manfaat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Manfaat dan Tujuan harus diisi.',
                ]
            ],
            'sasaran' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sasaran dan Capaian harus diisi.',
                ]
            ],
            'tglk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Kegiatan harus diisi.',
                ]
            ],
            'foto' => [
                'rules' => 'mime_in[foto,image/jpg,image/jpeg]|max_size[foto,500]',
                'errors' => [
                    'mime_in' => 'File extention hanya jpg, jpeg.',
                    'is_image' => 'Upload hanya file foto.',
                    'max_size' => 'Ukuran gambar maksimal 500kb.'
                ]
            ],
        ])) {
            return redirect()->to(base_url('laporan-kegiatan/edit/' . $this->request->getPost('id')))->withInput();
        }
        $file_foto   = $this->request->getFile('foto');
        if ($file_foto->getError() == 4) {
            $r = $this->laporanModel->find($id);
            $fileNamefoto = $r['foto_kegiatan'];
        } else {
            $fileNamefoto = $file_foto->getRandomName();
            //move file
            $file_foto->move(ROOTPATH . 'public/media/foto-kegiatan/', $fileNamefoto);
            //if file found then replace file
            $f = $this->laporanModel->find($id);
            $replacefoto = $f['foto_kegiatan'];
            if (file_exists(ROOTPATH . 'public/media/foto-kegiatan/' . $replacefoto)) {
                unlink(ROOTPATH . 'public/media/foto-kegiatan/' . $replacefoto);
            }
        }
        $data = [
            'id_user'       => session()->get('id'),
            'id_desa'        => session()->get('id_desa'),
            'id'            => $id,
            'judul'         => $this->request->getPost('judul'),
            'manfaat'       => $this->request->getPost('manfaat'),
            'sasaran'       => $this->request->getPost('sasaran'),
            'tgl_kegiatan'  => $this->request->getPost('tglk'),
            'foto_kegiatan' => $fileNamefoto,
            'pokja'          => session()->get('pokja'),
        ];
        $this->laporanModel->save($data);
        session()->setFlashdata('m', 'Data berhasil diupdate');
        return redirect()->to(base_url('laporan-kegiatan'));
    }
    public function detail($id)
    {
        $detail = $this->userModel->join('mod_laporan', 'mod_laporan.id_user = mod_user.id', 'left')->where('mod_laporan.id =', $id)->first();
        $data = array(
            'title' => 'Detail Laporan Kegiatan',
            'data' => $detail,
            'isi' => 'master/laporan/detail',
        );
        // dd($detail);
        return view('layout/wrapper', $data);
    }
    // public function details($id)
    // {
    //     $idd = session()->get('id_desa');
    //     $detail = $this->userModel->join('mod_laporan', 'mod_laporan.id_user = mod_user.id', 'left')->where('mod_laporan.id =', $id)->where('mod_laporan.id_desa =', $idd)->first();
    //     $data = array(
    //         'title' => 'Detail Laporan Kegiatan',
    //         'data' => $detail,
    //         'isi' => 'master/laporan/detail',
    //     );
    //     // dd($detail);
    //     return view('layout/wrapper', $data);
    // }
    public function print($id)
    {
        $print = $this->laporanModel->where('id =', $id)->first();
        $judul = $print['judul'];
        $manfaat = $print['manfaat'];
        $sasaran = $print['sasaran'];
        $tgl = $print['tgl_kegiatan'];
        $foto = '<img src="' . ROOTPATH . 'public/media/foto-kegiatan/' . $print['foto_kegiatan'] . '" width="300px" height="150px">';
        // $foto = '<img src="../public_html/media/foto-kegiatan/' . $print['foto_kegiatan'] . '" width="300" height="150">';
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //initialize document
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetMargins(20, 15, 20, true);
        $pdf->SetAutoPageBreak(TRUE, 2);
        $pdf->AddPage("P", "A4");
        $pdf->SetFont("helvetica", "", 12);
        $this->response->setContentType('application/pdf');

        //create html to pdf
        $html = '<table width="100%" border="0" cellpadding="1">
        <tr>
        <td width="35%"></td>
        <td width="2%"></td>
        <td width="63%"></td>
        </tr>
        <tr>
        <td>Judul</td>
        <td>:</td>
        <td>' . $judul . '</td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td>Manfaat dan Tujuan Kegiatan</td>
        <td>:</td>
        <td>' . $manfaat . '</td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td>Sasaran dan Capaian</td>
        <td>:</td>
        <td>' . $sasaran . '</td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td>Tanggal Kegiatan</td>
        <td>:</td>
        <td>' . format_indo($tgl) . '</td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        </tr>
        <tr>
        <td>Dokumentasi Kegiatan</td>
        <td>:</td>
        <td>' . $foto . '</td>
        </tr>
        <tr>
        <td></td>
        <td></td>
        </tr>
        </table>';
        //

        $pdf->writeHTML($html, true, false, true, false, '');
        $filename = "laporan-kegiatan/" . $judul . ".pdf";
        $pdf->Output($filename, 'I');
    }
}
