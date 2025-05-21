<?php 
    // Avvia la sessione per gestire l'autenticazione utente
    session_start();

    // Controlla se l'utente è loggato
    if(isset($_SESSION['id'])):
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniCorsi - Area Personale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="areaPersonaleStyle.css">
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
                    <h1 class="profile-name mt-3">Marco Rossi</h1>
                    <p class="profile-role">Studente di Ingegneria Informatica</p>
                    <p class="profile-university">Università di Milano</p>
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
                                <p class="info-value">marco.rossi@studenti.unimi.it</p>
                            </div>
                        </div>

                        <!-- Matricola -->
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Matricola:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="info-value">845721</p>
                            </div>
                        </div>

                        <!-- Anno di corso -->
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Anno di corso:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="info-value">3° anno</p>
                            </div>
                        </div>

                        <!-- Corso di laurea -->
                        <div class="info-group row mb-3">
                            <div class="col-md-4">
                                <p class="info-label">Corso di laurea:</p>
                            </div>
                            <div class="col-md-8">
                                <p class="info-value">Laurea in Ingegneria Informatica</p>
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
                                    <h3 class="stat-number">12</h3>
                                    <p class="stat-label">Corsi Iscritti</p>
                                </div>
                            </div>

                            <!-- Appunti condivisi -->
                            <div class="col-md-4">
                                <div class="stat-item text-center">
                                    <div class="stat-icon">
                                        <i class="bi bi-pencil-square"></i>
                                    </div>
                                    <h3 class="stat-number">24</h3>
                                    <p class="stat-label">Appunti Condivisi</p>
                                </div>
                            </div>

                            <!-- Download effettuati -->
                            <div class="col-md-4">
                                <div class="stat-item text-center">
                                    <div class="stat-icon">
                                        <i class="bi bi-download"></i>
                                    </div>
                                    <h3 class="stat-number">156</h3>
                                    <p class="stat-label">Download</p>
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
