<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carica i tuoi Appunti</title>
</head>
<body>
    <p>Seleziona il file da caricare:</p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" required>
        <input type="submit" value="Carica File">
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Crea la cartella se non esiste
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Controllo se il file esiste già
    if (file_exists($targetFile)) {
        echo "Il file esiste già.";
        $uploadOk = 0;
    }
    
    // Controllo la dimensione del file
    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5MB max
        echo "Il file è troppo grande.";
        $uploadOk = 0;
    }
    
    // Permetti solo alcuni tipi di file
    $allowedTypes = ["jpg", "png", "jpeg", "gif", "pdf" , "txt"];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sono permessi solo file JPG, JPEG, PNG, GIF, TXT e PDF.";
        $uploadOk = 0;
    }
    
    // Prova a caricare il file se tutto è a posto
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Il file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " è stato caricato con successo.";
        } else {
            echo "Si è verificato un errore durante il caricamento del file.";
        }
    } else {
        echo "Il file non è stato caricato.";
    }
}
?>