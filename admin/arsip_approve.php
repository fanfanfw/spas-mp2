<?php
include '../koneksi.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $query = "UPDATE arsip SET status = 'Diterima' WHERE arsip_id = $id";
    } elseif ($action == 'reject') {
        $query = "UPDATE arsip SET status = 'Ditolak' WHERE arsip_id = $id";
    }

    if (mysqli_query($koneksi, $query)) {
        $message = "Status berhasil diperbarui.";
    } else {
        $message = "Error: " . mysqli_error($koneksi);
    }

    // Redirect back to the referring page with message
    header("Location: {$_SERVER['HTTP_REFERER']}?message=" . urlencode($message));
    exit();
} else {
    echo "Aksi tidak valid.";
}
?>
