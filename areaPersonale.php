<?php 
    // Avvia la sessione per gestire l'autenticazione utente
    session_start();

    // Controlla se l'utente è loggato
    if(isset($_SESSION['id'])):
        // Connessione al database
        include 'config.php';

        // Query per ottenere il numero di corsi e i nomi della facoltà e dell'università
        $sql = "SELECT 
                    u.Nome AS nome_universita,
                    f.Nome AS nome_facolta,
                    COUNT(c.ID) AS numero_corsi
                FROM studente s
                JOIN facolta f ON s.ID_facolta = f.ID
                JOIN universita u ON f.ID_universita = u.ID
                JOIN corso c ON c.ID_facolta = f.ID
                WHERE s.ID = ". $_SESSION['id'] . "
                GROUP BY u.Nome, f.Nome;";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
        $numeroCorsi = $row['numero_corsi'];
        $nomeUniversita = $row['nome_universita'];
        $nomeFacolta = $row['nome_facolta'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniCorsi - Area Personale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
</head>
<body>
    <!-- Include la barra di navigazione da file esterno -->
    <?php include 'navbar.php'; ?>

    <!-- Intestazione del profilo -->
    <section class="profile-header pt-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center mb-4">
                    <div class="profile-avatar mx-auto">
                        <i class="bi bi-person-circle"></i> <!-- Icona utente -->
                    </div>
                    <?php
                        echo "<h1 class=\"profile-name mt-3\">" . htmlspecialchars($_SESSION['nome']) . " " . htmlspecialchars($_SESSION['cognome']) . "</h1>";
                        echo "<p class=\"profile-role\">Studente di " . htmlspecialchars($nomeFacolta) . "</p>";
                        echo "<p class=\"profile-university\">" . htmlspecialchars($nomeUniversita) . "</p>";
                        ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione con le informazioni personali -->
    <section class="user-info-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="user-info-card">
                        <h2 class="section-title mb-4">Le Mie Informazioni</h2>

                        <!-- Email -->
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Email:</p>
                            </div>
                            <div class="col-md-8">
                                <?php
                                    echo "<p class=\"info-value\">" . htmlspecialchars($_SESSION['email']) . "</p>";
                                ?>
                            </div>
                        </div>

                        <!-- Matricola -->
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Matricola:</p>
                            </div>
                            <div class="col-md-8">
                                <?php
                                    echo  "<p class=\"info-value\">". htmlspecialchars($_SESSION['id'])."</p>";
                                ?>
                            </div>
                        </div>

                        <!-- Anno di corso
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Anno di corso:</p>
                            </div>
                            <div class="col-md-8">
                                <?php
                                    // // Query per calcolare da quanto tempo lo studente è iscritto in anni
                                    // $sql = "SELECT";
                                    // $result = $conn->query($sql);

                                    // $row = $result->fetch_assoc();
                                    // $numeroCorsi = $row['numero_corsi'];
                                    // //echo "<p class=\"info-value\">".htmlspecialchars($anno_corso). "</p>";
                                ?>
                            </div>
                        </div> -->

                        <!-- Corso di laurea -->
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Corso di laurea:</p>
                            </div>
                            <div class="col-md-8">
                                <?php
                                    echo "<p class=\"profile-role\">Laurea in  " . htmlspecialchars($nomeFacolta) . "</p>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione riepilogo attività -->
    <section class="stats-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="stats-card">
                        <h2 class="section-title mb-4">Riepilogo Attività</h2>

                        <div class="row g-4">
                            <!-- Corsi iscritti -->
                            <div class="col-md-4">
                                <div class="stat-item text-center">
                                    <div class="stat-icon">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <?php
                                        echo "<h3 class=\"stat-number\">" . $numeroCorsi . "</h3>";
                                    ?>
                                    <p class="stat-label">Corsi Iscritti</p>
                                </div>
                            </div>

                            <!-- Appunti condivisi -->
                            <div class="col-md-4">
                                <div class="stat-item text-center">
                                    <div class="stat-icon">
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                    <?php
                                        // Query per ottenere il numero di appunti caricati
                                        $sql = "SELECT COUNT(*) AS numero_appunti
                                                FROM nota AS n
                                                WHERE n.ID = ". $_SESSION['id'] . ";";
                                        $result = $conn->query($sql);

                                        $row = $result->fetch_assoc();
                                        echo "<h3 class=\"stat-number\">" . $row['numero_appunti'] . "</h3>";
                                    ?>
                                    <p class="stat-label">Appunti Condivisi</p>
                                </div>
                            </div>

                            <!-- CFU totali ottenuti -->
                            <div class="col-md-4">
                                <div class="stat-item text-center">
                                    <div class="stat-icon">
                                        <i class="bi bi-download"></i>
                                    </div>
                                    <?php
                                        // Query per ottenere il numero di appunti caricati
                                        $sql = "SELECT SUM(c.CFU_totali) AS totale_cfu
                                                FROM studente s
                                                JOIN facolta f ON s.ID_facolta = f.ID
                                                JOIN corso c ON c.ID_facolta = f.ID
                                                WHERE s.ID = ". $_SESSION['id'] . ";";
                                        $result = $conn->query($sql);

                                        $row = $result->fetch_assoc();
                                        echo "<h3 class=\"stat-number\">" . $row['totale_cfu'] . "</h3>";
                                    ?>
                                    <p class="stat-label">CFU Ottenuti</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione per azioni sull'account -->
    <section class="account-actions-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="actions-card">
                        <h2 class="section-title mb-4">Gestione Account</h2>

                        <div class="row mb-4">
                            <!-- Modifica profilo -->
                            <div class="col-md-6 mb-3 mb-md-0">
                                <a href="#" class="btn btn-outline-primary d-block"><i class="bi bi-pencil me-2"></i>Modifica Profilo</a>
                            </div>
                            <!-- Cambia password -->
                            <div class="col-md-6">
                                <a href="#" class="btn btn-outline-primary d-block"><i class="bi bi-shield-lock me-2"></i>Cambia Password</a>
                            </div>
                        </div>

                        <!-- Logout -->
                        <div class="logout-container text-center mt-4">
                            <a href="logout.php" class="btn btn-danger btn-lg logout-btn"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include il footer da file esterno -->
    <?php include 'footer.php'; ?>

    <!-- Script per le animazioni -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Anima la navbar
            gsap.from('.navbar', { duration: 1, y: -50, opacity: 0, ease: 'power3.out' });

            // Anima avatar e nome
            gsap.from('.profile-avatar', { duration: 1, scale: 0.5, opacity: 0, delay: 0.2, ease: 'back.out(1.7)' });
            gsap.from('.profile-name', { duration: 0.8, y: 30, opacity: 0, delay: 0.5, ease: 'power3.out' });
            gsap.from('.profile-role, .profile-university', { duration: 0.8, y: 20, opacity: 0, delay: 0.7, ease: 'power3.out' });

            // Anima statistiche con anime.js
            anime({
                targets: '.stat-item',
                translateY: [50, 0],
                opacity: [0, 1],
                delay: anime.stagger(100),
                easing: 'easeOutQuad',
                duration: 800
            });

            // Funzione per animare elementi quando entrano nello schermo
            const animateOnScroll = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('user-info-card')) {
                            gsap.from(entry.target, { duration: 0.8, x: -50, opacity: 0, ease: 'power3.out' });
                        } else if (entry.target.classList.contains('stats-card')) {
                            gsap.from(entry.target, { duration: 0.8, x: 50, opacity: 0, ease: 'power3.out' });
                        } else if (entry.target.classList.contains('actions-card')) {
                            gsap.from(entry.target, { duration: 0.8, y: 50, opacity: 0, ease: 'power3.out' });
                        }
                        // Una volta animato, non viene più osservato
                        observer.unobserve(entry.target);
                    }
                });
            };

            // Inizializza IntersectionObserver
            const observer = new IntersectionObserver(animateOnScroll, {
                root: null,
                threshold: 0.1 // L'elemento deve essere visibile almeno al 10%
            });

            // Aggiunge all'osservazione le sezioni animate
            document.querySelectorAll('.user-info-card, .stats-card, .actions-card').forEach(element => {
                observer.observe(element);
            });

            // Anima il pulsante di logout
            anime({
                targets: '.logout-btn',
                scale: [1, 1.05, 1],
                opacity: [0, 1],
                easing: 'easeOutElastic(1, .8)',
                duration: 1200,
                delay: 1000
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    // Se la sessione non è valida, reindirizza al login
    else:
        header('Location: login.php');
        exit;
    endif;
?>
