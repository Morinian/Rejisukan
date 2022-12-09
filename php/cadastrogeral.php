<?php
include_once 'conexao.php';

session_start(); 


$_SESSION['med_sang'] = $_POST['med_sang'];
$_SESSION['med_aler'] = $_POST['med_aler'];
$_SESSION['med_dcro'] = $_POST['med_dcro'];
$_SESSION['med_medic'] = $_POST['med_medic'];
$_SESSION['med_pcd'] = $_POST['med_pcd'];

$_SESSION['turma_id'] = $_POST['turma_id'];
$_SESSION['atle_faixa'] = $_POST['atle_faixa'];

if(!isset($_SESSION['med_sang']) and !isset($_SESSION['med_aler'])and !isset($_SESSION['med_pcd']) and !isset($_SESSION['med_dcro']) and !isset($_SESSION['med_medic']) and !isset($_SESSION['turma_id'])and !isset($_SESSION['atle_faixa'])) {
	session_destroy();
	echo"<meta http-equiv='refresh' content='0;url=cadastroaluno.php'>";
    exit;
}


//alunos
$alu_cpf =  $_SESSION['alu_cpf']; 
$alu_nome =  $_SESSION['alu_nome'];
$alu_email =  $_SESSION['alu_email']; 

$senha_user = $_SESSION['alu_senha'];
$hasho = password_hash($senha_user, PASSWORD_DEFAULT);

$alu_rg =  $_SESSION['alu_rg']; 
$alu_nasc =  $_SESSION['alu_nasc']; 
$alu_tele =  $_SESSION['alu_tele']; 
$alu_cep =  $_SESSION['alu_cep']; 
$alu_rua =  $_SESSION['alu_rua']; 
$alu_ba =  $_SESSION['alu_ba']; 
$alu_cid =  $_SESSION['alu_cid']; 
$alu_num =  $_SESSION['alu_num']; 
$alu_comp =  $_SESSION['alu_comp']; 

//responsavel
$resp_cpf = $_SESSION['resp_cpf'];
$resp_nome = $_SESSION['resp_nome'];
$resp_rg = $_SESSION['resp_rg'];
$resp_nasc = $_SESSION['resp_nasc'];
$resp_email = $_SESSION['resp_email'];

//dados_medicos
$med_sang = $_SESSION['med_sang']; 
$med_aler = $_SESSION['med_aler']; 
$med_dcro = $_SESSION['med_dcro']; 
$med_medic = $_SESSION['med_medic']; 
$med_pcd = $_SESSION['med_pcd'];

//dados_atleta
$turma_id = $_SESSION['turma_id']; 
$atle_faixa = $_SESSION['atle_faixa']; 



$testuser = $connect->prepare("SELECT * FROM aluno WHERE alu_cpf = :alu_cpf");
$testuser->execute(array('alu_cpf' => $alu_cpf));
$checkuser = $testuser->rowCount();

$testemail = $connect->prepare("SELECT * FROM aluno WHERE alu_email = :alu_email");
$testemail->execute(array('alu_email' => $alu_email));
$checkemail = $testemail->rowCount();

$testcpf = $connect->prepare("SELECT * FROM aluno WHERE alu_rg = :alu_rg");
$testcpf->execute(array('alu_rg' => $alu_rg));
$checkcpf = $testcpf->rowCount();

if ($checkuser == 0 and $checkemail == 0 and $checkcpf == 0) {
    // Inserindo dados do usuário
    $sqluser = $connect->prepare("INSERT INTO aluno (alu_id, alu_cpf, alu_nome, alu_email, alu_senha, alu_rg, alu_nasc, alu_tele, alu_cep, alu_rua, alu_ba, alu_cid, alu_num, alu_comp) VALUES ( null , :alu_cpf, :alu_nome, :alu_email, :alu_senha , :alu_rg, :alu_nasc, :alu_tele, :alu_cep, :alu_rua, :alu_ba, :alu_cid, :alu_num, :alu_comp)");
    $sqluser->execute(array( 'alu_cpf' => $alu_cpf, 'alu_nome' => $alu_nome, 'alu_email' => $alu_email, 'alu_senha' => $hasho, 'alu_rg' => $alu_rg, 'alu_nasc' => $alu_nasc, 'alu_tele' => $alu_tele, 'alu_cep' => $alu_cep, 'alu_rua' => $alu_rua, 'alu_ba' => $alu_ba, 'alu_cid' => $alu_cid, 'alu_num' => $alu_num, 'alu_comp' => $alu_comp));

    // Consultando o usuário que acabou de se cadastrar

    $consulta = $connect->prepare("SELECT * FROM aluno WHERE alu_cpf = :alu_cpf");
    $consulta->execute(array('alu_cpf' => $alu_cpf));

    $fetchuser = $consulta->fetchAll();

    foreach($fetchuser as $item) {
      $alu_id = $item['alu_id'];
    

    // Inserindo endereço do responsavel

    $sqlend = $connect->prepare("INSERT INTO responsavel (alu_id, resp_cpf, resp_nome, resp_rg, resp_nasc, resp_email) VALUES (:alu_id, :resp_cpf, :resp_nome, :resp_rg, :resp_nasc, :resp_email)");

    $sqlend->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
    $sqlend->bindParam(':resp_cpf', $resp_cpf);
    $sqlend->bindParam(':resp_nome', $resp_nome);
    $sqlend->bindParam(':resp_rg', $resp_rg);
    $sqlend->bindParam(':resp_nasc', $resp_nasc);
    $sqlend->bindParam(':resp_email', $resp_email);
    
    $sqlend->execute();
    
    // Inserindo endereço do Medico

    $sqlmed = $connect->prepare("INSERT INTO dados_medicos (alu_id, med_sang, med_aler, med_dcro, med_medic, med_pcd) 
    VALUES (:alu_id, :med_sang, :med_aler, :med_dcro, :med_medic, :med_pcd)");

    $sqlmed->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
    $sqlmed->bindParam(':med_sang', $med_sang);
    $sqlmed->bindParam(':med_aler', $med_aler);
    $sqlmed->bindParam(':med_dcro', $med_dcro);
    $sqlmed->bindParam(':med_medic', $med_medic);
    $sqlmed->bindParam(':med_pcd', $med_pcd);

    $sqlmed->execute();


     // Inserindo endereço do Medico

     $sqlatle = $connect->prepare("INSERT INTO dados_atleta (alu_id, turma_id, atle_faixa) 
     VALUES (:alu_id, :turma_id, :atle_faixa)");
 
     $sqlatle->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
     $sqlatle->bindParam(':turma_id', $turma_id);
     $sqlatle->bindParam(':atle_faixa', $atle_faixa);
 
     $sqlatle->execute();
    }


    header("Location: cadastroaluno.php");


}   

elseif ($checkemail == 1 and $checkuser == 1 and $checkcpf == 1) {
    header("Location: ../areadoprofessor.html");
exit;
}

elseif ($checkemail == 1) {
    header("Location: ../areadoprofessor.html");
    exit;
}


elseif ($checkuser == 1) {
    header("Location: ../areadoprofessor.html");
    exit;
}

elseif ($checkcpf == 1) {
    header("Location: ../areadoprofessor.html");
    
    exit;
}
?>
