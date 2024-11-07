<?php
$titulo = "Inicio";
include __DIR__ . '/../vistas/plantillas/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>

    <!-- Fuente minimalista -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #EDF6F9;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background-color: #006D77;
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: 600; /* Resalta más el título */
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.5;
            font-weight: 300; /* Ligeramente más liviano que los títulos */
        }

        .btn-hero {
            background-color: #E29578;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 30px;
            font-size: 1.2rem;
            font-weight: 500; /* Estilo intermedio */
            transition: background-color 0.3s;
        }

        .btn-hero:hover {
            background-color: #83C5BE;
        }

        .content-section {
            padding: 60px 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .content-section h2 {
            color: #006D77;
            font-size: 2.8rem;
            font-weight: 600; /* Resalta más que el resto */
            margin-bottom: 30px;
            text-align: center;
        }

        .video-carousel {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 40px auto;
            position: relative;
            max-width: 80%;
            overflow: hidden;
        }

        .video-container {
            display: flex;
            justify-content: center;
            transition: transform 0.5s ease;
            width: 100%;
        }

        .video-carousel video {
            width: 12%;
            height: auto;
            margin: 0 5px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease-in-out;
            opacity: 0; /* Comienza invisible */
            transform: translateX(100%); /* Desplazamiento inicial */
        }

        .video-carousel video.active-video {
            opacity: 1;
            transform: translateX(0); /* Posición central */
        }

        /* Estilo de las flechas */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carousel-arrow:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .left-arrow {
            left: 10px;
        }

        .right-arrow {
            right: 10px;
        }
    </style>
</head>
<body>
    <section class="hero-section">
        <h1>Bienvenidos a Perfect Vibes</h1>
        <p>La marca más innovadora en cuidado y diseño de uñas.</p>
        <a href="productos.php" class="btn-hero">Conocer Más</a>
    </section>

    <section class="content-section">
        <h2>¿Quiénes somos?</h2>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">¿Quiénes somos?</h3>
                            <p class="card-text">
                                <strong>Perfect Vibes</strong> es un equipo apasionado que se dedica a transformar el cuidado y diseño de uñas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">¿Cómo lo hacemos?</h3>
                            <p class="card-text">
                                Utilizamos técnicas vanguardistas y productos de la más alta calidad.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">¿Por qué lo hacemos?</h3>
                            <p class="card-text">
                                Creemos en la autoexpresión y el poder del cuidado personal.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video-carousel">
        <button class="carousel-arrow left-arrow" onclick="prevVideo()">&#9664;</button>
        <div class="video-container">
            <video controls muted class="active-video">
                <source src="../public/videos/manicurevideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/productos2.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/maquillajevideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/pedicurevideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/productosvideo.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/manicure2.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <video controls muted>
                <source src="../public/videos/masaje.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
        </div>
        <button class="carousel-arrow right-arrow" onclick="nextVideo()">&#9654;</button>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const videos = document.querySelectorAll('.video-carousel video');
        let currentIndex = 0;

        function playVideo(index) {
            videos.forEach((video, i) => {
                if (i === index) {
                    video.classList.add('active-video');
                    video.style.opacity = 1; // Asegúrate de que el video activo sea visible
                    video.currentTime = 0; // Reinicia el tiempo del video
                    video.play(); // Reproduce el video
                } else {
                    video.classList.remove('active-video');
                    video.style.opacity = 0; // Oculta el video no activo
                    video.pause(); // Pausa el video
                }
            });
        }

        function nextVideo() {
            currentIndex = (currentIndex + 1) % videos.length; // Aumenta el índice
            playVideo(currentIndex);
        }

        function prevVideo() {
            currentIndex = (currentIndex - 1 + videos.length) % videos.length; // Disminuye el índice
            playVideo(currentIndex);
        }

        playVideo(currentIndex); // Reproducción automática del primer video
    </script>
</body>

<?php
include __DIR__ . '/../vistas/plantillas/footer.php';
?>
</html>
