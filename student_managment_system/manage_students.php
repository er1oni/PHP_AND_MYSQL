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
    $class_name = $_POST['class_name'];
    $parent_id = $_POST['parent_id'] ?? null;

    $stmt = $conn->prepare("INSERT INTO students (name, age, class_name, parent_id) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $age, $class_name, $parent_id])) {
        echo "<script>alert('Student added successfully!'); window.location='manage_students.php';</script>";
    } else {
        echo "<script>alert('Error adding student!');</script>";
    }
}

// Update Student Status (Pass/Fail)
if (isset($_GET['update_status']) && isset($_GET['status']) && isset($_GET['student_id'])) {
    $status = $_GET['status'];
    $student_id = $_GET['student_id'];

    if (in_array($status, ['Passed', 'Failed'])) {
        $stmt = $conn->prepare("UPDATE students SET status = ? WHERE id = ?");
        if ($stmt->execute([$status, $student_id])) {
            echo "<script>alert('Student status updated to $status!'); window.location='manage_students.php';</script>";
        } else {
            echo "<script>alert('Error updating status!');</script>";
        }
    }
}

// Update Student Details
if (isset($_POST['edit_student'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class_name = $_POST['class_name'];
    $parent_id = $_POST['parent_id'];

    $stmt = $conn->prepare("UPDATE students SET name = ?, age = ?, class_name = ?, parent_id = ? WHERE id = ?");
    if ($stmt->execute([$name, $age, $class_name, $parent_id, $student_id])) {
        echo "<script>alert('Student updated successfully!'); window.location='manage_students.php';</script>";
    } else {
        echo "<script>alert('Error updating student!');</script>";
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
        /* body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background: #3498db; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        input, select, button { padding: 10px; margin: 5px; border-radius: 5px; border: 1px solid #ddd; }
        button { cursor: pointer; background: #3498db; color: white; border: none; transition: 0.3s; }
        button:hover { background: #2980b9; }
        .delete-btn { color: red; background: none; cursor: pointer; border: none; font-weight: bold; }
        .status-btn { padding: 5px 10px; margin: 5px; border-radius: 5px; text-decoration: none; transition: 0.3s; color: white; }
        .status-btn.pass { background: green; }
        .status-btn.fail { background: red; }
        .status-btn:hover { opacity: 0.8; }
        .edit-btn { background: orange; padding: 5px 10px; text-decoration: none; border-radius: 5px; cursor: pointer; color: white; }
        #editForm { display: none; padding: 20px; margin-top: 20px; border: 1px solid #ddd; background: #fff; border-radius: 10px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); } */

        body {
    font-family: Arial, sans-serif;
    background: #f3f3f3; /* Soft light grey */
    text-align: center;
    padding: 20px;
}

.container {
    max-width: 900px;
    margin: auto;
    background: #ffffff; /* Clean white background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

th {
    background: #1e90ff; /* Blue for headers */
    color: white;
}

tr:nth-child(even) {
    background: #f9f9f9; /* Light grey for even rows */
}

input, select, button {
    padding: 10px;
    margin: 5px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

button {
    cursor: pointer;
    background: #1e90ff; /* Matching blue */
    color: white;
    border: none;
    transition: 0.3s;
}

button:hover {
    background: #4682b4; /* Slightly darker blue on hover */
}

.delete-btn {
    color: #e74c3c; /* Red for delete button */
    background: none;
    cursor: pointer;
    border: none;
    font-weight: bold;
}

.status-btn {
    padding: 5px 10px;
    margin: 5px;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
    color: white;
}

.status-btn.pass {
    background: #28a745; /* Green for pass */
}

.status-btn.fail {
    background: #e74c3c; /* Red for fail */
}

.status-btn:hover {
    opacity: 0.8;
}

.edit-btn {
    background: #f39c12; /* Orange for edit */
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
}

#editForm {
    display: none;
    padding: 20px;
    margin-top: 20px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
}

    </style>
    <script>
        function editStudent(id, name, age, className, parentId) {
            document.getElementById("edit_student_id").value = id;
            document.getElementById("edit_name").value = name;
            document.getElementById("edit_age").value = age;
            document.getElementById("edit_class_name").value = className;
            document.getElementById("edit_parent_id").value = parentId;
            document.getElementById("editForm").style.display = "block";
        }
    </script>
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

        <!-- Edit Student Form -->
        <form method="POST" id="editForm">
            <input type="hidden" name="student_id" id="edit_student_id">
            <input type="text" name="name" id="edit_name" placeholder="Student Name" required>
            <input type="number" name="age" id="edit_age" placeholder="Age" required>
            <input type="text" name="class_name" id="edit_class_name" placeholder="Class Name" required>
            <input type="number" name="parent_id" id="edit_parent_id" placeholder="Parent ID (Optional)">
            <button type="submit" name="edit_student">Update Student</button>
            <button type="button" onclick="document.getElementById('editForm').style.display='none'">Cancel</button>
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
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student['id']; ?></td>
                    <td><?= htmlspecialchars($student['name']); ?></td>
                    <td><?= $student['age']; ?></td>
                    <td><?= htmlspecialchars($student['class_name']); ?></td>
                    <td><?= $student['parent_id']; ?></td>
                    <td>
                        <?= htmlspecialchars($student['status']); ?>
                        <a href="?update_status=1&status=Passed&student_id=<?= $student['id']; ?>" class="status-btn pass">Pass</a>
                        <a href="?update_status=1&status=Failed&student_id=<?= $student['id']; ?>" class="status-btn fail">Fail</a>
                    </td>
                    <td>
                        <a href="#" onclick="editStudent(<?= $student['id']; ?>, '<?= htmlspecialchars($student['name']); ?>', <?= $student['age']; ?>, '<?= htmlspecialchars($student['class_name']); ?>', '<?= $student['parent_id']; ?>')" class="edit-btn">Edit</a>
                        <a href="?delete_id=<?= $student['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>
