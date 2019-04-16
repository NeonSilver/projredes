<ul class="nav" id="side-menu">
                        <li>
                            <a href="/administracao/utilizadores/utilizadores.php"><i class="fa fa-bar-chart-o fa-fw"></i> Utilizadores</a>                           
                        </li>
                        <li>
                            <a href="/administracao/utilizadores/gestao_ficheiros_admin.php"><i class="fa fa-dashboard fa-fw"></i> Gestão de ficheiros</a>
                        <li>
                            <a href="/logout.php" style="color:#F00"><i class="fa fa-edit fa-fw"></i>Terminar sessão</a>
                        </li> 
                        <li>
                            <?PHP                            
								echo '<img style="padding-left:30px; padding-top:30px" src="/imagens/imagens_utilizador/'.$_SESSION['fotografia'].'" height="100" width="110" />';
								echo '<p style="padding-left:30px"> '.$_SESSION['utilizador'].' </p>';
							?>
                        </li>                        
</ul>