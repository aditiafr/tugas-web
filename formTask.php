<?php
include 'koneksi.php';

$query = "SELECT * FROM tb_karyawan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4 d-flex align-items-center justify-content-between">
        <a href="index.php">
            <button type="button" class="btn btn-success">
                <i class="bi bi-chevron-left"></i> Back
            </button>
        </a>

        <a href="form_employee.php">
            <button type="button" class="btn btn-primary">Add Employee</button>
        </a>
    </div>
    <h1 class="text-center mt-4 ">FORM TASK LIST</h1>
    <form action="add_task.php" method="POST">
        <div class="container mt-5 border border-1 rounded p-4">
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select class="form-select" aria-label="Default select example" id="employee_id" name="employee_id" required>
                    <option selected value="">Select Employee</option>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <option value="<?= $row['id_karyawan'] ?>"><?= $row['nama_karyawan'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Task Name" required>
            </div>

            <div class="mb-3">
                <label for="duedate" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="duedate" name="duedate" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description Task" required></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>