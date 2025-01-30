<?php
// Sample movies array (replace this with database queries or API calls)
$movies = [
    ["title" => "Inception", "genre" => "Sci-Fi", "year" => 2010],
    ["title" => "The Dark Knight", "genre" => "Action", "year" => 2008],
    ["title" => "Interstellar", "genre" => "Sci-Fi", "year" => 2014],
];

// Handle form submission to add a new movie
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $newMovie = [
            "title" => $_POST['title'],
            "genre" => $_POST['genre'],
            "year" => $_POST['year'],
        ];
        $movies[] = $newMovie;
    } elseif ($_POST['action'] === 'delete') {
        $index = $_POST['index'];
        unset($movies[$index]);
        $movies = array_values($movies);
    } elseif ($_POST['action'] === 'edit') {
        $index = $_POST['index'];
        $movies[$index] = [
            "title" => $_POST['title'],
            "genre" => $_POST['genre'],
            "year" => $_POST['year'],
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Dashboard</title>
    <style>

         td{
            height: 50px;
         }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        form input, form select, form button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        form button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .actions button {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .edit {
            background-color: #FFC107;
            color: #fff;
        }
        .edit:hover {
            background-color: #e0a800;
        }
        .delete {
            background-color: #DC3545;
            color: #fff;
        }
        .delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Movie Dashboard</h1>

    <h2>Movie List</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $index => $movie): ?>
                <tr>
                    <td><?= htmlspecialchars($movie['title']) ?></td>
                    <td><?= htmlspecialchars($movie['genre']) ?></td>
                    <td><?= htmlspecialchars($movie['year']) ?></td>
                    <td class="actions">
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="delete">Delete</button>
                        </form>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <input type="hidden" name="action" value="edit">
                            <input type="text" name="title" placeholder="Title" value="<?= htmlspecialchars($movie['title']) ?>" required>
                            <input type="text" name="genre" placeholder="Genre" value="<?= htmlspecialchars($movie['genre']) ?>" required>
                            <input type="number" name="year" placeholder="Year" value="<?= htmlspecialchars($movie['year']) ?>" required>
                            <button type="submit" class="edit">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Add a New Movie</h2>
    <form method="POST">
        <input type="hidden" name="action" value="add">
        <input type="text" name="title" placeholder="Movie Title" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="number" name="year" placeholder="Release Year" required>
        <button type="submit">Add Movie</button>
    </form>
</body>
</html>
