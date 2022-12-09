<?php

session_start();
ob_start();
include_once 'conexao.php';

$turma_id = filter_input(INPUT_GET, "turma_id", FILTER_SANITIZE_NUMBER_INT);

if (empty($turma_id)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: listarturma.php");
    exit();
}

$query_usuario = "SELECT t.turma_id, t.turma_nome, p.prof_cpf, p.prof_nome FROM turma t INNER JOIN professor p ON t.prof_cpf = p.prof_cpf AND t.turma_id = $turma_id LIMIT 1";

$result_usuario = $connect->prepare($query_usuario);
$result_usuario->execute();


if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

    //var_dump($row_usuario);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Turma não encontrada!</p>";
    header("Location: listarturma.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Cadastro de Turma</title>
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
        
        $conexao = mysqli_connect("localhost","root","","rejisukan");
        $sql = "select prof_cpf, prof_nome from professor;";
        $result = mysqli_query($conexao, $sql);


        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        //Verificar se o usuário clicou no botão
        if (!empty($dados['EditUsuario'])) {
            $empty_input = false;
            $dados = array_map('trim', $dados);
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
            }

            if (!$empty_input) {
                $query_up_usuario= "UPDATE Turma SET turma_nome=:turma_nome, prof_cpf=:prof_cpf WHERE turma_id=:turma_id";
            
                $edit_usuario = $connect->prepare($query_up_usuario);
                $edit_usuario->bindParam(':turma_nome', $dados['turma_nome'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':prof_cpf', $dados['prof_cpf'], PDO::PARAM_STR);

                $edit_usuario->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
                
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green;'>Professor editado com sucesso!</p>";
                    header("Location: listarturma.php");
                }else{
                    echo "<p style='color: #f00;'>Erro: Professor não editado com sucesso!</p>";
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

        <br>
        <br>

    <section id="contato" class="contato">
          <div class="container" data-aos="fade-up">

            <div class="section-header">
              <p><span>Editar Professor</span></p>
            </div>

                <form id="edit-usuario" method="POST" action="" role="form">

                <div class="php-email-form p-3 p-md-4">
                    <div class="row">

                        <input type="text" name="turma_nome" id="turma_nome" placeholder="Nome completo" value="<?php
                        if (isset($dados['turma_nome'])) {
                            echo $dados['turma_nome'];
                        } elseif (isset($row_usuario['turma_nome'])) {
                            echo $row_usuario['turma_nome'];
                        }
                        ?>">

                    
                    


                    <br>
                    <br>
                    <br>
               

                      <select class="form-control" name="prof_cpf" >
                              
                        <option>Selecione o Sensei</option>

                          <?php
                            while ($dados = mysqli_fetch_assoc($result)){
                          ?>
                        <option value= "<?php echo $dados['prof_cpf']?>">
                          <?php echo $dados['prof_nome']?>
                        </option>
                              <?php
                                  }
                              ?>

                      </select>

                      </div>

                    <br>
                    <div class="text-center"><button type="submit" value="Salvar" name="EditUsuario">Editar</button></div>
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