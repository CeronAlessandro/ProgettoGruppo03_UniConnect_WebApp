<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>textEditor</title>
</head>
<body>
    <form method="post">
        <label for="title">Titolo Nota</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="contento">Scrivi qui la nota:</label><br>
        <textarea id="content" name="content" cols="130" rows="30" placeholder="Type your text here..."></textarea><br>
        <button type="submit">Salva</button>
    </form>
</body>
</html>

<?php
    include 'config.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start();
        $id = $_SESSION['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "INSERT INTO notes(title, content, id_user) VALUES('$title', '$content', '$id')";

        if($conn->query($sql) === true){
            echo "Nota salvata con successo!";
        }else{
            echo "Errore nel salavataggio";
        }
    }
?>