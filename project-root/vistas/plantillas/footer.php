<footer class="footer bg-dark text-light position-relative">
    <div class="wave-container">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,60 C100,90 200,30 300,60 C400,90 500,30 600,60 C700,90 800,30 900,60 C1000,90 1100,30 1200,60 L1200,0 L0,0 Z" fill="white" />
        </svg>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,60 C100,90 200,30 300,60 C400,90 500,30 600,60 C700,90 800,30 900,60 C1000,90 1100,30 1200,60 L1200,0 L0,0 Z" fill="white" />
        </svg>
    </div>

    <div class="container mt-5 footer-content">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>Perfect Vibes</h5>
                <p>Villeta - La Vega</p>
                <p>Phone: <a href="https://wa.me/573212343673?text=Hola%20necesito%20asesor%C3%ADa,%20en%20Perfect%20Vides..." class="text-what">+57 321 2343673</a></p>
                <p>Email: perfectvibes24@gmail.com</p>
                <div class="social-icons">
                    <a href="#" class="text-light"><i class="bi bi-WhatsApp"></i></a>
                    <a href="https://www.facebook.com/share/RFU2mMhGWBgKT755/?mibextid=LQQJ4d" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/perfect_vides/profilecard/?igsh=MTVhanJ0NDZ1Yndm" class="text-light"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="/project-root/public/index.php" class="text-light">Inicio</a></li>
                    <li><a href="/project-root/public/nosotros.php" class="text-light">Nosotros</a></li>
                    <li><a href="/project-root/public/productos.php" class="text-light">Productos</a></li>
                    <li><a href="/project-root/public/servicios.php" class="text-light">Servicios</a></li>
                    <li><a href="/project-root/public/contacto.php" class="text-light">Contacto</a></li>
                </ul>
            </div>
            <div class="text-center mt-4">
                <p>© Copyright</p>
                <p>Designed by <a href="#" class="text-light">Perfect Vibes</a></p>
            </div>
        </div>
    </div>
</footer>

<style>
    .wave-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 120px;
        overflow: hidden;
        z-index: 0;
    }

    .waves {
        width: 200%; /* Ancho extendido */
        height: 100%;
        position: absolute; /* Para superponer las olas */
    }

    .waves:nth-child(1) {
        animation: waveAnimation 6s infinite linear;
        top: 0; /* Ajuste para la primera ola */
    }

    .waves:nth-child(2) {
        animation: waveAnimation 6s infinite linear;
        top: 10px; /* Ajuste para la segunda ola */
        opacity: 0.5; /* Para agregar profundidad */
    }

    @keyframes waveAnimation {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%); /* Se repite suavemente */
        }
    }

    .footer {
        padding-top: 100px;
        position: relative;
        z-index: 1;
    }

    .footer-content {
        position: relative;
        z-index: 2;
    }
</style>
