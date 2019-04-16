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
                $('#blah'+t).attr('src', e.target.result);
            }
            document.getElementById("blah"+t).style.display="block";
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
                    <h1 class="page-header" style="color: #30F; font-style:italic">Área de gestão de ficheiros</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->        
       <script>
		function muda_imagem(e)
		{	
			f= "mostra_dados_utilizador"+e;		
			if (document.getElementById(f).getAttribute('src')=="/imagens/imagens_gerais/mais.jpg")
				{
				document.getElementById(f).src="/imagens/imagens_gerais/menos.jpg";	
				}
			else
				{
				document.getElementById(f).src="/imagens/imagens_gerais/mais.jpg";	
				};
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
						AND users.permissions_id_permissions != 1  
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
                 <td align="center" style="width:50px; font-weight:bold""></td>
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
					echo (round(($linha['cota_maxima']/1000000)).' MB');	
				echo '</td>';
				echo '<td align="center">';
					echo (round(($linha['cota_utilizada']/1000000)).' MB');	
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
					echo '<img id="mostra_dados_utilizador'.$linha['idlogin'].'" onClick="mostra_edita_dados_user('.$linha['idlogin'].'),muda_imagem('.$linha['idlogin'].')"  src="/imagens/imagens_gerais/mais.jpg" style="height:20px; width:20px" > ';
				echo '</td>';												
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="8">';
				//*************************************************zona  dos ficheiros do utilizador*****************************************************************
				echo '<div id="tre'.$linha['idlogin'].'" style="display: none">'; //**************************é a div que é escondida com o click na imagem id="mostra_dados_utilizador"
				?>
					<?php
        				$select7 = "SELECT 
                        				ficheiros.* 
                    				FROM 
                        				ficheiros 
                    				WHERE ficheiros.eliminado = 0
										AND ficheiros.id_login_fk = '".$linha['idlogin']."'  
											ORDER BY nome_do_ficheiro ASC";
        				$resultado7 = mysqli_query($conn, $select7);
        			?>   <br>             
                         <table align="center" id="utilizadores" style="border:thick, #00C">
                         	<tr style="height:30px; color: #000">
                                <td align="center" style="width:150px; font-weight:bold">nome</td>
                                <td align="center" style="width:70px; font-weight:bold">tamanho</td>
                                <td align="center" style="width:150px; font-weight:bold">data_upload</td>
                                <td align="center" style="width:80px; font-weight:bold; margin-left:auto"></td>
                            </tr>
                    <?php
						while ($linha7=mysqli_fetch_array($resultado7))
							{
							?>
                            <form name="ficheiros<?php echo $linha7['id_ficheiros']?>" id="ficheiros<?php echo $linha7['id_ficheiros']?>" method="post" action="eliminar_ficheiros_mysql.php" enctype="multipart/form-data">
                            <?php
							echo '<tr>';
								echo '<td style="text-align:center">';
									echo $linha7['nome_do_ficheiro'];	
								echo '</td>';
								echo '<td style="text-align:center">';
									echo (round($linha7['tamanho_ficheiro']/1000)." KB");	
								echo '</td>';
								echo '<td style="text-align:center">';
									echo $linha7['data_upload'];	
								echo '</td>';
								echo '<td style="text-align:center">';
									echo '<img id="elimina_ficheiro" name="elimina_ficheiro" onClick="elimina('.$linha7['id_ficheiros'].')" src="/imagens/imagens_gerais/elimina_ficheiro.png" style="height:22px; width:22px" >';
									echo '<img id="download_ficheiro" name="download_ficheiro" onClick="download('.$linha7['id_ficheiros'].')"  src="/imagens/imagens_gerais/download.jpg" style="height:22px; width:22px" > ';
									?> <input type="text" name="id_ficheiro_escondido" id="id_ficheiro_escondido" value="<?php echo $linha7["id_ficheiros"]?>" style="display:none">
                                    <input type="text" name="id_user_escondido" id="id_user_escondido" value="<?php echo $linha7["id_login_fk"]?>" style="display:none">
                                    <?php
								echo '</td>';												
							echo '</tr>';
						?></form> <?php
							}
					?>
                          </table>	
                          <br> 
                          <br>                                         
				<?PHP				
				echo '</div>';
		//********************************************************************************************************************************************
				echo '</td>';
			echo '</tr>';			//********************************************************************************************************************************************			
			};
		 ?>
        </table>
 <script>
 	<?php
	 	if (isset($_SESSION['utilizador_escolhido']))
			{
			echo ('c="#tre"+'.$_SESSION['utilizador_escolhido'].' ;');?>
			$( c ).toggle( "slow" ); //é o show() e hide() numa função ----jquery
			<?php
			unset($_SESSION["utilizador_escolhido"]);	
			};
	?>
 	function mostra_edita_dados_user(a)
		{	
			 //# é utilizado no jquery em vez do document.getElementById(b)			
			c="#tre"+a;
			$( c ).toggle( "slow" ); //é o show() e hide() numa função ----jquery							
		}
		
	function altera_dados(e) 
		{
			document.getElementById("idlogin_escondido"+e).value=e;
			f="editar_utilizador"+e;															
			document.getElementById(f).submit();							
		}
	
	function elimina(e) 
			{
			f="ficheiros"+e;
			document.getElementById(f).action ="eliminar_ficheiros_mysql.php";															
			document.getElementById(f).submit();			
			}
			
	function download(e) 
			{
			f="ficheiros"+e;
			document.getElementById(f).action ="download_ficheiro_mysql.php";															
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
</body>

</html>
