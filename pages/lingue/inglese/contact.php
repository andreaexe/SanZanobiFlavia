<?php
session_start(); // Start the session

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

$report = null; // Initialize $report as empty

// Execute code only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $guests = $_POST["guests"] ?? '';
    $dates = $_POST["dates"] ?? '';
    $message = $_POST["message"] ?? '';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Gmail SMTP server configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'andrea.sestini2005@gmail.com'; // Change with your Gmail address
        $mail->Password = 'pnss zswv buea xvdf'; // Use your Google app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('noreply@yourdomain.com', 'San Zanobi Holiday Home');
        $mail->addAddress('andrea.sestini2005@gmail.com'); // Destination email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Contact request for San Zanobi Holiday Home from $name";
        $mail->Body = "
            <h2>New contact request</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Number of guests:</strong> $guests</p>
            <p><strong>Stay dates:</strong> $dates</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // Send the email
        $mail->send();
        $_SESSION['report'] = "Message sent successfully. We will get back to you soon!";
    } catch (Exception $e) {
        $_SESSION['report'] = "Error sending the message. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_SESSION['report'])) {
  $report = $_SESSION['report'];
  unset($_SESSION['report']);
} else {
  $report = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - San Zanobi Holiday Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../contatti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    
  <header class="header1">
      <a href="./inglese.html" class="logo">SAN ZANOBI HOLIDAY HOME</a>
      <input class="menu-btn" id="menu-btn" type="checkbox">
      <label for="menu-btn" class="menu-icon" onclick="change()">
          <span class="nav-icon"></span>
      </label>
      <ul class="menu">
        <li><a href="./gallery.html" class="nav-link">Gallery</a></li>
        <li><a href="./services.html" class="nav-link">Services</a></li>
        <li><a href="./location.html" class="nav-link">Location</a></li>
        <li><a href="./contact.php" class="nav-link">Contact</a></li>
        <li><a href="./aboutUs.html" class="nav-link">Testimonials</a></li>
        
        <!-- Language switcher -->
        <li class="nav-item-dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Language
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../../contatti.php"><img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="Italy" style="width: 24px;">
                Italiano</a></li>
              <li><a class="dropdown-item" href="contact.php"><img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width: 24px;">
                English</a></li>
              <li><a class="dropdown-item" href="../francese/contacts.php"><img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg" alt="FR" style="width: 24px;">
                Français</a></li>
              <li><a class="dropdown-item" href="index-es.html"><img src="https://upload.wikimedia.org/wikipedia/en/9/9a/Flag_of_Spain.svg" alt="ES" style="width: 24px;">
                Español</a></li>
          </ul>
        </li>
      </ul>
  </header>
   
    <div class="containerForm">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label class="labelForm" for="name">Name:</label><br>
        <input class="inputForm" type="text" id="name" name="name" required><br>
    
        <label class="labelForm" for="email">Email:</label><br>
        <input class="inputForm" type="email" id="email" name="email" required><br>
    
        <label class="labelForm" for="phone">Phone:</label><br>
        <input class="inputForm" type="text" id="phone" name="phone" required><br>
    
        <label class="labelForm" for="guests">Number of Guests:</label><br>
        <input class="inputForm" type="number" id="guests" name="guests" required><br>
    
        <label class="labelForm" for="dates">Stay Dates:</label><br>
        <input class="inputForm" type="text" id="dates" name="dates" placeholder="e.g., June 10 to June 15" required><br>
    
        <label class="labelForm" for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br>
    
        <button type="submit">Send Request</button>
      </form>
    </div>

    <div style="height: 50vh;">
      <?php if ($report) { ?>
          <div id="report" style="color: green; font-weight: bold; text-align:center; margin-top:300px;"><?php echo $report; ?></div>
      <?php $report = null; } ?>
    </div>

    <!-- Footer -->
    <footer class="text-center text-lg-start footer">
      <div class="container">
        <div class="row text-center">
          <div class="col">
            <a href="https://www.instagram.com" target="_blank" class="text-decoration-none">
              <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
              <p>Instagram</p>
            </a>
          </div>
          <div class="col">
            <a href="tel:+1234567890" class="text-decoration-none">
              <i class="bi bi-telephone-fill" style="font-size: 1.5rem;"></i>
              <p>+123 456 7890</p>
            </a>
          </div>
          <div class="col">
            <a href="https://www.airbnb.com" target="_blank" class="text-decoration-none">
              <i class="bi bi-house-door-fill" style="font-size: 1.5rem;"></i>
              <p>Airbnb</p>
            </a>
          </div>
          <div class="col">
            <a href="mailto:info@example.com" class="text-decoration-none">
              <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
              <p>info@example.com</p>
            </a>
          </div>
          <div class="col">
            <a href="https://wa.me/1234567890" target="_blank" class="text-decoration-none">
              <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
              <p>WhatsApp</p>
            </a>
          </div>
        </div>
      </div>
    </footer>

    <script src="../../../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
