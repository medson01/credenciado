<?php
require_once("Connection.php");

/******************************************
 Verifica se houve uma solicitação AJAX, 
 verificando se o parâmetro "method" existe.
******************************************/
if(isset($_REQUEST['method'])) {
	$id_beneficiarios = $_REQUEST['id_beneficiarios'];
	$name = $_REQUEST['name'];
	$template = $_REQUEST['template'];
	$method = $_REQUEST['method'];
	

	$obj = new Controller();
	$obj->insertDB($id_beneficiarios, $name, $template);
}



class Controller {
	
	private $con;
	
	public function __construct() {
		
		// Cria uma instância para realizar a conexão com o banco.
		$this->con = new Connection();
	}
	
	/************************************************
	* Nome: insertDB
	* Descrição: Realiza a inserção das informação do 
	* 	usuário Nome e Template no banco de Dados.
	* 	Também foi definida o comando SQL de inserção.
	* Retorno: JSON
	************************************************/
	public function insertDB($id_beneficiarios, $name, $template) {
		
		$json;
		$sql = "INSERT INTO biometria(id_beneficiarios, name, template) VALUES ('". $id_beneficiarios ."','". $name ."','". $template ."')";
		if($this->con->execute($sql)) {
			
			$json = array(
				'error' => 'false',
				'msg' => 'Usuário Inserido com Sucesso!'

			);
		}
		/*else {
			$json = array(
				'error' => 'true',
				'msg' => 'Usuário Não Pode ser Cadastrado!'
			);
		}
		*/		
		echo json_encode($json);
	}

	
	/************************************************
	* Nome: selectDB
	* Descrição: Seleciona as informações de todos os
	* 	dados dos usuários cadastrados no banco.
	* 	Também monta o html das linhas da tabela contendo
	* 	as informações do usuário.
	* Retorno: String (html)
	************************************************/
	public function selectDB() {
		
		$sql = "SELECT template FROM biometria INNER JOIN beneficiarios on beneficiarios.id = biometria.id_beneficiarios where id_beneficiarios = ".$_GET['id_beneficiarios'];
		
		$result = $this->con->execute($sql);
		
		$tr = "";
				if ($result->num_rows > 0) {

			while ($row = $result->fetch_row()) {
        			$biometria = $row[0];
    		 }
				
				$tr .= "
		    	<div align='center'>
         				<h3 id='aviso'> Favor inserir a digital para verificação da biometria.       </h3>
      			</div>

					<tr>
					  <td class='align-middle' >
					  	 <center> 
					  	 	<button class='btn btn-primary btn-match'> Verificar </button>
					  	 </center>
					  </td>
					</tr>
					<input type='hidden' class='form-control' id='template' value=".$biometria.">";

		} 
		else {

			//Cadastra Biometria
		    $tr .= "

		    	<div align='center'>
         				<h3 id='aviso' >O usu&aacute;rio n&atilde;o possuir biometria cadastrada. <br />
           
           					Favor cadastrar a biometria.       </h3>
      			</div>

		      <input type='hidden' class='form-control' id='inputName' value=".$_GET['matricula'].">
			  <input type='hidden' class='form-control' id='id_beneficiarios' value=".$_GET['id_beneficiarios']."> 
			  
					<tr>
					  <td class='align-middle'>
					  	<center> 
					  		<button class='btn btn-primary' id='btn-capture'> Cadastrar </button>
					  	</center>
					  	</td>
					</tr>";

		}
		
		return $tr;
	}
}
?>