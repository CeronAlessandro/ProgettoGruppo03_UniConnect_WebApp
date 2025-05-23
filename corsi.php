<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Corsi Universitari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container my-5 page-content">
        <h1 class="mb-4">I tuoi Corsi</h1>
        <div class="position-relative mb-4">
            <!-- Icona lente d'ingrandimento -->
            <i class="bi bi-search position-absolute search-icon"></i>
            <!-- Campo input per la ricerca -->
            <input type="text" class="form-control form-control-lg ps-5" placeholder="Cerca corsi...">
        </div>

        <!-- Sezione che conterrà la griglia dei corsi -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

            <!-- Codice PHP per mostrare i corsi della facoltà dello studente loggato -->
            <?php
                // Inclusione del file di configurazione
                include 'config.php';

                // Avvio della sessione per accedere ai dati utente
                session_start();

                // Verifica che l'utente sia loggato
                if(isset($_SESSION['id'])){
                    // Prende l'ID della facoltà associata allo studente loggato
                    $id_facolta = $_SESSION['id_facolta'];

                    // Query per ottenere tutti i corsi della stessa facoltà dello studente
                    $sql = "SELECT corso.ID, corso.Nome, professore.Nome AS NomeProfessore, professore.Cognome AS CognomeProfessore
                            FROM corso 
                            JOIN studente ON corso.ID_facolta = studente.ID_facolta 
                            JOIN professore ON corso.ID_professore = professore.ID
                            WHERE studente.ID = ". $id_facolta . ";";

                    // Esecuzione della query
                    $result = $conn->query($sql);

                    // Se ci sono risultati
                    if ($result->num_rows > 0) {
                        // Ciclo su ogni corso trovato
                        while($row = $result->fetch_assoc()) {
                            // Crea una colonna con una card cliccabile che porta alla pagina del corso
                            echo "<div class=\"col\">";
                            echo "<a href=\"corso.php?id=" . $row['ID'] . "\" class=\"text-decoration-none\">";
                            echo "<div class=\"card h-100 course-card\">";
                            echo "<div class=\"card-body\">";
                            echo "<div class=\"d-flex justify-content-between mb-2\">";
                            echo "<h5 class=\"card-title\">". htmlspecialchars($row['Nome']) ."</h5>"; // Titolo del corso
                            echo "<i class=\"bi bi-book text-accent\"></i>"; // Icona libro
                            echo "</div>";
                            echo "<p class=\"card-text text-muted\"></p>"; // Eventuale descrizione del corso (vuota per ora)
                            echo "</div>";
                            echo "<div class=\"card-footer bg-white\">";
                            echo "<small class=\"text-muted\">Prof. " . htmlspecialchars($row['NomeProfessore']) . " " . htmlspecialchars($row['CognomeProfessore']) . "</small>";
                            echo "</div>";
                            echo "</div>";
                            echo "</a>";
                            echo "</div>";
                        }
                    } else {
                        // Se non ci sono corsi disponibili per quella facoltà
                        echo '<h4 class="mb-4">Non sono presenti corsi per questa facoltà</h4>';
                    }
                } else {
                    // Se l'utente non è loggato, viene mostrato un messaggio di accesso richiesto
                    echo '<div class="card shadow p-4" style="max-width: 400px;">
                        <h2 class="mb-3">Accesso richiesto</h2>
                        <p class="text-muted mb-4">Per accedere a questa funzionalità, effettua l\'accesso al tuo account.</p>
                        <a href="login.php" class="btn btn-primary">Accedi</a>
                        </div>';
                }
                $conn->close();
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="..." crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="..." crossorigin="anonymous"></script>
</body>
</html>
