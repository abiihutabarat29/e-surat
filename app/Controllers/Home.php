<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DesaModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Models\PenandatanganModel;

class Home extends BaseController
{
    protected $userModel;
    protected $desaModel;
    protected $suratmasukModel;
    protected $suratkeluarModel;
    protected $penandatanganModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->desaModel = new DesaModel();
        $this->suratmasukModel = new SuratMasukModel();
        $this->suratkeluarModel = new SuratKeluarModel();
        $this->penandatanganModel = new PenandatanganModel();
    }
    public function index()
    {
        if (session()->get('level') == 4) {
            $idd = session()->get('id_desa');
            $data = array(
                'title'         => 'Dashboard',
                'appname'       => 'Aplikasi Management Surat',
                'users'         => $this->userModel->where('level !=', 4)->where('id_desa', $idd)->countAllResults(),
                'sekretariat'   => $this->suratmasukModel->where('pokja =', null)->where('id_desa', $idd)->countAllResults(),
                'pokjaI'        => $this->suratmasukModel->where('pokja =', 'Pokja I')->where('id_desa', $idd)->countAllResults(),
                'pokjaII'       => $this->suratmasukModel->where('pokja =', 'Pokja II')->where('id_desa', $idd)->countAllResults(),
                'pokjaIII'      => $this->suratmasukModel->where('pokja =', 'Pokja III')->where('id_desa', $idd)->countAllResults(),
                'pokjaIV'       => $this->suratmasukModel->where('pokja =', 'Pokja IV')->where('id_desa', $idd)->countAllResults(),
                  'penandatangan'       => $this->penandatanganModel->where('id_desa', $idd)->countAllResults(),
                'sekretariatsk'   => $this->suratkeluarModel->where('pokja =', null)->where('id_desa', $idd)->countAllResults(),
                'pokjaIsk'        => $this->suratkeluarModel->where('pokja =', 'Pokja I')->where('id_desa', $idd)->countAllResults(),
                'pokjaIIsk'       => $this->suratkeluarModel->where('pokja =', 'Pokja II')->where('id_desa', $idd)->countAllResults(),
                'pokjaIIIsk'      => $this->suratkeluarModel->where('pokja =', 'Pokja III')->where('id_desa', $idd)->countAllResults(),
                'pokjaIVsk'       => $this->suratkeluarModel->where('pokja =', 'Pokja IV')->where('id_desa', $idd)->countAllResults(),
                'isi'           => 'home',
            );
            return view('layout/wrapper', $data);
        } else {
            $idd = session()->get('id_desa');
            if (session()->get('id_desa') == 0) {
                $user = $this->userModel->where('level !=', 4)->where('id_desa', $idd)->countAllResults();
            } else {
                $user = $this->userModel->where('level !=', 1)->where('id_desa', $idd)->countAllResults();
            }
            if (session()->get('id_desa') == 0) {
                $namaInstansi = 'Kabupaten Batu Bara';
            } else {
                $namaInstansi = $this->desaModel->getNamaDesaById($idd);
            }
            $data = array(
                'title'         => 'Dashboard',
                'appname'       => 'Aplikasi Management Surat',
                'users'         => $user,
                'sekretariat'   => $this->suratmasukModel->where('pokja =', null)->where('id_desa', $idd)->countAllResults(),
                'pokjaI'        => $this->suratmasukModel->where('pokja =', 'Pokja I')->where('id_desa', $idd)->countAllResults(),
                'pokjaII'       => $this->suratmasukModel->where('pokja =', 'Pokja II')->where('id_desa', $idd)->countAllResults(),
                'pokjaIII'      => $this->suratmasukModel->where('pokja =', 'Pokja III')->where('id_desa', $idd)->countAllResults(),
                'pokjaIV'       => $this->suratmasukModel->where('pokja =', 'Pokja IV')->where('id_desa', $idd)->countAllResults(),
                'penandatangan'       => $this->penandatanganModel->where('id_desa', $idd)->countAllResults(),
                'sekretariatsk'   => $this->suratkeluarModel->where('pokja =', null)->where('id_desa', $idd)->countAllResults(),
                'pokjaIsk'        => $this->suratkeluarModel->where('pokja =', 'Pokja I')->where('id_desa', $idd)->countAllResults(),
                'pokjaIIsk'       => $this->suratkeluarModel->where('pokja =', 'Pokja II')->where('id_desa', $idd)->countAllResults(),
                'pokjaIIIsk'      => $this->suratkeluarModel->where('pokja =', 'Pokja III')->where('id_desa', $idd)->countAllResults(),
                'pokjaIVsk'       => $this->suratkeluarModel->where('pokja =', 'Pokja IV')->where('id_desa', $idd)->countAllResults(),
                'isi'           => 'home',
                'namaInstansi'      => $namaInstansi
            );
            return view('layout/wrapper', $data);
        }
    }
}
