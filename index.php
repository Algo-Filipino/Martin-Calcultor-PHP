<?php
$history = array();
if(isset($_POST['submit'])){
    //get form data
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];

    //perform calculation based on operator selected
    switch($operator){
        case "+":
            $result = $num1 + $num2;
            break;
        case "-":
            $result = $num1 - $num2;
            break;
        case "*":
            $result = $num1 * $num2;
            break;
        case "/":
            $result = $num1 / $num2;
            break;
        case "%":
            $result = $num1 % $num2;
            break;
        default:
            $result = "";
    }
    // add calculation to history
    $calculation = $num1 . ' ' . $operator . ' ' . $num2 . ' = ' . $result;
    array_push($history, $calculation);


     // write calculation to history.txt file
     $file = fopen("history.txt", "a");
     fwrite($file, $calculation . "\n");
     fclose($file);
}
if(file_exists("history.txt")){
    $history_file = file("history.txt", FILE_IGNORE_NEW_LINES);
    $history = array_merge( $history_file);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calculator</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				<div class="calculator">
					<h2> PHP CALCULATOR</h2>
					<form method="post">
						<div class="form-group">
							<label for="num1">Number 1:</label>
							<input type="number" class="form-control" id="num1" name="num1" required>
						</div>
						<div class="form-group">
							<label for="operator">Operator:</label>
							<select class="form-control" id="operator" name="operator" required>
								<option value="+">+</option>
								<option value="-">-</option>
								<option value="*">*</option>
								<option value="/">/</option>
                                <option value="%">%</option>
							</select>
						</div>
						<div class="form-group">
							<label for="num2">Number 2:</label>
							<input type="number" class="form-control" id="num2" name="num2" required>
						</div>
						<?php if(isset($result)){ ?>
                            <div class="form-group">
                                <label for="result">Result:</label>
                                <input type="number" class="form-control" id="result" name="result" value="<?php echo $result; ?>" readonly>
                            </div>
                        <?php } ?>
						<button type="submit" class="btn btn-primary btn-block" name="submit">Calculate</button>
					</form>
                  <!-- History Section -->
					<div class="history">
						<h3>History:</h3>
						<ul>
							<?php 
							// Loop through history array and display each calculation
							foreach($history as $calculation){
								echo "<li>$calculation</li>";
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
    </body> 
</html>