<?php
$heightInput = '';
$error = '';
$triangle = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heightInput = isset($_POST['height']) && is_string($_POST['height'])
        ? trim($_POST['height'])
        : '';
    $height = filter_var($heightInput, FILTER_VALIDATE_INT);

    if ($height === false || $height < 1 || $height > 20) {
        $error = 'Masukkan bilangan bulat dari 1 sampai 20.';
    } else {
        for ($row = 1; $row <= $height; $row++) {
            for ($space = 1; $space <= $height - $row; $space++) {
                $triangle .= ' ';
            }

            for ($star = 1; $star <= (2 * $row) - 1; $star++) {
                $triangle .= '*';
            }

            if ($row < $height) {
                $triangle .= "\n";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segitiga Bintang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem auto;
            max-width: 32rem;
            padding: 0 1rem;
        }

        label,
        input,
        button {
            font-size: 1rem;
        }

        input {
            margin: 0.5rem 0;
            padding: 0.4rem;
            width: 7rem;
        }

        button {
            cursor: pointer;
            padding: 0.4rem 0.8rem;
        }

        .error {
            color: #b00020;
        }

        pre {
            font-family: Consolas, "Courier New", monospace;
            line-height: 1.4;
            white-space: pre;
        }
    </style>
</head>
<body>
    <h1>Segitiga Bintang</h1>
    <form method="post">
        <label for="height">Tinggi segitiga (1–20):</label><br>
        <input
            type="number"
            id="height"
            name="height"
            min="1"
            max="20"
            step="1"
            value="<?= htmlspecialchars($heightInput, ENT_QUOTES, 'UTF-8') ?>"
            required
        >
        <button type="submit">Tampilkan</button>
    </form>

    <?php if ($error !== ''): ?>
        <p class="error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php elseif ($triangle !== ''): ?>
        <h2>Hasil</h2>
        <pre><?= htmlspecialchars($triangle, ENT_QUOTES, 'UTF-8') ?></pre>
    <?php endif; ?>
</body>
</html>
