<?php
session_start();

if (!isset($_SESSION["name"])) {
    header("Location: index.php");
    exit();
}

$events = [
    [
        "Event Name" => "HCDC Foundation Night",
        "Available Seats" => 50,
        "Ticket Price" => 500
    ],
    [
        "Event Name" => "Music and Arts Festival",
        "Available Seats" => 30,
        "Ticket Price" => 750
    ],
    [
        "Event Name" => "Technology Summit 2026",
        "Available Seats" => 40,
        "Ticket Price" => 1000
    ]
];

$ticket_type = $_COOKIE["ticket_type"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Event</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Event Booking System</h1>
        <p>Book your favorite event easily.</p>
    </div>

    <div class="welcome">
        <h2>Hello, <?php echo htmlspecialchars($_SESSION["name"]); ?>! 👋</h2>
        <p>Choose an event and enter the number of tickets you want.</p>
    </div>

    <?php if (isset($_GET["status"]) && $_GET["status"] == "success"): ?>

        <div class="success">
            Booking successful!
        </div>

    <?php elseif (isset($_GET["status"]) && $_GET["status"] == "login_success"): ?>

        <div class="success">
            Login successful! You can now book an event.
        </div>

    <?php endif; ?>

    <?php if (isset($_GET["error"])): ?>

        <div class="error">

            <?php
            if ($_GET["error"] == "empty_fields") {
                echo "Please fill in all required fields.";
            } elseif ($_GET["error"] == "invalid_quantity") {
                echo "Please enter a valid ticket quantity.";
            } elseif ($_GET["error"] == "not_enough_seats") {
                echo "Not enough available seats.";
            } elseif ($_GET["error"] == "invalid_event") {
                echo "Please select a valid event.";
            }
            ?>

        </div>

    <?php endif; ?>

    <div class="card">

        <h2>Available Events</h2>

        <div class="events">

            <?php foreach ($events as $event): ?>

                <div class="event">

                    <h3>
                        <?php echo $event["Event Name"]; ?>
                    </h3>

                    <p>
                        <strong>Available Seats:</strong>
                        <?php echo $event["Available Seats"]; ?>
                    </p>

                    <p>
                        <strong>Ticket Price:</strong>
                        ₱<?php echo number_format($event["Ticket Price"], 2); ?>
                    </p>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

    <div class="card">

        <h2>Book Your Ticket</h2>

        <form action="process.php" method="POST">

            <label>Choose Event</label>

            <select name="event">

                <option value="">Select an event</option>

                <?php foreach ($events as $event): ?>

                    <option value="<?php echo $event["Event Name"]; ?>">
                        <?php echo $event["Event Name"]; ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <label>Ticket Quantity</label>

            <input
                type="number"
                name="quantity"
                min="1"
                placeholder="Enter quantity"
            >

            <label>Promo Code (Optional)</label>

            <input
                type="text"
                name="promo"
                placeholder="Example: HCDC2026"
            >

            <button type="submit">Book Now</button>

        </form>

    </div>

    <?php if (isset($_SESSION["booking"])): ?>

        <div class="card result">

            <h2>Booking Details</h2>

            <p>
                <strong>Event:</strong>
                <?php echo $_SESSION["booking"]["event"]; ?>
            </p>

            <p>
                <strong>Tickets:</strong>
                <?php echo $_SESSION["booking"]["quantity"]; ?>
            </p>

            <p>
                <strong>Ticket Price:</strong>
                ₱<?php echo number_format($_SESSION["booking"]["price"], 2); ?>
            </p>

            <p>
                <strong>Discount:</strong>
                <?php echo $_SESSION["booking"]["discount"]; ?>%
            </p>

            <div class="total">
                Total: ₱<?php echo number_format($_SESSION["booking"]["total"], 2); ?>
            </div>

        </div>

    <?php endif; ?>

    <div class="logout">
        <a href="index.php">Back to Login</a>
    </div>

    <p class="footer">Event Booking System © 2026</p>

</div>

</body>
</html>