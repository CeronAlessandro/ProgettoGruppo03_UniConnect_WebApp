<?php 
  include 'config.php';

  $error_message = null;
  $success_message = null;

  // Controllo se il metodo della richiesta è POST
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    // Recupero i dati inviati dal form (email e password)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query per cercare uno studente con le credenziali inserite
    $sql = "SELECT * FROM studente WHERE Email = '$email' AND Password = '$password'";
    $result = $conn->query($sql);

    // Se è stato trovato almeno un risultato (email e password corretti)
    if($result->num_rows > 0){
      echo "Login effettuato con successo!";
      
      // Avvio la sessione
      session_start();

      // Prendo i dati dello studente
      $row = $result->fetch_assoc();

      // Salvo le informazioni utili nella sessione per usarle in altre pagine
      $_SESSION['id'] = $row['ID'];
      $_SESSION['email'] = $email;
      $_SESSION['nome'] = $row['Nome'];
      $_SESSION['cognome'] = $row['Cognome'];
      $_SESSION['data_nascita'] = $row['Data_nascita'];
      $_SESSION['genere'] = $row['Genere'];
      $_SESSION['codice_fiscale'] = $row['Codice_fiscale'];
      $_SESSION['telefono'] = $row['Telefono'];
      $_SESSION['id_facolta'] = $row['ID_facolta'];
      $_SESSION['login_success'] = 1;

      // Reindirizzo l'utente alla home page dopo il login
      header("Location: index.php");
      exit(); // Termino lo script
    } else {
      // Se non ci sono risultati: email o password errati
      $error_message = "Email o password non corretti! Riprova.";
    }
  }
?>

<!-- Inizio del documento HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <div class="login-header">
                <div class="login-logo">
                    <img src="IMG/logo2.png" class="logo-navbar"> <!-- Immagine del logo -->
                </div>
                <h3 class="mb-3">Accedi</h3>
            </div>

            <!-- Alert per i messaggi di errore (visibile solo quando necessario) -->
            <?php if (isset($error_message)): ?>
            <div class="alert alert-danger alert-animation mb-4" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?php echo $error_message; ?>
            </div>
            <?php endif; ?>
            
            <!-- Form per il login, invia i dati alla stessa pagina con metodo POST -->
            <form action="login.php" method="post">
                <div class="mb-3">
                    <!-- Campo email -->
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" maxlength="128" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-4">
                    <!-- Campo password -->
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                </div>
                <!-- Bottone per inviare il form -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </form>

            <!-- Link per la registrazione -->
            <div class="register-link">
                <p>Se non sei ancora registrato:</p>
                <a href="register.php" class="btn btn-outline-primary">Registrati</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
    <script>
        // Simple animation effect
        document.addEventListener('DOMContentLoaded', function() {
            anime({
                targets: '.login-form',
                translateY: [20, 0],
                opacity: [0, 1],
                duration: 800,
                easing: 'easeOutElastic(1, .6)'
            });
        });

        // Animate alerts if present
        anime({
            targets: '.alert',
            translateY: [-10, 0],
            opacity: [0, 1],
            duration: 500,
            easing: 'easeOutQuad',
            delay: 300
        });
    </script>
</body>
</html>