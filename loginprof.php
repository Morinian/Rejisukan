<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rejisukan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="elementos/img/logo.png" rel="icon">
  <link href="elementos/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

  <!-- Vendor CSS Arquivos -->
  <link href="elementos/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="elementos/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="elementos/vendor/aos/aos.css" rel="stylesheet">
  <link href="elementos/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="elementos/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Arquivo CSS -->
  <link href="elementos/css/estilo.css" rel="stylesheet">


  <!-- Grupo de TCC: Carolina Pereira, Gabriel Santos, Giovanna Araujo, Ninna Zago e Paula Martins-->


</head>

<body>



 <!-- ======= Header ======= -->


 <header id="header" class="header fixed-top d-flex align-items-center">

<div class="container d-flex align-items-center justify-content-between">

  <a href="#home" class="logo d-flex align-items-center me-auto me-lg-0">
    <img src="elementos/img/logo.png" alt="" id="logo" a="">
    <h1 id="logot"><strong>Resjisukan</strong></h1>
  </a>

  <nav id="navbar" class="navbar">
    <ul>
      <li><a href="index.php#home">Home</a></li>
      <li><a href="index.php#sobrenos">Sobre Nós</a></li>
      <li><a href="index.php#gallery">Galeria</a></li>
      <li><a href="index.php#sensei">Sensei</a></li>
      <li class="dropdown"><a href="index.php#dojos"><span>Dojo's</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
              <li><a href="elementos/html/sede.html">Sede</a></li>
              <li><a href="elementos/html/maisenergia.html">Acadameia +Energia</a></li>
              <li><a href="elementos/html/academiavfitsp.html">Academia Vfitsp</a></li>
              <li><a href="elementos/html/shoppingboavista.html">Boavista Shopping</a></li>
              <li><a href="elementos/html/ceuguarapiranga.html">CEU Guarapiranga</a></li>
          </ul>
      </li>
      <li><a href="#contato">Contato</a></li>

      <li class="dropdown"><a class="btn-login" href="">Login<i class="bi bi-chevron-down dropdown-indicator"></i></a>
          <ul>
              <li><a href="loginaluno.php">Aluno</a></li>
              <li><a href="loginprof.php">Professor</a></li>
          </ul>
      </li>

    </ul>
  </nav>
  
  <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
  <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

</div>

</header>


<!-- Fim do Header -->
    

    <!-- ======= Login ======= -->

    <br>

    <section id="login" class="login">


      <div class="container" data-aos="fade-up">


        <div class="section-header">

          <h2>Login</h2>
          <a><p>Professor, Faça Seu <span>Login</span> </p></a>

        </div>

        <div class="container-fluid">


          <div class="row no-gutter">

              <div class="col-md-6 d-none d-md-flex bg-image"></div>
      

              <div class="col-md-6 bg-light">

                  <div class="login d-flex align-items-center py-5">
      
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-10 col-xl-7 mx-auto">

                                  <h3 class="display-4">Login</h3>
                                  <p class="text-muted mb-4">Professor, Use Cpf e Senha Para Logar</p>

                                  <?php
                                      if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);			
                                      }
                                      if(isset($_SESSION['msgcad'])){
                                        echo $_SESSION['msgcad'];
                                        unset($_SESSION['msgcad']);
                                      }
                                    ?>

                                  <form action="php/validacaoprof.php" method="post">

                                    <fieldset>
                                      <div class="form-group mb-3">
                                          <input id="inputEmail" name="usuario" type="CPF" placeholder="CPF" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                      </div>

                                      <div class="form-group mb-3">
                                          <input id="inputPassword" name="senha" type="password" placeholder="Senha" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                      </div>
                                      
                                      <button id="btnlogin" type="submit" name="acessar" value="acessar" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Entrar</button>
                                      
                                    <fieldset>
                                  </form>

                              </div>
                          </div>
                      </div>
      
                  </div>

              </div>
      
          </div>

      </div>

          </div>

        </div>

      </div>


    </section>
    
    
    <!-- Fim do Login -->



  </main>
  


 <!-- ======= Footer ======= -->


 <footer id="footer" class="footer">


  <div class="container">

    <div class="row gy-12">

      <div class="col-lg-5 col-md-6 d-flex"></div>


      <div class="col-lg-2 col-md-6 footer-links">

        <p id="pfooter"><strong>Desenvolvido por CGGNP </strong><br><br> Siga-nos</p>


        <!-- Botões do Footer -->

        <div class="social-links d-flex">
          <a href="https://www.instagram.com/cggnp/" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.youtube.com/@cggnp" class="youtube"><i class="bi bi-youtube"></i></a>
          <a href="https://github.com/CGGNP/TCC.git" class="github"><i class="bi bi-github"></i></a>
        </div>

      </div>

    </div>

  </div>


  <div class="container">
    
    <div class="copyright">
      &copy; Copyright <strong><span>Rejisukan</span></strong>. Todos Direitos Reservados.
    </div>

  </div>

</footer>

<!-- Fim do Footer -->



<!-- Botão - Topo da Página -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>



  <!-- Vendor JS Files -->

  <script src="elementos/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="elementos/vendor/aos/aos.js"></script>
  <script src="elementos/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="elementos/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="elementos/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="elementos/vendor/php-email-form/validate.js"></script>



  <!-- Template Main JS File -->

  <script src="elementos/js/main.js"></script>



</body>

</html>