<?php
include 'koneksi.php';

$employee_id = $_POST['employee_id'];
$task_name   = $_POST['task_name'];
$duedate     = $_POST['duedate'];
$description = $_POST['description'];
$id_status   = 1;

// Validasi input
if (empty($employee_id) || empty($task_name) || empty($duedate) || empty($description)) {
    echo "Semua kolom harus diisi.";
    exit;
}

$sql = "INSERT INTO tb_task (id_karyawan, id_status, task_name, duedate, description) 
        VALUES ('$employee_id', '$id_status', '$task_name', '$duedate', '$description')";

if (mysqli_query($conn, $sql)) {
    // Redirect ke index.php jika berhasil
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menambahkan task: " . mysqli_error($conn);
}

mysqli_close($conn);
