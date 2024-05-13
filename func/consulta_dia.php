 <?php

// REGRA QUANTIDAE DE PROCEDIMENTO POR DIA
/* 
INFORMAÇÕES TÉCNICAS: 
   - VARIÁVEL DE CONEXÃO $pdo, TEM QUE EXISTIR PARA A FUNÇÃO FUNCIONAR;
   - INSTRUÇÃO DE SQL QUE PEGA OS ULTIMOS 30DIAS DA DATA ATUAL => BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW();
   - O RETONRO É 30 DIAS EM CIMA DA ESPECIALIDADE;
	
*/
   function consulta_dia($id_benecificario, $id_credenciado, $id_especialidade, $id_profissional_saude  , $pdo) { 	 
	$sql = "SELECT sadt.id, sadt.operador, sadt.id_beneficiario, sadt.medico_solicitante,profissional_saude.numcr ,profissional_saude.qpd ,especialidade.nome,DATE_FORMAT(sadt.data_sadt, '%d/%m/%Y, ?s %H:%i:%s') as data
			FROM sadt 
			INNER JOIN sadt_procedimento ON sadt_procedimento.id_sadt = sadt.id 
			INNER JOIN especialidade ON especialidade.id = sadt.id_especialidade 
			INNER JOIN procedimento ON procedimento.id = sadt_procedimento.id_proc 
			INNER JOIN profissional_saude ON profissional_saude.id = sadt.id_profissional_saude 
			WHERE   
			CURDATE()
			AND sadt.id_especialidade = ".$id_especialidade."
			AND sadt.id_credenciado = ".$id_credenciado."
			AND profissional_saude.numcr = ".$id_profissional_saude."
			ORDER BY `data` DESC";          
		
            $stmt = $pdo->prepare($sql);  
            $stmt->execute();
			$i = 0;
            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){ 
			   $medico_solicitante[$i] = $registro["medico_solicitante"]; 
			   $especialidade[$i] = $registro["nome"];
			   $qpd[$i] =  $registro["qpd"];
			   $data[$i] =  $registro["data"]; 
			   $i++;
            }
	
			// VERIFICA SE A QUANTIDADE DE CONSUTLAS REALIZADAS NO DIA É INFERIOR A QUANTIDADE PROCEDIMENTOS REALIZADOS PERMINIDA POR MEDICO.
            if ( $i <=  $qpd[0] ) {   
                $dados = 0; 
			// TEVE CONUSLTA A MENOS DE 30 DIAS.	
            }else{
              $msg = "<script language='javascript' type='text/javascript'>alert(' Quandidade m\u00e1xima atingina de procedimentos realizados por dia ".$qpd[0].".');window.history.back();</script>";
				
               $dados['msg'] = $msg;
            }   
      // USADO PARA TESTE DE VARIÀVEL
      // $dados['msg'] = $qpd[0];

        return $dados;  	
	}



?>