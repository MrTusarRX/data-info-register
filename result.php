<?php
// result.php
if (isset($_GET['search'])) {
    $searchId = $_GET['search'];
    $jsonData = file_get_contents('data.json');
    $data = json_decode($jsonData, true);
    if (array_key_exists($searchId, $data)) {
        $person = $data[$searchId];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .info {
            margin-bottom: 15px;
        }
        .info strong {
            color: #555;
        }
        .info p {
            font-size: 16px;
            color: #444;
            line-height: 1.5;
        }
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        img {
            border-radius: 8px;
            width: 200px;
        }
        .error {
            color: red;
            text-align: center;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #007bff;
        }
        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
        echo "<div class='container'>";
        echo "<h1>Information Found</h1>";
        echo "<div class='info'><strong>Name:</strong> " . htmlspecialchars($person['name']) . "</div>";
        echo "<div class='info'><strong>Father's Name:</strong> " . htmlspecialchars($person['father_name']) . "</div>";
        echo "<div class='info'><strong>Phone:</strong> " . htmlspecialchars($person['phone']) . "</div>";
        echo "<div class='info'><strong>Email:</strong> " . htmlspecialchars($person['email']) . "</div>";
        echo "<div class='info'><strong>Address:</strong> " . htmlspecialchars($person['address']) . "</div>";
        echo "<div class='image-container'><strong>Passport Picture:</strong><br><img src='" . htmlspecialchars($person['passport_picture']) . "' alt='Passport Picture'></div>";
        echo "<div class='back-link'><a href='index.php'>Go Back</a></div>";
        echo "</div>";
    } else {
        echo "<div class='error'><h1>No data found for ID: " . htmlspecialchars($searchId) . "</h1></div>";
        echo "<div class='back-link'><a href='index.php'>Go Back</a></div>";
    }
} else {
    echo "<div class='error'><h1>Error: No search term provided!</h1></div>";
    echo "<div class='back-link'><a href='index.php'>Go Back</a></div>";
}
?>

</body>
</html>
