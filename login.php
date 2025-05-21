<?php 
  include 'config.php';

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

      // Reindirizzo l'utente alla home page dopo il login
      header("Location: index.php");
      exit(); // Termino lo script
    } else {
      // Se non ci sono risultati: email o password errati
      echo "Email o password non corretti! Riprova:";
    }
  }
?>

<!-- Inizio del documento HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<!-- Form per il login, invia i dati alla stessa pagina con metodo POST -->
<form action="login.php" method="post">
        <div class="mb-3">
          <!-- Campo email -->
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" maxlength="128" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <!-- Campo password -->
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
        </div>
        <!-- Bottone per inviare il form -->
        <button type="submit" class="btn btn-primary">Login</button>
</form>

<!-- Link per la registrazione se l'utente non è ancora registrato -->
<p class="mb-3">Se non sei ancora registrato:<br></p>
<a href="register.php">Registrati</a>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

