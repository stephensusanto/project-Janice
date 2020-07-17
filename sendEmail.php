<?php 

	require 'library/vendor/autoload.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require_once('library/vendor/phpmailer/phpmailer/src/PHPMailer.php');
	require_once('library/vendor/phpmailer/phpmailer/src/Exception.php');

	function send($to, $subject, $isi){
		$mail = new PHPMailer(true); //Argument true in constructor enables exceptions

		//From email address and name
		$mail->From = "from@yourdomain.com";
		$mail->FromName = "Full Name";

		//To address and name
		$mail->addAddress("recepient1@example.com", "Recepient Name");
		$mail->addAddress("recepient1@example.com"); //Recipient name is optional

		//Address to which recipient will reply
		$mail->addReplyTo("reply@yourdomain.com", "Reply");

		//CC and BCC
		$mail->addCC("cc@example.com");
		$mail->addBCC("bcc@example.com");

		//Send HTML or Plain Text email
		$mail->isHTML(true);

		$mail->Subject = "Subject Text";
		$mail->Body = "<i>Mail body in HTML</i>";
		$mail->AltBody = "This is the plain text version of the email content";

		try {
			$mail->send();
			echo "Message has been sent successfully";
		} catch (Exception $e) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}

	function test($nama){
		echo $nama;
	}
?>