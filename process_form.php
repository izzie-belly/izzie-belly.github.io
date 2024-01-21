<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include the PHPMailer autoload file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    if ($email && $subject && $message) {
        $to = "izziebellly@gmail.com";

        $mail = new PHPMailer(true);

        try {
            // Uncomment the following line if your server requires SMTP
            // $mail->isSMTP();

            // Uncomment and configure the following lines for SMTP settings
            // $mail->Host = 'your_smtp_server';
            // $mail->SMTPAuth = true;
            // $mail->Username = 'your_smtp_username';
            // $mail->Password = 'your_smtp_password';
            // $mail->SMTPSecure = 'tls'; // Change to 'ssl' if needed
            // $mail->Port = 587; // Adjust the port if needed

            $mail->setFrom($email);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            echo "Email sent successfully!";
        } catch (Exception $e) {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Invalid input. Please check your form data.";
    }
} else {
    echo "Invalid request method.";
}
?>