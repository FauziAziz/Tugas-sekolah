<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>perulangan</title>
</head>
<body>
    <li><a href="dashboard.html" class="nav-link">Dashboard</a></li>
    <li><a href="stok.html" class="nav-link">Informasi Bahan Ajar</a></li>
    <li><a href="tracking.html" class="nav-link active">Tracking Pengiriman</a></li>
    <li><a href="aritmatika.html" class="nav-link">aritmatika</a></li>
     <li><a href="perulangan.php" class="nav-link">perulangan</a></li>
     <li><a href="percabangan.php" class="nav-link">percabangan</a></li>

    <h2>Contoh Perulangan di HTML dengan PHP</h2>

    <h3>Perulangan For</h3>
    <ul>
        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "<li>Item ke-$i</li>";
        }
        ?>
    </ul>

    <h3>Perulangan While</h3>
    <ul>
        <?php
        $j = 1;
        while ($j <= 5) {
            echo "<li>Item ke-$j</li>";
            $j++;
        }
        ?>
    </ul>

    <h3>Perulangan Do-While</h3>
    <ul>
        <?php
        $k = 1;
        do {
            echo "<li>Item ke-$k</li>";
            $k++;
        } while ($k <= 5);
        ?>
    </ul>

    <h3>Perulangan Foreach</h3>
    <ul>
        <?php
        $items = ["Apel", "Pisang", "Jeruk", "Mangga", "Anggur"];
        foreach ($items as $item) {
            echo "<li>$item</li>";
        }
        ?>
    </ul>
</body>
</html>