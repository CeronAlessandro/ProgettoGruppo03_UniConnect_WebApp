<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario lezioni</title>
</head>
<body>
    <div>
        <table border="solid">
            <thead>
                <tr>
                    <th>LEZIONE</th>
                    <th>GIORNO</th>
                    <th>ORARIO</th>
                    <th>AULA</th>
                    <th>DESCRIZIONE</th>
                    <th>CORSO</th>
                    <th>PROFESSORE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'config.php';

                    // Selezioniamo le lezioni e i dettagli del corso e del professore
                    $sql = "SELECT l.ID, l.Titolo, l.Data, l.Ora_inizio, l.Ora_fine, l.Aula, l.Descrizione, c.Nome AS corso, p.Nome AS professore, p.Cognome AS cognome
                            FROM lezione l
                            JOIN corso c ON l.ID_Corso = c.ID
                            JOIN professore p ON c.ID_professore = p.ID
                            ORDER BY l.Data, l.Ora_inizio";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Titolo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Data']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Ora_inizio']) . " - " . htmlspecialchars($row['Ora_fine']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Aula']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Descrizione']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['corso']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['professore']) . " " . htmlspecialchars($row['cognome']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Nessuna lezione trovata</td></tr>";
                    }

                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <div>
        <br>
        <br>
        <form action="prenotazione.php" method="post">
            <label for="lesson-number">Digita il numero della lezione a cui vuoi partecipare:</label><br>
            <input type="number" name="lesson-number" id="lesson-number">
            <button type="submit">Prenota</button>
        </form>
    </div>

    <div>
        <br>
        <br>
        <a href="areaPersonale.php">Area Personale</a>
    </div>
</body>
</html>
