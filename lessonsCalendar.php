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
            <th>ORA INIZIO</th>
            <th>ORA FINE</th>
            <tbody>
                <?php
                    include 'config.php';

                    $sql = "SELECT * FROM lezione";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Titolo']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Data']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Ora_inizio']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Ora_fine']) . "</td>";
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
        <a href="areaPersonale.php">Area Personale</a>
    </div>
</body>
</html>