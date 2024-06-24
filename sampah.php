<div class="flex w-full">
 <!-- Formulir Uji Data -->
 <form class="form-pengujian" action="pengujian.php" method="post">
            <?php
        // Array label dan petunjuk yang akan ditampilkan di formulir
            $manualLabels = [
                'id_siswa' => 'NISN Siswa',
                'nama_siswa' => 'Nama Siswa',
                'jenis_tinggal' => 'Jenis Tinggal',
                'alat_transportasi' => 'Alat Transportasi',
                'penerima_KPS' => 'Penerima KPS',
                'pekerjaan_ayah' => 'Pekerjaan Ayah',
                'penghasilan_ayah' => 'Penghasilan Ayah ',
                'pekerjaan_ibu' => 'Pekerjaan Ibu',
                'penghasilan_ibu' => 'Penghasilan Ibu ',
                'penerima_KIP' => 'Penerima KIP',
                'penerima_KKS' => 'Penerima KKS',
                ];
            ?>
        
        <!-- Formulir Uji Data -->
        <div class="max-w-xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form class="form-pengujian" action="pengujian.php" method="post">
                <?php foreach ($manualLabels as $key => $label) : ?>
                    <div class="mb-4">
                        <label for="<?= $key ?>" class="block text-sm font-medium text-gray-700">
                            <?= $label ?>
                        </label>
                        <?php if (strpos($label, 'Jenis Tinggal') !== false || strpos($label, 'Alat Transportasi') !== false || strpos($label, 'Penerima KPS') !== false || strpos($label, 'Pekerjaan Ayah') !== false || strpos($label, 'Penghasilan Ayah') !== false || strpos($label, 'Pekerjaan Ibu') !== false || strpos($label, 'Penghasilan Ibu') !== false || strpos($label, 'Penerima KIP') !== false || strpos($label, 'Penerima KKS') !== false) : ?>
                            <select name="<?= $key ?>" id="<?= $key ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                                <?php if (strpos($label, 'Jenis Tinggal') !== false) : ?>
                                    <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                                    <option value="Panti Asuhan">Panti Asuhan</option>
                                <?php elseif (strpos($label, 'Alat Transportasi') !== false) : ?>
                                    <option value="Jalan Kaki">Jalan Kaki</option>
                                    <option value="Sepeda Motor">Sepeda Motor</option>
                                    <option value="Angkutan Umum">Angkutan Umum</option>
                                    <option value="Mobil Pribadi">Mobil Pribadi</option>
                                <?php elseif (strpos($label, 'Penerima KPS') !== false) : ?>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                <?php elseif (strpos($label, 'Pekerjaan Ayah') !== false) : ?>
                                    <option value="Buruh">Buruh</option>
                                    <option value="Nelayan">Nelayan</option>
                                    <option value="Sudah Meninggal">Sudah Meninggal</option>
                                    <option value="Petani">Petani</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                    <option value="Pedagang Kecil">Pedagang Kecil</option> 
                                <?php elseif (strpos($label, 'Penghasilan Ayah') !== false) : ?>
                                    <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                                    <option value="Rendah">Rendah (< 1 juta)</option>
                                    <option value="Sedang">Sedang (1 juta - 2 juta)</option>
                                    <option value="Tinggi">Tinggi (> 2 juta)</option>
                                <?php elseif (strpos($label, 'Pekerjaan Ibu') !== false) : ?>
                                    <option value="Sudah Meninggal">Sudah Meninggal</option>
                                    <option value="PNS/Polwan">PNS/Polwan</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                    <option value="Pedagang Kecil">Pedagang Kecil</option>
                                <?php elseif (strpos($label, 'Penghasilan Ibu') !== false) : ?>
                                    <option value="Tidak Berpenghasilan">Tidak Berpenghasilan</option>
                                    <option value="Rendah">Rendah (< 1 juta)</option>
                                    <option value="Sedang">Sedang (1 juta - 2 juta)</option>
                                    <option value="Tinggi">Tinggi (> 2 juta)</option>
                                <?php elseif (strpos($label, 'Penerima KIP') !== false) : ?>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                <?php elseif (strpos($label, 'Penerima KKS') !== false) : ?>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                <?php endif; ?>
                            </select>
                        <?php else : ?>
                            <input type="text" name="<?= $key ?>" id="<?= $key ?>" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
        
                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-blue-900 text-white py-2 rounded-md">Submit</button>
                </div>
            </form>
    </div>
