<?php

  //Conexão com o banco 
 // $conn = mysqli_connect("localhost","root","","credenciado");

     // Arquivo de configuraÃ§Ã£o
  require_once "../config/config.php";


if (isset($_POST["id_beneficiarios"])){
  $id_beneficiarios = $_POST["id_beneficiarios"];
}

if (isset($_POST["fixo"])){
  $fixo = $_POST["fixo"];
}
if (isset($_POST["celular"])){
  $celular = $_POST["celular"];

  $celular = str_replace("(", "", $celular);
  $celular = str_replace(")", "", $celular);
  $celular = str_replace(" ", "", $celular);
  $celular = str_replace("-", "", $celular);
}
if (isset($_POST["email"])){
  $email = $_POST["email"];
}

if (isset($_POST["id_contato"])){
   
}

if( !empty(($_POST["id_contato"])) ){

      $id_contato = $_POST["id_contato"];

      $query = "UPDATE `contato` SET `id_beneficiarios`= '".$id_beneficiarios."' ,`celular`= '".$celular."' ,`fixo`= '".$fixo."',`email`= '".$email."' ,`data`='".date("Y-m-d H:i:s" )."' WHERE id = '".$id_contato."'";
 
}else{
 

     $query = "INSERT INTO `contato`(`id`, `id_beneficiarios`, `celular`, `fixo`, `email`, `data`) VALUES (null , '".$id_beneficiarios."' , '".$celular."' , '".$fixo."' , '".$email."' ,'".date("Y-m-d H:i:s")."')";

}
           
   $insert = mysqli_query($conn, $query);
                
                    
    if($insert){

         echo"<script language='javascript' type='text/javascript'>window.location.href='http://www.ipasealsaude.al.gov.br/redecredenciada/'</script>";
                      
                      
    }else{
    		  echo"<script language='javascript' type='text/javascript'>alert('Erro de inclussão');window.location.href='www.ipasealsaude.al.gov.br'</script>";

    }

   ?>