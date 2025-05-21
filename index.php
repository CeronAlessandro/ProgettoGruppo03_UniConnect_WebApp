<!DOCTYPE html>
<html lang="it"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.1/lib/anime.min.js"></script>
</head>
<body>
    <!-- Inclusione della navbar da un file PHP esterno -->
    <?php include 'navbar.php'; ?>

    <!-- Sezione Hero: immagine + slogan principale -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Testo a sinistra -->
                <div class="col-lg-6 hero-text">
                    <h1 class="display-4 fw-bold hero-title">L'Università<br>a portata di mano</h1>
                    <p class="lead hero-subtitle">Accedi a tutti i tuoi corsi, scarica appunti e collabora con i tuoi compagni di classe da qualsiasi dispositivo.</p>
                    <div class="hero-cta">
                        <?php
                            session_start(); // Inizia la sessione
                            // Se l'utente è loggato, vai ai corsi
                            if(isset($_SESSION['id'])){
                                echo '<a href="corsi.php" class="btn btn-primary btn-lg me-3">Inizia Ora</a>';
                            }else{ // Altrimenti, mostra il login
                                echo '<a href="login.php" class="btn btn-primary btn-lg me-3">Inizia Ora</a>';
                            }
                        ?>
                        <!-- Link per scoprire di più -->
                        <a href="#features" class="btn btn-outline-primary btn-lg">Scopri di più</a>
                    </div>
                </div>

                <!-- Immagine a destra -->
                <div class="col-lg-6 hero-image">
                    <img src="IMG/Index5.jpeg" alt="Studenti universitari con laptop" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione Features: caratteristiche principali -->
    <section class="features-section" id="features">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2>Perché Scegliere UniConnect</h2>
                <p class="text-muted">Una piattaforma pensata per migliorare l'esperienza di studio universitaria</p>
            </div>
            <div class="row g-4 features-container">
                <!-- Feature 1 -->
                <div class="col-md-4 feature-item">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3>Tutti i Corsi in un Unico Posto</h3>
                        <p>Accedi a tutti i tuoi corsi universitari da un'unica piattaforma intuitiva ed elegante.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-4 feature-item">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h3>Appunti Condivisi</h3>
                        <p>Carica, scarica e condividi appunti delle lezioni con i tuoi compagni di corso.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-4 feature-item">
                    <div class="feature-card text-center p-4 h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-bell"></i>
                        </div>
                        <h3>Notifiche in Tempo Reale</h3>
                        <p>Ricevi notifiche su nuovi materiali, lezioni e scadenze per non perdere mai nulla.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione About: informazioni sulla piattaforma -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="row align-items-center">
                <!-- Immagine -->
                <div class="col-lg-6 about-image">
                    <img src="IMG/Index2.jpeg" alt="Studente che studia" class="img-fluid rounded shadow-lg">
                </div>

                <!-- Testo -->
                <div class="col-lg-6 about-text">
                    <h2>Una Piattaforma per Tutte le Università Italiane</h2>
                    <p class="lead">UniConnect è la prima piattaforma che unisce studenti e docenti di tutte le università italiane in un unico ecosistema digitale.</p>
                    <ul class="about-list">
                        <li><i class="bi bi-check-circle-fill"></i> Interfaccia semplice e intuitiva</li>
                        <li><i class="bi bi-check-circle-fill"></i> Compatibile con tutti i dispositivi</li>
                        <li><i class="bi bi-check-circle-fill"></i> Integrazione con i sistemi universitari esistenti</li>
                        <li><i class="bi bi-check-circle-fill"></i> Supporto per videolezioni e contenuti multimediali</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Sezione Download App -->
    <section class="download-section">
        <div class="container text-center">
            <div class="download-content">
                <h2>Porta UniConnect sempre con te</h2>
                <p class="lead mb-4">Scarica l'app mobile per accedere ai tuoi corsi anche in movimento</p>
                
                <!-- Pulsante per scaricare l'app -->
                <div class="app-buttons">
                    <a href="#" class="btn btn-dark btn-lg google-play">
                        <i class="bi bi-google-play me-2"></i>Google Play
                    </a>
                </div>

                <!-- Immagine dell'app -->
                <div class="app-image mt-5">
                    <img src="IMG/Index4.jpeg" alt="App mobile" class="img-fluid rounded mobile-app-preview">
                </div>
            </div>
        </div>
    </section>

    <!-- Inclusione del footer -->
    <?php include 'footer.php'; ?>

    <!-- Script di animazione con GSAP e Anime.js -->
    <script>
        // Quando il DOM è pronto
        document.addEventListener('DOMContentLoaded', function() {
            // Animazioni GSAP per la navbar e hero section
            gsap.from('.navbar', { duration: 1, y: -50, opacity: 0, ease: 'power3.out' });
            gsap.from('.hero-title', { duration: 1, y: 50, opacity: 0, delay: 0.2, ease: 'power3.out' });
            gsap.from('.hero-subtitle', { duration: 1, y: 50, opacity: 0, delay: 0.4, ease: 'power3.out' });
            gsap.from('.hero-cta', { duration: 1, y: 50, opacity: 0, delay: 0.6, ease: 'power3.out' });
            gsap.from('.hero-image img', { duration: 1.5, x: 100, opacity: 0, delay: 0.4, ease: 'power3.out' });

            // Animazione con Anime.js per le feature
            anime({
                targets: '.feature-item',
                translateY: [100, 0],
                opacity: [0, 1],
                delay: anime.stagger(200),
                easing: 'easeOutQuad',
                duration: 800
            });

            // Observer per animare elementi al momento della visualizzazione
            const animateOnScroll = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('about-text')) {
                            gsap.from(entry.target, { duration: 1, x: -50, opacity: 0, ease: 'power3.out' });
                        } else if (entry.target.classList.contains('about-image')) {
                            gsap.from(entry.target, { duration: 1, x: 50, opacity: 0, ease: 'power3.out' });
                        } else if (entry.target.classList.contains('download-content')) {
                            gsap.from(entry.target, { duration: 1, y: 50, opacity: 0, ease: 'power3.out' });
                        }
                        observer.unobserve(entry.target); // Interrompe l'osservazione dopo l'animazione
                    }
                });
            };

            // Impostazione dell'observer
            const observer = new IntersectionObserver(animateOnScroll, {
                root: null,
                threshold: 0.1
            });

            // Osserva gli elementi specificati
            document.querySelectorAll('.about-text, .about-image, .download-content').forEach(element => {
                observer.observe(element);
            });

            // Animazione dei pulsanti di download app
            anime({
                targets: '.app-buttons a',
                translateY: [20, 0],
                opacity: [0, 1],
                delay: anime.stagger(200),
                easing: 'easeOutQuad',
                duration: 800
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
