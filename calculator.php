<?php
$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $expression = $_POST['display'] ?? "";
    if (!empty($expression)) { 
        if (preg_match('/^[0-9+\-\*\/().]+$/', $expression)) {
            try {
                $result = eval("return ($expression);");
            } catch (Exception $e) {
                $result = "Lỗi tính toán!";
            }
        } else {
            $result = "Lỗi cú pháp!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Máy Tính PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calculator {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        .display {
            background: #222;
            color: #fff;
            font-size: 2em;
            text-align: right;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            min-height: 40px;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        button {
            padding: 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 10px;
            background: #f1f2f3;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        button:active {
            box-shadow: inset 0 4px 6px rgba(44, 57, 48, 0.2);
        }
        .operator {
            background:rgb(162, 0, 255);
            color: white;
        }
        .equal {
            background:rgb(183, 0, 255);
            color: white;
        }
        #input_display {
            display: none;
        }
    </style>
</head>
<body>
    <form class="calculator" method="post" onsubmit="return calculate()">
        <div class="display" id="display"><?php echo htmlspecialchars($result); ?></div>
        <input type="text" name="display" id="input_display" value="" autocomplete="off">
        <div class="buttons">
            <button type="button" class="button" onclick="clearDisplay()">C</button>
            <button type="button" class="button" onclick="deleteDigit()">DEL</button>
            <button type="button" class="button" onclick="input('.')">.</button>
            <button type="button" class="button operator" onclick="input('/')">÷</button>
            <button type="button" class="button" onclick="input('7')">7</button>
            <button type="button" class="button" onclick="input('8')">8</button>
            <button type="button" class="button" onclick="input('9')">9</button>
            <button type="button" class="button operator" onclick="input('*')">×</button>
            <button type="button" class="button" onclick="input('4')">4</button>
            <button type="button" class="button" onclick="input('5')">5</button>
            <button type="button" class="button" onclick="input('6')">6</button>
            <button type="button" class="button operator" onclick="input('-')">−</button>
            <button type="button" class="button" onclick="input('1')">1</button>
            <button type="button" class="button" onclick="input('2')">2</button>
            <button type="button" class="button" onclick="input('3')">3</button>
            <button type="button" class="button operator" onclick="input('+')">+</button>
            <button type="button" class="button" onclick="input('0')">0</button>
            <button type="submit" class="button equal">=</button>
        </div>
    </form>

    <script>
        function input(value) {
            let display = document.getElementById("input_display");
            display.value += value;
            document.getElementById("display").innerText = display.value;
        }

        function clearDisplay() {
            document.getElementById("input_display").value = "";
            document.getElementById("display").innerText = "";
        }

        function deleteDigit() {
            let display = document.getElementById("input_display");
            display.value = display.value.slice(0, -1);
            document.getElementById("display").innerText = display.value;
        }

        function calculate() {
            let display = document.getElementById("input_display");
            if (display.value === "") return false;
            return true;
        }
    </script>
</body>
</html>
