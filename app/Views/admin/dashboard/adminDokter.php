<h3 class="mb-4 text-center">Mengelola Dokter</h3>

<div class="container">
    <!-- Form Input -->
    <form action="<?= isset($dokterData) ? '/admin/dokter/update/' . $dokterData['dokter_id'] : '/admin/dokter/save'; ?>" method="post" class="mb-4">
        <div class="col-md-12 mb-3">
            <label for="nama_dokter" class="form-label">Nama Dokter</label>
            <input type="text" id="nama_dokter" name="nama_dokter" class="form-control" placeholder="Nama Dokter" 
                   value="<?= isset($dokterData) ? $dokterData['nama_dokter'] : ''; ?>" required>
        </div>
        
        <div class="col-md-12 mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" 
                   value="<?= isset($dokterData) ? $dokterData['alamat'] : ''; ?>" required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="no_hp" class="form-label">No. Hp</label>
            <input type="number" id="no_hp" name="no_hp" class="form-control" placeholder="No. Hp" 
                   value="<?= isset($dokterData) ? $dokterData['no_hp'] : ''; ?>" required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="id_poli" class="form-label">Poli</label>
            <select id="id_poli" name="id_poli" class="form-control" required>
                <option value="">Pilih Poli</option>
                <?php foreach ($poli as $p): ?>
                    <option value="<?= $p['poli_id']; ?>" <?= (isset($dokterData) && $dokterData['id_poli'] == $p['poli_id']) ? 'selected' : ''; ?>><?= $p['nama_poli']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary mb-3">Simpan</button>
        <?php if (isset($dokterData)): ?>
            <a href="/admin/dokter" class="btn btn-secondary mb-3">Batal</a>
        <?php endif; ?>
    </form>

    <!-- Table Dokter -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Nama Poli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dokter) && count($dokter) > 0): ?>
                <?php foreach ($dokter as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $row['nama_dokter'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['no_hp'] ?></td>
                        <td><?= $row['nama_poli'] ?></td>
                        <td>
                            <a href="/admin/dokter/edit/<?= $row['dokter_id'] ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="/admin/dokter/delete/<?= $row['dokter_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>x
            <?php endif; ?>
        </tbody>
    </table>
</div>
