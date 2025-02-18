<?php
// Include database configuration
require_once 'config.php';

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must be at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check for errors before inserting into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement to insert data into the 'users' table
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        try {
            // Prepare the SQL statement
            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement
                $stmt->bindParam(1, $param_username);
                $stmt->bindParam(2, $param_email);
                $stmt->bindParam(3, $param_password);

                // Set parameters
                $param_username = $username;
                $param_email = $email;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Password hashing

                // Execute the statement
                if ($stmt->execute()) {
                    // Redirect to login page after successful registration
                    header("location: login.php");
                    exit();
                } else {
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt = null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Close connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #1e90ff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .help-block {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #1e90ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #4682b4;
        }
        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Register</h2>

        <!-- Display error message if any -->
        <?php if (!empty($username_err) || !empty($email_err) || !empty($password_err) || !empty($confirm_password_err)): ?>
            <div class="error-message">
                <?php 
                echo htmlspecialchars($username_err);
                echo htmlspecialchars($email_err);
                echo htmlspecialchars($password_err);
                echo htmlspecialchars($confirm_password_err);
                ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" placeholder="Password" required>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>

</body>
</html>
