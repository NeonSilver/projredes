<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts

						/*
                        	echo ini_get('upload-max-filesize'),'<br />'
,ini_get('post-max-size');'<br />'; exit(); */
							ini_set('upload_max_filesize', 30000000); //It specifies the maximum file size (in bytes) that the PHP engine will accept. The default value is 2M (2 * 1048576 bytes).
							ini_set('post_max_size', 40000000); //It specifies the maximum size (in bytes) of HTTP POST data that is permitted. The default value is 8M (8 * 1048576 bytes). Make sure this value is greater than that of the upload_max_filesize directive.
							ini_set('memory_limit', 50000000); //It specifies the maximum amount of memory (in bytes) that is allowed for use by a PHP script. The default value is 16M (16 * 1048576 bytes). This value should be greater than that of the post_max_size directive.
							ini_set('max_input_time', 90); //It specifies the maximum amount of time (in seconds) that is allowed for each PHP script to receive the client's HTTP request. The default value is 60. If you need to support large file upload, you may need to increase this value to prevent timeouts. Note that some users may have a slow connection. You have to take that into account.
							ini_set('max_execution_time', 90); // It specifies the maximum amount of time (in seconds) that is allowed for each PHP script to execute. The default value is 30. If you need to process large uploaded files with PHP, you may need to increase this value to prevent timeouts.


//******evita que se introduza diretamento o link no browser e entre*******
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados

//******************************deteta se o user existe********************************
$select = "SELECT 
				users.idlogin  
			FROM 
				users 
			WHERE users.user ='".$_POST['username']. "' 
			LIMIT 1" ;

//echo $select;
//exit();
		
$resultado = mysqli_query($conn, $select);

$numero_de_linhas = mysqli_num_rows($resultado);

if($numero_de_linhas==1)
	{
		$_SESSION['utilizador_ja_existe']= "1";
	}
else
	{
		/*
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) 
			{
    			$_SESSION['imagem_demasiado_grande']= "1";	
			};
		
		// Allow certain file formats
		$imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "bmp"  && $imageFileType != "raw") 
			{
				$_SESSION['tipo_imagem_errada']= "1";
			};
			
		if(isset($_SESSION['imagem_demasiado_grande']) || isset($_SESSION['tipo_imagem_errada']))
			{
				mysqli_close($conn);
				header('Location:/administracao/utilizadores/criar_utilizadores.php');
				exit();	
			}
		*/		
		$insert = "INSERT INTO 
						users (
								nome_do_aluno,
								numero_proceso_aluno,
								email,
								cota_maxima,
								data_criacao,
								user,
								password, 
								attempts, 
								permissions_id_permissions, 
								lock_descriptions_id_lock_description)
					VALUES ('".$_POST['nome_aluno']."',
							'".$_POST['processo_aluno']."',
							'".$_POST['email_aluno']."',
							".$_POST['cota_maxima'].",
							NOW(),
							'".$_POST['username']."',
							PASSWORD('".$_POST['password']."'),
							".$_POST['tentativas'].",
							".$_POST['permissao'].",
							1)";
		mysqli_query($conn,$insert);
		$_SESSION['utilizador_criado_com_sucesso']= "1";


		$select = "SELECT MAX(users.idlogin) As idlogin  
					FROM users " ;	
		$resultado = mysqli_query($conn, $select);
		$linha = mysqli_fetch_array($resultado);
		$extensao_ficheiro = (pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));		
		//****************************upload imagerm*********************
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/imagens/imagens_utilizador/";
		$target_file = $target_dir.$linha["idlogin"].".".$extensao_ficheiro;
		//echo $target_file;
		//exit();		
		//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		
		$update="UPDATE users
					SET fotografia ='".$linha["idlogin"].".".$extensao_ficheiro."' 
					WHERE idlogin='".$linha["idlogin"]."' 
						LIMIT 1";
		mysqli_query($conn,$update);			
		//*****************************************************************
		//****************cria a diretoria do novo utilizador**************
		mkdir($_SERVER['DOCUMENT_ROOT']."/alunos/ficheiros/".$linha["idlogin"]);
		//*****************************************************************						
	};

mysqli_close($conn);
header('Location:/administracao/utilizadores/utilizadores.php');
exit();	

	

?>