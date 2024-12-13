<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PasienModel;
use App\Models\UserModel; // Menambahkan model User
use DateTime;

class PasienController extends BaseController
{
    protected $pasienModel;
    protected $userModel;

    public function __construct()
    {
        $this->pasienModel = new PasienModel();
        $this->userModel = new UserModel(); // Inisialisasi model user
    }

    public function index()
    {
        $pasien = $this->pasienModel->findAll();

        $data = [
            'title' => 'Data Pasien',
            'content' => 'admin/dashboard/adminPasien',
            'pasien' => $pasien
        ];

        return view('admin/layout', $data);
    }

    public function save()
    {
        $request = $this->request;

        // Generate Nomor RM using the current date
        $currentDate = new DateTime();
        $no_rm = $this->pasienModel->generateNoRM($currentDate);

        // Data pasien yang akan disimpan
        $pasienData = [
            'nama_pasien' => $request->getPost('nama_pasien'),
            'alamat' => $request->getPost('alamat'),
            'no_ktp' => $request->getPost('no_ktp'),
            'no_hp' => $request->getPost('no_hp'),
            'no_rm' => $no_rm
        ];

        // Simpan data pasien
        $this->pasienModel->save($pasienData);

        // Simpan data user untuk pasien (misal role: 'pasien')
        $userData = [
            'name' => $request->getPost('nama_pasien'),
            'email' => $request->getPost('email'),
            'password' => password_hash($request->getPost('password'), PASSWORD_BCRYPT), // Menggunakan password_hash
            'role' => 'pasien'
        ];

        // Simpan data user
        $this->userModel->save($userData);

        return redirect()->to('/admin/pasien')->with('success', 'Data pasien berhasil disimpan!');
    }

    public function edit($id)
    {
        $pasien = $this->pasienModel->find($id);

        $data = [
            'title' => 'Edit Pasien',
            'content' => 'admin/dashboard/adminPasien',
            'pasienData' => $pasien
        ];

        return view('admin/layout', $data);
    }

    public function update($id)
    {
        $request = $this->request;

        // Update data pasien
        $pasienData = [
            'nama_pasien' => $request->getPost('nama_pasien'),
            'alamat' => $request->getPost('alamat'),
            'no_ktp' => $request->getPost('no_ktp'),
            'no_hp' => $request->getPost('no_hp')
        ];

        // Simpan perubahan data pasien
        $this->pasienModel->update($id, $pasienData);

        return redirect()->to('/admin/pasien')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->pasienModel->delete($id);
        return redirect()->to('/admin/pasien')->with('success', 'Data pasien berhasil dihapus!');
    }
}
