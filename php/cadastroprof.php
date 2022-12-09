<?php
include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cadastro de Professores</title>
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
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Verificar se o usuário clicou no botão
        if (!empty($dados['CadUsuario'])) {
            //var_dump($dados);

            $empty_input = false;

            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            } elseif (!filter_var($dados['prof_email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }

            $senha_user = $_POST['prof_senha'];
            $hasho = password_hash($senha_user, PASSWORD_DEFAULT);

            if (!$empty_input) {

                $query_usuario = "INSERT INTO professor (prof_cpf, prof_senha, prof_rg, prof_nasc, prof_nome, prof_tele, prof_email) VALUES (:prof_cpf, :hasho, :prof_rg, :prof_nasc , :prof_nome, :prof_tele, :prof_email)";

                $cad_usuario = $connect->prepare($query_usuario);
                $cad_usuario->bindParam(':prof_cpf', $dados['prof_cpf'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':hasho', $hasho, PDO::PARAM_STR);
			        	$cad_usuario->bindParam(':prof_rg', $dados['prof_rg'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':prof_nasc', $dados['prof_nasc'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':prof_nome', $dados['prof_nome'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':prof_tele', $dados['prof_tele'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':prof_email', $dados['prof_email'], PDO::PARAM_STR);
                $cad_usuario->execute();

                if ($cad_usuario->rowCount()) {
                    echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                    unset($dados);
                } else {
                    echo "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
                    header("Location: cadastroprof.php");
                }
            }
        }
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
              <p><span>Cadastro de Professores</span></p>
            </div>
    
            <form name="cad-usuario" method="POST" action="">

                <div class="php-email-form p-3 p-md-4">
                  <div class="row">
                
                  <div class="col-xl-6 form-group">
                    <input type="text" name="prof_cpf" class="form-control" id="prof_cpf" placeholder="Seu CPF" required value="<?php
                    if (isset($dados['prof_cpf'])) {
                        echo $dados['prof_cpf'];
                    }
                    ?>">
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" name="prof_nome" class="form-control" id="prof_nome" placeholder="Seu Nome Completo" required value="<?php
                      if (isset($dados['prof_nome'])) {
                          echo $dados['prof_nome'];
                      }
                      ?>">
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="prof_email" id="prof_email" placeholder="Seu Email" required value="<?php
                      if (isset($dados['prof_email'])) {
                          echo $dados['prof_email'];
                      }
                      ?>">
                  </div>

                  <div class="col-xl-6 form-group">    
                    <input type="password" class="form-control" name="prof_senha" id="prof_senha" placeholder="Sua Senha" required value="<?php
                    if (isset($dados['prof_senha'])) {
                        echo $dados['prof_senha'];
                    }
                    ?>">
                  </div>

                  <div class="col-xl-6 form-group">      
                    <input type="number" class="form-control" name="prof_rg" id="prof_rg" placeholder="Seu RG" required value="<?php
                    if (isset($dados['prof_rg'])) {
                        echo $dados['prof_rg'];
                    }
                    ?>">
                  </div>                  

                  <div class="col-xl-6 form-group">
                    <input type="date" class="form-control" name="prof_nasc" id="prof_nasc" placeholder="Sua Data de Nascimento" requiredvalue="<?php
                    if (isset($dados['prof_nasc'])) {
                        echo $dados['prof_nasc'];
                    }
                    ?>">
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="number" class="form-control" name="prof_tele" id="prof_tele" placeholder="Seu Telefone" required value="<?php
                    if (isset($dados['prof_tele'])) {
                        echo $dados['prof_tele'];
                    }
                    ?>">
                  </div>

                  </div>

                  <BR>

                  <div class="text-center"><button type="submit" value="Cadastrar" name="CadUsuario">Cadastrar</button></div>

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