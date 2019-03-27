<?php
	use PHPMailer\PHPMailer\PHPMailer;
	require 'SMTP.php';
	require 'PHPMailer.php';

	if (isset($_POST['submit']) &&
		isset($_POST['to']) &&
		isset($_POST['subject']) && 
		isset($_POST['message']))
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = 'ssl';
		$mail->Host = "smtp.mailtrap.io";
		$mail->Port = 465; 
		$mail->IsHTML(true);
		$mail->Username = "";
		$mail->Password = "";
		$mail->SetFrom("");
		$mail->Subject = $_POST['subject'];
		$mail->Body = $_POST['message'];
		$mail->AddAddress($_POST['to']); 
		
		$mail = true; // $mail->Send();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mail</title>
	<style>
		body{
			text-align: center;
		}
		.wrap{
			padding: 20px;
			display: inline-block;
		}
		.wrap textarea{
			widows: 100%;
			margin: 10px 0;
		}
	</style>
</head>
<body>
	<h3 class="wrap">
		<p> 
			<?php 
			 	if(isset($mail) && !$mail)
			 		echo "Error";
				else if(isset($mail) && $mail)
			 		echo "Message has been sent";
			 ?>	
		 </p>
		<form action="./index.php" method="post">
			Příjemce: <input name="to" type="mail"> <br>
			Předmět: <input name="subject" type="text"> <br>
			<textarea cols="32" rows="10" name="message"></textarea> <br>
			<input name="submit" type="submit" value="Poslat">
		</form>
	</h3>
</body>
</html>
