<!DOCTYPE html>
<html>
<head>
	<title> Calculadora PHP 3 Daw </title>
</head>
<body>
	<h2>Calculadora PHP 3 Daw </h2>
	<form method="post" action="">
		<label>Número 1:</label>
		<input type="text" name="num1"><br><br>
		<label>Número 2:</label>
		<input type="text" name="num2"><br><br>
		<label>Operação:</label>
		<select name="operator">
			<option value="add">Adição</option>
			<option value="subtract">Subtração</option>
			<option value="multiply">Multiplicação</option>
			<option value="divide">Divisão</option>
			<option value="power">Potência</option>
			<option value="root">Radiciação</option>
		</select><br><br>
		<input type="submit" value="Calcular">
	</form>

	<?php
		if(isset($_POST['operator'])) {
			$num1 = $_POST['num1'];
			$num2 = $_POST['num2'];
			$operator = $_POST['operator'];

			if($operator == "add") {
				$result = $num1 + $num2;
			} elseif($operator == "subtract") {
				$result = $num1 - $num2;
			} elseif($operator == "multiply") {
				$result = $num1 * $num2;
			} elseif($operator == "divide") {
				if($num2 == 0) {
					$result = "Erro: divisão por zero";
				} else {
					$result = $num1 / $num2;
				}
			} elseif($operator == "power") {
				$result = pow($num1, $num2);
			} elseif($operator == "root") {
				$result = sqrt($num1);
			}

			echo "<p>O resultado é: $result</p>";
		}
	?>
</body>
</html>