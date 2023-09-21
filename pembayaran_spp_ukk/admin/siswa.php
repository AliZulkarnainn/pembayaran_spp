<h5>Halaman Data Siswa .</h5>
<a href="?url=tambah-siswa" class="btn btn-primary">Tambah Siswa</a>
<hr>
<input type="text" id="searchInput" placeholder="Cari...">
<table class="table table-stripped table-bordered">
    <script>
    // Mendapatkan elemen input dan tabel
    var searchInput = document.getElementById("searchInput");
    var table = document.querySelector("table");
    // Menambahkan event listener pada input
    searchInput.addEventListener("keyup", function() {
        // Mendapatkan nilai input
        var searchValue = searchInput.value.toLowerCase();
        // Mendapatkan semua baris data dalam tabel kecuali header
        var rows = table.querySelectorAll("tr:not(.fw-bold)");
        // Melakukan iterasi pada setiap baris data
        rows.forEach(function(row) {
            // Mendapatkan nilai pada kolom NISN, NIS, Nama, Kelas, Alamat, dan No Telpon
            var nisn = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            var nis = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
            var nama = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
            var kelas = row.querySelector("td:nth-child(5)").textContent.toLowerCase();
            var alamat = row.querySelector("td:nth-child(6)").textContent.toLowerCase();
            var noTelpon = row.querySelector("td:nth-child(7)").textContent.toLowerCase();
            // Memeriksa apakah nilai input cocok dengan nilai pada kolom NISN, NIS, Nama, Kelas, Alamat, atau No Telpon
            if (nisn.includes(searchValue) || nis.includes(searchValue) || nama.includes(searchValue) ||
                kelas.includes(searchValue) || alamat.includes(searchValue) || noTelpon.includes(
                    searchValue)) {
                row.style.display = ""; // Tampilkan baris jika cocok
            } else {
                row.style.display = "none"; // Sembunyikan baris jika tidak cocok
            }
        });
    });
    </script>
    <tr class="fw-bold">
        <td>No.</td>
        <td>NISN</td>
        <td>NIS</td>
        <td>Nama</td>
        <td>Kelas</td>
        <td>Alamat</td>
        <td>No Telpon</td>
        <td>SPP</td>
        <td>Edit</td>
        <td>Hapus</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $sql = "SELECT*FROM siswa,spp,kelas WHERE siswa.id_kelas=kelas.id_kelas AND siswa.id_spp=spp.id_spp ORDER BY
    nama ASC ";
    $query = mysqli_query($koneksi, $sql);
    foreach ($query as $data) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nisn']; ?></td>
        <td><?= $data['nis']; ?></td>
        <td><?= $data['nama']; ?></td>
        <td><?= $data['nama_kelas']; ?></td>
        <td><?= $data['alamat']; ?></td>
        <td><?= $data['no_telp']; ?></td>
        <td><?= $data['tahun'] ?> - <?= number_format($data['nominal'], 2, ',', '.'); ?></td>
        <td>
            <a href="?url=edit-siswa&nisn=<?= $data['nisn'] ?>" class="btn btn-warning">EDIT</a>
        </td>
        <td>
            <a onclick="return confirm('Yakin Ingin Menghapus Data??')"
                href="?url=hapus-siswa&nisn=<?= $data['nisn'] ?>" class="btn btn-danger">HAPUS</a>
        </td>
    </tr>
    <?php } ?>
</table>