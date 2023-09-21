<h5>Halaman Data Petugas.</h5>
<a href="?url=tambah-petugas" class="btn btn-primary">Tambah Petugas</a>
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
            // Mendapatkan nilai pada kolom Username, Password, dan Nama Petugas
            var username = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
            var password = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
            var namaPetugas = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
            // Memeriksa apakah nilai input cocok dengan nilai pada kolom Username, Password, atau Nama Petugas
            if (username.includes(searchValue) || password.includes(searchValue) || namaPetugas
                .includes(searchValue)) {
                row.style.display = ""; // Tampilkan baris jika cocok
            } else {
                row.style.display = "none"; // Sembunyikan baris jika tidak cocok
            }
        });
    });
    </script>
    <tr class="fw-bold">
        <td>No.</td>
        <td>Username</td>
        <td>Password</td>
        <td>Nama Petugas</td>
        <td>Level</td>
        <td>Edit</td>
        <td>Hapus</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $sql = "SELECT*FROM petugas ORDER BY id_petugas DESC";
    $query = mysqli_query($koneksi, $sql);
    foreach ($query as $data) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['username']; ?></td>
        <td><?= $data['password']; ?></td>
        <td><?= $data['nama_petugas']; ?></td>
        <td><?= $data['level']; ?></td>
        <td>
            <a href="?url=edit-petugas&id_petugas=<?= $data['id_petugas'] ?>" class="btn btn-warning">EDIT</a>
        </td>
        <td>
            <a onclick="return confirm('Yakin Ingin Menghapus Data??')"
                href="?url=hapus-petugas&id_petugas=<?= $data['id_petugas'] ?>" class="btn btn-danger">HAPUS</a>
        </td>
    </tr>
    <?php } ?>
</table>