<div class="w-1/2 mt-5 pl-5 flex flex-col gap-10">
 

    <div class="w-96 h-auto rounded-md bg-white shadow-md p-5">
        <h3 class="text-xl font-bold py-2 ">Langkah 2 :</h3>
        <?php
        // Hitung Likelihood
        foreach ($columns as $column) {
            // Skip field yang tidak ingin dihitung
            if ($column === 'id_training' || $column === 'id_siswa' || $column === 'nama_siswa' || $column === 'keterangan') {
                continue;
            }

            echo "<div class='mb-4'>";
            echo "<p class='text-sm font-semibold mb-1'><strong>{$column}</strong>:</p>";
            echo "<ul class='ml-4 list-disc'>";
            
            $uniqueValuesQuery = "SELECT DISTINCT {$column} FROM data_training";
            $uniqueValuesResult = mysqli_query($conn, $uniqueValuesQuery);

            while ($value = mysqli_fetch_assoc($uniqueValuesResult)) {
                echo "<li class='mb-1'>{$value[$column]}:</li>";
                foreach ($classProbabilities as $class => $classProbability) {
                    $likelihoodQuery = "SELECT COUNT(*) AS count FROM data_training WHERE {$column} = '{$value[$column]}' AND keterangan = '{$class}'";
                    $likelihoodResult = mysqli_query($conn, $likelihoodQuery);
                    $likelihoodCount = mysqli_fetch_assoc($likelihoodResult)['count'];
                    
                    $totalCategoryQuery = "SELECT COUNT(*) AS total FROM data_training WHERE keterangan = '{$class}'";
                    $totalCategoryResult = mysqli_query($conn, $totalCategoryQuery);
                    $totalCategoryCount = mysqli_fetch_assoc($totalCategoryResult)['total'];

                    $likelihood = $likelihoodCount / $totalCategoryCount;
                    
                    echo "<ul class='ml-4'><li class='text-xs'>{$class}: {$likelihood}</li></ul>";
                }
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="hasil-box w-96 h-auto rounded-md bg-white shadow-md p-5">
    <h3 class="text-lg font-semibold mb-3">Langkah 3 : Predictor Prior Probability</h3>
    <?php
    // Fungsi untuk menghitung likelihood
    function calculateLikelihood($conn, $column, $value, $class)
    {
        $likelihoodQuery = "SELECT COUNT(*) AS count FROM data_training WHERE {$column} = '{$value}' AND keterangan = '{$class}'";
        $likelihoodCountResult = mysqli_query($conn, $likelihoodQuery);
        $likelihoodCount = mysqli_fetch_assoc($likelihoodCountResult)['count'];

        $totalCategoryCountQuery = "SELECT COUNT(*) AS total FROM data_training WHERE keterangan = '{$class}'";
        $totalCategoryCountResult = mysqli_query($conn, $totalCategoryCountQuery);
        $totalCategoryCount = mysqli_fetch_assoc($totalCategoryCountResult)['total'];

        if ($totalCategoryCount > 0) {
            $likelihood = $likelihoodCount / $totalCategoryCount;
        } else {
            $likelihood = 0; // handle jika totalCategoryCount adalah 0 untuk menghindari division by zero
        }

        return $likelihood;
    }

    // Menghitung Predictor Prior Probability untuk setiap kelas
    $inputData = $_POST; // Ambil data dari formulir uji
    $predictorPriorProbabilities = array();
    $totalPredictorProbability = 0;

    foreach ($classProbabilities as $class => $classProbability) {
        $predictorPriorProbabilities[$class] = $classProbability;

        foreach ($inputData as $column => $value) {
            if ($column === 'id_siswa' || $column === 'nama_siswa') {
                continue;
            }

            $likelihood = calculateLikelihood($conn, $column, $value, $class);
            $predictorPriorProbabilities[$class] *= $likelihood;
        }

        // Tambahkan nilai predictor prior probability ke total
        $totalPredictorProbability += $predictorPriorProbabilities[$class];
    }

    // Menampilkan Predictor Prior Probability tanpa normalisasi
    foreach ($predictorPriorProbabilities as $class => $predictorPriorProbability) {
        echo "<p>{$class}: {$predictorPriorProbability}</p>";
    }
    ?>
</div>


<div class="hasil-box w-96 h-auto rounded-md bg-white shadow-md p-5">
    <h3 class="text-lg font-semibold mb-3">Langkah 4 : Probabilitas Posterior</h3>
    <?php
    // Menghitung Probabilitas Posterior untuk setiap kelas
    $posteriorProbabilities = array();
    $totalPredictorProbability = 0;

    // Hitung total dari Predictor Prior Probability
    foreach ($classProbabilities as $class => $classProbability) {
        $posteriorProbabilities[$class] = $classProbability;

        foreach ($inputData as $column => $value) {
            if ($column === 'id_siswa' || $column === 'nama_siswa') {
                continue;
            }

            $likelihood = calculateLikelihood($conn, $column, $value, $class);
            $posteriorProbabilities[$class] *= $likelihood;
        }

        $totalPredictorProbability += $posteriorProbabilities[$class];
    }

    // Normalisasi untuk mendapatkan Probabilitas Posterior
    foreach ($posteriorProbabilities as $class => $posteriorProbability) {
        // Normalisasi menggunakan formula Posterior Probability = Predictor Prior Probability / Total Predictor Prior Probability
        if ($totalPredictorProbability > 0) {
            $posteriorProbabilities[$class] /= $totalPredictorProbability;
        } else {
            $posteriorProbabilities[$class] = 0; // Handle jika totalPredictorProbability adalah 0
        }

        echo "<p>{$class}: {$posteriorProbabilities[$class]}</p>";
    }

    
    ?>

</div>
        
           
           
        </div>
        <?php
        
// Simpan data ke tabel data_testing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id_siswa = $_POST['id_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $jenis_tinggal = $_POST['jenis_tinggal'];
    $alat_transportasi = $_POST['alat_transportasi'];
    $penerima_KPS = $_POST['penerima_KPS'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $penghasilan_ayah = $_POST['penghasilan_ayah'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ibu = $_POST['penghasilan_ibu'];
    $penerima_KIP = $_POST['penerima_KIP'];
    $penerima_KKS = $_POST['penerima_KKS'];

    // Simpan data ke tabel data_testing
    $insertQuery = "INSERT INTO data_testing (id_siswa, nama_siswa, jenis_tinggal, alat_transportasi, penerima_KPS, pekerjaan_ayah, penghasilan_ayah, pekerjaan_ibu, penghasilan_ibu, penerima_KIP, penerima_KKS) VALUES ('$id_siswa', '$nama_siswa', '$jenis_tinggal', '$alat_transportasi', '$penerima_KPS', '$pekerjaan_ayah', '$penghasilan_ayah', '$pekerjaan_ibu', '$penghasilan_ibu', '$penerima_KIP', '$penerima_KKS')";
    
    if (mysqli_query($conn, $insertQuery)) {
        echo "Data berhasil disimpan ke tabel data_testing.";
        
        // Hitung Predictor Prior Probability untuk setiap kelas setelah menyimpan data
        $classProbabilities = array();
        $totalData = mysqli_query($conn, "SELECT COUNT(*) AS total FROM data_training")->fetch_assoc()['total'];
        $classes = mysqli_query($conn, "SELECT DISTINCT keterangan FROM data_training");
        while ($class = mysqli_fetch_assoc($classes)) {
            $classCount = mysqli_query($conn, "SELECT COUNT(*) AS count FROM data_training WHERE keterangan = '{$class['keterangan']}'")->fetch_assoc()['count'];
            $classProbability = $classCount / $totalData;
            $classProbabilities[$class['keterangan']] = $classProbability;
        }

        // Ambil input data dari $_POST untuk perhitungan Probabilitas Posterior
        $inputData = $_POST;
        $posteriorProbabilities = array();
        $totalPredictorProbability = 0;

        foreach ($classProbabilities as $class => $classProbability) {
            $posteriorProbabilities[$class] = $classProbability;

            foreach ($inputData as $column => $value) {
                if ($column === 'id_siswa' || $column === 'nama_siswa') {
                    continue;
                }

                $likelihood = calculateLikelihood($conn, $column, $value, $class);
                $posteriorProbabilities[$class] *= $likelihood;
            }

            $totalPredictorProbability += $posteriorProbabilities[$class];
        }

        // Normalisasi untuk mendapatkan Probabilitas Posterior
        foreach ($posteriorProbabilities as $class => $posteriorProbability) {
            if ($totalPredictorProbability > 0) {
                $posteriorProbabilities[$class] /= $totalPredictorProbability;
            } else {
                $posteriorProbabilities[$class] = 0; // Handle jika totalPredictorProbability adalah 0
            }

            // Simpan hasil prediksi ke dalam kolom 'keterangan' di tabel 'data_testing' jika layak
            if ($posteriorProbability >= 0.5) {
                $updateQuery = "UPDATE data_testing SET keterangan = '{$class}' WHERE id_siswa = '{$id_siswa}'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "Hasil prediksi berhasil disimpan di tabel data_testing.";
                } else {
                    echo "Error: " . $updateQuery . "<br>" . mysqli_error($conn);
                }
                break; // Hentikan iterasi setelah menemukan prediksi yang layak
            }
        }
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}
?>
