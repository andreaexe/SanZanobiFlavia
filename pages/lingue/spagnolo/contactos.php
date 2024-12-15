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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - Casa de Vacaciones San Zanobi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../contatti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    
  <header class="header1">
      <a href="./spagnolo.html" class="logo">CASA DE SAN ZANOBI</a>
      <input class="menu-btn" id="menu-btn" type="checkbox">
      <label for="menu-btn" class="menu-icon" onclick="change()">
          <span class="nav-icon"></span>
      </label>
      <ul class="menu">
        <li><a href="./galeria.html" class="nav-link">Galería</a></li>
        <li><a href="./servicios.html" class="nav-link">Servicios</a></li>
        <li><a href="./dondeEstamos.html" class="nav-link">Ubicación</a></li>
        <li><a href="./contactos.php" class="nav-link">Contactos</a></li>
        <li><a href="./dicenDeNosotros.html" class="nav-link">Testimonios</a></li>
        
        <!-- Selector de idioma -->
        <li class="nav-item-dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Idioma
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../../contatti.php"><img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="Italy" style="width: 24px;">
                Italiano</a></li>
              <li><a class="dropdown-item" href="../inglese/contact.php"><img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width: 24px;">
                English</a></li>
              <li><a class="dropdown-item" href="../francese/contacts.php"><img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg" alt="FR" style="width: 24px;">
                Français</a></li>
              <li><a class="dropdown-item" href="contactos.php"><img src="https://upload.wikimedia.org/wikipedia/en/9/9a/Flag_of_Spain.svg" alt="ES" style="width: 24px;">
                Español</a></li>
          </ul>
        </li>
      </ul>
  </header>
   
  <div class="containerForm">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label class="labelForm"for="nome">Nome:</label><br>
        <input class="inputForm" type="text" id="nome" name="nome" required><br>
    
        <label class="labelForm"for="email">Email:</label><br>
        <input class="inputForm" type="email" id="email" name="email" required><br>
    
        <label class="labelForm"for="telefono">Telefono:</label><br>
        <input class="inputForm" type="text" id="telefono" name="telefono" required><br>
    
        <label class="labelForm"for="ospiti">Numero di Ospiti:</label><br>
        <input class="inputForm" type="number" id="ospiti" name="ospiti" required><br>
    
        <label class="labelForm"for="date">Date di Soggiorno:</label><br>
        <input class="inputForm" type="text" id="date" name="date" placeholder="es. dal 10 al 15 giugno" required><br>
    
        <label class="labelForm"for="messaggio">Messaggio:</label><br>
        <textarea id="messaggio" name="messaggio" required></textarea><br>
    
        <button type="submit">Invia Richiesta</button>
    </form>
    
    </div>

  
    <div style="height: 20vh;">
       
          <?php 
      if ($report) {?>
           <div id='report' style='border:2px solid black;width:40%;margin:auto;padding:15px;color: black;background-color:#d3c09b; border-radius:30px; font-weight: bold;font-size:18px; text-align:center;margin-top:300px;'><?php echo $report ?></div>;
         <?php $report = null;
      }
      ?>
    </div>
    <!-- Pie de página -->
    <footer class="text-center text-lg-start footer" >
      <div class="container">
        <div class="row text-center">
          <!-- Instagram -->
          <div class="col">
            <a href="https://www.instagram.com/sanzanobi_holiday/" target="_blank" class="text-decoration-none" >
              <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
              <p>Instagram</p>
            </a>
          </div>
          <!-- Teléfono -->
          <div class="col">
            <a href="tel:+393280576886" class="text-decoration-none" >
              <i class="bi bi-telephone-fill" style="font-size: 1.5rem;"></i>
              <p>+393280576886</p>
            </a>
          </div>
          <!-- Airbnb -->
          <div class="col">
            <a href="https://www.airbnb.it/rooms/12360247/amenities?source_impression_id=p3_1728847931_P35IxTYupJ1CoKu9&translate_ugc=false" target="_blank" class="text-decoration-none" >
              <i class="bi bi-house-door-fill" style="font-size: 1.5rem;"></i>
              <p>Airbnb</p>
            </a>
          </div>
          <!-- Correo electrónico -->
          <div class="col">
            <a href="mailto:palumborossana2@gmail.com" class="text-decoration-none" >
              <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
              <p>Correo electrónico</p>
            </a>
          </div>
          <!-- WhatsApp -->
          <div class="col ">
            <a href="https://wa.me/+393280576886" target="_blank" class="text-decoration-none" >
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
