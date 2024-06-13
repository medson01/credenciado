 <?php

// 1 - REGRA QUANTIDADE
/* 
INFORMAÇÕES TÉCNICAS: 
   - 
	
*/
   function periodicidade($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $id, $pdo) { 	 
   
	// PEGAS OS PARAMETOS DE PERIODICIDADE DO PROCEDIMENTO
	 $sql = "SELECT * FROM `procedimento`
         		 WHERE
				 procedimento.id = ".$id_proc;          
		
				$stmt1 = $pdo->prepare($sql);  
				$stmt1->execute();
				while($registro1 = $stmt1->fetch(PDO::FETCH_ASSOC)){ 
					$periodicidade = $registro1["periodicidade"]; 
					$unid_periodicidade = $registro1["unid_periodicidade"];
				}
			
	// PEGA O ULTIMO PROCEDIMENTO AUTORIZADO = 1 $data_sad E 
     $sql = "SELECT sadt_procedimento.id_proc, sadt_procedimento.qtd_proc, sadt_procedimento.data 
   		   			 FROM sadt_procedimento 
                     INNER JOIN sadt on sadt.id = sadt_procedimento.id_sadt 
                     INNER JOIN especialidade on especialidade.id = sadt.id_especialidade
                     WHERE 
                         sadt.id_beneficiario =  ".$id_beneficiarios."
					 AND sadt_procedimento.id_proc = ".$id_proc."
					 AND sadt_procedimento.autorizado = 1 
					 ORDER BY sadt_procedimento.data DESC LIMIT 1";
                     
					$stmt2 = $pdo->prepare($sql);  
					$stmt2->execute();			
					while($registro2 = $stmt2->fetch(PDO::FETCH_ASSOC)){   
					   $ultimo_data_sadt = $registro2["data"];
					}

			$i = 1;
			$i = $i * $periodicidade;
			
	//DEFINIÇÃO DE PERÍODO 	
	if(!empty($periodicidade) && !empty($unid_periodicidade)){	
			switch ($unid_periodicidade) {
				case 1:								
					$data_final = date('d/m/Y', strtotime("+".$i." days",strtotime($ultimo_data_sadt)));
					$texto = "di\u00e1rio";
					break;
				case 2:
					$texto =  "m\u00eas";			
					$data_final = date('d/m/Y', strtotime("+".$i." month",strtotime($ultimo_data_sadt)));
					break;
				case 3:
					$texto =  "ano";
					$data_final = date('d/m/Y', strtotime("+".$i." year",strtotime($ultimo_data_sadt)));			
					break;
			}	
	
           $hoje = date('Y-m-d');

			// Comparando as Datas
			if(strtotime($hoje) > strtotime($data_final)) {
				// SEM PERIODICIDADE. PODE USAR O PLANO. 
					$dados = false;
				
			}elseif(strtotime($hoje) == strtotime($data_final))	{
				// ESTA EM PERIODICIDADE. SÓ AMANHÁ PODERÁ USAR O PLANNO
				$msg = "<script language='javascript' type='text/javascript'>alert('Encontra-se em Periodicidade. Amanhã poderá executar o procedimento');window.history.back();</script>";
				   $dados['msg']  = $msg;
				
			}else{
				// ESTÁ EM PERIODICIDADE, S´P APÓS A DATA $data_final PODERÁ EXECUTAR O PROCEDIMETO
				$msg = "<script language='javascript' type='text/javascript'>alert('Encontra-se em Periodicidade, só após ".$data_final.", poderá executar o procedimento.');window.history.back();</script>";
				   $dados['msg']  = $msg;
			}  
	}else{
					if(!empty($id)){
					$msg = "<script language='javascript' type='text/javascript'>alert('AVISO: \\n Falta defini\u00e7\u00e3o de Periodicidade e Per\u00edodo para esse procedimento! \\n Clique em Ok para continuar? ');window.location.href = 'painel.php?lab=exame&id=".$id."';</script>";
					}else{
					$msg = "<script language='javascript' type='text/javascript'>alert('AVISO: \\n Falta defini\u00e7\u00e3o de Periodicidade e Per\u00edodo para esse procedimento! \\n Clique em Ok para continuar? ');</script>";
					}
				    $dados['go']  = $msg;
                 
    }

        return $dados; 
     
  }

?>