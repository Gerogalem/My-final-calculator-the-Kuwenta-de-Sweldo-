<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $ticket_type = trim($_POST["ticket_type"] ?? "");

    if (empty($name) || empty($email) || empty($ticket_type)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email.";
    } else {
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;

        setcookie("ticket_type", $ticket_type, time() + 86400, "/");

        header("Location: booking.php?status=login_success");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Event Booking System</h1>
        <p>Welcome! Please enter your information.</p>
    </div>

    <div class="card">

        <h2>Login</h2>
        <p class="subtitle">Enter your details to continue.</p>

        <?php if (isset($error)): ?>
            <div class="error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <label>Name</label>
            <input type="text" name="name" placeholder="Enter your name">

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email">

            <label>Preferred Ticket Type</label>
            <select name="ticket_type">
                <option value="">Select ticket type</option>
                <option value="General Admission">General Admission</option>
                <option value="VIP">VIP</option>
            </select>

            <button type="submit">Continue</button>

        </form>

    </div>

    <p class="footer">Event Hub Sephine © 2026</p>

</div>

</body>
</html>