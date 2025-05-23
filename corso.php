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

    $row = $result->fetch_assoc();
    $nomeProfessore = $row['NomeProfessore'];
    $cognomeProfessore = $row['CognomeProfessore'];
    $cfu = $row['CFU_totali'];
    $nomeCorso = $row['Nome'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect - Dettaglio Corso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Navbar-->
    <?php include 'navbar.php';?>

    <!-- Contenuto principale -->
    <div class="container my-5 page-content">
        <!-- Link per tornare alla lista dei corsi -->
        <a href="corsi.php" class="text-decoration-none text-primary d-inline-block mb-4">
            <i class="bi bi-arrow-left me-1"></i> Torna ai corsi
        </a>

        <!-- Intestazione del corso -->
        <div class="course-header p-4 mb-5 rounded">
            <?php echo "<h1 class=\"text-white mb-2\">" . htmlspecialchars($nomeCorso) . "</h1>"; ?>
            <div class="d-flex text-white opacity-75 small">
                <?php  
                    echo "<div class=\"me-3\"><i class=\"bi bi-person me-1\"></i>" . htmlspecialchars($nomeProfessore) . " " . htmlspecialchars($cognomeProfessore)  . "</div>"; 
                    echo "<div class=\"me-3\"><i class=\"bi bi-calendar me-1\"></i> Dal " 
                        . date("d/m/Y", strtotime($row['Data_inizio'])) 
                        . " al " 
                        . date("d/m/Y", strtotime($row['Data_fine']))  
                        . "</div>"; 
                    echo "<div><i class=\"bi bi-clock me-1\"></i>" . htmlspecialchars($cfu) . " CFU</div>";
                ?>
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
                            // Stampa delle informazioni
                            echo "<div class=\"mb-3\">";
                            echo "<span class=\"d-block text-primary fw-semibold\">Professore</span>";
                            echo "<span>" . htmlspecialchars($nomeProfessore) . " " . htmlspecialchars($cognomeProfessore)  . "</span>";
                            echo "</div>";
                            echo "<div class=\"mb-3\">";
                            echo "<span class=\"d-block text-primary fw-semibold\">Lingua</span>";
                            echo "<span>" . htmlspecialchars($row['Lingua']) . "</span>";
                            echo "</div>";
                            echo "<div class=\"mb-3\">";
                            echo "<span class=\"d-block text-primary fw-semibold\">Crediti</span>";
                            echo "<span>" . htmlspecialchars($row['CFU_totali']) . " CFU</span>";
                            echo "</div>";
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
                                echo "<td>" . htmlspecialchars($row['Titolo']) . "</td>"; 
                                echo "<td class=\"text-end\">";
                                echo "<a href=\"visualizzaAppunti.php?id=" . $row['ID'] . "\" class=\"btn btn-sm btn-outline-secondary\">";
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
            <a class="btn btn-lg btn-accent" href="uploadAppunti.php?id_corso=<?php echo htmlspecialchars($id_corso); ?>">
                <i class="bi bi-plus me-2"></i> Aggiungi Appunti
            </a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
