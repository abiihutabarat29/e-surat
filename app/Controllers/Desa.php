<?php

namespace App\Controllers;

use App\Models\DesaModel;
use CodeIgniter\Config\Config;

class Desa extends BaseController
{
    protected $desaModel;
    public function __construct()
    {
        $this->desaModel = new DesaModel();
    }
    public function data()
    {
        $datadesa = $this->desaModel->findAll();
        $data = array(
            'title' => 'Desa',
            'data' => $datadesa,
            'isi' => 'master/desa/data'
        );
        return view('layout/wrapper', $data);
    }
    public function add()
    {
        $data = array(
            'titlebar' => 'Desa',
            'title' => 'Tambah Desa',
            'isi' => 'master/desa/add',
            'validation' => \Config\Services::validation()
        );
        return view('layout/wrapper', $data);
    }
    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'kode' => [
                'rules' => 'required|numeric|max_length[10]|is_unique[mod_desa.kode]',
                'errors' => [
                    'required' => 'Kode tidak boleh kosong.',
                    'numeric' => 'Kode harus angka.',
                    'max_length' => 'Kode maksimal 10 digit.',
                    'is_unique' => 'Kode sudah ada.'

                ]
            ],
            'nama_desa' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama Desa tidak boleh kosong.',
                    'alpha_space' => 'Nama Desa harus huruf dan spasi.'
                ]
            ],
        ])) {
            return redirect()->to('add')->withInput();
        }
        $data = [
            'kode'          => $this->request->getPost('kode'),
            'nama_desa'       => $this->request->getPost('nama_desa'),
        ];
        $this->desaModel->save($data);
        session()->setFlashdata('m', 'Data berhasil disimpan');
        return redirect()->to(base_url('desa'));
    }
    public function delete($id)
    {
        $this->desaModel->delete($id);
        session()->setFlashdata('m', 'Data berhasil dihapus');
        return redirect()->to(base_url('desa'));
    }
    public function edit($id)
    {
        $data = array(
            'titlebar' => 'Desa',
            'title' => 'Edit Desa',
            'isi' => 'master/desa/edit',
            'validation' => \Config\Services::validation(),
            'data' => $this->desaModel->where('id', $id)->first(),
        );
        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        $kodeLama = $this->desaModel->where(['id' => $id])->first();
        if ($kodeLama['kode'] == $this->request->getPost('kode')) {
            $rule_kode = 'required|numeric|max_length[10]';
        } else {
            $rule_kode = 'required|numeric|max_length[10]|is_unique[mod_desa.kode]';
        }
        //Validasi input
        if (!$this->validate([
            'kode' => [
                'rules' => $rule_kode,
                'errors' => [
                    'required' => 'Kode tidak boleh kosong.',
                    'numeric' => 'Kode harus angka.',
                    'max_length' => 'Kode maksimal 10 digit.',
                    'is_unique' => 'Kode sudah ada.'

                ]
            ],
            'nama_desa' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama Desa tidak boleh kosong.',
                    'alpha_space' => 'Nama Desa harus huruf dan spasi.'
                ]
            ],
        ])) {
            return redirect()->to(base_url('desa/edit/' . $this->request->getPost('id')))->withInput();
        }
        $data = [
            'id'            => $id,
            'kode'          => $this->request->getPost('kode'),
            'nama_desa'       => $this->request->getPost('nama_desa'),
        ];
        $this->desaModel->save($data);
        session()->setFlashdata('m', 'Data berhasil diupdate');
        return redirect()->to(base_url('desa'));
    }
}
