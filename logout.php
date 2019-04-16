<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************


//*************************************************************************

include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados

//******************************deteta se o user existe********************************

//*******atualiza a tabela dos logs***************
$select = "SELECT MAX(logs.idrecords) AS idrecords
			FROM 
				logs 
			WHERE logs.users_idlogin ='".$_SESSION['id_utilizador']. "' 
			" ;
//echo $select;
//exit();
		
$resultado = mysqli_query($conn, $select);
$linha=mysqli_fetch_array($resultado);

$update="UPDATE logs
				SET dateout = NOW() 
						WHERE logs.idrecords='".$linha['idrecords']."'
								LIMIT 1";
mysqli_query($conn,$update);
//echo $update;
//exit();

//************************************************

//********destroi as variáveis sessão*******
unset($_SESSION["permissao_utilizador"]);
session_destroy();
//******************************************

mysqli_close($conn);
header('Location:/index.php');
exit();
?>