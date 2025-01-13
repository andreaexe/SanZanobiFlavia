<?php
session_start();

$messaggioReport = ""; // Inizializza il messaggio
$flagReport = false;    // Inizializza il flag

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera i dati dal form
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $ospiti = $_POST['ospiti'];
    $date = htmlspecialchars(trim($_POST['date']));
    $messaggio = htmlspecialchars(trim($_POST['messaggio']));

    // Destinatario
    $to = 'andrea.sestini2005@gmail.com';

    // Oggetto dell'email
    $subject = 'Demande de contact San Zanobi Holiday Home';

    // Corpo del messaggio
    $message = "Vous avez reçu une nouvelle demande de contact :\r\n\r\n";
    $message .= "Nom: $nome\r\n";
    $message .= "Email: $email\r\n";
    $message .= "Téléphone: $telefono\r\n";
    $message .= "Nombre d'invités: $ospiti\r\n";
    $message .= "Dates de séjour: $date\r\n";
    $message .= "Message:\r\n$messaggio\r\n";

    // Intestazioni dell'email
    $headers = "From: San Zanobi Holiday Home <sestini5c@altervista.org>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Invia l'email
    if (mail($to, $subject, $message, $headers)) {
        $_SESSION['messaggioReport'] = "Message envoyé avec succès!";
        $_SESSION['flagReport'] = true; // Salva il flag nella sessione
    } else {
        $_SESSION['messaggioReport'] = "Échec de l'envoi du message.";
        $_SESSION['flagReport'] = false; // Salva il flag nella sessione
    }

    // Reindirizza alla stessa pagina con l'ancora #report
    header("Location: " . $_SERVER['PHP_SELF'] . "#report");
    exit();
}

// Recupera il messaggio e il flag dalla sessione
$messaggioReport = isset($_SESSION['messaggioReport']) ? $_SESSION['messaggioReport'] : '';
$flagReport = isset($_SESSION['flagReport']) ? $_SESSION['flagReport'] : false;

// Rimuove i dati dalla sessione
unset($_SESSION['messaggioReport']);
unset($_SESSION['flagReport']);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../contatti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lexend:wght@414&family=VT323&display=swap" rel="stylesheet">
</head>
<body>
    
    
    
  <header class="header1">
      
      <a href="./francese.html" class="logo">SAN ZANOBI MAISON DE VACANCES</a>
      <input class="menu-btn" id="menu-btn" type="checkbox">
      <label for="menu-btn" class="menu-icon"onclick=change()>
  
          <span class="nav-icon"></span>
      </label>
      <ul class="menu">
        <li><a href="./galerie.html" class="nav-link">Galerie</a></li>
        <li><a href="./services.html" class="nav-link">Services</a></li>
        <li><a href="./position.html" class="nav-link">Localisation</a></li>
        <li><a href="./contacts.php" class="nav-link">Contact</a></li>
        <li><a href="./aPropousDeNous.html" class="nav-link">Témoignages</a></li>
      
        <!-- Boutons pour changer de langue -->
        <li class="nav-item-dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Langue
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../../contatti.php"><img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="Italia" style="width: 24px;">
                Italiano</a></li>
              <li><a class="dropdown-item" href="../inglese/contact.php"><img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width: 24px;">
                English</a></li>
              <li><a class="dropdown-item" href="./contacts.php"><img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg" alt="FR" style="width: 24px;">
                Français</a></li>
              <li><a class="dropdown-item" href="../spagnolo/contactos.php"><img src="https://upload.wikimedia.org/wikipedia/en/9/9a/Flag_of_Spain.svg" alt="ES" style="width: 24px;">
                Español</a></li>
          </ul>
      </li>
      
      
      </ul>
      
    
  </header>
   
    <div class="containerForm">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
         <!--<label class="labelForm lato-bold"for="nome">Nome:</label><br>-->
        <input class="inputForm" type="text" id="nome" name="nome" placeholder="Nom:"required><br>
    
         <!--<label class="labelForm lato-bold"for="email">Email:</label><br>-->
        <input class="inputForm" type="email" id="email" name="email" placeholder="Email:"required><br>
    
         <!--<label class="labelForm lato-bold"for="telefono">Telefono:</label><br>-->
        <input class="inputForm" type="text" id="telefono" name="telefono"placeholder="Téléphone:" required><br>
    
        <!--<label class="labelForm lato-bold"for="ospiti">Numero di Ospiti:</label><br>-->
        <input class="inputForm" type="number" id="ospiti" placeholder="Nombre d'invités:" name="ospiti" required><br>
    
         <!--<label class="labelForm lato-bold"for="date">Date di Soggiorno:</label><br>-->
        <input class="inputForm" type="text" id="date" name="date" placeholder="Dates de séjour:" required><br>
    
         <!--<label class="labelForm lato-bold"for="messaggio">Messaggio:</label><br>-->
        <textarea id="messaggio" name="messaggio" placeholder="Message:" required></textarea><br>
    
        <button type="submit">Envoyer demande</button>
    </form>
    
    </div>

  
    <div style="height: 20vh; margin-top: 200px;">
    <?php if (!empty($messaggioReport)): ?>
        <div id="report" style="
            border: 2px solid <?php echo $flagReport ? '#4caf50' : 'orange'; ?>;
            width: 50%;
            margin: auto;
            padding: 20px;
            color: <?php echo $flagReport ? '#155724' : 'red'; ?>;
            background-color: <?php echo $flagReport ? '#d4edda' : '#fed8b1'; ?>;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <?php echo $messaggioReport; ?>
        </div>
    <?php endif; ?>
</div>



   
      
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
          <!-- Telefono -->
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
          <!-- Email -->
          <div class="col">
            <a href="mailto:palumborossana2@gmail.com" class="text-decoration-none" >
              <i class="bi bi-envelope-fill" style="font-size: 1.5rem;"></i>
              <p>Email</p>
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