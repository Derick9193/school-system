<?php
session_start();
session_unset(); 
session_destroy(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Agriculture Scheduling</title>
<style>

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

.container {
    background-color:rgb(18, 31, 42);
    padding: 30px 50px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    text-align: center;
}

h1 {
    margin-bottom: 20px;
    font-size: 2em;
    color:rgb(0, 68, 255); 
}



.button {
    background-color:rgb(0, 64, 255); 
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 1em;
    text-decoration: none;
    display: inline-block;
    margin: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.button:hover {
    background-color:rgb(3, 51, 210); 
    transform: translateY(-2px);
}

.button:active {
    background-color:rgb(0, 72, 255); 
    transform: translateY(0);
}
</style>
</head>
<body>
    <div class="container">
        <h1>You have been logged out</h1>
        <a href="login.php" class="button">Log In Again</a>
    </div>

    <script>

document.getElementById("homeButton").addEventListener("click", function() {
    alert("Navigating to Home Page");
});
</script>
</body>
</html>
