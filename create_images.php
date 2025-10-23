<?php
// Script untuk membuat gambar placeholder produk

// Pastikan folder uploads/produk ada
$uploadDir = 'public/uploads/produk/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Data produk dengan warna
$products = [
    ['name' => 'Indomie\nGoreng', 'color' => [255, 107, 53], 'filename' => 'indomie.jpg'],
    ['name' => 'Aqua\n600ml', 'color' => [0, 102, 204], 'filename' => 'aqua.jpg'],
    ['name' => 'Beras\nPremium', 'color' => [255, 204, 0], 'filename' => 'beras.jpg'],
    ['name' => 'Minyak\nGoreng', 'color' => [255, 153, 0], 'filename' => 'minyak.jpg'],
    ['name' => 'Gula\nPasir', 'color' => [200, 200, 200], 'filename' => 'gula.jpg'],
    ['name' => 'Teh Botol\nSosro', 'color' => [0, 102, 0], 'filename' => 'teh.jpg'],
    ['name' => 'Susu Ultra\nMilk', 'color' => [51, 102, 255], 'filename' => 'susu.jpg'],
    ['name' => 'Kopi Kapal\nApi', 'color' => [102, 51, 0], 'filename' => 'kopi.jpg'],
];

foreach ($products as $product) {
    // Buat canvas 300x300
    $width = 300;
    $height = 300;
    $image = imagecreate($width, $height);

    // Set background color
    $bgColor = imagecolorallocate($image, $product['color'][0], $product['color'][1], $product['color'][2]);

    // Set text color (putih atau hitam tergantung background)
    $brightness = ($product['color'][0] * 0.299 + $product['color'][1] * 0.587 + $product['color'][2] * 0.114);
    if ($brightness > 128) {
        $textColor = imagecolorallocate($image, 0, 0, 0); // Hitam
    } else {
        $textColor = imagecolorallocate($image, 255, 255, 255); // Putih
    }

    // Tulis text di tengah
    $lines = explode('\n', $product['name']);
    $fontSize = 5;
    $lineHeight = 20;

    $totalHeight = count($lines) * $lineHeight;
    $startY = ($height - $totalHeight) / 2;

    foreach ($lines as $index => $line) {
        $textWidth = strlen($line) * imagefontwidth($fontSize);
        $x = ($width - $textWidth) / 2;
        $y = $startY + ($index * $lineHeight);

        imagestring($image, $fontSize, $x, $y, $line, $textColor);
    }

    // Simpan gambar
    $filepath = $uploadDir . $product['filename'];
    imagejpeg($image, $filepath, 80);
    imagedestroy($image);

    echo "Created: " . $product['filename'] . "\n";
}

echo "All product images created successfully!\n";
?>
