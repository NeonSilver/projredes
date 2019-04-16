<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session 

//******evita que se introduza diretamento o link no browser***************
if (!isset($_SESSION['permissao_utilizador']) || $_SESSION['permissao_utilizador']!=1)
	{
		header('Location:/index.php');
		exit();		
	}
//*************************************************************************

//*************************************************************************
include ($_SERVER['DOCUMENT_ROOT']."/acesso_bd.php"); //script de acesso à base de dados
//*************************************************************************
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ESAB - BROX</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script> <!--animação da função SHOW(( -->
<script src="/meus_javascripts/sweetalert.min.js"></script> 


   <!-- **************************** script do preview da imagem a gravar************************* -->
    <script class="jsbin" src="bibliotecas_javascript_upload/jquery.min.js"></script>
    <script class="jsbin" src="bibliotecas_javascript_upload/jquery-ui.min.js"></script>
	<!--[if IE]>
  	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 
    <script language="javascript" type="text/javascript">
	    function readURL(input,t) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah2'+t).attr('src', e.target.result);
            }
            document.getElementById("blah2"+t).style.display="block";
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
	
	</script>

    <script language="javascript" type="text/javascript">
	    function readdURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            document.getElementById("blah").style.display="block";
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
	
	</script>    

    <!-- ********************************************************************************************* -->   
</head>

<body>

    <div id="wrapper">
<script type="text/javascript">

	var mes = data.getMonth();          // 0-11 (zero=janeiro)
//	var d = new Date();
//	var n = d.getFullYear();
	alert(mes);
</script>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->

            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    
 <?PHP
 //************************menu*********************************                   
 include ($_SERVER['DOCUMENT_ROOT']."/menu.php"); 
 //*************************************************************                  
 ?>                   
                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color: #30F; font-style:italic">Utilizadores</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
         <br>
         <img id="mostra_area_criar" name="mostra_area_criar" onClick="muda_imagem()" src="/imagens/imagens_gerais/criar_utilizador.jpg" style="height:50px; width:50px" >
         <span style=" font-size:24px; font-style:italic; font-weight:bolder; color:#0F0">
         Criar utilizador
         </span>
         <br>
         
         <div id="mostra_area" name="mostra_area" style="display: none">
         	<!-- Zona de pedido de elementos para criar o utilizador------>
                                <form name="criar_utilizador" id="criar_utilizador" method="post" action="criar_utilizador_mysql.php" enctype="multipart/form-data" >
                        <br>
                        Nome do aluno: <input type="text" id="nome_aluno" name="nome_aluno" required>
                        <br>
                        <br>
                        Nº processo aluno: <input type="text" id="processo_aluno" name="processo_aluno" required>
                        <br>
                        <br>
                        Email do aluno: <input type="email" id="email_aluno" name="email_aluno" required>
                        <br>
                        <br>                                                   
                    	Nome do utilizador: <input type="text" id="username" name="username" required>
                        <br>
                        <?PHP 
						if (isset($_SESSION['utilizador_criado_com_sucesso']))
								{
								?>	
								<script type="text/javascript">
									swal("Good job!", "Utilizador criado com sucesso!", "success");
                                </script>
								<?PHP unset($_SESSION["utilizador_criado_com_sucesso"]);	
								}
						if (isset($_SESSION['utilizador_ja_existe']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Utilizador já existe! Tente novamente com outro nome.</p>';
								unset($_SESSION["utilizador_ja_existe"]);	
								}							
						?>
                        <br>
                        Palavra-passe: <input type="text" id="password" name="password" required>
                        <br>
                        <br>
                        Permissão: 
                        <select id="permissao" name="permissao" style="width:204px" required="required">
                        	<option value="" style="display:none">Escolha uma opção</option>
                        	<?php
							$select = "SELECT 
											permissions.id_permissions,
											permissions.descriptions  
										FROM 
											permissions" ;		
							$resultado = mysqli_query($conn, $select);
							while ($linha=mysqli_fetch_array($resultado))
										{
										echo '<option value="'.$linha["id_permissions"].'">'.$linha["descriptions"].'</option>';
										};												
							?>
						</select>
                        <br>
                        <br>
                        Tentativas: 
                        <select id="tentativas" name="tentativas" style="width:50px" required="required">
                        	<?php
							for ($i=0;$i<21; $i++)
								{
								if ($i==3)
									{
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
									}
								else
									{
									echo '<option value="'.$i.'">'.$i.'</option>';	
									}
								};												
							?>
						</select>
                        <br>
                        <br>
                        Cota máxima: 
                        <select id="cota_maxima" name="cota_maxima" style="width:150px" required="required">
                        	<?php
							for ($i=500;$i<901; $i=$i+100)
								{
								echo '<option value="'.($i*1000000).'">'.$i.' MB</option>';	
								};
							for ($i=1000;$i<3001; $i=$i+500)
								{
									if($i==1000)
									{
									echo '<option value="'.($i*1000000).'" selected>'.($i/1000).' GB</option>';	
									}
									else
									{
									echo '<option value="'.($i*1000000).'">'.($i/1000).' GB</option>';
									}
								};																					
							?>
						</select>                        
                        <br>
                        <br>
                        Foto
                        <br>
                        <br>
                         <img src="/imagens/imagens_utilizador/desconhecido.jpg" id="blah" height="140" width="140" />          
                        <br>
                        <br>
                        <?PHP
							//('upload_max_filesize', '32M') It specifies the maximum file size (in bytes) that the PHP engine will accept. The default value is 2M (2 * 1048576 bytes).
							//('post_max_size', '40M'); It specifies the maximum size (in bytes) of HTTP POST data that is permitted. The default value is 8M (8 * 1048576 bytes). Make sure this value is greater than that of the upload_max_filesize directive.
							//('memory_limit', '50M') It specifies the maximum amount of memory (in bytes) that is allowed for use by a PHP script. The default value is 16M (16 * 1048576 bytes). This value should be greater than that of the post_max_size directive.
							//('max_input_time', 90) It specifies the maximum amount of time (in seconds) that is allowed for each PHP script to receive the client's HTTP request. The default value is 60. If you need to support large file upload, you may need to increase this value to prevent timeouts. Note that some users may have a slow connection. You have to take that into account.
							//('max_execution_time', 90);  It specifies the maximum amount of time (in seconds) that is allowed for each PHP script to execute. The default value is 30. If you need to process large uploaded files with PHP, you may need to increase this value to prevent timeouts.
							
// estes parametros têm de ser mudados no php.ini
						?>
 
                         <input type="file" name="fileToUpload" id="fileToUpload" onchange="readdURL(this);"> 
                        
                        <br>
						
                        <?PHP
						
						if (isset($_SESSION['imagem_demasiado_grande']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Ficheiro demasiado grande! Tente novamente com outro ficheiro com tamanho inferior a 500KB.</p>';
								unset($_SESSION["imagem_demasiado_grande"]);	
								}
						if (isset($_SESSION['tipo_imagem_errada']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Tipo de ficheiro errado! Tente com ficheiros do tipo ".jpg; .bmp; jpeg".</p>';
								unset($_SESSION["tipo_imagem_errada"]);	
								}							
						?>
                        <br>
                        <!-- <button type="submit">
								Criar utilizador
						</button> -->
                        <input type="submit" value="Criar utilizador" name="submit">
                    </form>
            <!------------------------------------------------------------>
         </div>
        <script>
		function muda_imagem()
		{
			$( "#mostra_area" ).toggle( "slow" ); //jquery
			
			if (document.getElementById("mostra_area_criar").getAttribute('src')=="/imagens/imagens_gerais/criar_utilizador.jpg")
				{
				document.getElementById("mostra_area_criar").src="/imagens/imagens_gerais/menos.jpg";	
				}
			else
				{
				document.getElementById("mostra_area_criar").src="/imagens/imagens_gerais/criar_utilizador.jpg";	
				};
			//$( "#mostra_area_criar" ).click(function() {$( "#mostra_area" ).toggle( "slow" );});
		}
		</script>
         <br>
		<?php
        $select = "SELECT 
                        users.* 
                    FROM 
                        users 
                    WHERE users.eliminado =0
						AND users.idlogin != 1 
							ORDER BY user ASC";
        $resultado = mysqli_query($conn, $select);
		$numero_de_linhas = mysqli_num_rows($resultado);
        ?>        
         <table id="utilizadores">
         	<tr style="height:30px; color: #000; background-color:#CCC">
                 <td align="center" style="width:100px; font-weight:bold">Foto</td>
                 <td align="center" style="width:150px; font-weight:bold"">Utilizador</td>
                 <td align="center" style="width:150px; font-weight:bold"">Permissão</td>
                 <td align="center" style="width:150px; font-weight:bold"">Cota máxima</td>
                 <td align="center" style="width:150px; font-weight:bold"">Cota utilizada</td>
                 <td align="center" style="width:150px; font-weight:bold"">Estado</td>
                 <td align="center" style="width:150px; font-weight:bold"">Data de criação</td>
                 <td align="center" style="width:300px; font-weight:bold""></td>
         	</tr>
         <?php
		 while ($linha=mysqli_fetch_array($resultado))
			{
			echo '<tr style="height:40px; border:thin; border-top-color:#CCC; border-top-style:solid">';
				echo '<td align="center">';
					echo '<img src="/imagens/imagens_utilizador/'.$linha['fotografia'].'" height="30px" width="30px" />';	
				echo '</td>';
				echo '<td align="center">';
					echo $linha['user'];	
				echo '</td>';
				echo '<td align="center">';
					$select = "SELECT 
                        	permissions.descriptions 
                    		FROM 
                        		permissions 
                    			WHERE 
								permissions.id_permissions =".$linha['permissions_id_permissions'];
					$resultado1 = mysqli_query($conn, $select);
					$linha1=mysqli_fetch_array($resultado1);
					echo $linha1['descriptions'];
				echo '</td>';
				echo '<td align="center">';
					echo (round(($linha['cota_maxima']/1000000),1).' MB');	
				echo '</td>';
				echo '<td align="center">';
					echo (round(($linha['cota_utilizada']/1000000),1).' MB');	
				echo '</td>';
				echo '<td align="center">';
					$select = "SELECT 
                        	lock_descriptions.descriptions 
                    		FROM 
                        		lock_descriptions 
                    		WHERE 
								lock_descriptions.id_lock_description =".$linha['lock_descriptions_id_lock_description'];
					$resultado1 = mysqli_query($conn, $select);
					$linha1=mysqli_fetch_array($resultado1);
					echo $linha1['descriptions'];
				echo '</td>';				
				echo '<td align="center">';
					echo $linha['data_criacao'];	
				echo '</td>';				
				echo '<td align="center">';
					echo '<img id="mostra_dados_utilizador" onClick="mostra_dados_user('.$linha['idlogin'].')" src="/imagens/imagens_gerais/consultar.jpg" style="height:25px; width:25px" > ';
					echo '<img id="mostra_dados_utilizador" onClick="mostra_edita_dados_user('.$linha['idlogin'].')"  src="/imagens/imagens_gerais/editar.jpg" style="height:25px; width:25px" > ';
					echo '<img id="mostra_dados_utilizador"
 onClick="mostra_eliminar_dados_user('.$linha['idlogin'].')" src="/imagens/imagens_gerais/eliminar.jpg" style="height:25px; width:25px" > ';	
				echo '</td>';												
			echo '</tr>';
			//*************************************************zona de consultar utilizador*****************************************************************
			echo '<tr>';
				echo '<td colspan="8">';
				echo '<div id="tr'.$linha['idlogin'].'" style="display: none">'; //**************************é a div que é escondida com o click na imagem id="mostra_dados_utilizador"
				?>
                        <br>
                        Nome do aluno:<span style="font-weight:bold"> <?php echo $linha['nome_do_aluno']?> </span>
                        <br><br>
                        Nº processo aluno: <span style="font-weight:bold"><?php echo $linha['numero_proceso_aluno']?></span>
                        <br><br>
                        Email do aluno: <span style="font-weight:bold"><?php echo $linha['email']?></span>
                        <br><br>                      
                        Permissão: 
                        	<?php
							$select2 = "SELECT 
											permissions.descriptions  
										FROM 
											permissions
										WHERE 
											permissions.id_permissions ='". $linha['permissions_id_permissions']."' 
											LIMIT 1";		
							$resultado2 = mysqli_query($conn, $select2);
							$linha2=mysqli_fetch_array($resultado2);
							echo '<span style="font-weight:bold">'.$linha2['descriptions'].'</span>';
							?>
                        <br><br>
                        Estado: 
                        	<?php
							$select7 = "SELECT 
										lock_descriptions.descriptions  
										FROM 
											lock_descriptions
										WHERE
											lock_descriptions.id_lock_description='".$linha['lock_descriptions_id_lock_description']."' 
											LIMIT 1" ;		
							$resultado7 = mysqli_query($conn, $select7);
							$linha7=mysqli_fetch_array($resultado7);
							echo '<span style="font-weight:bold">'.$linha7["descriptions"].'</span>';
																						
							?>
                        <br><br>
                        Tentativas restantes: 
                        	<?php
							echo '<span style="font-weight:bold">'.$linha['attempts'].'</span>';
							?>
                        <br><br> 
                        Cota utilizada:
                        	<?php
							echo '<span style="font-weight:bold">'.$linha['cota_utilizada'].' MB</span>';
							?>                                         
                        <br><br>
                        Cota disponível:
                        	<?php
							echo '<span style="font-weight:bold">'.($linha['cota_maxima']-$linha['cota_utilizada']).' MB</span>';
							?>                                         
                        <br><br>
                        Cota máxima:
                        	<?php
							echo '<span style="font-weight:bold">'.$linha['cota_maxima'].' MB</span>';
							?>                         
                        <br><br>
                        Foto
                        <br>
                        <br>
                         <img src="/imagens/imagens_utilizador/<?php echo $linha['fotografia']?>" id="blah<?php echo $linha['idlogin']?>" height="140" width="140" />          
                        <br>	
                        <br><br>
				<?PHP
				echo '</div>';
				//*************************************************zona de editar utilizador*****************************************************************
				echo '<div id="tre'.$linha['idlogin'].'" style="display: none">'; //**************************é a div que é escondida com o click na imagem id="mostra_dados_utilizador"
				?>
                	<form name="editar_utilizador<?php echo $linha['idlogin']?>" id="editar_utilizador<?php echo $linha['idlogin']?>" method="post" action="editar_utilizador_mysql.php" enctype="multipart/form-data">
						<br>
                        <input type="text" name="idlogin_escondido" id="idlogin_escondido<?php echo $linha['idlogin']?>" value="" style="display:none">
                        Nome do aluno: <input type="text" id="nome_aluno" name="nome_aluno" value="<?php echo $linha['nome_do_aluno']?>">
                        <br><br>
                        Nº processo aluno: <input type="text" id="processo_aluno" name="processo_aluno" value="<?php echo $linha['numero_proceso_aluno']?>">
                        <br><br>
                        Email do aluno: <input type="email" id="email_aluno" name="email_aluno" value="<?php echo $linha['email']?>">
                        <br><br>
                        Palavra-passe: 
                        <input type="text" id="password<?php echo $linha['idlogin']?>" name="password" value="*************" readonly> 
                        <input type="checkbox" id="muda_password<?php echo $linha['idlogin']?>" name="muda_password" onChange="muda_pass(<?php echo $linha['idlogin']?>)" >Clique aqui para escolher nova  password!

                        <br><br>                        
                        Permissão: 
                        <select id="permissao" name="permissao" style="width:204px" required="required">
                        	<option value="" style="display:none">Escolha uma opção</option>
                        	<?php
							$select2 = "SELECT 
											permissions.id_permissions,
											permissions.descriptions  
										FROM 
											permissions" ;		
							$resultado2 = mysqli_query($conn, $select2);
							while ($linha2=mysqli_fetch_array($resultado2))
										{
										if($linha['permissions_id_permissions']==$linha2['id_permissions'])
											{
											echo '<option value="'.$linha2["id_permissions"].'" selected>'.$linha2["descriptions"].'</option>';
											}
										else
											{
											echo '<option value="'.$linha2["id_permissions"].'">'.$linha2["descriptions"].'</option>';
											}
										};												
							?>
						</select>
                        <br><br>
                        Estado: 
                        <select id="estado" name="estado" style="width:204px" required="required">
                        	<option value="" style="display:none">Escolha uma opção</option>
                        	<?php
							$select7 = "SELECT 
											lock_descriptions.id_lock_description,
											lock_descriptions.descriptions  
										FROM 
											lock_descriptions" ;		
							$resultado7 = mysqli_query($conn, $select7);
							while ($linha7=mysqli_fetch_array($resultado7))
										{
										if($linha['lock_descriptions_id_lock_description']==$linha7['id_lock_description'])
											{
											echo '<option value="'.$linha7["id_lock_description"].'" selected>'.$linha7["descriptions"].'</option>';
											}
										else
											{
											echo '<option value="'.$linha7["id_lock_description"].'">'.$linha7["descriptions"].'</option>';
											}
										};												
							?>
						</select>
                        <br><br>                                                
                    	Tentativas restantes:
                        <select id="tentativas" name="tentativas" style="width:50px" required="required">
                        	<?php
							for ($i=0;$i<21; $i++)
								{
								if ($i==$linha['attempts'])
									{
									echo '<option value="'.$i.'" selected>'.$i.'</option>';
									}
								else
									{
									echo '<option value="'.$i.'">'.$i.'</option>';	
									}
								};												
							?>
						</select>
                        <br><br>
                        Cota máxima: 
                        <select id="cota_maxima" name="cota_maxima" style="width:150px" required="required">
                        	<?php
							for ($i=500;$i<901; $i=$i+100)
								{
									if($i==$linha['cota_maxima'])
									{
									echo '<option value="'.($i*1000000).'" selected>'.$i.' MB</option>';	
									}
									else
									{
									echo '<option value="'.($i*1000000).'">'.$i.' MB</option>';
									}
								};
							for ($i=1000;$i<3001; $i=$i+500)
								{
									if($i==$linha['cota_maxima'])
									{
									echo '<option value="'.($i*1000000).'" selected>'.($i/1000).' GB</option>';	
									}
									else
									{
									echo '<option value="'.($i*1000000).'">'.($i/1000).' GB</option>';
									}
								};																					
							?>
						</select>                        
                        <br><br>
                        Foto
                        <br>
                        <br>
                         <img src="/imagens/imagens_utilizador/<?php echo $linha['fotografia']?>" id="blah2<?php echo $linha['idlogin']?>" height="140" width="140" />          
                        <br>
                        <br>
                          <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this,<?php echo $linha['idlogin']?>)"> 
                        
                        <br>		
                        <?PHP
						
						if (isset($_SESSION['imagem_demasiado_grande']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Ficheiro demasiado grande! Tente novamente com outro ficheiro com tamanho inferior a 500KB.</p>';
								unset($_SESSION["imagem_demasiado_grande"]);	
								}
						if (isset($_SESSION['tipo_imagem_errada']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Tipo de ficheiro errado! Tente com ficheiros do tipo ".jpg; .bmp; jpeg".</p>';
								unset($_SESSION["tipo_imagem_errada"]);	
								}							
						?>
                        <br>
                        <button type="button" onClick="altera_dados(<?php echo $linha['idlogin']?>)">
								Guardar alterações
						</button>
                        <!--<input type="submit" value="Criar utilizador" name="submit">--> 
             </form>	                                        
				<?PHP				
				echo '</div>';
		//********************************************************************************************************************************************
//*************************************************zona de eliminar utilizador*****************************************************************
				echo '<div id="treliminar'.$linha['idlogin'].'" style="display: none">'; //**************************é a div que é escondida com o click na imagem id="mostra_dados_utilizador"
				?>
                	<form name="eliminar_utilizador<?php echo $linha['idlogin']?>" id="eliminar_utilizador<?php echo $linha['idlogin']?>" method="post" action="eliminar_utilizador_mysql.php" enctype="multipart/form-data">
						<br>
                        <input type="text" name="idlogin_escondido_eliminar" id="idlogin_escondido_eliminar<?php echo $linha['idlogin'];?>" value="" style="display:none">
                        Nome do aluno:<span style="font-weight:bold"> <?php echo $linha['nome_do_aluno']?> </span>
                        <br><br>
                        Nº processo aluno: <span style="font-weight:bold"><?php echo $linha['numero_proceso_aluno']?></span>
                        <br><br>
                        Email do aluno: <span style="font-weight:bold"><?php echo $linha['email']?></span>
                        <br><br>                      
                        Permissão: 
                        	<?php
							$select2 = "SELECT 
											permissions.descriptions  
										FROM 
											permissions
										WHERE 
											permissions.id_permissions ='". $linha['permissions_id_permissions']."' 
											LIMIT 1";		
							$resultado2 = mysqli_query($conn, $select2);
							$linha2=mysqli_fetch_array($resultado2);
							echo '<span style="font-weight:bold">'.$linha2['descriptions'].'</span>';
							?>
                        <br><br>
                        Estado: 
                        	<?php
							$select7 = "SELECT 
										lock_descriptions.descriptions  
										FROM 
											lock_descriptions
										WHERE
											lock_descriptions.id_lock_description='".$linha['lock_descriptions_id_lock_description']."' 
											LIMIT 1" ;		
							$resultado7 = mysqli_query($conn, $select7);
							$linha7=mysqli_fetch_array($resultado7);
							echo '<span style="font-weight:bold">'.$linha7["descriptions"].'</span>';
																						
							?>
                        <br><br>
                        Tentativas restantes: 
                        	<?php
							echo '<span style="font-weight:bold">'.$linha['attempts'].'</span>';
							?>
                        <br><br>
                        Cota máxima:
                        	<?php
							echo '<span style="font-weight:bold">'.$linha['cota_maxima'].' MB</span>';
							?>                         
                        <br><br>
                        Foto
                        <br>
                        <br>
                         <img src="/imagens/imagens_utilizador/<?php echo $linha['fotografia']?>" id="blah<?php echo $linha['idlogin']?>" height="140" width="140" />          
                        <br>		
                        <?PHP
						
						if (isset($_SESSION['imagem_demasiado_grande']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Ficheiro demasiado grande! Tente novamente com outro ficheiro com tamanho inferior a 500KB.</p>';
								unset($_SESSION["imagem_demasiado_grande"]);	
								}
						if (isset($_SESSION['tipo_imagem_errada']))
								{
								echo '<p style=" color:#F00; font-weight:bold"">Tipo de ficheiro errado! Tente com ficheiros do tipo ".jpg; .bmp; jpeg".</p>';
								unset($_SESSION["tipo_imagem_errada"]);	
								}							
						?>
                        <br>
                        <button type="button" onClick="elimina_utilizador(<?php echo $linha['idlogin']?>)">
								Eliminar o utilizador
						</button>
             </form>	                                        
				<?PHP				
				echo '</div>';
		//********************************************************************************************************************************************
				echo '</td>';
			echo '</tr>';			//********************************************************************************************************************************************			
			};
		 ?>
        </table>
 <script>
	function muda_pass(p)
		{
		if(document.getElementById('muda_password'+p).checked==true) 
			{
			document.getElementById('password'+p).readOnly=false;
			document.getElementById('password'+p).value="";	
			} 
		else
			{
			document.getElementById('password'+p).readOnly=true;
			document.getElementById('password'+p).value="*************";		
			};
		}

 	function mostra_dados_user(a)
		{			
			b="#tr"+a; //# é utilizado no jquery em vez do document.getElementById(b)			
			c="#tre"+a;
			d="#treliminar"+a;
			$( b ).toggle( "slow" ); //é o show() e hide() numa função ----jquery	
			if	($(c).is(':visible')) //testa se o elemento com id = "#tre"+a está visivel (ocupa área no documento)
				{
				 	$( c ).toggle( "slow" );
				};
			if	($(d).is(':visible')) //testa se o elemento com id = "#tre"+a está visivel (ocupa área no documento)
				{
				 	$( d ).toggle( "slow" );
				};
		}
 	function mostra_edita_dados_user(a)
		{	
			b="#tr"+a; //# é utilizado no jquery em vez do document.getElementById(b)			
			c="#tre"+a;
			d="#treliminar"+a;
			$( c ).toggle( "slow" ); //é o show() e hide() numa função ----jquery
			if	($(b).is(':visible')) //testa se o elemento com id = "#tre"+a está visivel (ocupa área no documento)
				{
				 	$( b ).toggle( "slow" );
				};
			if	($(d).is(':visible')) //testa se o elemento com id = "#tre"+a está visivel (ocupa área no documento)
				{
				 	$( d ).toggle( "slow" );
				};								
		}
 	function mostra_eliminar_dados_user(a)
		{	
			b="#tr"+a; //# é utilizado no jquery em vez do document.getElementById(b)			
			c="#tre"+a;
			d="#treliminar"+a;
			$( d ).toggle( "slow" ); //é o show() e hide() numa função ----jquery
			if	($(b).is(':visible')) //testa se o elemento com id = "#tre"+a está visivel (ocupa área no documento)
				{
				 	$( b ).toggle( "slow" );
				};
			if	($(c).is(':visible')) //testa se o elemento com id = "#tre"+a está visivel (ocupa área no documento)
				{
				 	$( c ).toggle( "slow" );
				};								
		}
	function altera_dados(e) 
		{
			document.getElementById("idlogin_escondido"+e).value=e;
			f="editar_utilizador"+e;															
			document.getElementById(f).submit();							
		}
	function elimina_utilizador(e) 
		{			
			document.getElementById("idlogin_escondido_eliminar"+e).value=e;
			f="eliminar_utilizador"+e;															
			document.getElementById(f).submit();							
		}		
 </script>       
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <?PHP 
		if (isset($_SESSION['utilizador_actualizado_com_sucesso']))
		{
		?>	
		<script type="text/javascript">
			swal("Sucesso!", "Utilizador atualizado com sucesso!", "success");
        </script>
		<?PHP unset($_SESSION["utilizador_actualizado_com_sucesso"]);	
		}


		if (isset($_SESSION['utilizador_eliminado_com_sucesso']))
		{
		?>	
		<script type="text/javascript">
			swal("Sucesso!", "Utilizador eliminado com sucesso!", "success");
        </script>
		<?PHP unset($_SESSION["utilizador_eliminado_com_sucesso"]);	
		}
		
		if (isset($_SESSION['utilizador__empresa_nao_pode_ser_eliminado']))
		{
		?>	
		<script type="text/javascript">
			swal("Erro!", "Utilizador não pode ser eliminado!", "error");
        </script>
		<?PHP unset($_SESSION["utilizador__empresa_nao_pode_ser_eliminado"]);	
		}

		if (isset($_SESSION['utilizador_nao_e_empresa_ou_admin']))
		{
		?>	
		<script type="text/javascript">
			swal("Erro!", "Não tem permissão para eliminar administradores!", "error");
        </script>
		<?PHP unset($_SESSION["utilizador_nao_e_empresa_ou_admin"]);	
		}
	?>
    <br>
    <br>
    <br>
</body>

</html>
