<?php
include 'koneksi.php';

// Validasi id_task
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID task tidak ditemukan.";
    exit;
}

$id_task = intval($_GET['id']);

// Proses update status jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = intval($_POST['id_status']);

    $updateQuery = mysqli_query($conn, "UPDATE tb_task SET id_status = $new_status WHERE id_task = $id_task");

    if ($updateQuery) {
        header("Location: detail_task.php?id=$id_task");
        exit;
    } else {
        echo "Gagal mengupdate status.";
    }
}

// Ambil data task
$query = mysqli_query($conn, "
    SELECT tb_task.*, tb_karyawan.nama_karyawan, tb_status.status 
    FROM tb_task 
    INNER JOIN tb_karyawan ON tb_task.id_karyawan = tb_karyawan.id_karyawan
    INNER JOIN tb_status ON tb_task.id_status = tb_status.id_status
    WHERE id_task = $id_task
");
$task = mysqli_fetch_assoc($query);
if (!$task) {
    echo "Task tidak ditemukan.";
    exit;
}

// Ambil semua status
$statusResult = mysqli_query($conn, "SELECT * FROM tb_status");
$statusList = [];
while ($row = mysqli_fetch_assoc($statusResult)) {
    $statusList[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Detail Task</h2>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <?= htmlspecialchars($task['task_name']) ?>
            </div>

            <?php
            // Tentukan warna berdasarkan status
            $statusLabel = '';
            switch (strtolower($task['status'])) {
                case 'new':
                    $statusLabel = '<span class="badge bg-primary">New</span>';
                    break;
                case 'process':
                    $statusLabel = '<span class="badge bg-warning text-dark">Process</span>';
                    break;
                case 'finish':
                    $statusLabel = '<span class="badge bg-success">Finish</span>';
                    break;
                default:
                    $statusLabel = '<span class="badge bg-secondary">' . htmlspecialchars($task['status']) . '</span>';
                    break;
            }
            ?>

            <div class="card-body">
                <p><strong>Nama Karyawan:</strong> <?= htmlspecialchars($task['nama_karyawan']) ?></p>
                <p><strong>Status Saat Ini:</strong> <?= $statusLabel ?></p>
                <p><strong>Due Date:</strong> <?= htmlspecialchars($task['duedate']) ?></p>
                <p><strong>Deskripsi:</strong><br><?= nl2br(htmlspecialchars($task['description'])) ?></p>

                <hr>

                <form method="POST">
                    <div class="mb-3">
                        <label for="id_status" class="form-label">Update Status</label>
                        <select name="id_status" id="id_status" class="form-select" required>
                            <?php foreach ($statusList as $status): ?>
                                <option value="<?= $status['id_status'] ?>" <?= ($status['id_status'] == $task['id_status']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($status['status']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update Status</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>