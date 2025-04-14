<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UniConnect</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>  
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Uniconnect</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php 
                session_start();
                if(isset($_SESSION['nome']) && isset($_SESSION['cognome'])): ?>
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                    <h4>Ciao, <?php echo htmlspecialchars($_SESSION['nome']) . ' ' . htmlspecialchars($_SESSION['cognome']); ?>!</h1>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                    <a class="nav-link" href="register.php">Registrati</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Cerca Appunti" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
        </nav>
    
        <div class="center-container d-flex justify-content-center gap-4 my-5">

        <div class="card" style="width: 18rem;">
            <img src="IMG/lessonsCalendar.png" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Calendario Lezioni</h5>
                <a href="lessonsCalendar.php" class="btn btn-primary">Le tue prossime lezioni</a>
            </div>
        </div>
        
        <div class="card" style="width: 18rem;">
            <img src="IMG/upload.webp" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Carica i tuoi appunti!</h5>
                <a href="upload.php" class="btn btn-primary">Upload Appunti</a>
            </div>
        </div>
    
        <div class="card" style="width: 18rem;">
            <img src="IMG/writing.jpg" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Scrivi i tuoi appunti!</h5>
                <a href="textEditor.php" class="btn btn-primary">Apri Text Editor</a>
            </div>
        </div>
        </div>
    
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
    </html>