<?php
    // Connessione al database
    include 'config.php';

    // Recupera l'ID della lezione
    $id_lezione = $_GET['id'];

    // Query per ottenere i dettagli della lezione (CORRETTA)
    $sql = "SELECT lezione.*, corso.Nome AS NomeCorso 
            FROM lezione 
            JOIN corso ON lezione.ID_Corso = corso.ID 
            WHERE lezione.ID = " . $id_lezione . ";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniCorsi - Visualizza Appunti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar-->
    <?php include 'navbar.php';?>

    <!-- Contenuto principale -->
    <div class="container my-5 page-content">
        <!-- Link per tornare al corso -->
        <a href="corso.php?id=<?php echo $row['ID_Corso']; ?>" class="text-decoration-none text-primary d-inline-block mb-4">
            <i class="bi bi-arrow-left me-1"></i> Torna al corso
        </a>
        
        <!-- Intestazione della lezione -->
        <div class="course-header p-4 mb-5 rounded">
            <h1 class="text-white mb-2"><?php echo htmlspecialchars($row['NomeCorso']); ?></h1>
            <div class="d-flex text-white opacity-75 small">
                <div class="me-3">
                    <i class="bi bi-calendar me-1"></i> 
                    <?php echo date("d/m/Y", strtotime($row['Data'])); ?>
                </div>
                <div>
                    <i class="bi bi-clock me-1"></i>
                    <?php echo substr($row['Ora_inizio'], 0, 5) . " - " . substr($row['Ora_fine'], 0, 5); ?>
                </div>
            </div>
        </div>

        <!-- Titolo della lezione -->
        <div class="mb-4">
            <h2>Appunti per: <?php echo htmlspecialchars($row['Titolo']); ?></h2>
            <p class="text-muted">
                <?php echo htmlspecialchars($row['Descrizione']); ?>
            </p>
        </div>

        <!-- Sezione degli appunti -->
        <div class="notes-container">
            <?php
                // Query corretta per recuperare le note (appunti)
                $sql = "SELECT nota.*, studente.Nome AS NomeStudente, studente.Cognome AS CognomeStudente 
                        FROM nota 
                        JOIN studente ON nota.ID_studente = studente.ID 
                        WHERE nota.ID_lezione = " . $id_lezione . " 
                        ORDER BY nota.Data_creazione DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="row">';
                    
                    while($appunto = $result->fetch_assoc()) {
                        $is_file = !empty($appunto['file_path']);
                        $date_formatted = date("d/m/Y", strtotime($appunto['Data_creazione']));
                        
                        echo '<div class="col-lg-6 mb-4">';
                        echo '<div class="notes-card card h-100">';
                        
                        // Card header con tipo di appunto e data
                        echo '<div class="card-header bg-light d-flex justify-content-between align-items-center">';
                        echo '<span>';
                        if ($is_file) {
                            echo '<i class="bi bi-file-earmark me-2"></i>File';
                        } else {
                            echo '<i class="bi bi-file-text me-2"></i>Testo';
                        }
                        echo '</span>';
                        echo '<span class="text-muted small">' . $date_formatted . '</span>';
                        echo '</div>';
                        
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($appunto['Titolo']) . '</h5>';
                        
                        // Contenuto dell'appunto
                        if ($is_file) {
                            echo '<div class="file-preview p-3 bg-light rounded mb-3">';
                            
                            // Determina l'icona in base al tipo di file
                            $file_extension = pathinfo($appunto['file_path'], PATHINFO_EXTENSION);
                            $file_icon = 'bi-file';
                            
                            if (in_array($file_extension, ['pdf'])) {
                                $file_icon = 'bi-file-earmark-pdf';
                            } elseif (in_array($file_extension, ['doc', 'docx'])) {
                                $file_icon = 'bi-file-earmark-word';
                            } elseif (in_array($file_extension, ['xls', 'xlsx'])) {
                                $file_icon = 'bi-file-earmark-excel';
                            } elseif (in_array($file_extension, ['ppt', 'pptx'])) {
                                $file_icon = 'bi-file-earmark-ppt';
                            } elseif (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                $file_icon = 'bi-file-earmark-image';
                            } elseif (in_array($file_extension, ['zip', 'rar'])) {
                                $file_icon = 'bi-file-earmark-zip';
                            }
                            
                            echo '<div class="d-flex align-items-center">';
                            echo '<i class="bi ' . $file_icon . ' me-3" style="font-size: 2rem;"></i>';
                            echo '<div>';
                            echo '<p class="mb-1">' . basename($appunto['file_path']) . '</p>';
                            $size = 123456; // valore fittizio per test
                            //echo '<p class="mb-0 text-muted small">' . strtoupper($file_extension) . ' - ' . formatFileSize(filesize($appunto['file_path'])) . '</p>';
                            //echo '<p class="mb-0 text-muted small">' . strtoupper($file_extension) . ' - ' . formatFileSize($size) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            
                            echo '<a href="' . htmlspecialchars($appunto['file_path']) . '" class="btn btn-outline-primary" download>';
                            echo '<i class="bi bi-download me-2"></i>Scarica appunti';
                            echo '</a>';
                        } else {
                            // Mostra il testo dell'appunto
                            echo '<div class="notes-content mb-3">';
                            echo nl2br(htmlspecialchars($appunto['Testo']));
                            echo '</div>';
                        }
                        
                        // Footer con info studente
                        echo '<div class="text-muted mt-3 pt-3 border-top">';
                        echo '<i class="bi bi-person-circle me-1"></i>';
                        echo 'Condiviso da <strong>' . htmlspecialchars($appunto['NomeStudente']) . ' ' . htmlspecialchars($appunto['CognomeStudente']) . '</strong>';
                        echo '</div>';
                        
                        echo '</div>'; // Fine card-body
                        echo '</div>'; // Fine card
                        echo '</div>'; // Fine col
                    }
                    
                    echo '</div>'; // Fine row
                } else {
                    // Messaggio se non ci sono appunti disponibili
                    echo '<div class="alert alert-info">';
                    echo '<i class="bi bi-info-circle me-2"></i>';
                    echo 'Non ci sono appunti disponibili per questa lezione.';
                    echo '</div>';
                }
                
                // Helper function per formattare la dimensione del file
                function formatFileSize($bytes) {
                    if ($bytes >= 1073741824) {
                        return number_format($bytes / 1073741824, 2) . ' GB';
                    } else if ($bytes >= 1048576) {
                        return number_format($bytes / 1048576, 2) . ' MB';
                    } else if ($bytes >= 1024) {
                        return number_format($bytes / 1024, 2) . ' KB';
                    } else {
                        return $bytes . ' bytes';
                    }
                }
                
                $conn->close();
            ?>
        </div>
        
        <!-- Bottone per aggiungere nuovi appunti -->
        <div class="text-center mt-5">
            <a href="uploadAppunti.php?lezione=<?php echo $id_lezione; ?>" class="btn btn-lg btn-accent">
                <i class="bi bi-plus me-2"></i> Aggiungi Appunti
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>