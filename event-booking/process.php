<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: booking.php");
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

function calculateTotal($price, $quantity, $discountCode)
{
    $total = $price * $quantity;

    if ($discountCode == "HCDC2026") {
        $total = $total * 0.90;
    }

    return $total;
}

$event_name = trim($_POST["event"] ?? "");
$quantity = trim($_POST["quantity"] ?? "");
$discountCode = trim($_POST["promo"] ?? "");

if (empty($event_name) || empty($quantity)) {
    header("Location: booking.php?error=empty_fields");
    exit();
}

$selected_event = null;

foreach ($events as $event) {

    if ($event["Event Name"] == $event_name) {
        $selected_event = $event;
        break;
    }

}

if ($selected_event === null) {
    header("Location: booking.php?error=invalid_event");
    exit();
}

if (!is_numeric($quantity) || $quantity <= 0) {
    header("Location: booking.php?error=invalid_quantity");
    exit();
}

$quantity = (int)$quantity;

if ($quantity > $selected_event["Available Seats"]) {
    header("Location: booking.php?error=not_enough_seats");
    exit();
}

$total = calculateTotal(
    $selected_event["Ticket Price"],
    $quantity,
    $discountCode
);

$discount = 0;

if ($discountCode == "HCDC2026") {
    $discount = 10;
}

$_SESSION["booking"] = [
    "event" => $selected_event["Event Name"],
    "quantity" => $quantity,
    "price" => $selected_event["Ticket Price"],
    "discount" => $discount,
    "total" => $total
];

header("Location: booking.php?status=success");
exit();
?>