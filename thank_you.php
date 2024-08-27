<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            max-width: 600px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            color: #495057;
            margin-bottom: 30px;
        }
        a {
            font-size: 1rem;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .gif-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Order!</h1>
        <div class="gif-container">
            <img src="path_to_your_gif/thank_you_animation.gif" alt="Thank You Animation" style="width: 150px; height: auto;">
        </div>
        <p>Your order has been placed successfully. We will contact you shortly.</p>
        <a href="index.php">Return to Home</a>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
