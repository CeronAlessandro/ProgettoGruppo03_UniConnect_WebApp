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
            <th></th>
            <th>LEZIONE</th>
            <th>GIORNO</th>
            <th>ORARIO</th>
            <th>MASSIMO PARTECIPANTI</th>
            <tbody>
                <?php
                    include 'config.php';

                    $sql = "SELECT * FROM classes";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['day']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['capacity']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Nessuna lezione trovata</td></tr>";
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
            <label for="lesson-numer">Digita il numero della lezione a cui vuoi partecipare:</label><br>
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