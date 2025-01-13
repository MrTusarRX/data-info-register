<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Result</title>
</head>
  <style>
    .back-link a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
<body>
    <h1>Search Information</h1>
    <form action="result.php" method="GET">
        <label for="search">Enter ID (e.g., R765):</label>
        <input type="text" id="search" name="search" required>
        <input type="submit" value="Search">
    </form>
  <br>
  <br>
  <div class="back-link"><a href="./register.php">click here if you had not regitered</a></div>
</body>
</html>
