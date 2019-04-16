
<ul class="nav" id="side-menu">
                            <a href="/logout.php" style="color:#F00"><i class="fa fa-edit fa-fw"></i>Terminar sessão</a>
                        </li> 
                        <li>
                            <?PHP
        						$select = "SELECT 
                        				users.cota_maxima, users.cota_utilizada 
                    				FROM 
                        				users 
                    				WHERE users.idlogin = '".$_SESSION['id_utilizador']."'";
        						$resultado_user_presente = mysqli_query($conn, $select);
								$linha_user_presente=mysqli_fetch_array($resultado_user_presente);
														
								echo '<img style="padding-left:30px; padding-top:30px" src="/imagens/imagens_utilizador/'.$_SESSION['fotografia'].'" height="100" width="110" />';
								echo '<p style="padding-left:50px; font-size:12px; font-weight:bold"> '.$_SESSION['utilizador'].' </p>';
								echo '<p style="padding-left:12px; font-size:11px; font-weight:bold"> Cota utilizada: '.(round(($linha_user_presente['cota_utilizada'])/1000000,1)).' MB  </p>';
								echo '<p style="padding-left:12px; font-size:11px; font-weight:bold"> Cota disponível: '.(round(($linha_user_presente['cota_maxima']-$linha_user_presente['cota_utilizada'])/1000000,1)).' MB  </p>';
							?>
                        </li>                     
</ul>