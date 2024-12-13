<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokterModel;
use App\Models\PoliModel;

class DokterController extends BaseController
{
    protected $dokterModel;
    protected $poliModel;

    public function __construct()
    {
        $this->dokterModel = new DokterModel();
        $this->poliModel = new PoliModel();
    }

    public function index()
{
    $data = [
        'title' => 'Poliklinik Dokter',
        'content' => 'admin/dashboard/adminDokter',
        'dokter' => $this->dokterModel->getAllDokter(), // Mengambil semua data dokter dengan nama poli
        'poli' => $this->poliModel->findAll()  // Mengambil data semua poli untuk keperluan dropdown
    ];

    return view('admin/layout', $data);
}

    public function save()
    {
        $this->dokterModel->save([
            'nama_dokter' => $this->request->getPost('nama_dokter'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'id_poli' => $this->request->getPost('id_poli')
        ]);

        return redirect()->to('/admin/dokter')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($dokter_id)
    {
        $data = [
            'title' => 'Edit Dokter',
            'content' => 'admin/dashboard/adminDokter',
            'dokterData' => $this->dokterModel->find($dokter_id),
            'dokter' => $this->dokterModel->getAllDokter(), 
            'poli' => $this->poliModel->findAll()  // Get all poli for dropdown
        ];

        return view('admin/layout', $data);
    }

    public function update($dokter_id)
    {
        $this->dokterModel->update($dokter_id, [
            'nama_dokter' => $this->request->getPost('nama_dokter'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp'),
            'id_poli' => $this->request->getPost('id_poli')
        ]);

        return redirect()->to('/admin/dokter')->with('success', 'Data berhasil diperbarui!');
    }

    public function delete($dokter_id)
    {
        $this->dokterModel->delete($dokter_id);
        return redirect()->to('/admin/dokter')->with('success', 'Data berhasil dihapus!');
    }
}
