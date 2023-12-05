@extends('admin.layout')

@section('content')

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Beli Gundam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        section {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
<header>
    <h1>Jual Beli Gundam</h1>
</header>

<section>
    <h2>Selamat datang di Jual Beli Gundam</h2>
    <p>Temukan berbagai koleksi Gundam berkualitas tinggi di sini.</p>

    <!-- Tampilkan informasi lainnya dari database atau sumber data lainnya -->
    <?php
    // Misalnya, kita punya array data sebagai contoh
    $gundamList = array(
        array("RX 78 Gundam", "RX-78 Gundam adalah sebuah serial dari senjata bergerak fiksional percobaan dalam Universal Century Gundam yang dikembangkan oleh Federasi Bumi. Baju bergerak dari serial ini, RX-78-2 Gundam, adalah anggota serial ini. RX-78-2 Gundam menjadi simbol bagi serial Gundam atas banyaknya spinoff dan sekuel dari cerita ini.", "Harga: Rp. 100.000,0"),
        array("Mobile Suit Gundam", "In the war between the Earth Federation and Zeon, an inexperienced crew find themselves on a new spaceship. Their best chance at making it through the conflict is the Gundam, a giant humanoid robot, and its gifted teenage pilot.", "Harga: Rp. 300.000,0"),
        array("MS Igloo (UC 0079)", "Mobile Suit Gundam MS IGLOO is a Japanese mini-series of nine CGI short films and OVAs based on the Gundam anime franchise, released from 2004 to 2009 in three chapters each comprising three episodes.", "Harga: Rp. 500.000,0"),
    );

    // Loop untuk menampilkan informasi Gundam
    foreach ($gundamList as $gundam) {
        echo "<div>";
        echo "<h3>{$gundam[0]}</h3>";
        echo "<p>{$gundam[1]}</p>";
        echo "<p>{$gundam[2]}</p>";
        echo "</div>";
    }
    ?>
</section>
</body>
</html>




@stop
