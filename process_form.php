<head>
<link href="https://fonts.googleapis.com/css?family=YourPreferredFont&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.1/css/bulma.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Righteous&display=swap');
        label{
            font-weight: 300;
            font-size: 27px;
            font-style: bold;
            font-family: 'Righteous', sans-serif;
        }
        
    </style>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hb = intval($_POST["hb"] <= 11.7);
    $pc = intval($_POST["pc"] >= 206000);
    $lc = intval($_POST["lc"] >= 15900);
    $nc = intval($_POST["nc"] >= 11470);
    $formula = 100 / (1 + exp(-(-4.51556408422852 + 3.06642171350431 * $hb + 2.30728252552722 * $pc + 0.643177245457609 * $lc + 0.713948327029514 * $nc)));
    $formula = round($formula, 2);
    $outcome = ($formula>= 70) ? "TO BIOPSY" : "NOT TO BIOPSY";

    echo "<label>$formula%<br>$outcome</label>";
}
?>
