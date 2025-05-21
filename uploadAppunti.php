<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Aggiungi Appunti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container mt-4 page-content">
        <div class="d-flex align-items-center mb-4">
            <a href="javascript:history.back()" class="text-decoration-none text-primary">
                <i class="bi bi-arrow-left me-1"></i> Torna al corso
            </a>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">Aggiungi Appunti</h2>
                <p class="text-muted mb-0">Aggiungi appunti per il corso. Puoi scrivere direttamente o caricare un file.</p>
            </div>
            <div class="card-body">
                <!-- Tab navigation -->
                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active d-flex align-items-center" id="editor-tab" data-bs-toggle="tab" data-bs-target="#editor" type="button" role="tab" aria-controls="editor" aria-selected="true">
                            <i class="bi bi-pencil me-2"></i> Editor di testo
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button" role="tab" aria-controls="upload" aria-selected="false">
                            <i class="bi bi-upload me-2"></i> Carica file
                        </button>
                    </li>
                </ul>
                
                <!-- Tab content -->
                <div class="tab-content" id="myTabContent">
                    <!-- Editor tab -->
                    <div class="tab-pane fade-in" id="editor" role="tabpanel" aria-labelledby="editor-tab">
                        <form id="editor-form">
                            <div class="mb-3">
                                <label for="note-title" class="form-label">Titolo Nota</label>
                                <input type="text" class="form-control" id="note-title" placeholder="Inserisci un titolo per i tuoi appunti" required>
                            </div>
                            <div class="mb-3">
                                <label for="editor-lesson-select" class="form-label">Lezione</label>
                                <select class="form-select" id="editor-lesson-select" required>
                                    <option value="" selected disabled>Seleziona la lezione a cui si riferiscono gli appunti</option>
                                    <!-- Le opzioni verranno popolate dinamicamente -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note-content" class="form-label">Scrivi qui la nota</label>
                                <textarea class="form-control" id="note-content" rows="12" placeholder="Scrivi i tuoi appunti qui..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2" onclick="history.back()">Annulla</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Salva
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Upload tab -->
                    <div class="tab-pane fade-out" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        <form id="upload-form">
                            <div class="mb-3">
                                <label for="upload-title" class="form-label">Titolo Nota</label>
                                <input type="text" class="form-control" id="upload-title" placeholder="Inserisci un titolo per i tuoi appunti" required>
                            </div>
                            <div class="mb-3">
                                <label for="upload-lesson-select" class="form-label">Lezione</label>
                                <select class="form-select" id="upload-lesson-select" required>
                                    <option value="" selected disabled>Seleziona la lezione a cui si riferiscono gli appunti</option>
                                    <!-- Le opzioni verranno popolate dinamicamente -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="file-upload" class="form-label">Carica il tuo file</label>
                                <input class="form-control" type="file" id="file-upload" required>
                                <div id="file-selected" class="file-selected d-none"></div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary me-2" onclick="history.back()">Annulla</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-cloud-arrow-up me-1"></i> Carica
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>
                    <span id="toast-message">Operazione completata con successo!</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!-- editor -->
<?php
    include 'config.php';

    // Verifica se la richiesta è di tipo POST, quindi il form è stato inviato
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        session_start(); // Avvia la sessione per ottenere l'ID utente salvato

        // Recupera l'ID dell'utente dalla sessione
        $id = $_SESSION['id'];

        // Recupera i dati inviati dal form
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Query SQL per inserire una nuova nota nel database
        $sql = "INSERT INTO notes(title, content, id_user) VALUES('$title', '$content', '$id')";

        // Esegui la query e controlla se è andata a buon fine
        if($conn->query($sql) === true){
            echo "Nota salvata con successo!";
        }else{
            echo "Errore nel salvataggio";
        }
    }
?>

<!-- upload -->
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
        $allowedTypes = ["pdf" , "txt"];
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
