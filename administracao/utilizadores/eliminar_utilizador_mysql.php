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

$select = "SELECT  
				users.permissions_id_permissions  
			FROM 
				users 
			WHERE users.idlogin ='".$_POST['idlogin_escondido_eliminar']. "' 
			LIMIT 1" ;
$resultado = mysqli_query($conn, $select);
$linha=mysqli_fetch_array($resultado);

if($linha['permissions_id_permissions'] != 1) // o valor 1 é um administrador
	{
	$update = "UPDATE users
				SET
					eliminado = 1, cota_utilizada = 0, data_eliminacao = NOW()    
				WHERE idlogin=".$_POST['idlogin_escondido_eliminar']." 
					LIMIT 1";

	//**********elimina os ficheiros do utilizador****************			
	$select = "SELECT 
			  		diretoria,
			  		nome_do_ficheiro 
		   		FROM 
					ficheiros 
		   		WHERE 
		   			id_login_fk = ".$_POST['idlogin_escondido_eliminar']." 
		   		AND 
		   			eliminado != 1 
					" ;		
	$resultado = mysqli_query($conn, $select);
	//echo $select;
	//exit();
	while ($linha=mysqli_fetch_array($resultado))
			{		
			$target_file = $_SERVER['DOCUMENT_ROOT'].$linha['diretoria'].$linha['nome_do_ficheiro']; 	
			unlink($target_file);
			};		
	//************************************************************
	//**********elimina a diretoria do utilizador*****************
	$diretoria=$_SERVER['DOCUMENT_ROOT']."/alunos/ficheiros/".$_POST['idlogin_escondido_eliminar'];
	if (is_dir($diretoria)) 
			{
    			rmdir($diretoria);
			}
	//************************************************************
	//****elimina os ficheiros do utilizador na tabela ficheiros**					
	$update1 = "UPDATE ficheiros
				SET
					eliminado = 1, data_eliminado = NOW()  
				WHERE 
					id_login_fk=".$_POST['idlogin_escondido_eliminar']."
				AND 
					eliminado !=1";
	mysqli_query($conn,$update1);
			
	//************************************************************					
	}
else
	{	
	if ($_POST['idlogin_escondido_eliminar']==2) 
		{$_SESSION['utilizador__empresa_nao_pode_ser_eliminado']=1;
		mysqli_close($conn);
		header('Location:/administracao/utilizadores/utilizadores.php');
		exit();	
		};
	if($_SESSION['id_utilizador']!=1 && $_SESSION['id_utilizador']!=2 )
	 	{$_SESSION['utilizador_nao_e_empresa_ou_admin']=1;
		mysqli_close($conn);
		header('Location:/administracao/utilizadores/utilizadores.php');
		exit();
		}
	else
		{
		//**********elimina o utilizador*****************************					
		$update = "UPDATE users
				SET
					eliminado = 1, cota_utilizada = 0, data_eliminacao = NOW()    
				WHERE idlogin=".$_POST['idlogin_escondido_eliminar']." 
						LIMIT 1";
		//************************************************************
		//**********elimina os ficheiros do utilizador****************			
		$select = "SELECT 
			  			diretoria,
			  			nome_do_ficheiro 
		   			FROM 
						ficheiros 
		   			WHERE 
		   				id_login_fk = ".$_POST['idlogin_escondido_eliminar']." 
		   			AND 
		   				eliminado != 1 
					" ;		
		$resultado = mysqli_query($conn, $select);

		while ($linha=mysqli_fetch_array($resultado))
			{		
			$target_file = $_SERVER['DOCUMENT_ROOT'].$linha['diretoria'].$linha['nome_do_ficheiro']; 	
			unlink($target_file);
			};		
		//************************************************************
		//**********elimina a diretoria do utilizador*****************
		$diretoria=$_SERVER['DOCUMENT_ROOT']."/alunos/ficheiros/".$_POST['idlogin_escondido_eliminar'];
		if (is_dir($diretoria)) 
			{
    			rmdir($diretoria);
			}
		//************************************************************
		//****elimina os ficheiros do utilizador na tabela ficheiros**					
		$update1 = "UPDATE ficheiros
					SET
						eliminado = 1, data_eliminado = NOW()  
					WHERE 
						id_login_fk=".$_POST['idlogin_escondido_eliminar']."
					AND 
						eliminado !=1";
		mysqli_query($conn,$update1);			
		//************************************************************			
		}
	};
mysqli_query($conn,$update);
$_SESSION['utilizador_eliminado_com_sucesso']= "1";

mysqli_close($conn);
header('Location:/administracao/utilizadores/utilizadores.php');
exit();	

?>