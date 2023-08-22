<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "contactform";

    $db = mysqli_connect($server, $username, $password, $database);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $insert = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = array();

        // Validate name
    if (empty($_POST["name"])) {
        $errors["name"] = "Name is required";
    } else {
        $name = $_POST["name"];
    }

    // Validate email
    if (empty($_POST["email"])) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    } else {
        $email = $_POST["email"];
    }

    // Validate phone
    if (empty($_POST["phone"])) {
        $errors["phone"] = "Phone number is required";
    } elseif (!preg_match("/^\d{10}$/", $_POST["phone"]) || !preg_match("/^[6-9]{1}\d{9}$/", $_POST["phone"])) {
        $errors["phone"] = "Invalid phone number";
    } else {
        $phone = $_POST["phone"];
    }
    // Get the user's IP address
    $ip_address = $_SERVER["REMOTE_ADDR"];
    // Validate message
    if (empty($_POST["msg"])) {
        $errors["msg"] = "Message is required";
    } else {
        $msg = $_POST["msg"];
    }

        if (empty($errors)) {
            // Insert data into the database
            $sql = "INSERT INTO contact_form (`name`, `email`, `phone`, `msg`, `ip_address`, `dt`) VALUES ('$name', '$email', '$phone', '$msg', '$ip_address', current_timestamp());";

            if ($db->query($sql) == true) {
                // Send email notification to site owner
                     
            // Send email to user
            require 'PHPMailer-master/src/PHPMailer.php';
            require 'PHPMailer-master/src/SMTP.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer();

            // Set up SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'avirsingh52@gmail.com';  // Your SMTP username
            $mail->Password = 'pzupooimyyfbpzkkb';    // Your SMTP password
            $mail->SMTPSecure = 'tls';            // Encryption (tls or ssl)
            $mail->Port = 587;                    // SMTP port

            // Sender information
            $mail->setFrom('avirsingh52@gmail.com', 'Himanshu');

            // Recipient
            $mail->addAddress($email, $name);     // User's email and name

            // Email content
            $mail->Subject = 'Thank you for contacting us!';
            $mail->Body = "Dear $name,\n\nThank you for reaching out to us. We have received your message and will be in contact soon.";

            // Send the email
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
                echo "<script>alert('We have successfully received your message'); window.location.href='index.php';</script>";
                $insert = true;
            } else {
                echo "ERROR: $sql <br> $db->error";
            }
            // close the database connection
            $db->close();
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Contact Us Form</title>
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
    <div class="container">
        <div class="text">Contact us Form</div>
        <form action="" method="post">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" required name="name" value="<?php echo isset($name) ? $name : ''; ?>">
                    <?php echo isset($errors["name"]) ? "<span class='error'>" . $errors["name"] . "</span>" : ''; ?>
                    <div class="underline"></div>
                    <label for="">Name</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" required name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                    <?php echo isset($errors["email"]) ? "<span class='error'>" . $errors["email"] . "</span>" : ''; ?>
                    <div class="underline"></div>
                    <label for="">Email Address</label>
                </div>
                <div class="input-data">
                    <input type="number" required name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                    <?php echo isset($errors["phone"]) ? "<span class='error'>" . $errors["phone"] . "</span>" : ''; ?>
                    <div class="underline"></div>
                    <label for="">Phone number</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data textarea">
                    <textarea rows="8" cols="80" required name="msg"><?php echo isset($msg) ? $msg : ''; ?></textarea>
                    <?php echo isset($errors["msg"]) ? "<span class='error'>" . $errors["msg"] . "</span>" : ''; ?>
                    <br />
                    <div class="underline"></div>
                    <label for="">Write your message</label>
                    <br />
                    <div class="form-row submit-btn">
                        <div class="input-data">
                            <div class="inner"></div>
                            <input type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
     </div>
   </body>
</html>