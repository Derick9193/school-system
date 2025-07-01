<?php
session_start();

$error_message = "";  // Variable to store error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "school_fees_db"; // Your new database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM logs WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Store the user's role in the session

            // Redirect to the appropriate page based on role
            if ($user['role'] == 'admin') {
                header("Location: Admin.html");
            } else {
                header("Location: client.php");
            }
            exit;
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Agricschedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ececec,rgb(69, 112, 198));
        }

        header {
            padding: 6px;
            position: relative;
            background-color:rgb(2, 14, 36);
            height: 2cm;
        }

        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .logo img {
            width: 150px;
            height: 70px;
        }

        .main-nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: right;
        }

        .main-nav ul li {
            margin: 0 10px;
        }

        .main-nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            display: block;
            padding: space-between;
            margin-top: 45px;
            border-radius: 5px;
        }

        .main-nav ul li a:hover {
      color: rgb(175, 191, 207);
        }

        .container {
            padding: 20px;
            max-width: 400px;
            margin-top: 180px;
            color: #fff;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 100px;
            background: rgba(0, 0, 0, 0.72);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color:#fff;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background:rgb(0, 49, 246);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background:rgb(0, 24, 204);
        }

        a{
            color:rgb(255, 255, 255);
        }

        .toggle-password {
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            background-color: #ffdddd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Log In</h2>

        <!-- Display error message if exists -->
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form id="loginForm" method="POST" action="login.php">
            <input type="email" name="email" id="Email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <div class="toggle-password">
                <input type="checkbox" id="togglePassword"> Show Password
            </div>

            <button type="submit">Log In</button>
        </form>
        <p style="text-align:center;"><button <a href type="submit">Home</button>
    </div>



    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); 

            const email = document.getElementById("Email").value;
            const password = document.querySelector('input[name="password"]').value;

            if (!email || !password) {
                alert("Please fill out all required fields.");
                return;
            }

            this.submit(); 
        });

        document.getElementById("togglePassword").addEventListener("change", function() {
            const passwordField = document.getElementById("password");
            if (this.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        });
    </script>
</body>
</html>
