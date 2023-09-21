<h5>Halaman Data SPP.</h5>
<a href="?url=tambah-spp" class="btn btn-primary">Tambah SPP</a>
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
            // Mendapatkan nilai pada kolom No., Tahun, dan Nominal
            var no = row.querySelector("td:nth-child(1)").textContent.toLowerCase();
            var tahun = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            var nominal = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
            // Memeriksa apakah nilai input cocok dengan nilai pada kolom No., Tahun, atau Nominal
            if (no.includes(searchValue) || tahun.includes(searchValue) || nominal.includes(
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
        <td>Tahun</td>
        <td>Nominal</td>
        <td>Edit</td>
        <td>Hapus</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $sql = "SELECT*FROM spp ORDER BY id_spp DESC";
    $query = mysqli_query($koneksi, $sql);
    foreach ($query as $data) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['tahun']; ?></td>
        <td><?= $data['nominal']; ?></td>
        <td>
            <a href="?url=edit-spp&id_spp=<?= $data['id_spp'] ?>" class="btn btn-warning">EDIT</a>
        </td>
        <td>
            <a onclick="return confirm('Yakin Ingin Menghapus Data??')"
                href="?url=hapus-spp&id_spp=<?= $data['id_spp'] ?>" class="btn btn-danger">HAPUS</a>
        </td>
    </tr>
    <?php } ?>
</table>