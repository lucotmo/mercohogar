<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="icon" href="views/img/ConstructoraPotencial.ico"/> -->
  <title>Mercohogar</title>
  <meta name="description" content="Empresa de venta de productos"/>
  <meta name="keywords" content="constructora potencial, construcción, arriendo, venta">
	<meta name="author" content="Luis Carlos Otero Montoya">
	<meta name="owner" content="Mercohogar">
	<meta name="robots" content="index, follow">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,900|Russo+One" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="views/css/sweetalert.css"/>
  <link rel="stylesheet" href="views/css/style.css"/>
  <link rel="icon" href="views/imagenes/icono.png">

  <script src="views/js/jquery.js"></script>
  <script src="views/js/sweetalert.min.js"></script>
</head>
<body>




<!--=====================================
CONTENT
======================================-->

<?php

  $modulos = new Enlaces();
  $modulos -> enlacesController();

?>

</main>

<!--====  Fin de CONTENT  ====-->



<!--=====================================
FOOTER
======================================-->

<footer class="Footer">
  <div class="footer-redes"><a class="footer__link-social" href="#"><img class="footer__img-social" src="views/imagenes/facebook.svg" alt="facebook"></a><a class="footer__link-social" href="#"><img class="footer__img-social" src="views/imagenes/instagram.svg" alt="instagram"></a><a class="footer__link-social" href="#"><img class="footer__img-social" src="views/imagenes/vimeo.svg" alt="vimeo"></a></div>
  <div class="footer-content">
    <div class="links">
      <h3 class="footer__title">Links</h3>
      <ul class="links__content">
        <!-- <li class="link_item__item">
          <li class="link_item"><a class="link__link" href="">frutas</a></li>
          <li class="link_item"><a class="link__link" href="">Verduras</a></li>

        </li>
        <li class="link_item__item">
          <li class="link_item"><a class="link__link" href="">Promociones</a></li>
          <li class="link_item"><a class="link__link" href="">Comó pedir</a></li>
        </li>
        <li class="link_item__item">
          <li class="link_item"><a class="link__link" href="">Nuestros clientes</a></li>
          <li class="link_item"><a class="link__link" href="">¡Afiliate!</a></li>

        </li> -->
      </ul>
    </div>
    <div class="contactanos">
      <h3 class="footer__title">Contáctanos</h3>
      <div class="contactanos__info"><span>Bucaramanga, Colombia</span><span>Email: ventas@mercohogar.com</span><span>Teléfonos: (7)6314762 | 318 222 0604</span></div>
    </div>
    <div class="horarios">
      <h3 class="footer__title">Horarios de atención</h3>
      <div class="horario__info"><span>Lunes a Sábado</span><span>7:00 am – 9:00 pm</span>
        <div class="termin"><a class="termin__link" href="">Términos y condiciones</a><a class="termin__link" href="">Políticas y privacidad</a></div>
      </div>
    </div><a class="logo-container" href="./"><img class="Logo" src="views/imagenes/logo-mercohogar.svg"></a>
  </div>
</footer>

<!--====  Fin de FOOTER  ====-->

<script src="views/js/script.js"></script>
</body>
</html>