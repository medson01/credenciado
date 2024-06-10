 <?php

// 1 - REGRA QUANTIDADE
/* 
INFORMAÇÕES TÉCNICAS: 
   - 
	
*/
   function quantidade($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $qtd_proc, $id, $pdo) { 	 
   
	 $sql = "SELECT * FROM `procedimento`
         		 WHERE
				 procedimento.id = ".$id_proc;          
		
            $stmt1 = $pdo->prepare($sql);  
            $stmt1->execute();
            while($registro1 = $stmt1->fetch(PDO::FETCH_ASSOC)){ 
			   $quantidade = $registro1["quantidade"]; 
			   $unid_quantidade = $registro1["unid_quantidade"];
            }

    //AND sadt.data_sadt BETWEEN '".$data_inicial."' AND '".$data_final."'";		
		    $ano_atual = date("Y");
			$mes_atual = date("m");
			$dia_atual = date("d");
		    $dia_mes_inclusao =  date("m-d", strtotime($data_inclusao)); 
			
	// COMPOSIÇÃO DA DATA INICIAL PARA CONSULTA NO SQL DOS PROCEDIMENTOS EXECUTADOS PELO USUÁRIO
			$data_inicial = $ano_atual."-".$dia_mes_inclusao;
			
			
	//DEFINIÇÃO DE PERÍODO 	
	if(!empty($quantidade) && !empty($unid_quantidade)){	
			switch ($unid_quantidade) {
				case 1:
					$periodo = "di\u00e1rio";
					$data = "AND sadt_procedimento.data = CURDATE()";
					break;
				case 2:
					$periodo =  "m\u00eas";
					$i = 30 * $quantidade;
	// COMPOSIÇÃO DA DATA FINAL PARA CONSULTA NO SQL DOS PROCEDIMENTOS EXECUTADOS PELO USUÁRIO				
					$data_final = date('Y-m-d', strtotime("+".$i." days",strtotime($data_inicial)));
					$data = "AND sadt.data_sadt BETWEEN '".$data_inicial."' AND '".$data_final."'";
					break;
				case 3:
					$periodo =  "ano";
	// COMPOSIÇÃO DA DATA FINAL PARA CONSULTA NO SQL DOS PROCEDIMENTOS EXECUTADOS PELO USUÁRIO	
					$year = date('Y');
					if (($year % 4 == 0) && ($year % 100 != 0 || $year %400 == 0)) {
						// É BISSEXTO 365 DIAS
						$i = 365;
					} else {
						// NÃO É BISSEXTO 366 DIAS
						$i = 366;
					}
					$data_final = date('Y-m-d', strtotime("+".$i." days",strtotime($data_inicial)));			
					$data = "AND sadt.data_sadt BETWEEN '".$data_inicial."' AND '".$data_final."'";
					break;
			}
			
   // PEGA TODOS OS PROCEDIMENTO ID_SADT CAMPO AUTORIZADO = 1, SÓ CONTO OS AUTORIZADOS
       $sql = "SELECT sadt_procedimento.qtd_proc, sadt.data_sadt 
   		   			 FROM sadt_procedimento 
                     INNER JOIN sadt on sadt.id = sadt_procedimento.id_sadt 
                     INNER JOIN especialidade on especialidade.id = sadt.id_especialidade
                     WHERE 
                         sadt.id_beneficiario =  ".$id_beneficiarios."
					 AND sadt_procedimento.id_proc = ".$id_proc."
					 AND sadt_procedimento.autorizado = 1 "
					 .$data;
                     
   // APENAS UM REGISTRO NA CONSULTA            
   // echo $count = current($pdo->query($sql)->fetch());         
			$stmt2 = $pdo->prepare($sql);  
            $stmt2->execute();
		
			$qtd= 0;
            while($registro2 = $stmt2->fetch(PDO::FETCH_ASSOC)){   
               $data_sadt = $registro2["data_sadt"];
               $qtd =  $qtd + $registro2["qtd_proc"];
            
            }
	// SOMA DA QUANTIDADES QUE EXITE NO BANCO PEDIDAS + O QUE ESTÁ SENDO PEDIDO.  		
		   $qtd_total = $qtd_proc + $qtd;
		   
			   		   	
	// A SOMA NÃO PODE SER MAIOR DO QUE O VALOR PARAMETRIZADO
				 if($qtd_total > $quantidade ) {
				 	$resta = $quantidade - $qtd;
					$msg = "<script language='javascript' type='text/javascript'>alert('Limite ".$periodo." exedido de procedimentos executados pelo usuario. Saldo apenas de ".$resta."');window.history.back();</script>";
				   $dados['msg']  = $msg;
				
				}else{
	// SE NÃO EXEDER A QUANTIDADE 
				   $dados = false;
				}
	}else{

					if(!empty($id)){
					$msg = "<script language='javascript' type='text/javascript'>alert('AVISO: \\n Falta defini\u00e7\u00e3o de Quantidade e Per\u00edodo para esse procedimento! \\n Clique em Ok para continuar? ');window.location.href = 'painel.php?lab=exame&id=".$id."';</script>";
					}else{
					$msg = "<script language='javascript' type='text/javascript'>alert('AVISO: \\n Falta defini\u00e7\u00e3o de Quantidade e Per\u00edodo para esse procedimento! \\n Clique em Ok para continuar? ');</script>";
					}
				    $dados['go']  = $msg;
                   //$dados =0;
    }

        return $dados; 
     
}

?>