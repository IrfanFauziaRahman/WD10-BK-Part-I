<?php
namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'dokter_id';  // Primary key untuk tabel dokter
    protected $allowedFields = ['nama_dokter', 'alamat', 'no_hp', 'id_poli'];  // Kolom yang dapat diubah

    // Method untuk mengambil semua data dokter dengan nama poli
    public function getAllDokter()
    {
        // Melakukan join antara tabel dokter dan poli
        return $this->select('dokter.dokter_id, dokter.nama_dokter, dokter.alamat, dokter.no_hp, poli.nama_poli')
                    ->join('poli', 'dokter.id_poli = poli.poli_id')  // Menghubungkan dengan tabel poli
                    ->findAll();  // Mengambil semua data
    }
}
