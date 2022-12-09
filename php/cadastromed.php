<?php
include_once 'conexao.php';

session_start();

$_SESSION['resp_cpf'] = $_POST['resp_cpf'];
$_SESSION['resp_nome'] = $_POST['resp_nome'];
$_SESSION['resp_rg'] = $_POST['resp_rg'];
$_SESSION['resp_nasc'] = $_POST['resp_nasc'];
$_SESSION['resp_email'] = $_POST['resp_email'];



if(!isset($_SESSION['resp_cpf']) and !isset($_SESSION['resp_nome']) and !isset($_SESSION['resp_rg']) and !isset($_SESSION['resp_nasc']) and !isset($_SESSION['resp_email'])) {
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

  <title>Cadastro de Dados Médicos e de Atleta</title>
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
  $sql = "select turma_nome,turma_id from turma;";
  $result = mysqli_query($conexao, $sql);

  //Receber os dados do formulário
  /*$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  $conexao = mysqli_connect("localhost","root","","rejisukan");
  $sql = "select turma_nome,turma_id from turma;";
  $result = mysqli_query($conexao, $sql);

  //Verificar se o usuário clicou no botão
  if (!empty($dados['CadUsuario'])) {
      //var_dump($dados);

        $empty_input = false;

        $dados = array_map('trim', $dados);
        if (in_array("", $dados)) {
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
        }


        if (!$empty_input) {

          $_SESSION['med_sang'] = $_POST['med_sang'];
          $_SESSION['med_aler'] = $_POST['med_aler'];
          $_SESSION['med_dcro'] = $_POST['med_dcro'];
          $_SESSION['med_medic'] = $_POST['med_medic'];
          $_SESSION['med_pcd'] = $_POST['med_pcd'];

          $_SESSION['turma_id'] = $_POST['turma_id'];
          $_SESSION['atle_faixa'] = $_POST['atle_faixa'];
          

            /*$query_usuario = "INSERT INTO dados_medicos (alu_id, med_sang, med_aler, med_dcro, med_medic, med_pcd) 
            VALUES (:alu_id, :med_sang, :med_aler, :med_dcro, :med_medic, :med_pcd)";

            $cad_usuario = $connect->prepare($query_usuario);
            $cad_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_STR);
            $cad_usuario->bindParam(':med_sang', $dados['med_sang'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':med_aler', $dados['med_aler'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':med_dcro', $dados['med_dcro'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':med_medic', $dados['med_medic'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':med_pcd', $dados['med_pcd'], PDO::PARAM_STR);
            $cad_usuario->execute();

            $query_usuario = "INSERT INTO dados_atleta (alu_id, turma_id, atle_faixa) 
            VALUES (:alu_id, :turma_id, :atle_faixa)";

            $cad_usuario = $connect->prepare($query_usuario);
            $cad_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_STR);
            $cad_usuario->bindParam(':turma_id', $dados['turma_id'], PDO::PARAM_STR);
            $cad_usuario->bindParam(':atle_faixa', $dados['atle_faixa'], PDO::PARAM_STR);
            $cad_usuario->execute();

            if ($cad_usuario->rowCount()) {
                echo "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                unset($dados);
                header("Location: cadastrogeral.php");
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
              <p><span>Cadastro do Atleta</span></p>
            </div>
    
            <form action="cadastrogeral.php" method="post" role="form" >

              <div class="php-email-form p-3 p-md-4">
                <div class="row">

                <div class="col-xl-6 form-group">
                  <select class="form-control" name="turma_id" >
                          
                    <option>Selecione o Sensei</option>

                      <?php
                        while ($dados = mysqli_fetch_assoc($result)){
                      ?>
                    <option value= "<?php echo $dados['turma_id']?>">
                      <?php echo $dados['turma_nome']?>
                    </option>
                          <?php
                              }
                          ?>

                  </select>
                </div>               

                  <div class="col-xl-6 form-group">
                    <input type="text" name="med_sang" class="form-control" id="med_sang" placeholder="Seu Tipo Sanguíneo" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" name="med_aler" class="form-control" id="med_aler" placeholder="Alergias (se possuir)" >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="med_dcro" id="med_dcro" placeholder="Doenças Crônicas (se possuir)" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="med_medic" id="med_medic" placeholder="Uso de Medicamentos (quais)" required >
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="med_pcd" id="med_pcd" placeholder="É PCD" required>
                  </div>

                  <div class="col-xl-6 form-group">
                    <input type="text" class="form-control" name="atle_faixa" id="atle_faixa" placeholder="Sua Faixa" required>
                  </div>
                  
                    </select><br><br>
                    
                  </div>
                  
                <div class="text-center"><button type="submit">Finalizar</button></div>

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