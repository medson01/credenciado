<?php 

  
// Arquivo de configuração
  require_once "./config/config.php";
	
  $login = strtoupper($_POST['login']);
  $entrar = $_POST['entrar'];
  $senha = $_POST['senha'];


  
    if (isset($entrar)) {
            
      $verifica = mysqli_query($conn,"SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'") or die("erro ao selecionar");
        if (mysqli_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.html';</script>";
          die();

        }else{

        	//mysqli_query("UPDATE usuarios SET ultimo_logon = CURRENT_TIMESTAMP(0) where login = '$login'");
        	
              while($registro = mysqli_fetch_assoc($verifica)){

        				switch ($registro["perfil"]) {
        					case "administrador":
        								setcookie("login",$login);
                        $_SESSION["login"] = $registro["nome"];
        								$_SESSION["perfil"] = $registro["perfil"];	
                        $_SESSION["id"] = $registro["id"];	
								        $_SESSION["id_credenciado"] = $registro["id_credenciado"];
										  									
        						break;


                 case "medico":
                        setcookie("login",$login);
                        $_SESSION["login"] = $registro["nome"];
                        $_SESSION["perfil"] = $registro["perfil"];
                        $_SESSION["id"] = $registro["id"]; 
                        $_SESSION["id_credenciado"] = $registro["id_credenciado"];   
                                              
                    break;
               

								case "auditor":
  										setcookie("login",$login);
                      $_SESSION["login"] = $registro["nome"];
  										$_SESSION["perfil"] = $registro["perfil"];  
  										$_SESSION["id"] = $registro["id"]; 
                      $_SESSION["id_credenciado"] = $registro["id_credenciado"];    
  										         
									
								break;
        							
        						case "usuario":
        								setcookie("login",$login);
                        $_SESSION["login"] = $registro["nome"];
        							 	$_SESSION["perfil"] = $registro["perfil"];
        								$_SESSION["id"] = $registro["id"]; 
                        $_SESSION["id_credenciado"] = $registro["id_credenciado"]; 	
										    							 				
        						break;
        					}
        			}
          $sql = "UPDATE `usuarios` SET `ultimo_logon`= '".date("Y-m-d H:i:s" )."' WHERE `id` = '".$_SESSION["id"]."'";

          $update = mysqli_query($conn,$sql); 

          echo"<script language='javascript' type='text/javascript'>alert('Aguarde um minuto at\u00e9 a p\u00e1gina ser carregada.');window.location.href='files/principal.php';</script>";
          
			
			
        }
    }

     mysqli_close($conn);
?>