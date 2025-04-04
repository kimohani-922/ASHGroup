<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is loaded

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted and if there is an uploaded file
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        // Retrieve form data
        $jobPosition = $_POST['job'];

        // Set up PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                  // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                  // Set the SMTP server
            $mail->SMTPAuth = true;                            // Enable SMTP authentication
            $mail->Username = 'kareemhani922@gmail.com'; // Replace with your email
            $mail->Password = 'vzeqhpzkxnjzbdqt';           // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587;                                 // TCP port to connect to

            // Recipients
            $mail->setFrom('ASH@example.com', 'Applicant');
            $mail->addAddress('kareemhani201@gmail.com'); // Add the recipient

            // Attach CV file
            $cvPath = $_FILES['cv']['tmp_name'];
            $cvName = $_FILES['cv']['name'];
            $mail->addAttachment($cvPath, $cvName); // Attach the CV

            // Content
            $mail->isHTML(true);                               // Set email format to HTML
            $mail->Subject = 'Join ASH Hospitality Group';
            $mail->Body    = "
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            color: #333;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 20px;
                        }
                        h3 {
                            color: #ff4d17;
                        }
                        .content {
                            background-color: #fff;
                            border-radius: 8px;
                            padding: 20px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                    </style>

                </head>
                <body>
                    <div class='content'>
                        <h3>Job Position: $jobPosition</h3>
                    </div>
                </body>
                </html>
            ";

            // Send the email
            $mail->send();
            echo "
            <script>
            alert('Your application sent successfully');
            document.location.href='Careers.html';
            </script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No file uploaded or there was an error with the upload.";
    }
} else {
    echo "Invalid request.";
}
