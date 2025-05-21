<link rel="stylesheet" href="style.css">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="IMG/logo1.png" class="logo-navbar"> <!-- Immagine del logo -->
        </a>

        <!-- Bottone per espandere/collassare il menu in versione mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenuto del menu che viene mostrato/collassato -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Lista di link di navigazione, allineati a destra grazie a ms-auto -->
            <ul class="navbar-nav ms-auto">
                
                <!-- Link alla pagina dei corsi -->
                <li class="nav-item">
                    <a class="nav-link" href="corsi.php">Corsi</a>
                </li>

                <!-- Link alla sezione "Chi Siamo" nella homepage -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about">Chi Siamo</a>
                </li>

                <!-- Link alla sezione "Contatti" nella homepage -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php#contact">Contatti</a>
                </li>

                <!-- Icona dell'utente che rimanda all'area personale -->
                <li class="nav-item ms-2">
                    <div class="user-icon">
                        <a href="areaPersonale.php" class="user-icon text-decoration-none">
                            <i class="bi bi-person"></i> <!-- Icona profilo utente (Bootstrap Icons) -->
                        </a>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>
