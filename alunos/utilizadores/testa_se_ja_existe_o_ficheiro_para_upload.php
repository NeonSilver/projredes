<?php
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session 


//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=2)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************


//*************************************************************************
include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados
//*************************************************************************


//************************obtem o nome do ficheiro que vai ser gravado***************************************
	// var_dump( $_POST );
	//echo $_POST["valor1"]; devolve c:/faketpath/nome_ficheiro.extensão
	$separado = explode("\\", $_POST["valor1"]); // separa por "/" o que existe no $_POST["valor1"] e coloca no array $separado
	$comprimento = count($separado);
	$ultimo_elemento = $comprimento-1;
	$separado[$ultimo_elemento]; //aqui já só tem o nome e extensão do ficheiro
//***********************************************************************************************************	


//************************testa se o nome do ficheiro já existe gravado no servidor *************************
	$select = "SELECT 
				  ficheiros.id_ficheiros 
			   FROM 
					ficheiros 
			   WHERE 
			 		ficheiros.nome_do_ficheiro = '".$separado[$ultimo_elemento]."' 			
			 	AND
			 		diretoria='/alunos/ficheiros/".$_SESSION['id_utilizador']."/' 
				AND
					eliminado=0   
				LIMIT 1";
	$resultado = mysqli_query($conn, $select);
	$numero_de_linhas = mysqli_num_rows($resultado);
	
	if($numero_de_linhas==1)
		{
			echo "nome_ficheiro_ja_existe";
		}
	else
		{
			echo "nome_ficheiro_nao_existe";
		}
//***********************************************************************************************************
?>