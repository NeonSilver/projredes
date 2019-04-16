<?php 
session_start(); //para utilizar "session" tem de estar aqui no topo e em todos os scripts
//*************************************para eliminar a variável session 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ESAB - BROX</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">
<!--===============================================================================================-->
	<script type="text/javascript">
	function focus_on_input()
	{
	document.getElementById('username').focus();
	}
		
	function limpa_input()
	{				
	document.getElementById('username').value = "";
	document.getElementById('username').focus();
	document.getElementById('password').value = "";
	}
	var timerId=0;	
	function timer1()
	{
	clearTimeout(timerId);
	timerId = setTimeout(limpa_input,4000); //***espera 4s e depois executa a função limpa_input()
	}	
	</script> 
</head>
<body onLoad="focus_on_input()">
	
	<div class="limiter">
		<div class="container-login100" style="background-image:url(/images/bg-02.jpg); background-repeat:no-repeat; background-size: auto; background-size: cover;">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form name="login" id="login" method="post" class="login100-form validate-form" action="teste_user.php" >
					<span class="login100-form-title p-b-49" style="font-size:26px">
						ESAB - BROX
                        <br>
                        <p>
                         <?php 
						 //*******escreve o ano letivo consoante a data presente*****
							$letivo_ano=date("Y");
							$letivo_mes=date("n");
							if($letivo_mes >= 9) 
									{echo $letivo_ano.' | '.($letivo_ano+1);}
								else
									{echo (($letivo_ano-1).' | '.($letivo_ano));};		
						//*********************************************
        				?>
                        </p> 
						<p style="font-size:18px; font-weight:bold">
                        Sistema de Gestão de Ficheiros 
                        </p> 
					</span>                    

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Utilizador</span>
						<input class="input100" type="text" id="username" name="username" placeholder="Introduza o nome de utilizador" onKeyPress="timer1()">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
                        
                        <?PHP 
						if (isset($_SESSION['utilizador_eliminado']))
								{
								echo '<p style="color:#900">Utilizador está eliminado!</p>';
								unset($_SESSION["utilizador_eliminado"]);	
								}
						if (isset($_SESSION['utilizador_nao_existe']))
								{
								echo '<p style="color:#900">Utilizador não registado!</p>';
								unset($_SESSION["utilizador_nao_existe"]);	
								}
						if (isset($_SESSION['tentativas_zero']))
								{
								echo '<p style="color:#900">Utilizador bloqueado!</p>';
								unset($_SESSION["tentativas_zero"]);	
								}													
						?>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Palavra-passe</span>
						<input class="input100" type="password" id="password" name="password" placeholder="Introduza a sua palavra-passe" onKeyPress="timer1()">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
                        <?PHP 
						if (isset($_SESSION['password_errada']))
								{
								if ($_SESSION['tentativas_restantes']==0)
									{
									echo '<p style="color:#900">Password errada! Restam '.$_SESSION['tentativas_restantes'].' tentativa(s). Utilizador bloqueado!</p>';
									}
								else
									{
									echo '<p style="color:#900">Password errada! Restam '.$_SESSION['tentativas_restantes'].' tentativa(s).</p>';
									}
								unset($_SESSION["password_errada"]);
								unset($_SESSION["tentativas_restantes"]);	
								}								
						?>					
					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Esqueceu a palavra-passe?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Iniciar sessão
							</button>
						</div>            
					</div>	
				</form>
                <br>
                <br>
                <p style="text-align:center; color:#006; font-size:14px">Desenvolvido por José Carlos Martins</p>
			</div>
		</div>
	</div>

	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/daterangepicker/moment.min.js"></script>
	<script src="/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
<?PHP 
//**************destroi as variáveis sessão que foram criadas no teste_user.php*************
	unset($_SESSION["permissao_utilizador"]);
	unset($_SESSION["id_utilizador"]);
	unset($_SESSION["utilizador"]);
	session_destroy();
//******************************************************************************************	
?>
</html>