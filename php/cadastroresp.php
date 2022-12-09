<?php
include_once 'conexao.php';

session_start();

$_SESSION['alu_cpf'] = $_POST['alu_cpf'];
$_SESSION['alu_nome'] = $_POST['alu_nome'];
$_SESSION['alu_email'] = $_POST['alu_email'];
$_SESSION['alu_senha'] = $_POST['alu_senha'];
$_SESSION['alu_rg'] = $_POST['alu_rg'];
$_SESSION['alu_nasc'] = $_POST['alu_nasc'];
$_SESSION['alu_tele'] = $_POST['alu_tele'];
$_SESSION['alu_cep'] = $_POST['alu_cep'];
$_SESSION['alu_rua'] = $_POST['alu_rua'];
$_SESSION['alu_ba'] = $_POST['alu_ba'];
$_SESSION['alu_cid'] = $_POST['alu_cid'];
$_SESSION['alu_num'] = $_POST['alu_num'];
$_SESSION['alu_comp'] = $_POST['alu_comp'];

if(!isset($_SESSION['alu_id']) and !isset($_SESSION['alu_cpf']) and !isset($_SESSION['alu_nome']) and !isset($_SESSION['alu_email'])
and !isset($_SESSION['alu_senha']) and !isset($_SESSION['alu_rg']) and !isset($_SESSION['alu_nasc']) and !isset($_SESSION['alu_tele'])
and !isset($_SESSION['alu_cep']) and !isset($_SESSION['alu_rua']) and !isset($_SESSION['alu_ba']) and !isset($_SESSION['alu_cid']) 
and !isset($_SESSION['alu_num']) and !isset($_SESSION['alu_comp'])) {

	session_destroy();
	echo"<meta http-equiv='refresh' content='0;url=cadastroaluno.php'>";
    exit;

}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cadastro do Responsável</title>
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

</head>

<body>
  
<?php

        //Receber os dados do formulário
        /*$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $conexao = mysqli_connect("localhost","root","","rejisukan");
        $sql = "select alu_id, alu_nome from aluno;";
        $result = mysqli_query($conexao, $sql);


        //Verificar se o usuário clicou no botão
        if (!empty($dados['CadUsuario'])) {
            //var_dump($dados);

            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } elseif (!filter_var($dados['resp_email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }


            if (!$empty_input) {

              $_SESSION['resp_cpf'] = $_POST['resp_cpf'];
              $_SESSION['resp_nome'] = $_POST['resp_nome'];
              $_SESSION['resp_rg'] = $_POST['resp_rg'];
              $_SESSION['resp_nasc'] = $_POST['resp_nasc'];
              $_SESSION['resp_email'] = $_POST['resp_email'];

                /*$query_usuario = "INSERT INTO responsavel (alu_id, resp_cpf, resp_nome, resp_rg, resp_nasc, resp_email) 
				        VALUES (:alu_id, :resp_cpf, :resp_nome, :resp_rg, :resp_nasc, :resp_email)";

                $cad_usuario = $connect->prepare($query_usuario);
                $cad_usuario->bindParam(':alu_id',$alu_id, PDO::PARAM_STR);
                $cad_usuario->bindParam(':resp_cpf', $dados['resp_cpf'], PDO::PARAM_STR);
			        	$cad_usuario->bindParam(':resp_nome', $dados['resp_nome'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':resp_rg', $dados['resp_rg'], PDO::PARAM_STR);
			        	$cad_usuario->bindParam(':resp_nasc', $dados['resp_nasc'], PDO::PARAM_STR);
			        	$cad_usuario->bindParam(':resp_email', $dados['resp_email'], PDO::PARAM_STR);
                $cad_usuario->execute();

                if ($cad_usuario->rowCount()) {
                    echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                    unset($dados);
                    header("Location: cadastromed.php");
                } else {
                    echo "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
                }
            }
        }*/
        ?>

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
    
        <section id="contato" class="contato">
          <div class="container" data-aos="fade-up">
    
            <div class="section-header">
              <p><span>Cadastro do Responsável</span></p>
            </div>
    
            <form action="cadastromed.php" method="post" role="form" >
              <div class="php-email-form p-3 p-md-4">
                <div class="row">
                   

                  <div class="col-xl-6 form-group">
                    <input type="text" name="resp_cpf" class="form-control" id="resp_cpf" placeholder="Seu CPF" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" name="resp_nome" class="form-control" id="resp_nome" placeholder="Seu Nome Completo" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="resp_email" id="resp_email" placeholder="Seu Email" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="resp_rg" id="resp_rg" placeholder="Seu RG" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="date" class="form-control" name="resp_nasc" id="resp_nasc" placeholder="Sua Data de Nascimento" required>
                  </div>
                      </div>
  
                      <div class="text-center"><button type="submit">Próximo</button></div>
                  </div>
              </form>             
      
            </div>
   
          </section>

 <!-- ======= Footer ======= -->
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