<?php

session_start();
ob_start();
include_once 'conexao.php';

$alu_id = filter_input(INPUT_GET, "alu_id", FILTER_SANITIZE_NUMBER_INT);

if (empty($alu_id)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: index.php");
    exit();
}

$query_usuario = "SELECT a.alu_id, a.alu_cpf, a.alu_nome, a.alu_email, a.alu_senha, a.alu_rg, a.alu_nasc, a.alu_tele, a.alu_cep, a.alu_rua, a.alu_ba, a.alu_cid, a.alu_num, a.alu_comp,r.alu_id, r.resp_cpf, r.resp_nome, r.resp_rg, r.resp_nasc, r.resp_email, m.med_sang, m.med_aler, m.med_dcro, m.med_medic, m.med_pcd, t.atle_faixa

                FROM aluno a 

                INNER JOIN responsavel r 

                ON a.alu_id= r.alu_id

                INNER JOIN dados_medicos m

                ON a.alu_id= m.alu_id 

                INNER JOIN dados_atleta t

                ON a.alu_id= t.alu_id AND a.alu_id = $alu_id LIMIT 1";

$result_usuario = $connect->prepare($query_usuario);
$result_usuario->execute();


if (($result_usuario) AND ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

    //var_dump($row_usuario);
} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    exit();
}
?>
<!DOCTYPE html>
<html>
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

        <?php
        //Receber os dados do formulário
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
                $query_up_usuario= "UPDATE aluno SET alu_nome=:alu_nome,  alu_email=:alu_email, alu_cpf=:alu_cpf, alu_rg=:alu_rg, alu_nasc=:alu_nasc, alu_tele=:alu_tele, alu_cep=:alu_cep, alu_rua=:alu_rua, alu_ba=:alu_ba, alu_num=:alu_num, alu_cid=:alu_cid, alu_comp=:alu_comp WHERE alu_id=:alu_id";
            
                $edit_usuario = $connect->prepare($query_up_usuario);
                $edit_usuario->bindParam(':alu_nome', $dados['alu_nome'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_email', $dados['alu_email'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_cpf', $dados['alu_cpf'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_rg', $dados['alu_rg'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_nasc', $dados['alu_nasc'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_tele', $dados['alu_tele'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_cep', $dados['alu_cep'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_rua', $dados['alu_rua'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_ba', $dados['alu_ba'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':alu_num', $dados['alu_num'], PDO::PARAM_INT);
                $edit_usuario->bindParam(':alu_cid', $dados['alu_cid'], PDO::PARAM_INT);
                $edit_usuario->bindParam(':alu_comp', $dados['alu_comp'], PDO::PARAM_INT);


                $edit_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                    header("Location: listaraluno.php");
                }else{
                    echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
                }

            }
            if (!$empty_input) {
                $query_up_usuario= "UPDATE responsavel SET resp_cpf=:resp_cpf, resp_nome=:resp_nome, resp_rg=:resp_rg, resp_nasc=:resp_nasc, resp_email=:resp_email WHERE alu_id=:alu_id";
            
                $edit_usuario = $connect->prepare($query_up_usuario);
                $edit_usuario->bindParam(':resp_cpf', $dados['resp_cpf'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':resp_nome', $dados['resp_nome'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':resp_rg', $dados['resp_rg'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':resp_nasc', $dados['resp_nasc'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':resp_email', $dados['resp_email'], PDO::PARAM_STR);

                $edit_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
                $edit_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                    header("Location: listaraluno.php");
                }else{
                    echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
                }

            }
            if (!$empty_input) {
                $query_up_usuario= "UPDATE dados_medicos SET med_sang=:med_sang, med_aler=:med_aler, med_dcro=:med_dcro, med_medic=:med_medic, med_pcd=:med_pcd WHERE alu_id=:alu_id";
            
                $edit_usuario = $connect->prepare($query_up_usuario);
                $edit_usuario->bindParam(':med_sang', $dados['med_sang'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':med_aler', $dados['med_aler'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':med_dcro', $dados['med_dcro'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':med_medic', $dados['med_medic'], PDO::PARAM_STR);
                $edit_usuario->bindParam(':med_pcd', $dados['med_pcd'], PDO::PARAM_STR);

                $edit_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
                $edit_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                    header("Location: listaraluno.php");
                }else{
                    echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
                }

            }if (!$empty_input) {
                $query_up_usuario= "UPDATE dados_atleta SET atle_faixa=:atle_faixa WHERE alu_id=:alu_id";
            
                $edit_usuario = $connect->prepare($query_up_usuario);
                $edit_usuario->bindParam(':atle_faixa', $dados['atle_faixa'], PDO::PARAM_STR);

                $edit_usuario->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
                if($edit_usuario->execute()){
                    $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                    header("Location: listaraluno.php");
                }else{
                    echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
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
              <p><span>Editar Aluno</span></p>
            </div>

                <form id="edit-usuario" method="POST" action="" role="form">

                <div class="php-email-form p-3 p-md-4">
                    <div class="row">

                        <input type="text" name="alu_nome" id="alu_nome" placeholder="Nome completo" value="<?php
                        if (isset($dados['alu_nome'])) {
                            echo $dados['alu_nome'];
                        } elseif (isset($row_usuario['alu_nome'])) {
                            echo $row_usuario['alu_nome'];
                        }
                        ?>">

                        <input type="text" name="alu_email" id="alu_email" placeholder="Melhor e-mail" value="<?php
                            if (isset($dados['alu_email'])) {
                                echo $dados['alu_email'];
                            } elseif (isset($row_usuario['alu_email'])) {
                                echo $row_usuario['alu_email'];
                            }
                        ?>">

                        
                        <input type="text" name="alu_cpf" id="alu_cpf" placeholder="Cpf" value="<?php
                            if (isset($dados['alu_cpf'])) {
                                echo $dados['alu_cpf'];
                            } elseif (isset($row_usuario['alu_cpf'])) {
                                echo $row_usuario['alu_cpf'];
                            }
                        ?>">

                        <input type="text" name="alu_rg" id="alu_rg" placeholder="alu_rg" value="<?php
                        if (isset($dados['alu_rg'])) {
                            echo $dados['alu_rg'];
                        } elseif (isset($row_usuario['alu_rg'])) {
                            echo $row_usuario['alu_rg'];
                        }
                        ?>" >


                        <input type="date" name="alu_nasc" id="alu_nasc" placeholder="alu_nasc" value="<?php
                        if (isset($dados['alu_nasc'])) {
                            echo $dados['alu_nasc'];
                        } elseif (isset($row_usuario['alu_nasc'])) {
                            echo $row_usuario['alu_nasc'];
                        }
                        ?>" >


                        <input type="text" name="alu_tele" id="alu_tele" placeholder="alu_tele" value="<?php
                        if (isset($dados['alu_tele'])) {
                            echo $dados['alu_tele'];
                        } elseif (isset($row_usuario['alu_tele'])) {
                            echo $row_usuario['alu_tele'];
                        }
                        ?>" >


                        <input type="alu_cep" name="alu_cep" id="alu_cep" placeholder="alu_cep" value="<?php
                            if (isset($dados['alu_cep'])) {
                                echo $dados['alu_cep'];
                            } elseif (isset($row_usuario['alu_cep'])) {
                                echo $row_usuario['alu_cep'];
                            }
                        ?>" >



                        <input type="text" name="alu_rua" id="alu_rua" placeholder="alu_rua" value="<?php
                        if (isset($dados['alu_rua'])) {
                            echo $dados['alu_rua'];
                        } elseif (isset($row_usuario['alu_rua'])) {
                            echo $row_usuario['alu_rua'];
                        }
                        ?>" >


                        <input type="alu_ba" name="alu_ba" id="alu_ba" placeholder="alu_ba" value="<?php
                            if (isset($dados['alu_ba'])) {
                                echo $dados['alu_ba'];
                            } elseif (isset($row_usuario['alu_ba'])) {
                                echo $row_usuario['alu_ba'];
                            }
                            ?>" >

                        <input type="alu_num" name="alu_num" id="alu_num" placeholder="alu_num" value="<?php
                            if (isset($dados['alu_num'])) {
                                echo $dados['alu_num'];
                            } elseif (isset($row_usuario['alu_num'])) {
                                echo $row_usuario['alu_num'];
                            }
                            ?>" >
                            
                        <input type="alu_cid" name="alu_cid" id="alu_cid" placeholder="alu_cid" value="<?php
                            if (isset($dados['alu_cid'])) {
                                echo $dados['alu_cid'];
                            } elseif (isset($row_usuario['alu_cid'])) {
                                echo $row_usuario['alu_cid'];
                            }
                            ?>" >

                        <input type="alu_comp" name="alu_comp" id="alu_comp" placeholder="alu_comp" value="<?php
                            if (isset($dados['alu_comp'])) {
                                echo $dados['alu_comp'];
                            } elseif (isset($row_usuario['alu_comp'])) {
                                echo $row_usuario['alu_comp'];
                            }
                            ?>" >
                            

                            <div class="section-header">
                            <br>
                            <p><span>Editar Responsável</span></p>
                            </div>

                            <input type="text" name="resp_cpf" class="form-control" id="resp_cpf" placeholder="Seu "  value="<?php
                        if (isset($dados['resp_cpf'])) {
                            echo $dados['resp_cpf'];
                        } elseif (isset($row_usuario['resp_cpf'])) {
                            echo $row_usuario['resp_cpf'];
                        }
                        ?>" >
                        <input type="text" name="resp_nome" class="form-control" id="resp_nome" placeholder="Seu Nome Completo"  value="<?php
                        if (isset($dados['resp_nome'])) {
                            echo $dados['resp_nome'];
                        } elseif (isset($row_usuario['resp_nome'])) {
                            echo $row_usuario['resp_nome'];
                        }
                        ?>" >

                        <input type="text" class="form-control" name="resp_email" id="resp_email" placeholder="Seu Email"  value="<?php
                            if (isset($dados['resp_email'])) {
                                echo $dados['resp_email'];
                            } elseif (isset($row_usuario['resp_email'])) {
                                echo $row_usuario['resp_email'];
                            }
                            ?>" >
                            

                        <input type="text" class="form-control" name="resp_rg" id="resp_rg" placeholder="Seu RG"   value="<?php
                        if (isset($dados['resp_rg'])) {
                            echo $dados['resp_rg'];
                        } elseif (isset($row_usuario['resp_rg'])) {
                            echo $row_usuario['resp_rg'];
                        }
                        ?>" >


                        <input type="date" class="form-control" name="resp_nasc" id="resp_nasc" placeholder="Sua Data de Nascimento"  value="<?php
                        if (isset($dados['resp_nasc'])) {
                            echo $dados['resp_nasc'];
                        } elseif (isset($row_usuario['resp_nasc'])) {
                            echo $row_usuario['resp_nasc'];
                        } ?>" >

                            <div class="section-header">
                            <br>
                            <p><span>Editar Dados Médicos</span></p>
                            </div>

                            <input type="text" name="med_sang" class="form-control" id="med_sang" placeholder="Seu Tipo Sanguíneo"  value="<?php
                        if (isset($dados['med_sang'])) {
                            echo $dados['med_sang'];
                        } elseif (isset($row_usuario['med_sang'])) {
                            echo $row_usuario['med_sang'];
                        }
                        ?>" >
                        <input type="text" name="med_aler" class="form-control" id="med_aler" placeholder="Alergias (se possuir)" value="<?php
                        if (isset($dados['med_aler'])) {
                            echo $dados['med_aler'];
                        } elseif (isset($row_usuario['med_aler'])) {
                            echo $row_usuario['med_aler'];
                        }
                        ?>" >

                        <input type="text" class="form-control" name="med_dcro" id="med_dcro" placeholder="Doenças Crônicas (se possuir)" value="<?php
                            if (isset($dados['med_dcro'])) {
                                echo $dados['med_dcro'];
                            } elseif (isset($row_usuario['med_dcro'])) {
                                echo $row_usuario['med_dcro'];
                            }
                            ?>" >
                            

                        <input type="text" class="form-control" name="med_medic" id="med_medic" placeholder="Uso de Medicamentos (quais)" value="<?php
                        if (isset($dados['med_medic'])) {
                            echo $dados['med_medic'];
                        } elseif (isset($row_usuario['med_medic'])) {
                            echo $row_usuario['med_medic'];
                        }
                        ?>" >


                        <input type="text" class="form-control" name="med_pcd" id="med_pcd" placeholder="É PCD"  value="<?php
                        if (isset($dados['med_pcd'])) {
                            echo $dados['med_pcd'];
                        } elseif (isset($row_usuario['med_pcd'])) {
                            echo $row_usuario['med_pcd'];
                        } ?>" >

                            <div class="section-header">
                            <br>
                            <p><span>Editar Dados atleta</span></p>
                            </div>

                        <input type="text" class="form-control" name="atle_faixa" id="atle_faixa" placeholder="É PCD"  value="<?php
                        if (isset($dados['atle_faixa'])) {
                            echo $dados['atle_faixa'];
                        } elseif (isset($row_usuario['atle_faixa'])) {
                            echo $row_usuario['atle_faixa'];
                        } ?>" >


                    </div>
                    <br>
                    <div class="text-center"><button type="submit" value="Salvar" name="EditUsuario">Próximo</button></div>
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