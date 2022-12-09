<?php
	session_start();
	$sql = new mysqli("localhost","root","","rejisukan");
    
	$acessar = filter_input(INPUT_POST, 'acessar', FILTER_SANITIZE_STRING);
	
	if($acessar) {
		$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
		$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
		
		if((!empty($usuario)) AND ((!empty($senha)))) {

			$resul_usuario = "select * from aluno where alu_cpf = '$usuario' limit 1";
			$resultado_usuario = mysqli_query($sql, $resul_usuario);


			if ($resultado_usuario) {
				$row_usuario = mysqli_fetch_assoc($resultado_usuario);
				
				if(password_verify($senha, $row_usuario['alu_senha'])) {

					header("Location: ../areadoaluno.html");
        
				} else {
				
					header("Location:../loginaluno.php");
				}	

			} else {
			
				header("Location:../loginaluno.php");
			}

		} else {
			$_SESSION['msg'] = "<text>Página não encontrada.</text>";

		}
	}
?>