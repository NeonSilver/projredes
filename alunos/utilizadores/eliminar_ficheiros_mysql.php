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

		$update="UPDATE users
					SET cota_utilizada = cota_utilizada - (SELECT tamanho_ficheiro FROM ficheiros WHERE id_ficheiros = ".$_POST['id_ficheiro_escondido'].") 
					WHERE idlogin='".$_SESSION['id_utilizador']."' 
						LIMIT 1";
		mysqli_query($conn,$update);
		
		$update="UPDATE ficheiros
					SET eliminado = 1, data_eliminado = NOW()   
						WHERE id_ficheiros='".$_POST['id_ficheiro_escondido']."' 
							LIMIT 1";
		mysqli_query($conn,$update);


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

 	
unlink($target_file);		

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
	
		//*****************************************************************						
	mysqli_close($conn);
	header('Location:/alunos/utilizadores/alunos.php');
	exit();
?>