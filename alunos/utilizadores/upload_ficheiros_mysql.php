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
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=2)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************



include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados

$select = "SELECT 
			(users.cota_maxima - users.cota_utilizada) AS cota_disponivel  
		   FROM 
				users 
		   WHERE 
		   		users.idlogin = '".$_SESSION['id_utilizador']."'  
				LIMIT 1" ;		
$resultado = mysqli_query($conn, $select);
$linha=mysqli_fetch_array($resultado);

if($linha['cota_disponivel'] < $_FILES["fileToUpload"]["size"])
	{
		$_SESSION['ficheiro_demasiado_grande']= "1";
	}
else
	{
		//************************testa se o nome do ficheiro já existe gravado no servidor *************************
		$select = "SELECT 
				  ficheiros.id_ficheiros, tamanho_ficheiro  
			   FROM 
					ficheiros 
			   WHERE 
			 		ficheiros.nome_do_ficheiro = '".$_FILES["fileToUpload"]["name"]."' 			
			 	AND
			 		diretoria='/alunos/ficheiros/".$_SESSION['id_utilizador']."/' 
				AND
					eliminado=0   
				LIMIT 1";
		$resultado1 = mysqli_query($conn, $select);
		$numero_de_linhas = mysqli_num_rows($resultado1);
		$linha1=mysqli_fetch_array($resultado1);
		if($numero_de_linhas==1)
			{
			$update="UPDATE users
					SET cota_utilizada = cota_utilizada - ".$linha1['tamanho_ficheiro']."  
					WHERE idlogin='".$_SESSION['id_utilizador']."' 
						LIMIT 1";
			mysqli_query($conn,$update);
			
			$update="UPDATE ficheiros
					SET eliminado = 1, data_eliminado = NOW()   
						WHERE id_ficheiros='".$linha1['id_ficheiros']."' 
							LIMIT 1";
			mysqli_query($conn,$update);	
			}
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
		

//$_FILES["fileToUpload"]["name"];		
		//****************************upload imagerm*********************
		$target_dir = $_SERVER['DOCUMENT_ROOT']."/alunos/ficheiros/".$_SESSION['id_utilizador']."/";
		echo $target_dir;
		$target_file = $target_dir.$_FILES["fileToUpload"]["name"];
		
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		
		$insert = "INSERT INTO 
						ficheiros (
								diretoria,
								id_login_fk,
								nome_do_ficheiro,
								tamanho_ficheiro,
								data_upload
								)
					VALUES ('/alunos/ficheiros/".$_SESSION['id_utilizador']."/',
							'".$_SESSION['id_utilizador']."',
							'".$_FILES["fileToUpload"]["name"]."',
							'".$_FILES["fileToUpload"]["size"]."',
							NOW()
							)";
		//echo $insert;
		//exit();
		mysqli_query($conn,$insert);
		
		$update="UPDATE users
					SET cota_utilizada = cota_utilizada + '".$_FILES["fileToUpload"]["size"]."' 
					WHERE idlogin='".$_SESSION['id_utilizador']."' 
						LIMIT 1";
		mysqli_query($conn,$update);
		$_SESSION['ficheiro_gravado']=1;		
	}
		//*****************************************************************						
	mysqli_close($conn);
	header('Location:/alunos/utilizadores/alunos.php');
	exit();
?>