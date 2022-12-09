<?php
include_once 'conexao.php';
session_start();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cadastro de Alunos</title>
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



  <!-- ======= php ======= -->
<?php

        //Receber os dados do formulário
        /*$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        

        //Verificar se o usuário clicou no botão
        if (!empty($dados['CadUsuario'])) {
            //var_dump($dados);

            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } elseif (!filter_var($dados['alu_email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }

            $senha_user = $_POST['alu_senha'];
            $hasho = password_hash($senha_user, PASSWORD_DEFAULT);

            if (!$empty_input) {

              $_SESSION['alu_id'] = $_POST['alu_id'];
              $_SESSION['alu_cpf'] = $_POST['alu_cpf'];
              $_SESSION['alu_nome'] = $_POST['alu_nome'];
              $_SESSION['alu_email'] = $_POST['alu_email'];
              $_SESSION['alu_senha'] = $hasho;
              $_SESSION['alu_rg'] = $_POST['alu_rg'];
              $_SESSION['alu_nasc'] = $_POST['alu_nasc'];
              $_SESSION['alu_tele'] = $_POST['alu_tele'];
              $_SESSION['alu_cep'] = $_POST['alu_cep'];
              $_SESSION['alu_rua'] = $_POST['alu_rua'];
              $_SESSION['alu_ba'] = $_POST['alu_ba'];
              $_SESSION['alu_cid'] = $_POST['alu_cid'];
              $_SESSION['alu_num'] = $_POST['alu_num'];
              $_SESSION['alu_comp'] = $_POST['alu_comp'];


                /*$query_usuario = "INSERT INTO aluno (alu_id, alu_cpf, alu_nome, alu_email, alu_senha, alu_rg, alu_nasc, alu_tele, alu_cep, alu_rua, alu_ba, alu_cid, alu_num, alu_comp) 
				        VALUES (:alu_id, :alu_cpf, :alu_nome, :alu_email, :hasho , :alu_rg, :alu_nasc, :alu_tele, :alu_cep, :alu_rua, :alu_ba, :alu_cid, :alu_num, :alu_comp)";

                $cad_usuario = $connect->prepare($query_usuario);
                $cad_usuario->bindParam(':alu_id', $dados['alu_id'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_cpf', $dados['alu_cpf'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_nome', $dados['alu_nome'], PDO::PARAM_STR);
				        $cad_usuario->bindParam(':alu_email', $dados['alu_email'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':hasho', $hasho, PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_rg', $dados['alu_rg'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_nasc', $dados['alu_nasc'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_tele', $dados['alu_tele'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_cep', $dados['alu_cep'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_rua', $dados['alu_rua'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_ba', $dados['alu_ba'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_cid', $dados['alu_cid'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_num', $dados['alu_num'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':alu_comp', $dados['alu_comp'], PDO::PARAM_STR);
                $cad_usuario->execute();

                if ($cad_usuario->rowCount()) {
                    echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                    unset($dados);
                    header("Location: cadastroresp.php");
                    
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
              <p><span>Cadastro de Alunos</span></p>
            </div>
    
            <form action="cadastroresp.php" method="post" role="form" name="cad-usuario" >

              <div class="php-email-form p-3 p-md-4">
                <div class="row">
                  <div class="col-xl-6 form-group">

                    <input type="text" name="alu_cpf" class="form-control" id="alu_cpf" placeholder="Seu CPF" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" name="alu_nome" class="form-control" id="alu_nome" placeholder="Seu Nome" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_email" id="alu_email" placeholder="Seu Email" required>
                  </div>

                  <div class="col-xl-6 form-group"> 
                    <input type="password" class="form-control" name="alu_senha" id="alu_senha" placeholder="Sua Senha" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_rg" id="alu_rg" placeholder="Seu RG" required>
                  </div>

                  <div class="col-xl-6 form-group"> 
                    <input type="date" class="form-control" name="alu_nasc" id="alu_nasc" placeholder="Data de Nascimento" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_tele" id="alu_tele" placeholder="Seu Telefone" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_cep" id="alu_cep" placeholder="Seu CEP" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_rua" id="alu_rua" placeholder="Sua Rua" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="number" class="form-control" name="alu_num" id="alu_num" placeholder="Número" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_ba" id="alu_ba" placeholder="Seu Bairro" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_cid" id="alu_cid" placeholder="Sua Cidade" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="alu_comp" id="alu_comp" placeholder="Complemento (opcional)">
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