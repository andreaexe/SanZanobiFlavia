<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous - San Zanobi Maison de Vacances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../contatti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    
  <header class="header1">
      <a href="./francese.html" class="logo">SAN ZANOBI MAISON DE VACANCES</a>
      <input class="menu-btn" id="menu-btn" type="checkbox">
      <label for="menu-btn" class="menu-icon" onclick="change()">
          <span class="nav-icon"></span>
      </label>
      <ul class="menu">
        <li><a href="./galerie.html" class="nav-link">Galerie</a></li>
        <li><a href="./services.html" class="nav-link">Services</a></li>
        <li><a href="./position.html" class="nav-link">Position</a></li>
        <li><a href="./contacts.php" class="nav-link">Contacts</a></li>
        <li><a href="./aPropousDeNous" class="nav-link">A propous de nous</a></li>
        
        <!-- Sélecteur de langue -->
        <li class="nav-item-dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Langue
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="../../../contatti.html"><img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="Italy" style="width: 24px;">
                Italiano</a></li>
              <li><a class="dropdown-item" href="./inglese/contact.php"><img src="https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width: 24px;">
                English</a></li>
              <li><a class="dropdown-item" href="./contacts.php"><img src="https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg" alt="FR" style="width: 24px;">
                Français</a></li>
              <li><a class="dropdown-item" href="index-es.html"><img src="https://upload.wikimedia.org/wikipedia/en/9/9a/Flag_of_Spain.svg" alt="ES" style="width: 24px;">
                Español</a></li>
          </ul>
        </li>
      </ul>
  </header>
   
    <div class="containerForm">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label class="labelForm" for="name">Nom:</label><br>
        <input class="inputForm" type="text" id="name" name="name" required><br>
    
        <label class="labelForm" for="email">E-mail:</label><br>
        <input class="inputForm" type="email" id="email" name="email" required><br>
    
        <label class="labelForm" for="phone">Téléphone:</label><br>
        <input class="inputForm" type="text" id="phone" name="phone" required><br>
    
        <label class="labelForm" for="guests">Nombre de personnes:</label><br>
        <input class="inputForm" type="number" id="guests" name="guests" required><br>
    
        <label class="labelForm" for="dates">Dates de séjour:</label><br>
        <input class="inputForm" type="text" id="dates" name="dates" placeholder="ex. du 10 au 15 juin" required><br>
    
        <label class="labelForm" for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br>
    
        <button type="submit">Envoyer la demande</button>
      </form>
    </div>

    <div style="height: 50vh;">
      <?php if ($report) { ?>
          <div id="report" style="color: green; font-weight: bold; text-align:center; margin-top:300px;"><?php echo $report; ?></div>
      <?php $report = null; } ?>
    </div>

    <!-- Pied de page -->
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
