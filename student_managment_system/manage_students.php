<?php
session_start();
include_once("config.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Add Student
if (isset($_POST['add_student'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class_name = $_POST['class_name']; // class_name is now retrieved
    $parent_id = isset($_POST['parent_id']) ? $_POST['parent_id'] : null; // Check if parent_id is set

    // If parent_id is not set, exclude it from the query
    if ($parent_id) {
        $stmt = $conn->prepare("INSERT INTO students (name, age, class_name, parent_id) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $age, $class_name, $parent_id])) {
            echo "<script>alert('Student added successfully!'); window.location='manage_students.php';</script>";
        } else {
            echo "<script>alert('Error adding student!');</script>";
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, age, class_name) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $age, $class_name])) {
            echo "<script>alert('Student added successfully!'); window.location='manage_students.php';</script>";
        } else {
            echo "<script>alert('Error adding student!');</script>";
        }
    }
}

// Update Student Status (Pass/Fail)
if (isset($_GET['update_status']) && isset($_GET['status']) && isset($_GET['student_id'])) {
    $status = $_GET['status']; // "Passed" or "Failed"
    $student_id = $_GET['student_id'];

    // Validate status
    if (in_array($status, ['Passed', 'Failed'])) {
        $stmt = $conn->prepare("UPDATE students SET status = ? WHERE id = ?");
        if ($stmt->execute([$status, $student_id])) {
            echo "<script>alert('Student status updated to $status!'); window.location='manage_students.php';</script>";
        } else {
            echo "<script>alert('Error updating status!');</script>";
        }
    }
}

// Delete Student
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    
    if ($stmt->execute([$delete_id])) {
        echo "<script>alert('Student deleted successfully!'); window.location='manage_students.php';</script>";
    } else {
        echo "<script>alert('Error deleting student!');</script>";
    }
}

// Fetch Students
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM students WHERE name LIKE ? ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute(["%$search%"]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 20px; }
        .container { max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        form { margin-bottom: 20px; }
        input, select { padding: 8px; margin: 5px; }
        button { padding: 8px 15px; cursor: pointer; }
        .delete-btn { color: red; border: none; background: none; cursor: pointer; }
        .status-btn { padding: 5px 10px; margin: 5px; cursor: pointer; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Manage Students</h2>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search students..." value="<?= htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Add Student Form -->
        <form method="POST">
            <input type="text" name="name" placeholder="Student Name" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="class_name" placeholder="Class Name" required>
            <input type="number" name="parent_id" placeholder="Parent ID (Optional)">
            <button type="submit" name="add_student">Add Student</button>
        </form>

        <!-- Student List Table -->
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Class</th>
                <th>Parent ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if (count($students) > 0): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student['id']; ?></td>
                        <td><?= htmlspecialchars($student['name']); ?></td>
                        <td><?= $student['age']; ?></td>
                        <td><?= htmlspecialchars($student['class_name']); ?></td>
                        <td><?= $student['parent_id']; ?></td>
                        <td>
                            <?= htmlspecialchars($student['status']); ?>
                            <?php if ($student['status'] != 'Passed'): ?>
                                <a href="?update_status=1&status=Passed&student_id=<?= $student['id']; ?>" class="status-btn" style="background-color: green; color: white;">Pass</a>
                            <?php endif; ?>
                            <?php if ($student['status'] != 'Failed'): ?>
                                <a href="?update_status=1&status=Failed&student_id=<?= $student['id']; ?>" class="status-btn" style="background-color: red; color: white;">Fail</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="?delete_id=<?= $student['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7">No students found.</td></tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
