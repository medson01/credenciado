<?php


 class Documento {

 	private $documento;


 	public function setDocumento($a){

 		$this->documento = $a;

 	} 

 	public function getDocumento(){

 		return $this->documento;
 		
 	} 


 	public function validarMatricula(){


 		$query = mysqli_query($conn,"SELECT * FROM `pronto_atendimento` WHERE matricula = ".$this->getDocumento()." AND contrato_ativo = 't' AND pessoa_ativo = 't'") or die("erro ao selecionar");
        if (mysqli_num_rows($query)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Usuario não está ativo.');window.location.href='pronto_atendimento_cadastro.php';</script>";
          die();

        }else{

        	return "1";
        }

 	}
}


$matric = new Documento();

$matric->setDocumento($matricula); 

echo $matric->validarMatricula();

?>
