 <?php

// 1 - REGRA RETORNO
/* 
INFORMA��ES T�CNICAS: 
   - VARI�VEL DE CONEX�O $pdo, TEM QUE EXISTIR PARA A FUN��O FUNCIONAR;
   - INSTRU��O DE SQL QUE PEGA OS ULTIMOS 30DIAS DA DATA ATUAL => BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW();
   - O RETONRO � 30 DIAS EM CIMA DA ESPECIALIDADE;
	
*/
   function retorno($id_beneficiario, $id_credenciado, $id_especialidade  , $pdo) { 	 
	$sql = "SELECT sadt.id, sadt.operador, sadt.id_beneficiario, sadt.medico_solicitante, especialidade.nome,  DATE_FORMAT(sadt.data_sadt, '%d/%m/%Y, �s %H:%i:%s') as data, sadt.data_sadt
		FROM    sadt	
						INNER JOIN sadt_procedimento ON sadt_procedimento.id_sadt = sadt.id
						INNER JOIN especialidade ON especialidade.id = sadt.id_especialidade
						INNER JOIN procedimento ON procedimento.id = sadt_procedimento.id_proc
		WHERE   
			data_sadt BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
			AND sadt.id_especialidade = ".$id_especialidade."
			AND sadt.id_credenciado = ".$id_credenciado."
			AND sadt.id_beneficiario = ".$id_beneficiario."
			AND procedimento.codigo = 10101012
			ORDER BY `data` DESC";          
		
            $stmt = $pdo->prepare($sql);  
            $stmt->execute();
			$i = 0;
            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){ 
			   $medico_solicitante[$i] = $registro["medico_solicitante"]; 
			   $nome[$i] = $registro["nome"];
			   $data[$i] =  $registro["data"]; 
			   $data_sadt[$i] =  $registro["data_sadt"]; 
			   $i++;
            }
			// PEGA A DATA DO BANCO data_sadt E ADICIONA 30 DIAS NO FUTURO.
			if(isset($data_sadt[0])){
				$data_uso = date('d/m/Y', strtotime("+30 days",strtotime($data_sadt[0])));
			}
			// N�O TEVE CONSULTA A MENOS DE 30 DIAS
            if ( $i <= 0 ) {   
                $dados = 0; 
			// TEVE CONUSLTA A MENOS DE 30 DIAS.	
            }else{
              $msg = "<script language='javascript' type='text/javascript'>alert(' Usu\u00e1rio est\u00e1 em retono! \\n Especialidade ".$nome[0]." \\n Ultima consulta realizada no dia ".$data[0].", m\u00e9dico ".$medico_solicitante[0].". \\n Sa\u00edda do retorno ap\u00f3s a data ".$data_uso.".');window.history.back();</script>";
				
               $dados['msg'] = $msg;
            }   
      // USADO PARA TESTE DE VARI�VEL
      // $dados['msg'] = $data[1];

        return $dados;  	
	}



?>