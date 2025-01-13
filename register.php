<?php
// register.php (handle the form submission and display the registration form)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {      // Get the form data
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $passport_picture_url = $_POST['passport_picture_url']; //* Get the picture URL from the form *//

    //* Read the existing JSON data *//
    if (file_exists('data.json')) {
        $jsonData = file_get_contents('data.json');
        $data = json_decode($jsonData, true);
    } else {
        $data = [];
    }
    $existingId = null; //* Check if the entered data already exists*//
    foreach ($data as $id => $user) {
        if ($user['name'] === $name && $user['father_name'] === $father_name && $user['phone'] === $phone) {
            $existingId = $id;
            break;
        }
    }

    if ($existingId) {
        $_GET['exists'] = true;
        $_GET['id'] = $existingId;
        $_GET['name'] = $name;
        $_GET['father_name'] = $father_name;
        $_GET['phone'] = $phone;
        $_GET['email'] = $email;
        $_GET['address'] = $address;
        $_GET['passport_picture_url'] = $passport_picture_url;
    } else {
        if (!empty($passport_picture_url)) {
            $id = generateUniqueId($data);
            $data[$id] = [
                'name' => $name,
                'father_name' => $father_name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'passport_picture' => $passport_picture_url 
            ];

            file_put_contents('data.json', json_encode($data, JSON_PRETTY_PRINT));
            $_GET['success'] = true;
            $_GET['id'] = $id; 
        } else {
            echo "<h1>Error: Invalid picture URL.</h1>";
        }
    }
}
function generateUniqueId($data) {
    do {
        // Generate an 8-digit random number
        $id = 'DUM' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);
    } while (array_key_exists($id, $data)); // Check if the ID already exists in the data
    return $id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 16px;
            color: #555;
        }
        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
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

<div class="container">
    <?php if (isset($_GET['success']) && $_GET['success'] == true): ?>
        <h1>Registration Successful!</h1>
        <p>Your information has been saved.</p>
        <p>Generated ID: <?php echo htmlspecialchars($_GET['id']); ?></p>  <!-- Display the generated ID -->
        <p><a href="index.php">Go Back to Search</a></p>
    <?php elseif (isset($_GET['exists']) && $_GET['exists'] == true): ?>
        <h1>Information Already Exists</h1>
        <p>The following information already exists in the system:</p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($_GET['name']); ?></p>
        <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($_GET['father_name']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($_GET['phone']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_GET['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($_GET['address']); ?></p>
        <p><strong>Passport Picture URL:</strong> <?php echo htmlspecialchars($_GET['passport_picture_url']); ?></p>
        <p><strong>Existing ID:</strong> <?php echo htmlspecialchars($_GET['id']); ?></p>
        <p><a href="index.php">Go Back to Search</a></p>
    <?php else: ?>
        <h1>Register Information</h1>
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name:</label>
                <input type="text" id="father_name" name="father_name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="passport_picture_url">Picture URL:</label>
                <input type="text" id="passport_picture_url" name="passport_picture_url" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
        <div class="back-link">
            <a href="index.php">Go Back</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
