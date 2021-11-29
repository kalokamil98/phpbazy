<?php

	session_start();
	
	if ((isset($_SESSION['loged_in'])) && ($_SESSION['loged_in']==true))
	{
		header('Location: show.php');
		exit();
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
    <title>UWJP2 login</title>
</head>
<body>
    <header>
      <h1>Uczelnia im Jana Pawła 2 w Wadowicach</h1>
      <h2>Panel Administracyjny</h2>
    </header>



<form action="login.php" method='POST' class="login">
<h2>Logowanie</h2>
<label for="login">
Login :  <input type="text" name="login"> </label>
<label for="password">
Hasło :  <input type="password" name="password"> </label>
<?php 

if(isset($_SESSION['blad']))	echo $_SESSION['blad'];

?>
<br>
<button>Zaloguje się</button>


</form>







</body>
</html>