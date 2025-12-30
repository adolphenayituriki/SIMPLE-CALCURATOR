<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Calculator</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#0d6efd">

</head>
<script>
if ("serviceWorker" in navigator) {
  navigator.serviceWorker.register("service-worker.js");
}
</script>
<body>

<!-- MAIN -->
<div class="container py-5 flex-grow-1">
    <div class="card shadow calculator-card">

        <div class="card-header">
            <i class="bi bi-calculator-fill me-2"></i>
            Simple Calculator
        </div>

        <div class="card-body">
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="row g-3">

                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-123 me-1"></i> First Number
                    </label>
                    <input type="number" name="num01" class="form-control" placeholder="Enter number" required>
                </div>

                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-sliders me-1"></i> Operator
                    </label>
                    <select name="operator" class="form-select" required>
                        <option value="add">➕ Add</option>
                        <option value="substract">➖ Subtract</option>
                        <option value="multiply">✖ Multiply</option>
                        <option value="divide">➗ Divide</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-123 me-1"></i> Second Number
                    </label>
                    <input type="number" name="num02" class="form-control" placeholder="Enter number" required>
                </div>

                <div class="col-12 d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-lightning-charge-fill me-1"></i>
                        Calculate
                    </button>
                </div>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                $num1 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $num2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $operator = htmlspecialchars($_POST["operator"]);

                echo "<p id='overview' class='mt-3 text-center'>
                        <i class='bi bi-eye'></i> $num1 $operator $num2
                      </p>";

                if (!is_numeric($num1) || !is_numeric($num2)) {
                    echo "<p class='calc-error text-center'>
                            <i class='bi bi-exclamation-triangle-fill'></i> Invalid numbers
                          </p>";
                } else {
                    switch ($operator) {
                        case "add": $value = $num1 + $num2; break;
                        case "substract": $value = $num1 - $num2; break;
                        case "multiply": $value = $num1 * $num2; break;
                        case "divide":
                            if ($num2 == 0) {
                                echo "<p class='calc-error text-center'>
                                        <i class='bi bi-x-circle-fill'></i> Cannot divide by zero
                                      </p>";
                                return;
                            }
                            $value = $num1 / $num2;
                            break;
                        default: return;
                    }

                    echo "<p class='calc-result text-center mt-2'>
                            <i class='bi bi-check-circle-fill'></i> Result = $value
                          </p>";
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-dark text-light text-center py-2 mt-auto">
    <div>
        <i class="bi bi-person-circle"></i> Powered By Nayituriki Adolphe | KIGALI Rwanda | 
        <i class="bi bi-envelope-fill"></i>
        <a href="mailto:nayiturikiadolphe@gmail.com" class="text-warning">
            www.nayituriki.com@gmail.com
        </a><br>
        <i class="bi bi-windows text-primary fs-3"></i>
        <a href="https://adolpheict.vercel.app/" class="text-success        ">
            <i class="fa-brands fa-windows"></i> Portifolio Website
        </a>
    </div>
</footer>

</body>
</html>
