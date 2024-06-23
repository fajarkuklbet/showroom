<!DOCTYPE html>
<html>

<head>
    <title>Form Pendaftaran Peserta Pelatihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        //Include file koneksi, untuk koneksikan ke database
        include "db_conn.php";

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = input($_POST["name"]);
            $nohp = input($_POST["nohp"]);
            $namamotor = input($_POST["namamotor"]);
            //Query input menginput data kedalam tabel anggota
            $sql = "insert into formulir (username,nohp,namamotor) values
		('$username','$nohp','$namamotor')";

            //Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($conn, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                $last_id = mysqli_insert_id($conn);
                header("Location: cetak.php?id=$last_id");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>
        <h2>Form Pendaftaran Pembeli</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="name" class="form-control" placeholder="Masukan Nama" required />
            </div>
            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="nohp" class="form-control" placeholder="Masukan No Hp" required />
            </div>
            <div class="form-group">
                <label> Motor:</label>
                <select id="namamotor" name="namamotor" class="form-control" required>
                    <option value="">Pilih Motor</option>
                    <?php
                    $sql7 = $conn->query("SELECT * FROM motor");
                    while ($data = $sql7->fetch_assoc()) {
                        echo "<option value='" . $data['namamotor'] . "'>" . $data['namamotor'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="home.php" class="btn btn-info text-white">Kembali</a>
        </form>
    </div>
</body>

</html>