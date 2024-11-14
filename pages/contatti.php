<?php

/*$nome=$_POST["nome"];
$email=$_POST["email"];
$messaggio=$_POST["messaggio"];

if(empty($nome) || empty($email) || empty($messaggio) ){

    echo "compila tutti i campi" ; 

}

else{

    $to="andrea.sestini2005@gmail.com";
    $subject="Nuovo messaggio da $nome";    
    $body="Nome: $nome \nemail: $email \nmessaggio:\n$messaggio";
    $headers="From:noreply@tuodominio.com";

    if(mail($to,$subject,$body,$headers)){

        echo "messaggio inviato con successo";
    }
    else{
        echo "errore nell' invio del messaggio";
    }
}*/




/*error_reporting(E_ERROR | E_PARSE);*/

session_start(); // Avvia la sessione

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$report = null; // Inizializza la variabile $report come vuota

// Esegui il codice solo quando il form viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal form
    $nome = $_POST["nome"] ?? '';
    $email = $_POST["email"] ?? '';
    $telefono = $_POST["telefono"] ?? '';
    $ospiti = $_POST["ospiti"] ?? '';
    $date = $_POST["date"] ?? '';
    $messaggio = $_POST["messaggio"] ?? '';

    // Crea un'istanza di PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configura il server SMTP di Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'andrea.sestini2005@gmail.com'; // Cambia con il tuo indirizzo Gmail
        $mail->Password = 'pnss zswv buea xvdf';    // Usa la password per app di Google
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Mittente e destinatario
        $mail->setFrom('noreply@tuodominio.com', 'San Zanobi Holiday Home');
        $mail->addAddress('andrea.sestini2005@gmail.com'); // Email di destinazione

        // Contenuto dell'email
        $mail->isHTML(true);
        $mail->Subject = "Richiesta di contatto per San Zanobi Holiday Home da $nome";
        $mail->Body = "
            <h2>Nuova richiesta di contatto</h2>
            <p><strong>Nome:</strong> $nome</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Telefono:</strong> $telefono</p>
            <p><strong>Numero di ospiti:</strong> $ospiti</p>
            <p><strong>Date di soggiorno:</strong> $date</p>
            <p><strong>Messaggio:</strong> $messaggio</p>
        ";

        // Invia l'email
        $mail->send();
        $_SESSION['report'] = "Messaggio inviato con successo. Ti risponderemo al più presto!";
    } catch (Exception $e) {
      $_SESSION['report'] = "Errore nell'invio del messaggio. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_SESSION['report'])) {
  // Se esiste, assegna quel messaggio a $report
  $report = $_SESSION['report'];
  // Rimuovi il messaggio dalla sessione dopo averlo mostrato
  unset($_SESSION['report']);
} else {
  // Se non c'è alcun messaggio, imposta $report come una stringa vuota
  $report = '';
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../contatti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    
    
    
  <header class="header1">
      
      <a href="../index.html" class="logo">SAN ZANOBI CASA VACANZE </a>
      <input class="menu-btn" id="menu-btn" type="checkbox">
      <label for="menu-btn" class="menu-icon"onclick=change()>
  
          <span class="nav-icon"></span>
      </label>
      <ul class="menu">
        <li><a href="./galleria.html" class="nav-link">Galleria</a></li>
        <li><a href="./servizi.html" class="nav-link">Servizi</a></li>
        <li><a href="./doveSiamo.html" class="nav-link">Dove siamo</a></li>
        <li><a href="./contatti.php" class="nav-link">Contatti</a></li>
        <li><a href="./diconoDiNoi.html" class="nav-link">Dicono di noi</a></li>
      
        <!-- Pulsanti per cambiare lingua -->
        <li class="nav-item-dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Lingua
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="./contatti.php"><img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="Italia" style="width: 24px;">
                Italiano</a></li>
              <li><a class="dropdown-item" href="./lingue/inglese/contact.php"><img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width: 24px;">
                English</a></li>
              <li><a class="dropdown-item" href="./lingue/francese/contacts.php"><img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg" alt="FR" style="width: 24px;">
                Français</a></li>
              <li><a class="dropdown-item" href="index-es.html"><img src="https://upload.wikimedia.org/wikipedia/en/9/9a/Flag_of_Spain.svg" alt="ES" style="width: 24px;">
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
   
      
        <!-- Footer -->
        <footer class="text-center text-lg-start footer" >
          <div class="container">
            <div class="row text-center">
              <!-- Instagram -->
              <div class="col">
                <a href="https://www.instagram.com" target="_blank" class="text-decoration-none" >
                  <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                  <p>Instagram</p>
                </a>
              </div>
              <!-- Telefono -->
              <div class="col">
                <a href="tel:+1234567890" class="text-decoration-none" >
                  <i class="bi bi-telephone-fill" style="font-size: 1.5rem;"></i>
                  <p>+123 456 7890</p>
                </a>
              </div>
              <!-- Airbnb -->
              <div class="col">
                <a href="https://www.airbnb.com" target="_blank" class="text-decoration-none" >
                  <i class="bi bi-house-door-fill" style="font-size: 1.5rem;"></i>
                  <p>Airbnb</p>
                </a>
              </div>
              <!-- Email -->
              <div class="col">
                <a href="mailto:info@example.com" class="text-decoration-none" >
                  <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
                  <p>info@example.com</p>
                </a>
              </div>
              <!-- WhatsApp -->
              <div class="col ">
                <a href="https://wa.me/1234567890" target="_blank" class="text-decoration-none" >
                  <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
                  <p>WhatsApp</p>
                </a>
              </div>
            </div>
          </div>
        </footer>
      </div>
         
    
      
        
    <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>