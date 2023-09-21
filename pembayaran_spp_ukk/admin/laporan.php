<h5>Laporan Pembayaran SPP.</h5>
<a href="cetak-laporan.php" class="btn btn-primary">Cetak Laporan</a>
<hr>
<input type="text" id="searchInput" placeholder="Search...">
<table class="table table-stripped table-bordered">
    <script>
        // Get the input element and table
        var searchInput = document.getElementById("searchInput");
        var table = document.querySelector("table");
        // Add event listener to the input
        searchInput.addEventListener("keyup", function() {
            // Get the input value
            var searchValue = searchInput.value.toLowerCase();
            // Get all data rows in the table except the header
            var rows = table.querySelectorAll("tr:not(.fw-bold)");
            // Iterate through each data row
            rows.forEach(function(row) {
                // Get the values in the NISN, Nama, and Kelas columns
                var nisn = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                var nama = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                var kelas = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                // Check if the input value matches any value in the NISN, Nama, or Kelas columns
                if (nisn.includes(searchValue) || nama.includes(searchValue) || kelas.includes(
                        searchValue)) {
                    row.style.display = ""; // Show the row if there is a match
                } else {
                    row.style.display = "none"; // Hide the row if there is no match
                }
            });
        });
    </script>
    <tr class="fw-bold">
        <td>No.</td>
        <td>NISN</td>
        <td>Nama</td>
        <td>Kelas</td>
        <td>Tahun SPP</td>
        <td>Nominal Dibayar</td>
        <td>Sudah Dibayar</td>
        <td>Tanggal Bayar</td>
        <td>Petugas</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $sql = "SELECT*FROM pembayaran,siswa,kelas,spp,petugas WHERE pembayaran.nisn=siswa.nisn AND
     siswa.id_kelas=kelas.id_kelas
    AND pembayaran.id_spp=spp.id_spp AND pembayaran.id_petugas=petugas.id_petugas      
     ORDER by tgl_bayar DESC";
    $query = mysqli_query($koneksi, $sql);
    foreach ($query as $data) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nisn']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['nama_kelas']; ?></td>
            <td><?= $data['tahun'] ?></td>
            <td><?= number_format($data['nominal'], 2, ',', '.'); ?></td>
            <td><?= number_format($data['jumlah_bayar'], 2, ',', '.'); ?></td>
            <td><?= $data['tgl_bayar']; ?></td>
            <td><?= $data['nama_petugas']; ?></td>
        </tr>
    <?php } ?>
</table>