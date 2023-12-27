<?php
$k = 5;
$i = 0;
// Pengambilan data training ke dalam variable array
foreach ($dataset as $rowDataset) {
    $spl[$i] = $rowDataset['sepal_length'];
    $spw[$i] = $rowDataset['sepal_width'];
    $ptl[$i] = $rowDataset['petal_length'];
    $ptw[$i] = $rowDataset['petal_width'];
    $kelas[$i] = $rowDataset['kelas'];
    $i++;
}
// Pengambilan data maksimum dan minimun ke dalam variable
$max_ptl = $minMax[0]->max_ptl;
$max_ptw = $minMax[0]->max_ptw;
$max_spl = $minMax[0]->max_spl;
$max_spw = $minMax[0]->max_spw;
$min_ptl = $minMax[0]->min_ptl;
$min_ptw = $minMax[0]->min_ptw;
$min_spl = $minMax[0]->min_spl;
$min_spw = $minMax[0]->min_spw;

// Mencari nilai max-min dengan membandingkan dengan data baru
$max_spl = max($max_spl, $sepal_length);
$min_spl = min($min_spl, $sepal_length);
$max_spw = max($max_spw, $sepal_width);
$min_spw = min($min_spw, $sepal_width);
$max_ptl = max($max_ptl, $petal_length);
$min_ptl = min($min_ptl, $petal_length);
$max_ptw = max($max_ptw, $petal_width);
$min_ptw = max($min_ptw, $petal_width);

// Melakukan normalisasi menggunakan min-max featuring scalling
// normalisasi data baru
$normal_sepal_length = ($sepal_length - $min_spl) / ($max_spl - $min_spl);
$normal_sepal_width = ($sepal_width - $min_spw) / ($max_spw - $min_spw);
$normal_petal_length = ($petal_length - $min_ptl) / ($max_ptl - $min_ptl);
$normal_petal_width = ($petal_width - $min_ptw) / ($max_ptw - $min_ptw);

// Melakukan normalisasi data latih
$i = 0;
foreach ($dataset as $rowDataset) {
    $normal_spl[$i] = ($spl[$i] - $min_spl) / ($max_spl - $min_spl);
    $normal_spw[$i] = ($spw[$i] - $min_spw) / ($max_spw - $min_spw);
    $normal_ptl[$i] = ($ptl[$i] - $min_ptl) / ($max_ptl - $min_ptl);
    $normal_ptw[$i] = ($ptw[$i] - $min_ptw) / ($max_ptw - $min_ptw);
    $i++;
}

// Melakukan perhitungan untuk setiap data latih
$i = 0;
foreach ($dataset as $rowDataset) {
    $temp = 0;
    $temp += pow($normal_sepal_length - $normal_spl[$i], 2);
    $temp += pow($normal_sepal_width - $normal_spw[$i], 2);
    $temp += pow($normal_petal_length - $normal_ptl[$i], 2);
    $temp += pow($normal_petal_width - $normal_ptw[$i], 2);
    $jarak[$i] = sqrt($temp);
    $i++;
}

// Mencari jarak terbesar
$max_jarak = 0;
$i = 0;
foreach ($dataset as $rowDataset) {
    $max_jarak = max($max_jarak, $jarak[$i]);
    $i++;
}

// Mencari jarak k terkecil
for ($j = 0; $j <= $k; $j++) {
    $min_jarak[$j] = $max_jarak; // sebagai nilai awal diset terbsesar terlebih dahulu
    $i = 0;
    foreach ($dataset as $rowDataset) {
        if ($jarak[$i] < $min_jarak[$j]) {
            $min_jarak[$j] = $jarak[$i];
            $indeks = $i;
        }
        $kelas_min[$j] = $kelas[$indeks]; // Menyimpan indeks dari kelas terkecil
        $jarak[$indeks] = $max_jarak;
    }
}

// Menghitung jumlah terkecil
$Iris_setosa = 0;
$Iris_versicolor = 0;
$Iris_virginica = 0;
for ($j = 0; $j <= $k; $j++) {
    if ($kelas_min[$j] == "Iris-setosa") {
        $Iris_setosa += 1;
    } elseif ($kelas_min[$j] == "Iris-versicolor") {
        $Iris_versicolor += 1;
    } else {
        $Iris_virginica += 1;
    }
}

// Menentukan kelas berdasarkan jumlah kelas teridentifikasi terbanyak
$terbesar = $Iris_setosa;
$kelas_terpilih = "Iris-setosa";
if ($Iris_versicolor > $terbesar) {
    $terbesar = $Iris_versicolor;
    $kelas_terpilih = "Iris-versicolor";
}
if ($Iris_virginica > $terbesar) {
    $tersebar = $Iris_virginica;
    $kelas_terpilih = "Iris-virginia";
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-xxl">
        <div class="row">
            <div class="col">
                <h1>Data Training</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sepal Length</th>
                            <th scope="col">SepaL Width</th>
                            <th scope="col">Petal Length</th>
                            <th scope="col">Petal Width</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($dataset as $rowDataset) : ?>
                            <tr>
                                <th scope="row"><?php echo $no++ ?></th>
                                <td><?php echo $rowDataset['sepal_length'] ?></td>
                                <td><?php echo $rowDataset['sepal_width'] ?></td>
                                <td><?php echo $rowDataset['petal_length'] ?></td>
                                <td><?php echo $rowDataset['petal_width'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <h1>Data Iputan</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sepal Length</th>
                            <th scope="col">SepaL Width</th>
                            <th scope="col">Petal Length</th>
                            <th scope="col">PetaL Width</th>
                            <th scope="col">Kelas-kelas dengan jarak terkecil</th>
                            <th scope="col">Kelas terpilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><?php echo $sepal_length ?></td>
                            <td><?php echo $sepal_width ?></td>
                            <td><?php echo $petal_length ?></td>
                            <td><?php echo $petal_width ?></td>
                            <td>
                                <ul>
                                    <?php for ($j = 0; $j <= $k; $j++) : ?>
                                        <li><?php echo $kelas_min[$j] ?></li>
                                    <?php endfor ?>
                                </ul>
                            </td>
                            <td><?php echo $kelas_terpilih ?></td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>