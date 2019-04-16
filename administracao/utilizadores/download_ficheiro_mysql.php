<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts

//******evita que se introduza diretamento o link no browser e entre*******
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados

//*********download do ficheiro********************************************
$select = "SELECT 
			  diretoria,
			  nome_do_ficheiro 
		   FROM 
				ficheiros 
		   WHERE 
		   		id_ficheiros = ".$_POST['id_ficheiro_escondido']."   
			LIMIT 1" ;		
$resultado = mysqli_query($conn, $select);
$linha=mysqli_fetch_array($resultado);
		
$target_file = $_SERVER['DOCUMENT_ROOT'].$linha['diretoria'].$linha['nome_do_ficheiro'];

$file = $target_file;

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    //exit;
}
//*************************************************************************

//*****************************************************************						
mysqli_close($conn); 
//header('Location:/administracao/utilizadores/gestao_ficheiros_admin.php');
exit();
?>