<?php
    //include il file che mi permette di connettermi al db
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $checkPassword = $_POST['checkpassword'];

        if ($password === $checkPassword){
            $email = $_POST['Email'];
            $nome = $_POST['Nome'];
            $cognome = $_POST['Cognome'];
            $data_nascita = $_POST['Data_nascita'];
            $genere = $_POST['Genere'];
            $codice_fiscale = $_POST['Codice_fiscale'];
            $telefono = $_POST['Telefono'];
            $id_facolta = $_POST['Facolta'];

            $sql = "INSERT INTO studente(Email, Password, Nome, Cognome, Data_nascita, Genere, Codice_fiscale, Telefono, ID_facolta) VALUES('$email', '$password', '$nome' , '$cognome', '$data_nascita', '$genere', '$codice_fiscale', '$telefono', '$id_facolta');";

            if($conn->query($sql) === true){
                echo "Utente registrato con successo!";
            }else{
                echo "Errore nell'inserimento";
            }
        }else{
            echo "La password non è corretta! Scrivi 2 volte la stessa password.";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Attività Registrazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form class="row g-3 needs-validation" method="post">
    <!-- Nome -->
    <!-- Nome -->
    <div class="col-md-4">
        <label for="Nome" class="form-label">Nome</label>
        <input type="text" name="Nome" class="form-control" minlength="2" maxlength="50" required>
        <label for="Nome" class="form-label">Nome</label>
        <input type="text" name="Nome" class="form-control" minlength="2" maxlength="50" required>
        <div class="valid-feedback">
        </div>
    </div>

    <!-- Cognome -->

    <!-- Cognome -->
    <div class="col-md-4">
        <label for="Cognome" class="form-label">Cognome</label>
        <input type="text" name="Cognome" class="form-control" minlength="2" maxlength="50" required>
        <label for="Cognome" class="form-label">Cognome</label>
        <input type="text" name="Cognome" class="form-control" minlength="2" maxlength="50" required>
        <div class="valid-feedback">
        </div>
    </div>
    
    <!-- Data di Nascita -->
    <div class="col-md-4">
        <label for="Data_nascita" class="form-label">Data di Nascita</label>
        <input type="date" name="Data_nascita" class="form-control" required>
        <div class="valid-feedback"></div>
    </div>

    <!-- Genere (M/F) -->
    <div class="col-md-4">
        <label class="form-label d-block">Genere</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Genere" id="genereM" value="M">
            <label class="form-check-label" for="genereM">Maschio</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Genere" id="genereF" value="F">
            <label class="form-check-label" for="genereF">Femmina</label>
        </div>
    </div>

    <!-- Codice Fiscale -->
    <div class="col-md-4">
        <label for="Codice_fiscale" class="form-label">Codice Fiscale</label>
        <input type="text" name="Codice_fiscale" class="form-control" minlength="16" maxlength="16" required>
        <div class="valid-feedback"></div>
    </div>

    <!-- Email -->
    
    <!-- Data di Nascita -->
    <div class="col-md-4">
        <label for="Data_nascita" class="form-label">Data di Nascita</label>
        <input type="date" name="Data_nascita" class="form-control" required>
        <div class="valid-feedback"></div>
    </div>

    <!-- Genere (M/F) -->
    <div class="col-md-4">
        <label class="form-label d-block">Genere</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Genere" id="genereM" value="M">
            <label class="form-check-label" for="genereM">Maschio</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="Genere" id="genereF" value="F">
            <label class="form-check-label" for="genereF">Femmina</label>
        </div>
    </div>

    <!-- Codice Fiscale -->
    <div class="col-md-4">
        <label for="Codice_fiscale" class="form-label">Codice Fiscale</label>
        <input type="text" name="Codice_fiscale" class="form-control" minlength="16" maxlength="16" required>
        <div class="valid-feedback"></div>
    </div>

    <!-- Email -->
    <div class="col-md-4">
        <label for="Email" class="form-label">Email</label>
        <input type="email" name="Email" class="form-control" maxlength="100" required>
        <label for="Email" class="form-label">Email</label>
        <input type="email" name="Email" class="form-control" maxlength="100" required>
        <div class="valid-feedback">
        </div>
    </div>

    <!-- Telefono -->
    <div class="col-md-4">
        <label for="Telefono" class="form-label">Telefono</label>
        <input type="tel" name="Telefono" class="form-control" maxlength="15" pattern="[0-9]+">
        <div class="valid-feedback"></div>
    </div>

    <!-- Password -->

    <!-- Telefono -->
    <div class="col-md-4">
        <label for="Telefono" class="form-label">Telefono</label>
        <input type="tel" name="Telefono" class="form-control" maxlength="15" pattern="[0-9]+">
        <div class="valid-feedback"></div>
    </div>

    <!-- Password -->
    <div class="col-md-4">
        <label for="Password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" maxlength="255" required>
        <label for="Password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" maxlength="255" required>
        <div class="valid-feedback">
        </div>
    </div>

    <!-- Controllo Password -->

    <!-- Controllo Password -->
    <div class="col-md-4">
        <label for="checkPassword" class="form-label">Digita nuovamente la Password</label>
        <input type="password" name="checkpassword" class="form-control" maxlength="255" required>
        <div class="valid-feedback">
        </div>
    </div>

    <!-- Università -->
    <div class="col-md-4">
        <label for="Universita" class="form-label">Università</label>
        <select name="Universita" class="form-select" required>
            <option selected disabled value="">Seleziona...</option>
            <?php
                $sql = "SELECT id, nome FROM universita";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                }
            ?>
        </select>
        <div class="valid-feedback"></div>
    </div>
    <!-- Facoltà -->
    <div class="col-md-4">
        <label for="Facolta" class="form-label">Facoltà</label>
        <select name="Facolta" class="form-select" required>
            <option selected disabled value="">Seleziona...</option>
            <?php
                $sql = "SELECT id, nome FROM facolta";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                }
            ?>
        </select>
        <div class="valid-feedback"></div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Register</button>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
