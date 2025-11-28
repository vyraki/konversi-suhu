<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-width, initial-scale=1.0">
    <title>Konverter Suhu - Smart Converter</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="wrapper">

    <!-- KIRI: IDENTITAS -->
    <div class="identitas-box">
        <h2>Identitas</h2>
        <p><b>Nama:</b> Kira Arsya Savaira</p>
        <p><b>Kelas:</b> XII RPL 3</p>
        <p><b>Absen:</b> 18</p>
    </div>

    <!-- KANAN: APLIKASI -->
    <div class="container">

        <div class="header">
            <h1>Suhu</h1>
            <p>Konverter Suhu Instan</p>
        </div>

        <?php
        // Default display
        $outputValue = "-";
        $outputUnit = "-";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            // Kalau tombol reset ditekan → balik default
            if (isset($_POST["reset"])) {
                $outputValue = "-";
                $outputUnit = "-";
            } else {

                $inputTemp = floatval($_POST['inputTemp']);
                $fromUnit = $_POST['fromUnit'];
                $toUnit = $_POST['toUnit'];

                // Convert ke Celsius dulu
                if ($fromUnit == 'celsius') $celsius = $inputTemp;
                elseif ($fromUnit == 'fahrenheit') $celsius = ($inputTemp - 32) * 5/9;
                elseif ($fromUnit == 'kelvin') $celsius = $inputTemp - 273.15;
                elseif ($fromUnit == 'reumer') $celsius = $inputTemp * 5/4;

                if ($celsius < -273.15) {
                    $outputValue = "Invalid";
                    $outputUnit = "";
                } else {
                    // Convert ke target
                    if ($toUnit == 'celsius') {
                        $outputValue = $celsius;
                        $outputUnit = "°C";
                    }
                    elseif ($toUnit == 'fahrenheit') {
                        $outputValue = ($celsius * 9/5) + 32;
                        $outputUnit = "°F";
                    }
                    elseif ($toUnit == 'kelvin') {
                        $outputValue = $celsius + 273.15;
                        $outputUnit = "K";
                    }
                    elseif ($toUnit == 'reumer') {
                        $outputValue = $celsius * 4/5;
                        $outputUnit = "°Re";
                    }

                    $outputValue = number_format($outputValue, 2, ".", "");
                }
            }
        }
        ?>

        <form method="POST">
            <div class="form-section">

                <div class="input-group">
                    <label for="inputTemp">Masukkan Nilai</label>
                    <input type="number" name="inputTemp" step="0.01" placeholder="Contoh: 25" required>
                </div>

                <div class="input-group">
                    <label for="fromUnit">Dari</label>
                    <select name="fromUnit" required>
                        <option value="celsius">Celsius (°C)</option>
                        <option value="fahrenheit">Fahrenheit (°F)</option>
                        <option value="kelvin">Kelvin (K)</option>
                        <option value="reumer">Reumer (°Re)</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="toUnit">Ke</label>
                    <select name="toUnit" required>
                        <option value="fahrenheit">Fahrenheit (°F)</option>
                        <option value="celsius">Celsius (°C)</option>
                        <option value="kelvin">Kelvin (K)</option>
                        <option value="reumer">Reumer (°Re)</option>
                    </select>
                </div>

            </div>

            <div class="actions">
                <button type="submit" name="convert" class="btn-convert">Konversi Sekarang</button>
                <button type="submit" name="reset" class="btn-reset">Bersihkan</button>
            </div>
        </form>

        <div id="result" class="result-box show">
            <div class="result-label">Hasil Konversi</div>
            <div class="result-value"><?= $outputValue ?></div>
            <div class="result-unit"><?= $outputUnit ?></div>
        </div>

        <div class="footer-text">✓ Akurat • ✓ Cepat • ✓ Gratis</div>

    </div>

</div>

</body>
</html>
