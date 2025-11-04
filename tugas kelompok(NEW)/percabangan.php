<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tolong buatkan kodingan php tentang SEMUA percabangan LENGKAP seperti if else, if, else, switch. ini semua harus ada</title>
</head>
<body>
     <li><a href="dashboard.html" class="nav-link active">Dashboard</a></li>
    <li><a href="stok.html" class="nav-link">Informasi Bahan Ajar</a></li>
     <li><a href="tracking.html" class="nav-link">Tracking Pengiriman</a></li>
     <li><a href="aritmatika.html" class="nav-link">aritmatika</a></li>
     <li><a href="perulangan.php" class="nav-link">perulangan</a></li>
     <li><a href="percabangan.php" class="nav-link">percabangan</a></li>
     
    <h2>Contoh Percabangan di HTML dengan PHP</h2>

    <h3>Percabangan If</h3>
    <?php
        $nilai = 75;
        if ($nilai >= 60) {
            echo "<p>Selamat! Anda lulus.</p>";
        }
    ?>

    <h3>Percabangan If-Else</h3>
    <?php
        $nilai = 45;
        if ($nilai >= 60) {
            echo "<p>Selamat! Anda lulus.</p>";
        } else {
            echo "<p>Maaf, Anda tidak lulus.</p>";
        }
    ?>

    <h3>Percabangan If-Elseif-Else</h3>
    <?php
        $nilai = 85;
        if ($nilai >= 85) {
            echo "<p>Nilai Anda A.</p>";
        } elseif ($nilai >= 70) {
            echo "<p>Nilai Anda B.</p>";
        } elseif ($nilai >= 60) {
            echo "<p>Nilai Anda C.</p>";
        } else {
            echo "<p>Nilai Anda D.</p>";
        }
    ?>

    <h3>Percabangan Switch</h3>
    <?php
        $hari = 3;
        switch ($hari) {
            case 1:
                echo "<p>Senin</p>";
                break;
            case 2:
                echo "<p>Selasa</p>";
                break;
            case 3:
                echo "<p>Rabu</p>";
                break;
            case 4:
                echo "<p>Kamis</p>";
                break;
            case 5:
                echo "<p>Jumat</p>";
                break;
            case 6:
                echo "<p>Sabtu</p>";
                break;
            case 7:
                echo "<p>Minggu</p>";
                break;
            default:
                echo "<p>Hari tidak valid</p>";
        }
    ?>
</body>
</html>