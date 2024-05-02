
<?php 

	// Arquivo de configuração
 require_once "../config/config.php";


$nome = strtoupper($_POST["nome"]);
$sobre_nome = strtoupper($_POST["sobre_nome"]);
$login = strtoupper($_POST["login"]);
$perfil = $_POST["perfil"];
$senha = $_POST['senha'];
$id_credenciado = $_POST['empresa'];
$sql = mysqli_query($conn,"SELECT login FROM usuarios WHERE login = '$login'") or die("erro ao carregar os usuários");
$array = mysqli_fetch_array($sql, MYSQLI_ASSOC);
$logarray = $array['login'];

  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='painel.php?caduser=1';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>alert('Esse login j\u00e1 existe');window.location.href='painel.php?caduser=1';</script>";
        die();

      }else{
         $query = "INSERT INTO usuarios (id_credenciado,nome,sobre_nome,login,senha,perfil) VALUES ('$id_credenciado','$nome','$sobre_nome','$login','$senha','$perfil')";
        $insert = mysqli_query($conn, $query);
        
        if($insert){
          echo"<script language='javascript' type='text/javascript'>alert('Usu\u00e1rio cadastrado com sucesso!');window.location.href='painel.php?caduser=1'</script>";
        }else{
       //   echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse Usu\u00e1rio');window.location.href='form_cadastro_usuario.php' </script>";
        }
      }
    }
?>