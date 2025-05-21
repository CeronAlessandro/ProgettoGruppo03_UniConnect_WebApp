<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniCorsi - Dettaglio Corso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar principale -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <!-- Logo e nome sito -->
            <a class="navbar-brand d-flex align-items-center" href="index.html">
                <i class="bi bi-book me-2"></i>
                <span class="fw-bold">UniCorsi</span>
            </a>
            <!-- Bottone per menu mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Link della navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.html">Corsi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Calendario</a></li>
                    <li class="nav-item ms-2">
                        <!-- Icona utente -->
                        <div class="user-icon"><i class="bi bi-person"></i></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenuto principale -->
    <div class="container my-5">
        <!-- Link per tornare alla lista dei corsi -->
        <a href="corsi.php" class="text-decoration-none text-primary d-inline-block mb-4">
            <i class="bi bi-arrow-left me-1"></i> Torna ai corsi
        </a>

        <!-- Intestazione del corso -->
        <div class="course-header p-4 mb-5 rounded">
            <h1 class="text-white mb-2">Introduzione alla Programmazione</h1>
            <div class="d-flex text-white opacity-75 small">
                <div class="me-3"><i class="bi bi-person me-1"></i> Prof. Marco Rossi</div>
                <div class="me-3"><i class="bi bi-calendar me-1"></i> Primo Semestre</div>
                <div><i class="bi bi-clock me-1"></i> 6 CFU</div>
            </div>
        </div>

        <div class="row">
            <!-- Colonna con la descrizione -->
            <div class="col-lg-8 mb-4">
                <h2>Descrizione del corso</h2>
                <p class="text-muted">
                    Un corso introduttivo alla programmazione con Python...
                </p>
            </div>

            <!-- Colonna con le info dettagliate del corso -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title h5 mb-4">Informazioni corso</h3>
                        
                        <?php
                            // Connessione al database
                            include 'config.php';

                            // Recupera l'ID del corso
                            $id_corso = $_GET['id'];

                            // Query per ottenere i dettagli del corso
                            $sql = "SELECT corso.* , professore.Nome AS NomeProfessore, professore.Cognome AS CognomeProfessore
                                    FROM corso
                                    JOIN professore ON corso.ID_professore = professore.ID
                                    WHERE corso.ID = ". $id_corso . ";";
                            $result = $conn->query($sql);

                            // Stampa delle informazioni se presenti
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<div class=\"mb-3\">";
                                    echo "<span class=\"d-block text-primary fw-semibold\">Professore</span>";
                                    echo "<span>" . htmlspecialchars($row['NomeProfessore']) . " " . htmlspecialchars($row['CognomeProfessore'])  . "</span>";
                                    echo "</div>";
                                    echo "<div class=\"mb-3\">";
                                    echo "<span class=\"d-block text-primary fw-semibold\">Lingua</span>";
                                    echo "<span>" . htmlspecialchars($row['Lingua']) . "</span>";
                                    echo "</div>";
                                    echo "<div class=\"mb-3\">";
                                    echo "<span class=\"d-block text-primary fw-semibold\">Crediti</span>";
                                    echo "<span>" . htmlspecialchars($row['CFU_totali']) . " CFU</span>";
                                    echo "</div>";
                                }
                            } else {
                                // Messaggio se il corso non esiste
                                echo '<h4 class="mb-4">Non sono presenti corsi per questa facoltà</h4>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sezione delle lezioni del corso -->
        <h2>Lezioni del corso</h2>
        <div class="table-responsive mb-5">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><i class="bi bi-calendar2 me-2"></i>Data</th>
                        <th>Titolo della lezione</th>
                        <th class="text-end">Appunti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Query per recuperare le lezioni del corso
                        $sql = "SELECT *
                                FROM lezione
                                WHERE lezione.ID_Corso = " . $id_corso . "
                                ORDER BY lezione.Data, lezione.Ora_inizio;";
                        $result = $conn->query($sql);

                        // Mostra una riga per ogni lezione trovata
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>15/09/2024</td>";
                                echo "<td>Introduzione a Python e ambiente di sviluppo</td>"; 
                                echo "<td class=\"text-end\">";
                                echo "<a href=\"#\" class=\"btn btn-sm btn-outline-secondary\">";
                                echo "<i class=\"bi bi-file-text me-1\"></i> Visualizza";
                                echo "</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo '<h4 class="mb-4">Non sono presenti informazioni per questo corso</h4>';
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Bottone per aggiungere nuovi appunti -->
        <div class="text-center">
            <a href="uploadAppunti.php" class="btn btn-lg btn-accent">
                <i class="bi bi-plus me-2"></i> Aggiungi Appunti
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
