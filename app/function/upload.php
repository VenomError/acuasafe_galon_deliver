<?php

/**
 * Fungsi untuk mengunggah file dengan nama unik.
 *
 * @param string $inputName Nama input file pada formulir.
 * @param string $targetDir Direktori tujuan penyimpanan file.
 * @param array $allowedTypes Jenis file yang diizinkan.
 * @param int $maxFileSize Ukuran maksimum file (dalam byte).
 * @return string Pesan hasil unggahan.
 */
function uploadFile($inputName, $dir = '', $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'], $maxFileSize = 2 * 1024 * 1024)
{
    $targetDir = __DIR__ . '/../../uploads/';
    if (!empty($dir)) {
        $targetDir = $targetDir . $dir . '/';
    }
    // Periksa apakah file diunggah
    if (!isset($_FILES[$inputName])) {
        throw new Exception("Tidak ada file yang diunggah.");
    }

    // Ambil informasi file
    $originalName = $_FILES[$inputName]["name"];
    $fileSize = $_FILES[$inputName]["size"];
    $fileType = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    // Hasilkan nama file unik
    $uniqueName = uniqid('file_', true) . '.' . $fileType;
    $targetFile = $targetDir . $uniqueName;

    // Cek apakah direktori tujuan ada, jika tidak buat direktori
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Validasi jenis file
    if (!in_array($fileType, $allowedTypes)) {
        throw new Exception("Maaf, hanya file dengan tipe JPG, JPEG, PNG, GIF, dan PDF yang diperbolehkan.");
    }

    // Validasi ukuran file
    if ($fileSize > $maxFileSize) {
        throw new Exception("Maaf, ukuran file terlalu besar. Maksimum 2MB.");
    }

    // Coba mengunggah file
    if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetFile)) {
        return $uniqueName;
    } else {
        throw new Exception("Maaf, terjadi kesalahan saat mengunggah file.");
    }
}
