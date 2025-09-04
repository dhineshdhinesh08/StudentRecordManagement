<?php
function addStudent($pdo) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = (int)$_POST['age'];

    // Basic validation
    if (empty($name) || empty($email) || $age <= 0) {
        return false;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO students (name, email, age) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $age]);
        return true;
    } catch (PDOException $e) {
        // Handle duplicate email error
        if ($e->getCode() == 23000) {
        // Email already exists
            return false;
        }
        throw $e;
    }
}

function deleteStudent($pdo) {
    if (isset($_POST['student_id'])) {
        $student_id = (int)$_POST['student_id'];
        
        try {
            $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
            $stmt->execute([$student_id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    return false;
}

function getAllStudents($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM students ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}
?>