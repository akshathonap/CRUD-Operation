<?php
include 'db.php';

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];



// // To check that User Name only contains alphabets, numbers, and underscores 
// if (!preg_match("/^[a-zA-Z0-9_]*$/", $name)) {
//       $errorMsg = "Only alphabets, numbers, and underscores are allowed for User Name";
// }else{
//       echo $name;
// }





    
    $sql = "INSERT INTO student (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        $success_message = "New record created successfully";
    } else {
        $success_message = "Error: " . mysqli_error($conn);
    }
}


// Fetch all student
$user_data = [];
$result = mysqli_query($conn, "SELECT * FROM student");
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user_data[] = $row;
    }  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #e4e4e4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .main-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
        }

        .form-container,
        .table-container {
            max-width: 100%;
            background-color: #1c1c1c;
            color: #ddd;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            height: 43.0rem;
            /* Fixed height */
            overflow-y: auto;
            /* Vertical scroll */
        }


        .table-scroll {
            width: 100%;
            overflow-x: auto;
        }


        h3 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #ccc;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #555;
            background-color: #2d2d2d;
            color: #fff;
            border-radius: 6px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #444;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #444;
        }

        th {
            background-color: #333;
            color: white;
            text-align: left;
            padding: 12px;
        }

        td {
            padding: 12px;
            color: #eee;
        }

        a i {
            font-size: 16px;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .form-container,
            .table-container {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="main-container">
        <div class="form-container">
            <h3>Create New User</h3>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>

                <label for="phone">Phone No:</label>
                <input type="text" name="phone" id="phone" required>

                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required>

                <input type="submit" value="Create">
            </form>

            <?php if (!empty($success_message)): ?>
                <div class="message"><?php echo htmlspecialchars(string: $success_message); ?></div>
            <?php endif; ?>
        </div>

        <?php if (!empty($user_data)): ?>
            <div class="table-container">
                <h3>Users List</h3>
                <div class="table-scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user_data as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" title="Edit">
                                            <i class="fas fa-edit" style="color:#ccc;"></i>
                                        </a>
                                        &nbsp;
                                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" title="Delete"
                                            onclick="return confirm('Are you sure you want to delete this user?');">
                                            <i class="fas fa-trash-alt" style="color:#aaa;"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>