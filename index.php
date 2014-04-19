<?php
session_start();
?>

<form method=post>
<input type=text name='val'>
<input type='submit'>
</form>

<img src='draw.php'><br>

<?php
$usr_num = $_POST['val'];

// Проверка на цифру с двумя разрядами, затем диапазон от 2 до 10
if (!(preg_match('/^[0-9]{1,2}$/', $usr_num, $result) && ($usr_num > 1) && ($usr_num < 11)))
{
	$usr_num = 1;
	echo "Numbers from 2 to 10 only.";
}

$_SESSION['text'] = $usr_num;