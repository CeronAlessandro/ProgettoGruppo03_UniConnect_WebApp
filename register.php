<?php
    //include il file che mi permette di connettermi al db
    include 'config.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $checkPassword = $_POST['checkPassword'];

        if ($password === $checkPassword){
            $email = $_POST['email'];
            $first_name = $_POST['first-name'];
            $last_name = $_POST['last-name'];

            $sql = "INSERT INTO users(email, password, first_name, last_name) VALUES('$email', '$password', '$first_name' , '$last_name');";

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
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">First name</label>
        <input type="text" name="first-name" class="form-control" id="validationCustom01" minlength="2" maxlength="60" required>
        <div class="valid-feedback">
        </div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Last name</label>
        <input type="text" name="last-name" class="form-control" id="validationCustom02" minlength="2" maxlength="60" required>
        <div class="valid-feedback">
        </div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="validationCustom02" maxlength="128" required>
        <div class="valid-feedback">
        </div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="validationCustom02" required>
        <div class="valid-feedback">
        </div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Ripeti la password</label>
        <input type="password" name="checkPassword" class="form-control" id="validationCustom02" required>
        <div class="valid-feedback">
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Register</button>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>