<h5>Halaman Data Kelas.</h5>
<a href="?url=tambah-kelas" class="btn btn-primary">Tambah Kelas</a>
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
            // Mendapatkan nilai pada kolom Tahun dan Nominal
            var tahun = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            var nominal = row.querySelector("td:nth-child(3)").textContent.toLowerCase();

            // Memeriksa apakah nilai input cocok dengan nilai pada kolom Tahun atau Nominal
            if (tahun.includes(searchValue) || nominal.includes(searchValue)) {
                row.style.display = ""; // Tampilkan baris jika cocok
            } else {
                row.style.display = "none"; // Sembunyikan baris jika tidak cocok
            }
        });
    });
    </script>
    <tr class="fw-bold">
        <td>No.</td>
        <td>Nama Kelas</td>
        <td>Kompetensi Keahlian</td>
        <td>Edit</td>
        <td>Hapus</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $sql = "SELECT*FROM kelas ORDER BY id_kelas DESC";
    $query = mysqli_query($koneksi, $sql);
    foreach ($query as $data) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nama_kelas']; ?></td>
        <td><?= $data['kompetensi_keahlian']; ?></td>
        <td>
            <a href="?url=edit-kelas&id_kelas=<?= $data['id_kelas'] ?>" class="btn btn-warning">EDIT</a>
        </td>
        <td>
            <a onclick="return confirm('Yakin Ingin Menghapus Data??')"
                href="?url=hapus-kelas&id_kelas=<?= $data['id_kelas'] ?>" class="btn btn-danger">HAPUS</a>
        </td>
    </tr>
    <?php } ?>
</table>