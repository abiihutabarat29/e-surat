<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DesaModel;
use CodeIgniter\Config\Config;

class UserKab extends BaseController
{
    protected $userModel;
    protected $desaModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->desaModel = new DesaModel();
    }

    public function userkab()
    {
        $idd = session()->get('id_desa');
        $datauser = $this->userModel->where('id_desa =', $idd)->where('level !=', 4)->findAll();
        $data = array(
            'title' => 'User Kabupaten',
            'data' => $datauser,
            'isi' => 'master/user-kab/data'
        );
        return view('layout/wrapper', $data);
    }
    public function add()
    {
        $data = array(
            'titlebar' => 'Data User',
            'title' => 'Tambah Data',
            'isi' => 'master/user-kab/add',
            'validation' => \Config\Services::validation()
        );
        return view('layout/wrapper', $data);
    }
    public function save()
    {
        //Validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                    'alpha_space' => 'Nama harus huruf dan spasi.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[mod_user.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.',
                ]
            ],
            'nohp' => [
                'rules' => 'required|max_length[12]|min_length[11]|regex_match[^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$]',
                'errors' => [
                    'required' => 'Nomor Handphone tidak boleh kosong.',
                    'max_length' => 'Nomor Handphone maximal 12 digit.',
                    'min_length' => 'Nomor Handphone manimal 11 digit.',
                    'regex_match' => 'Penulisan Nomor Handphone harus benar'
                ]
            ],
            'username' => [
                'rules' => 'required|max_length[25]|min_length[8]|is_unique[mod_user.username]',
                'errors' => [
                    'required' => 'Username tidak boleh kosong.',
                    'is_unique' => 'Username sudah terdaftar.',
                    'max_length' => 'Username maximal 25 digit.',
                    'min_length' => 'Username minimal 8 digit.',

                ]
            ],
            'password' => [
                'rules' => 'required|max_length[8]|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                ]
            ],
            'repassword' => [
                'rules' => 'required|max_length[8]|min_length[6]|matches[password]',
                'errors' => [
                    'required' => 'Re-Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                    'matches' => 'Password harus sama.'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level tidak boleh kosong.',
                ]
            ]
        ])) {
            return redirect()->to('add')->withInput();
        }
        $md5 = md5($this->request->getPost('password'));
        $password = password_hash($md5, PASSWORD_DEFAULT);
        $data = [
            'id_desa'              => session()->get('id_desa'),
            'nama'                 => $this->request->getPost('nama'),
            'email'                => $this->request->getPost('email'),
            'nohp'                 => $this->request->getPost('nohp'),
            'username'             => $this->request->getPost('username'),
            'password'             => $password,
            'foto'                 => 'blank.png',
            'level'                => $this->request->getPost('level'),
            'pokja'                => $this->request->getPost('pokja'),
        ];
        $this->userModel->save($data);
        session()->setFlashdata('m', 'Data berhasil disimpan');
        return redirect()->to(base_url('user'));
    }
    public function delete($id)
    {
        $data = $this->userModel->find($id);
        $foto = $data['foto'];
        if (file_exists(ROOTPATH . '../public_html/media/fotouser/' . $foto)) {
            if ($data['foto'] != 'blank.png') {
                unlink(ROOTPATH . '../public_html/media/fotouser/' . $foto);
            }
        }
        $this->userModel->delete($id);
        session()->setFlashdata('m', 'Data berhasil dihapus');
        return redirect()->to(base_url('user'));
    }
    public function edit($id)
    {
        $idd = session()->get('id_desa');
        $data = array(
            'titlebar' => 'Data User',
            'title' => 'Edit User',
            'isi' => 'master/user-kab/edit',
            'validation' => \Config\Services::validation(),
            'data' => $this->userModel->where('id', $id)->where('id_desa', $idd)->first(),
        );
        return view('layout/wrapper', $data);
    }
    public function update($id)
    {
        $emailLama = $this->userModel->where(['id' => $id])->first();
        if ($emailLama['email'] == $this->request->getPost('email')) {
            $rule_email = 'required|valid_email';
        } else {
            $rule_email = 'required|valid_email|is_unique[mod_user.email]';
        }
        $usernameLama = $this->userModel->where(['id' => $id])->first();
        if ($usernameLama['username'] == $this->request->getPost('username')) {
            $rule_username = 'required|max_length[25]|min_length[8]';
        } else {
            $rule_username = 'required|max_length[25]|min_length[8]|is_unique[mod_user.username]';
        }
        if (!$this->validate([
            //Validasi input
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                    'alpha_space' => 'Nama harus huruf dan spasi.'
                ]
            ],
            'email' => [
                'rules' => $rule_email,
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.',
                ]
            ],
            'nohp' => [
                'rules' => 'required|max_length[12]|min_length[11]|regex_match[^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$]',
                'errors' => [
                    'required' => 'Nomor Handphone tidak boleh kosong.',
                    'max_length' => 'Nomor Handphone maximal 12 digit.',
                    'min_length' => 'Nomor Handphone manimal 11 digit.',
                    'regex_match' => 'Penulisan Nomor Handphone harus benar'
                ]
            ],
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Username tidak boleh kosong.',
                    'is_unique' => 'Username sudah terdaftar.',
                    'max_length' => 'Username maximal 25 digit.',
                    'min_length' => 'Username minimal 8 digit.',

                ]
            ],
            'password' => [
                'rules' => 'required|max_length[8]|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                ]
            ],
            'repassword' => [
                'rules' => 'required|max_length[8]|min_length[6]|matches[password]',
                'errors' => [
                    'required' => 'Re-Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                    'matches' => 'Password harus sama.'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level tidak boleh kosong.',
                ]
            ]
        ])) {
            return redirect()->to(base_url('user/edit/' . $this->request->getPost('id')))->withInput();
        }
        $md5 = md5($this->request->getPost('password'));
        $password = password_hash($md5, PASSWORD_DEFAULT);
        $data = [
            'id'                   => $id,
            'id_desa'              => session()->get('id_desa'),
            'nama'                 => $this->request->getPost('nama'),
            'email'                => $this->request->getPost('email'),
            'nohp'                 => $this->request->getPost('nohp'),
            'username'             => $this->request->getPost('username'),
            'password'             => $password,
            'level'                => $this->request->getPost('level'),
            'pokja'                => $this->request->getPost('pokja'),
        ];
        $this->userModel->save($data);
        session()->setFlashdata('m', 'Data berhasil diupdate');
        return redirect()->to(base_url('user'));
    }
    public function useradmdes()
    {
        $datauser = $this->userModel->where('level =', 1)->findAll();
        $data = array(
            'title' => 'User Admin Desa',
            'data' => $datauser,
            'isi' => 'master/user-adm-desa/data'
        );
        return view('layout/wrapper', $data);
    }
    public function addadm()
    {
        $desa = $this->desaModel->findAll();
        $data = array(
            'titlebar' => 'Data Admin Desa',
            'title' => 'Tambah Data',
            'desa' => $desa,
            'isi' => 'master/user-adm-desa/add',
            'validation' => \Config\Services::validation()
        );
        return view('layout/wrapper', $data);
    }
    public function saveadm()
    {
        //Validasi input
        if (!$this->validate([
            'desa_id' => [
                'rules' => 'required|is_unique[mod_user.id_desa]',
                'errors' => [
                    'required' => 'Pilih desa terlebih dahulu.',
                    'is_unique' => 'Sudah ada akun di desa ini.',
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                    'alpha_space' => 'Nama harus huruf dan spasi.'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[mod_user.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.',
                ]
            ],
            'nohp' => [
                'rules' => 'required|max_length[12]|min_length[11]|regex_match[^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$]',
                'errors' => [
                    'required' => 'Nomor Handphone tidak boleh kosong.',
                    'max_length' => 'Nomor Handphone maximal 12 digit.',
                    'min_length' => 'Nomor Handphone manimal 11 digit.',
                    'regex_match' => 'Penulisan Nomor Handphone harus benar'
                ]
            ],
            'username' => [
                'rules' => 'required|max_length[25]|min_length[8]|is_unique[mod_user.username]',
                'errors' => [
                    'required' => 'Username tidak boleh kosong.',
                    'is_unique' => 'Username sudah terdaftar.',
                    'max_length' => 'Username maximal 25 digit.',
                    'min_length' => 'Username minimal 8 digit.',

                ]
            ],
            'password' => [
                'rules' => 'required|max_length[8]|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                ]
            ],
            'repassword' => [
                'rules' => 'required|max_length[8]|min_length[6]|matches[password]',
                'errors' => [
                    'required' => 'Re-Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                    'matches' => 'Password harus sama.'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level tidak boleh kosong.',
                ]
            ]
        ])) {
            return redirect()->to('add')->withInput();
        }
        $md5 = md5($this->request->getPost('password'));
        $password = password_hash($md5, PASSWORD_DEFAULT);
        $data = [
            'id_desa'              => $this->request->getPost('desa_id'),
            'nama'                 => $this->request->getPost('nama'),
            'email'                => $this->request->getPost('email'),
            'nohp'                 => $this->request->getPost('nohp'),
            'username'             => $this->request->getPost('username'),
            'password'             => $password,
            'foto'                 => 'blank.png',
            'level'                => $this->request->getPost('level'),
            'pokja'                => $this->request->getPost('pokja'),
        ];
        $this->userModel->save($data);
        session()->setFlashdata('m', 'Data berhasil disimpan');
        return redirect()->to(base_url('user-admin-desa'));
    }
    public function deleteadm($id)
    {
        $data = $this->userModel->find($id);
        $foto = $data['foto'];
        if (file_exists(ROOTPATH . '../public_html/media/fotouser/' . $foto)) {
            if ($data['foto'] != 'blank.png') {
                unlink(ROOTPATH . '../public_html/media/fotouser/' . $foto);
            }
        }
        $this->userModel->delete($id);
        session()->setFlashdata('m', 'Data berhasil dihapus');
        return redirect()->to(base_url('user-admin-desa'));
    }
    public function editadm($id)
    {
        $desa = $this->desaModel->findAll();
        $data = array(
            'titlebar' => 'Data Admin Desa',
            'title' => 'Edit',
            'desa' => $desa,
            'isi' => 'master/user-adm-desa/edit',
            'validation' => \Config\Services::validation(),
            'data' => $this->userModel->where('id', $id)->first(),
        );
        return view('layout/wrapper', $data);
    }
    public function updateadm($id)
    {
        $emailLama = $this->userModel->where(['id' => $id])->first();
        if ($emailLama['email'] == $this->request->getPost('email')) {
            $rule_email = 'required|valid_email';
        } else {
            $rule_email = 'required|valid_email|is_unique[mod_user.email]';
        }
        $idDesa = $this->userModel->where(['id' => $id])->first();
        if ($idDesa['id_desa'] == $this->request->getPost('desa_id')) {
            $rule_id = 'required';
        } else {
            $rule_id = 'required|is_unique[mod_user.id_desa]';
        }
        $usernameLama = $this->userModel->where(['id' => $id])->first();
        if ($usernameLama['username'] == $this->request->getPost('username')) {
            $rule_username = 'required|max_length[25]|min_length[8]';
        } else {
            $rule_username = 'required|max_length[25]|min_length[8]|is_unique[mod_user.username]';
        }
        if (!$this->validate([
            //Validasi input
            'desa_id' => [
                'rules' => $rule_id,
                'errors' => [
                    'required' => 'Pilih desa terlebih dahulu.',
                    'is_unique' => 'Sudah ada akun di desa ini.',
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                    'alpha_space' => 'Nama harus huruf dan spasi.'
                ]
            ],
            'email' => [
                'rules' => $rule_email,
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                    'is_unique' => 'Email sudah terdaftar.',
                ]
            ],
            'nohp' => [
                'rules' => 'required|max_length[12]|min_length[11]|regex_match[^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$]',
                'errors' => [
                    'required' => 'Nomor Handphone tidak boleh kosong.',
                    'max_length' => 'Nomor Handphone maximal 12 digit.',
                    'min_length' => 'Nomor Handphone manimal 11 digit.',
                    'regex_match' => 'Penulisan Nomor Handphone harus benar'
                ]
            ],
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Username tidak boleh kosong.',
                    'is_unique' => 'Username sudah terdaftar.',
                    'max_length' => 'Username maximal 25 digit.',
                    'min_length' => 'Username minimal 8 digit.',

                ]
            ],
            'password' => [
                'rules' => 'required|max_length[8]|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                ]
            ],
            'repassword' => [
                'rules' => 'required|max_length[8]|min_length[6]|matches[password]',
                'errors' => [
                    'required' => 'Re-Password tidak boleh kosong.',
                    'max_length' => 'Password maximal 8 digit.',
                    'min_length' => 'Password minimal 6 digit.',
                    'matches' => 'Password harus sama.'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level tidak boleh kosong.',
                ]
            ]
        ])) {
            return redirect()->to(base_url('user-admin-desa/edit/' . $this->request->getPost('id')))->withInput();
        }
        $md5 = md5($this->request->getPost('password'));
        $password = password_hash($md5, PASSWORD_DEFAULT);
        $data = [
            'id'                   => $id,
            'id_desa'              => $this->request->getPost('desa_id'),
            'nama'                 => $this->request->getPost('nama'),
            'email'                => $this->request->getPost('email'),
            'nohp'                 => $this->request->getPost('nohp'),
            'username'             => $this->request->getPost('username'),
            'password'             => $password,
            'level'                => $this->request->getPost('level'),
            'pokja'                => $this->request->getPost('pokja'),
        ];
        $this->userModel->save($data);
        session()->setFlashdata('m', 'Data berhasil diupdate');
        return redirect()->to(base_url('user-admin-desa'));
    }
}
