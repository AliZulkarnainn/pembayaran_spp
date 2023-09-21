<h5>Halaman Pilih Data Siswa Untuk Pembayaran.</h5>
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
                // Mendapatkan nilai pada kolom NISN, Nama, dan Kelas
                var nisn = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                var nama = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                var kelas = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                // Memeriksa apakah nilai input cocok dengan nilai pada kolom NISN, Nama, atau Kelas
                if (nisn.includes(searchValue) || nama.includes(searchValue) || kelas.includes(
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
        <td>Nama</td>
        <td>Kelas</td>
        <td>SPP</td>
        <td>Nominal</td>
        <td>Sudah Dibayar</td>
        <td>Kekurangan</td>
        <td>Status</td>
        <td>History</td>
    </tr>
    <?php
    include '../koneksi.php';
    $no = 1;
    $sql = "SELECT*FROM siswa,spp,kelas WHERE siswa.id_kelas=kelas.id_kelas AND siswa.id_spp=spp.id_spp ORDER BY
    nama ASC ";
    $query = mysqli_query($koneksi, $sql);
    foreach ($query as $data) {
        $data_pembayaran = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) as jumlah_bayar FROM pembayaran
        WHERE nisn='$data[nisn]'");
        $data_pembayaran = mysqli_fetch_array($data_pembayaran);
        $sudah_bayar = $data_pembayaran['jumlah_bayar'];
        $kekurangan = $data['nominal'] -
            $data_pembayaran['jumlah_bayar'];
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nisn']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['nama_kelas']; ?></td>
            <td><?= $data['tahun'] ?></td>
            <td><?= number_format($data['nominal'], 2, ',', '.'); ?></td>
            <td><?= number_format($sudah_bayar, 2, ',', '.'); ?></td>
            <td><?= number_format($kekurangan, 2, ',', '.'); ?></td>
            <td>
                <?php
                if ($kekurangan == 0) {
                    echo "<span class='badge text-bg-success'>Sudah Lunas</span>";
                } else { ?>
                    <a href="?url=tambah-pembayaran&nisn=<?= $data['nisn'] ?>&kekurangan=<?= $kekurangan ?>" class="btn btn-danger">Pilih & Bayar</a>
                <?php } ?>
            </td>
            <td>
                <a href="?url=history-pembayaran&nisn=<?= $data['nisn'] ?>" class="btn btn-info">History</a>
            </td>
        </tr>
    <?php } ?>
</table>