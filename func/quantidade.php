 <?php

// 1 - REGRA QUANTIDADE
/* 
INFORMAÇÕES TÉCNICAS: 
   - 
	
*/
   function quantidade($id_beneficiarios, $id_especialidade, $data_inclusao, $id_proc, $qtd_proc, $pdo) { 	 
   
   
   
	 $sql = "SELECT * FROM `procedimento`
         		 WHERE
				 procedimento.id = ".$id_proc;          
		
            $stmt1 = $pdo->prepare($sql);  
            $stmt1->execute();
            while($registro1 = $stmt1->fetch(PDO::FETCH_ASSOC)){ 
			 echo  $quantidade = $registro1["quantidade"]; 
			   $unid_quantidade = $registro1["unid_quantidade"];
            }

			$ano_atual = date("Y");
			$mes_atual = date("m");
			$dia_atual = date("d");
			$dia_mes_inclusao =  date("d-m", strtotime($data_inclusao)); 
			// COMPOSIÇÃO DA DATA INICIAL E FINAL PARA CONSULTA NO SQL DOS PROCEDIMENTOS EXECUTADOS PELO USUÁRIO
			$data_inicial = $dia_mes_inclusao."-".$ano_atual;
			$data_final = date('d-m-Y', strtotime("+30 days",strtotime($data_inicial)));
			
   // PEGA TODOS OS PROCEDIMENTO ID_SADT CAMPO AUTORIZADO = 1, SÓ CONTO OS AUTORIZADOS
   $sql = "SELECT sadt_procedimento.qtd_proc, sadt.data_sadt 
   		   			 FROM sadt_procedimento 
                     INNER JOIN sadt on sadt.id = sadt_procedimento.id_sadt 
                     INNER JOIN especialidade on especialidade.id = sadt.id_especialidade
                     WHERE 
                         sadt.id_beneficiario =  ".$id_beneficiarios."
                     AND sadt.id_especialidade = ".$id_especialidade."
					 AND sadt_procedimento.autorizado = 1
                     AND sadt.data_sadt BETWEEN '".$data_inicial."' AND '".$data_final."'";	 
            
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
           if($qtd_total > $quantidade) {
					$msg = "<script language='javascript' type='text/javascript'>alert('Limite anual exedido de procedimentos executados pelo usuario.');window.history.back();</script>";
               $dados['msg']  = $msg;
			
            }else{

               $dados = 0;
            }

        return $dados; 
        
}

?>