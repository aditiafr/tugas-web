<?php
include 'koneksi.php';

// Ambil status yang tersedia
$statusQuery = mysqli_query($conn, "SELECT * FROM tb_status");
$statusList = [];
while ($row = mysqli_fetch_assoc($statusQuery)) {
    $statusList[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task List </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task-column {
            min-width: 300px;
        }

        .task-card {
            margin-bottom: 15px;
            border-left: 5px solid #0d6efd;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .task-board {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
        }

        .status-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .task-title {
            font-weight: bold;
        }

        .duedate {
            font-size: 0.9em;
            color: gray;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="text-end mb-3">
            <a href="formTask.php">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Task
                </button>
            </a>
        </div>
        <h2 class="text-center mb-4">TASK LIST</h2>
        <div class="row">
            <?php foreach ($statusList as $status): ?>
                <div class="col-md-4 mb-4">
                    <div class="task-column">
                        <div class="status-title text-bg-primary p-2 rounded text-white">
                            <?= htmlspecialchars($status['status']) ?>
                        </div>

                        <?php
                        $id_status = $status['id_status'];
                        $taskQuery = mysqli_query($conn, "SELECT * FROM tb_task INNER JOIN tb_karyawan ON tb_task.id_karyawan = tb_karyawan.id_karyawan WHERE id_status = $id_status");

                        while ($task = mysqli_fetch_assoc($taskQuery)) :
                        ?>
                            <a href="detail_task.php?id=<?= $task['id_task'] ?>" class="text-decoration-none text-dark">
                                <div class="task-card rounded shadow-sm">
                                    <div class="task-title border-bottom mb-2"><?= htmlspecialchars($task['nama_karyawan']) ?></div>
                                    <div><?= htmlspecialchars($task['task_name']) ?></div>
                                    <div class="duedate text-end"><?= htmlspecialchars($task['duedate']) ?></div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>