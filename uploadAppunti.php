<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniCorsi - Aggiungi Appunti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php';?>
    
    <div class="container mt-4 page-content">
        <div class="d-flex align-items-center mb-4 back-link">
            <a href="javascript:history.back()" class="text-decoration-none btn btn-link ps-0">
                <i class="bi bi-arrow-left me-2"></i> Torna al corso
            </a>
        </div>
        
        <div class="card notes-card shadow">
            <div class="card-header bg-light py-4">
                <h2 class="mb-2 fw-bold text-primary-dark">Aggiungi Appunti</h2>
                <p class="text-muted mb-0">Aggiungi appunti per il corso. Puoi scrivere direttamente o caricare un file.</p>
            </div>
            <div class="card-body p-4">
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
                    <div class="tab-pane fade show active animate-tab" id="editor" role="tabpanel" aria-labelledby="editor-tab">
                        <form id="editor-form">
                            <div class="mb-4 form-floating">
                                <input type="text" class="form-control" id="note-title" placeholder="Inserisci un titolo per i tuoi appunti" required>
                                <label for="note-title">Titolo Nota</label>
                            </div>
                            <div class="mb-4 form-floating">
                                <select class="form-select" id="editor-lesson-select" required>
                                    <option value="" selected disabled>Seleziona la lezione</option>
                                    <?php
                                        include "config.php";

                                        $lezioni = [];

                                        // Query per recuperare le lezioni del corso
                                        $sql = "SELECT *
                                                FROM lezione
                                                WHERE lezione.ID_Corso = " . $_GET['id_corso'] . "
                                                ORDER BY lezione.Data, lezione.Ora_inizio;";
                                        $result = $conn->query($sql);

                                        // Mostra una riga per ogni lezione trovata
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $lezioni[] = $row;
                                            }
                                            foreach ($lezioni as $lezione) {
                                                echo "<option value=\"" . htmlspecialchars($row['ID']) . "\"> " . htmlspecialchars($lezione['Titolo']) . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="editor-lesson-select">Lezione</label>
                            </div>
                            <div class="mb-4">
                                <label for="note-content" class="form-label">Scrivi qui la nota</label>
                                <textarea class="form-control" id="note-content" rows="12" placeholder="Scrivi i tuoi appunti qui..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-secondary me-2 btn-lg" onclick="history.back()">
                                    <i class="bi bi-x-circle me-1"></i> Annulla
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-save me-1"></i> Salva
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Upload tab -->
                    <div class="tab-pane fade animate-tab" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                        <form id="upload-form">
                            <div class="mb-4 form-floating">
                                <input type="text" class="form-control" id="upload-title" placeholder="Inserisci un titolo per i tuoi appunti" required>
                                <label for="upload-title">Titolo Nota</label>
                            </div>
                            <div class="mb-4 form-floating">
                                <select class="form-select" id="upload-lesson-select" required>
                                    <option value="" selected disabled>Seleziona la lezione</option>
                                    <?php
                                        // Mostra una riga per ogni lezione trovata
                                        if ($result->num_rows > 0) {
                                            foreach ($lezioni as $lezione) {
                                                echo "<option value=\"" . htmlspecialchars($row['ID']) . "\"> " . htmlspecialchars($lezione['Titolo']) . "</option>";
                                            }
                                        }
                                        $conn->close();
                                    ?>
                                </select>
                                <label for="upload-lesson-select">Lezione</label>
                            </div>
                            <div class="mb-4">
                                <label for="file-upload" class="form-label">Carica il tuo file</label>
                                <div class="file-upload-container">
                                    <input class="form-control form-control-lg" type="file" id="file-upload" required>
                                    <div class="mt-3 d-none" id="file-preview">
                                        <div class="card bg-light p-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-text fs-1 me-3 text-accent"></i>
                                                <div>
                                                    <h5 class="mb-1 file-name">filename.pdf</h5>
                                                    <p class="mb-0 text-muted file-size">Size: 2.3 MB</p>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-danger ms-auto" id="remove-file">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-secondary me-2 btn-lg" onclick="history.back()">
                                    <i class="bi bi-x-circle me-1"></i> Annulla
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg">
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
        <div id="successToast" class="toast align-items-center text-white bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animation with anime.js
        document.addEventListener('DOMContentLoaded', function() {
            // Animate back link
            anime({
                targets: '.back-link',
                translateX: ['-20px', '0px'],
                opacity: [0, 1],
                easing: 'easeOutQuad',
                duration: 800
            });
            
            // Animate card
            anime({
                targets: '.notes-card',
                translateY: ['20px', '0px'],
                opacity: [0, 1],
                easing: 'easeOutExpo',
                duration: 1000,
                delay: 200
            });
            
            // Tab animations
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    anime({
                        targets: '.animate-tab',
                        opacity: [0, 1],
                        translateY: ['10px', '0px'],
                        easing: 'easeOutQuad',
                        duration: 400
                    });
                });
            });
            
            // Form submission animations
            ['editor-form', 'upload-form'].forEach(formId => {
                const form = document.getElementById(formId);
                if(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        // Show toast
                        const toast = new bootstrap.Toast(document.getElementById('successToast'));
                        toast.show();
                        
                        // Success animation
                        anime({
                            targets: '.card',
                            scale: [1, 1.02, 1],
                            duration: 800,
                            easing: 'easeInOutQuad'
                        });
                        
                        // In a real application, you would send form data to the server here
                        console.log('Form submitted:', formId);
                    });
                }
            });
        });
    </script>
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
