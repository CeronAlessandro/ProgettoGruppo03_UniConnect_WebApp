<?php
include 'config.php';
session_start();
if (isset($_SESSION['id'])) {
    //se l'utente è già loggato, reindirizza alla pagina principale
    header("Location: form.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $checkPassword = $_POST['checkPassword'];

    if ($password === $checkPassword) {
        $email = $_POST['email'];
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $data_nascita = $_POST['data-nascita'];
        $genere = $_POST['genere'];
        $codice_fiscale = $_POST['codice-fiscale'];
        $telefono = $_POST['telefono'];
        $id_facolta = $_POST['id-facolta'];

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO studente (Nome, Cognome, Data_nascita, Genere, Codice_fiscale, Email, Telefono, Password, ID_facolta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $first_name, $last_name, $data_nascita, $genere, $codice_fiscale, $email, $telefono, $password_hash, $id_facolta);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Utente registrato con successo!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Errore nell'inserimento: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-warning text-center'>La password non è corretta! Scrivi 2 volte la stessa password.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione Studente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Registrazione Studente</h1>
    <form class="row g-3" method="post">
        <div class="col-md-4">
            <label class="form-label">Nome</label>
            <input type="text" name="first-name" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Cognome</label>
            <input type="text" name="last-name" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Ripeti la password</label>
            <input type="password" name="checkPassword" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Data di nascita</label>
            <input type="date" name="data-nascita" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Genere</label>
            <select name="genere" class="form-select" required>
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Codice Fiscale</label>
            <input type="text" name="codice-fiscale" class="form-control" maxlength="16" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Telefono</label>
            <input type="text" name="telefono" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">ID Facoltà</label>
            <input type="number" name="id-facolta" class="form-control" required>
            <div class="form-text">Inserisci l'ID della facoltà (es. 1)</div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Registrati</button>
        </div>
    </form>
</div>
</body>
</html>