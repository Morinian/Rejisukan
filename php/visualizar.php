<?php
session_start();
ob_start();
include_once 'conexao.php';

$alu_id = filter_input(INPUT_GET, "alu_id", FILTER_SANITIZE_NUMBER_INT);

if (empty($alu_id)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: listaraluno.php");
    exit();
}
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

        <h1>Visualizar Dados</h1>


        <div class="text-center">
        <?php

        $query_usuario = "SELECT alu_id, alu_cpf, alu_nome, alu_email, alu_rg, alu_nasc, alu_tele, alu_cep, alu_rua, alu_ba, 
        alu_cid, alu_num, alu_comp FROM aluno WHERE alu_id = $alu_id LIMIT 1";

        $result_usuario = $connect->prepare($query_usuario);
        $result_usuario->execute();

        if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            extract($row_usuario);
            //echo "ID: " . $row_usuario['id'] . "<br>";          
            echo"<br><br><br>";  
            echo " <div class=section-header><p>Aluno: <span>$alu_nome </span><br></p></div>";
            echo "<div class=container data-aos=fade-up><b>CPF:</b> $alu_cpf <br>";
            echo "<b>E-mail:</b> $alu_email <br>";
            echo "<b>RG:</b> $alu_rg <br>";
            echo "<b>Nascimento:</b> $alu_nasc <br>";
            echo "<b>Telefone:</b> $alu_tele <br>";
            echo "<b>CEP:</b> $alu_cep <br>";
            echo "<b>Rua:</b> $alu_rua <br>";
            echo "<b>Bairro:</b> $alu_ba <br>";
            echo "<b>Cidade:</b> $alu_cid <br>";
            echo "<b>Número casa:</b> $alu_num <br>";
            echo "<b>Complemento:</b> $alu_comp <br>";
            echo"<br><br>"; 
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
            header("Location: listaraluno.php");
        }

        $query_usuario = "SELECT alu_id, resp_cpf, resp_nome, resp_rg, resp_nasc,resp_email FROM responsavel WHERE alu_id = $alu_id LIMIT 1";

        $result_usuario = $connect->prepare($query_usuario);
        $result_usuario->execute();

        if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            extract($row_usuario);
            //echo "ID: " . $row_usuario['id'] . "<br>";       
            
            echo "<h3>Responsável</h3>";
            echo "Nome: $resp_nome <br>";
            echo "cpf: $resp_cpf <br>";
            echo "RG: $resp_rg <br>";
            echo "Data de nascimento: $resp_nasc <br>";
            echo "Email: $resp_email <br>";
            echo"<br><br>"; 

        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Responsavel não encontrado!</p>";
        }
        $query_usuario = "SELECT alu_id, med_sang, med_aler, med_dcro, med_medic, med_pcd FROM dados_medicos WHERE alu_id = $alu_id LIMIT 1";

        $result_usuario = $connect->prepare($query_usuario);
        $result_usuario->execute();

        if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            extract($row_usuario);
            //echo "ID: " . $row_usuario['id'] . "<br>";       
            
            echo "<h3>Dados Médico</h3>";
            echo "Tipo Sanguíneo: $med_sang <br>";
            echo "Possui Alergia: $med_aler <br>";
            echo "Possui Doenças Crônicas: $med_dcro <br>";
            echo "Uso de Medicamentos: $med_medic <br>";
            echo "É PCD: $med_pcd <br>";
            echo"<br><br>"; 

        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Dados médicos não encontrado!</p>";
        }
        $query_usuario = "SELECT t.turma_nome, a.alu_id, t.turma_id FROM turma t INNER JOIN dados_atleta a ON t.turma_id = a.turma_id and alu_id=$alu_id LIMIT 1";

        $result_usuario = $connect->prepare($query_usuario);
        $result_usuario->execute();

        if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);
            extract($row_usuario);
            //echo "ID: " . $row_usuario['id'] . "<br>";       
            
            echo "<h3>Dados Turma</h3>";
            echo "Turma: $turma_nome <br>";
            echo"<br><br>"; 

        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Dados Atleta não encontrado!</p>";
        }

        if(isset($_SESSION['msg'])){
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
      }
        ?>

    </div>



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