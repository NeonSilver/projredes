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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
	<script>
    //********************************função que verifica se o nome do ficheiro já existe na directoria do utilizador e submete consoante as escolhas******
    $(document).ready(function(){
        $("#gravar_novo_ficheiro").click(function(){
			if (($("#fileToUpload").prop("value")) != "")
			{
            //alert ($("#fileToUpload").prop("value"));
            $.post(
                "testa_se_ja_existe_o_ficheiro_para_upload.php",
                {
                    valor1:  $("#fileToUpload").prop("value")
                },
                function(resposta, estado) {
                    //alert(resposta + " " + estado);
                    //$("#contentor").prop("innerHTML", resposta);
                    if (resposta=="﻿nome_ficheiro_ja_existe") 
                        {
                            //alert(resposta);
							swal({
								  title: "O ficheiro já existe na pasta destino. Quer continuar?",
								  text: "Se continuar, irá perder o ficheiro da pasta de destino!",
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => { //surge como erro mas funciona
								  if (willDelete) {
									  document.getElementById("upload_ficheiros").submit();
									;
								  } else {
									swal("O ficheiro não foi copiado e o ficheiro na pasta destino está a salvo!");
								  }
							});
                        }
                    else
                        {
                            document.getElementById("upload_ficheiros").submit();
                        }
                }
            )
            .done(function() {
                //alert( "sucesso" );
            })
            .fail(function() {
                //alert( "erro" );
            })
            .always(function() {
                //alert( "terminou" );
            });
			}
        });
    });
    //*******************************************************************************************************
    </script>
    <!-- ********************************************************************************************* -->   
    
</head>

<body>
    <div id="wrapper">
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
 include ($_SERVER['DOCUMENT_ROOT']."/menu_alunos.php"); 
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
                <form name="upload_ficheiros" id="upload_ficheiros" method="post" action="upload_ficheiros_mysql.php" enctype="multipart/form-data" >
                	<input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <hr style="color:#00F;font-weight:bold; width:200px; margin-left:0px">
                	<button type="button" id="gravar_novo_ficheiro">Gravar</button>
                </form>

					<?php
        				$select = "SELECT 
                        				ficheiros.* 
                    				FROM 
                        				ficheiros 
                    				WHERE ficheiros.eliminado = 0
										AND ficheiros.id_login_fk = '".$_SESSION['id_utilizador']."'  
											ORDER BY nome_do_ficheiro ASC";
        				$resultado = mysqli_query($conn, $select);
        			?>                
            	         <hr style="color:#00F;font-weight:bold; width:200px; margin-left:0px">
                         <table id="utilizadores" style="border:thick, #00C">
                         	<tr style="height:30px; color: #000; background-color:#CCC">
                                <td align="center" style="width:150px; font-weight:bold">nome</td>
                                <td align="center" style="width:70px; font-weight:bold">tamanho</td>
                                <td align="center" style="width:150px; font-weight:bold">data_upload</td>
                                <td align="center" style="width:80px; font-weight:bold; margin-left:auto"></td>
                            </tr>
                    <?php
						while ($linha=mysqli_fetch_array($resultado))
							{
							?>
                            <form name="ficheiros<?php echo $linha['id_ficheiros']?>" id="ficheiros<?php echo $linha['id_ficheiros']?>" method="post" action="eliminar_ficheiros_mysql.php" enctype="multipart/form-data">
                            <?php
							echo '<tr style="height:40px; border:thin; border-top-color:#CCC; border-top-style:solid">';
								echo '<td style="text-align:center">';
									echo $linha['nome_do_ficheiro'];	
								echo '</td>';
								echo '<td style="text-align:center">';
									echo (round($linha['tamanho_ficheiro']/1000)." KB");	
								echo '</td>';
								echo '<td style="text-align:center">';
									echo $linha['data_upload'];	
								echo '</td>';
								echo '<td style="text-align:center">';
									echo '<img id="elimina_ficheiro" name="elimina_ficheiro" onClick="elimina('.$linha['id_ficheiros'].')" src="/imagens/imagens_gerais/elimina_ficheiro.png" style="height:22px; width:22px" >';
									echo (" ");
									echo '<img id="download_ficheiro" name="download_ficheiro" onClick="download('.$linha['id_ficheiros'].')"  src="/imagens/imagens_gerais/download.jpg" style="height:22px; width:22px" > ';
									?> <input type="text" name="id_ficheiro_escondido" id="id_ficheiro_escondido" value="<?php echo $linha["id_ficheiros"]?>" style="display:none">
                                    <?php
								echo '</td>';												
							echo '</tr>';
						?></form> <?php
							}
					?>
                          </table>
            </div>
            <!-- /.row -->    
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
	<script>
		function elimina(e) 
			{
			f="ficheiros"+e;															
			document.getElementById(f).submit();
			}
		function download(e) 
			{
			f="ficheiros"+e;
			document.getElementById(f).action ="download_ficheiro_mysql.php";															
			document.getElementById(f).submit();
			}			
 	</script>
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
		if (isset($_SESSION['ficheiro_gravado']))
			{
	?>	
			<script type="text/javascript">
				swal("Sucesso!", "Ficheiro gravado com sucesso!", "success");
            </script>
	<?PHP 	unset($_SESSION["ficheiro_gravado"]);	
			}
			
		if (isset($_SESSION['ficheiro_demasiado_grande']))
			{
	?>
			<script type="text/javascript">
				swal("Erro!", "Ficheiro demasiado grande para a cota disponível!", "error");
            </script>
    <?PHP
			unset($_SESSION["ficheiro_demasiado_grande"]);	
			}													
	?> 	

</body>

</html>
