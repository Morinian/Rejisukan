<?php
session_start();
include_once 'conexao.php';


?>
<!DOCTYPE html>
<html>
    <head>

    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Listagem de Alunos</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../elementos/img/logo.png" rel="icon">
  <link href="../elementos/img/logo.png" rel="apple-touch-icon">

   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../elementos/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../elementos/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../elementos/vendor/aos/aos.css" rel="stylesheet">
  <link href="../elementos/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../elementos/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Arquivo CSS -->
  <link href="../elementos/css/estilo.css" rel="stylesheet">

  <!-- Grupo de TCC: Carolina Pereira, Gabriel Santos, Giovanna Araujo, Ninna Zago e Paula Martins-->

        <meta charset="UTF-8">
        <title>Aluno - Listar</title>
    </head>
    <body>
        <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

            <div class="container d-flex align-items-center justify-content-between">

            <a href="../areadoprofessor.html" class="logo d-flex align-items-center me-auto me-lg-0">
                <img src="../elementos/img/logo.png" alt="" id="logo" a="">
                <h1 id="logot"><strong>Resjisukan</strong></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                <li><a href="cadastroaluno.php">Cadastro Aluno</a></li>
                <li><a href="cadastroturma.php">Cadastro Turma</a></li>
                <li><a href="cadastroprof.php">Cadastro Professor</a></li>

                <li class="dropdown"><a href="#dojos"><span>Listas</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="listaraluno.php">Aluno</a></li>
                  <li><a href="listarprof.php">Professor</a></li>
                  <li><a href="listarturma.php">Turmas</a></li>
              </ul>
          </li>

                </ul>
            </nav>

            <a class="btn-login" href="sair.php">Sair</a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

            </div>

</header>
<!-- Fim do Header -->

        <a href="cadastro.php">Cadastrar</a><br>
        <h1>Listar</h1>

        <link href="../elementos/css/estilo.css" rel="stylesheet"> 
        
         <!-- ======= Contact Section ======= -->
         <section id="contato" class="contato">
          <div class="container" data-aos="fade-up">
    
            <div class="section-header">
              <p><span>Listagem de Alunos</span></p>
            </div> 



   

                <?php
              


                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                
                //Receber o número da página
                $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
                $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                //var_dump($pagina);

                //Setar a quantidade de registros por página
                $limite_resultado = 2;

                // Calcular o inicio da visualização
                $inicio = ($limite_resultado * $pagina) - $limite_resultado;


                $query_usuarios = "SELECT alu_id, alu_cpf, alu_nome, alu_email FROM aluno ORDER BY alu_id DESC LIMIT $inicio, $limite_resultado";
                $result_usuarios = $connect->prepare($query_usuarios);
                $result_usuarios->execute();

                if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
                    while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
                        //var_dump($row_usuario);
                        extract($row_usuario);
                        //echo "ID: " . $row_usuario['id'] . "<br>";

                        echo "
                        <div class=container data-aos=fade-up>

                        <div class=col-md-6>

                          <div class=info-item d-flex align-items-center>
                            <i></i>
                            <div>
                              <h3>$alu_nome</h3>
                              <p>CPF: $alu_cpf</p>
                              <p>Email: $alu_email</p>
                            
                        
                        <a href='visualizar.php?alu_id=$alu_id'>Visualizar</a>&nbsp&nbsp&nbsp&nbsp
                        <a href='editaraluno.php?alu_id=$alu_id'>Editar</a><br></div>
                        
                        </div>
                        </div> 
                        </div>
                        <hr>";
                    }

                    //Contar a quantidade de registros no BD
                    $query_qnt_registros = "SELECT COUNT(alu_id) AS num_result FROM aluno";
                    $result_qnt_registros = $connect->prepare($query_qnt_registros);
                    $result_qnt_registros->execute();
                    $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

                    //Quantidade de página
                    $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

                    // Maximo de link
                    $maximo_link = 2;

                    echo " <div class=section-header><a href='listaraluno.php?page=1'>Primeira&nbsp&nbsp&nbsp</a>";

                    for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
                        if ($pagina_anterior >= 1) {
                            echo "<a href='listaraluno.php?page=$pagina_anterior'>$pagina_anterior</a> ";
                        }
                    }

                    echo "$pagina ";

                    for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
                        if ($proxima_pagina <= $qnt_pagina) {
                            echo "<a href='listaraluno.php?page=$proxima_pagina'>&nbsp$proxima_pagina</a>";
                        }
                    }

                    echo "<a href='listaraluno.php?page=$qnt_pagina'>&nbsp&nbsp&nbspÚltima</a></div>";
                } else {
                    echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
                }
                ?>
                
                
    
        <!-- ======= Footer ======= -->
        </div>
              
      
        </div>
        
        
        </section>

 <footer id="footer" class="footer">


<div class="container">

  <div class="row gy-12">

    <div class="col-lg-5 col-md-6 d-flex"></div>


    <div class="col-lg-2 col-md-6 footer-links">

      <p id="pfooter"><strong> Desenvolvido por CGGNP</strong><br><br> Siga-nos</p>


      <!-- Botões do Footer -->

      <div class="social-links d-flex">
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="youtube"><i class="bi bi-youtube"></i></a>
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="github"><i class="bi bi-github"></i></a>
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

<script src="../elementos/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../elementos/vendor/aos/aos.js"></script>
<script src="../elementos/vendor/glightbox/js/glightbox.min.js"></script>
<script src="../elementos/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../elementos/vendor/swiper/swiper-bundle.min.js"></script>
<script src="../elementos/vendor/php-email-form/validate.js"></script>


<!-- Template Main JS File -->

<script src="../elementos/js/main.js"></script>
    </body>
</html>