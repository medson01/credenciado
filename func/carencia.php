 <?php

// 1 - REGRA QUANTIDADE
/* 
INFORMAÇÕES TÉCNICAS: 
   - 
	
*/
   function carencia($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $qtd_proc, $id, $pdo) { 
   
   // ÁREA DE TESTE
    
	
   // VERIFICAÇÃO DA CARENDIA NO PROCEDIMENTO
	$sql = "SELECT * FROM `procedimento`
         		 WHERE
				 procedimento.id = ".$id_proc;          
		
            $stmt = $pdo->prepare($sql);  
            $stmt->execute();
            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){ 
			 $carencia = $registro["carencia"]; 
			 $unid_carencia = $registro["unid_carencia"];
            }
			
	if(empty($carencia) || empty($unid_carencia)){
		$msg = "<script language='javascript' type='text/javascript'>alert('AVISO: \\n Falta defini\u00e7\u00e3o de Car\u00encia e Per\u00edodo para esse procedimento! \\n Clique em Ok para continuar? ');</script>";
		$dados['go']  = $msg;
	}		
	// VERIFICAÇÃO DA QUANTIDADE DE DIAS DESDE A ENTRADA NO PLANO	
	// DATA DE INCLUSÃO
		$date1=date_create($data_inclusao);
	// DATA ATUAL
		$date2=date_create();
	// DIFIRENÇA DAS DATAS ->  DATA_ATUAL - DATA_INCLUSÃO = DIAS
		$diff=date_diff($date1,$date2);
		$dias= $diff->format("%a");		
	
	// DEFINIR O PERIODO
	switch ($unid_carencia) {
           case '3':
              $unid = "year";
			  $periodo = "anos";
              break;
           case '2':
              $unid = "month";
			  $periodo = "m\u00eas(es)";
              break;
           case '1':
              $unid = "day";
			  $periodo = "dias";
              break;
           default:
              $unid = 0;
              break;
        }		
		
	// VARIÁVEL $data_atual -> DATA DA SOLICITAÇÃO DO PROCEDIMENTO
		    $data_atual = strtotime(date("Y-m-d H:i:s"));		
			
	// VARIÁVEL $data_uso   -> DATA DE USO -> APARTIR DESSA DATA PODE SER UTILIZADO O PLANO. 
             $data_uso = strtotime($data_inclusao. ' + '.$carencia.' '.$unid);	
			
			
		 // COMPARAÇÃO DAS DATAS -> DATA ATUAL ($data_atual) TEM QUE SER SEMPRE MAIOR QUE A DATA DE USO ($data_uso), SE FOR MENOR OU IGUAL ESTÁ EM CARÊNCIA
            if ( $data_atual > $data_uso ) {       
                $dados = 0;
            }else{
			
			if($dias == 0){
				$tempo = "Amanhã j\u00e1 poder\u00e1 utiliz\u00e1-lo.";
			}else{
				$tempo = "Falta ".$dias." ".$periodo." para sa\u00edr da car\u00eancia.";
			}
              $msg = "<script language='javascript' type='text/javascript'>alert('Usu\u00e1rio encontra-se em per\u00edodo de car\u00eancia para esse procedimento. \\n".$tempo."');window.history.back();</script>"; 
				   $dados['msg']  = $msg;
            }  	
						
        return $dados; 
     
}

?>