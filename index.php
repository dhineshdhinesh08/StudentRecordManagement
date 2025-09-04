<?php
require_once 'config.php';
require_once 'functions.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_student'])) {
        addStudent($pdo);
    } elseif (isset($_POST['delete_student'])) {
        deleteStudent($pdo);
    }
}

// Get all students
$students = getAllStudents($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record Manager</title>
   
    <!--Bootstrap link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body>
     <!--Stylesheet link-->
    <link rel="stylesheet" href="style.css">

    <div class="m-5 px-5 container text-align-center container-fluid bg-secondary-subtle">
       
        <h1 class="display-4 text-success py-3">Student Record Manager</h1>

        <!-- Add Student Form -->
        <form method="POST" action="">
            <h3 class="text-center">Add New Student</h3>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="1" required>
            </div>
            <button type="submit" name="add_student">Add Student</button>
        </form>

        <!-- Students Table -->
        <?php if (!empty($students)): ?>
            <h3>Student List</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['id']); ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['age']); ?></td>
                            <td>
                                <form method="POST" action="" style="display: inline;">
                                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                                    <button class="bg-danger"type="submit" name="delete_student" class="delete-btn" 
                                            onclick="return confirm('Are you sure you want to delete this student?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-primary" style="text-align: center; color: #666; margin-top: 30px;">
                Add the student details above!!
            </p>
        <?php endif; ?>
    </div>
</body>
</html>