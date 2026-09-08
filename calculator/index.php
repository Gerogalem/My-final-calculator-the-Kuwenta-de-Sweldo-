<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pink Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="calculator">

    <div class="top-decoration">♡ ✦ ♡</div>

    <h1>Kuwenta de Sweldo</h1>

<?php

$display = "";
$motivation = "✨ You can do it! ✨";

$messages = [
    "Ayaw sige'g calculator, basin ma-calculate imong utang!😂",
    "Dili tanan problema ma-solve ug calculator, labi na ang love life.",
    "Paningkamot ayaw sig paningtiil.😂",
    "💀 Result: Wala gihapon kay uyab. torpe man gud ka",
    "Padayon lang, bisan ang calculator kapoy na sa ka bugo nimo.🤣",
    "Math ra ni, ayaw paghilak. kay diko uyab nimo para hilakan😭",
    "Kung lisod ang math, mas lisod sabton imong attitude!!!",
    "Gowww kaya mo 'yan! Pero pangutana kaya bpa ka niya ipaglaban?",
    "Hindi lahat ng sagot nasa calculator... minsan nasa Google.",
    "nigga yarn",
    "Ayaw kabalaka, love lagi ka ato .",
    "Laban lang, bes! Kaya ra na!🌸 ",
    "Kung negative ang result, at least positive imong vibes.",
    "Smile pud ay sig kasuko",
    "Believe in yourself... ug sa calculator!💗"
];

if (isset($_POST["number"])) {
    $display = $_POST["display"] . $_POST["number"];
    $motivation = $messages[array_rand($messages)];
}

elseif (isset($_POST["operator"])) {
    $display = $_POST["display"] . $_POST["operator"];
    $motivation = $messages[array_rand($messages)];
}

elseif (isset($_POST["clear"])) {
    $display = "";
    $motivation = "🌸 Fresh start! Kaya ra na! 🌸";
}

elseif (isset($_POST["calculate"])) {

    $expression = $_POST["display"];

    if (preg_match('/^[0-9+\-*\/%.]+$/', $expression)) {

        try {

            $result = eval("return $expression;");

            $display = $result;
            $motivation = "🎉 Nice! Nakuha nimo ang answer! 🎉";

        } catch (Throwable $e) {

            $display = "Error";
            $motivation = "😂 Math ra ni, ayaw paghilak!";
        }

    } else {

        $display = "Error";
        $motivation = "🤣 Check sa imong equation, bes!";
    }
}

?>

<form method="POST">

    <input
        type="text"
        name="display"
        class="display"
        value="<?php echo htmlspecialchars($display); ?>"
        readonly
    >

    <div class="buttons">

        <button type="submit" name="clear" class="clear">C</button>

        <button type="submit" name="operator" value="%">%</button>

        <button type="submit" name="operator" value="/">÷</button>

        <button type="submit" name="operator" value="*">×</button>

        <button type="submit" name="number" value="7">7</button>
        <button type="submit" name="number" value="8">8</button>
        <button type="submit" name="number" value="9">9</button>

        <button type="submit" name="operator" value="-">−</button>

        <button type="submit" name="number" value="4">4</button>
        <button type="submit" name="number" value="5">5</button>
        <button type="submit" name="number" value="6">6</button>

        <button type="submit" name="operator" value="+">+</button>

        <button type="submit" name="number" value="1">1</button>
        <button type="submit" name="number" value="2">2</button>
        <button type="submit" name="number" value="3">3</button>

        <button type="submit" name="calculate" class="equals">=</button>

        <button type="submit" name="number" value="0" class="zero">0</button>

        <button type="submit" name="number" value=".">.</button>

    </div>

</form>

<div class="motivation">
    <?php echo htmlspecialchars($motivation); ?>
</div>

<div class="bottom-decoration">
    ♡ ✦ ♡
</div>

</div>

</body>
</html>