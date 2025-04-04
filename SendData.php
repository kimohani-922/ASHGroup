 <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

    $mail = new PHPMailer(true);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $nationality = $_POST['nationality'];
        $passport = $_POST['passport'];
        $service = $_POST['service'];
        $booking_from = $_POST['booking_from'];
        $booking_to = $_POST['booking_to'];
        $destination = $_POST['destination'];

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Change to your mail server
            $mail->SMTPAuth = true;
            $mail->Username = 'kareemhani922@gmail.com'; // Replace with your email
            $mail->Password = 'vzeqhpzkxnjzbdqt'; // Replace with your email password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email Content
            $mail->setFrom($email, $name); // Sender email
            $mail->addAddress('kareemhani201@gmail.com'); // Recipient email
            $mail->isHTML(true);
            $mail->Subject = 'New Reservation Request';
            $mail->Body = "
                <html>
                <head>
                    <title>New Reservation</title>
                </head>
                <body>
                    <h3>Reservation Details:</h3>
                    <p><strong>Name:</strong> $name</p>
                    <p><strong>Nationality:</strong> $nationality</p>
                    <p><strong>Passport Number:</strong> $passport</p>
                    <p><strong>Service Required:</strong> $service</p>
                    <p><strong>Booking Date:</strong> From $booking_from to $booking_to</p>
                    <p><strong>Destination To:</strong> $destination</p>
                </body>
                </html>
            ";

            // Send Email
            $mail->send();
            echo "
            <script>
            alert('sent successfully');
            document.location.href='Reservation.html';
            </script>";
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Message could not be sent. Mailer Error: " . $mail->ErrorInfo . "</div>";
        }
    }
    ?>