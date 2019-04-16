<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session $_SESSION['permissao'] depois de logout******

//******evita que se introduza diretamento o link no browser e entre*******
if (!isset($_POST['username']))
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados

//******************************deteta se o user está eliminado********************************
$select = "SELECT 
				users.idlogin  
			FROM 
				users 
			WHERE users.user ='".$_POST['username']. "' 
				AND eliminado = 1 
			LIMIT 1" ;
		
$resultado = mysqli_query($conn, $select);

$numero_de_linhas = mysqli_num_rows($resultado);

if($numero_de_linhas==1)
	{
		$_SESSION['utilizador_eliminado']= "1";
		mysqli_close($conn);
		header('Location:/index.php');
		exit();
	}
//*************************************************************************************

//******************************deteta se o user existe********************************
$select = "SELECT 
				users.idlogin, 
				users.user, 
				users.attempts,
				users.lock_descriptions_id_lock_description, 
				users.permissions_id_permissions  
			FROM 
				users 
			WHERE users.user ='".$_POST['username']. "' 
			LIMIT 1" ;

//echo $select;
//exit();
		
$resultado = mysqli_query($conn, $select);

$numero_de_linhas = mysqli_num_rows($resultado);

if($numero_de_linhas==0)
	{
		$_SESSION['utilizador_nao_existe']= "1";
		mysqli_close($conn);
		header('Location:/index.php');
		exit();
	}
//*************************************************************************************
else
//*****************deteta se tem tentativas ou se está bloqueado na descrição**********
	{
		$linha=mysqli_fetch_array($resultado);
		if($linha["attempts"]==0 || $linha["lock_descriptions_id_lock_description"]!=1)
			{
			$_SESSION['tentativas_zero']= "1";
			mysqli_close($conn);
			header('Location:/index.php');
			exit();	
			}
//**************************************************************************************
		else
			{
			$select = "SELECT 
							users.idlogin, 
							users.user, 
							users.attempts,
							users.lock_descriptions_id_lock_description, 
							users.permissions_id_permissions,
							users.fotografia  
						FROM 
							users 
						WHERE users.user ='".$_POST['username']. "' 
							AND users.password = PASSWORD('".$_POST['password']. "') 
						LIMIT 1" ;
			$resultado = mysqli_query($conn, $select);

			$numero_de_linhas = mysqli_num_rows($resultado);
			if($numero_de_linhas==0)
				{
				$update="UPDATE users
							SET attempts = attempts-1 
								WHERE users.user ='".$_POST['username']."'
								LIMIT 1";
				mysqli_query($conn,$update);
				
				$_SESSION['tentativas_restantes']= $linha["attempts"]-1;				
				$_SESSION['password_errada']= "1";
				
				if($_SESSION['tentativas_restantes']==0)
					{
					$update="UPDATE users
							SET lock_descriptions_id_lock_description = 2 
								WHERE users.user ='".$_POST['username']."'
								LIMIT 1";
					mysqli_query($conn,$update);	
					}
				
				mysqli_close($conn);
				header('Location:/index.php');
				exit();
				}
			else
				{
				$update="UPDATE users
							SET attempts = 3 
								WHERE users.user ='".$_POST['username']."'
								LIMIT 1";
				mysqli_query($conn,$update);
				
				
				$linha=mysqli_fetch_array($resultado);
				$_SESSION['permissao_utilizador']= $linha["permissions_id_permissions"];
				$_SESSION['id_utilizador']= $linha["idlogin"];
				$_SESSION['utilizador']= $linha["user"];
				$_SESSION['fotografia']= $linha["fotografia"];

//***************marca entrada na tabela dos logs******************************************
				$insert = "INSERT INTO logs (users_idlogin, datein)
								VALUES (".$_SESSION['id_utilizador'].",NOW())";
				//echo $insert;
				//exit();
				mysqli_query($conn,$insert);				
				mysqli_close($conn);
//*****************************************************************************************
				
				if($linha["permissions_id_permissions"]==1) 
					{
						header('Location:/administracao/administracao_principal.php');
					};
				if($linha["permissions_id_permissions"]==2) 
					{
						header('Location:/alunos/utilizadores/alunos.php');
					};
					
				exit();	
				}
			}
	}
?>