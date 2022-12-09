<?php
include_once 'conexao.php';
shell_exec("C:\wamp64\bin\mysql\mysql5.7.31\bin\mysqldump -u root rejisukan > backupRejisukan.sql");
header("Location: ../areadoprofessor.html");


?>