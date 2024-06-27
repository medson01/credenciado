<?php
function valor_procedimento($qtd_proc_guia, $qtd_proc_sol, $id_proc ,$pdo ) {

    $sql = "SELECT * FROM procedimento WHERE id=".$id_proc;
    $stmt = $pdo->prepare($sql);  
    $stmt->execute();
   
    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
       $valor_tabela = $registro["valor_tabela"];
    }

 // TODO PROCEDIMENTO EM QUE O VALOR MULTIPLICADO PELA QUANTIDADO SOLICITADO FOR MAIOR QUE R$ 1000,00, ENTRARÁ DA REGRA DE VALOR_PROCEDIMENTO E	<br />
 // RERÁ QUE SER ANALIZADA PELA GERÊNCIA DE SAÚDE
    $valor_tabela = $qtd_proc_sol * $valor_tabela;

    if($valor_tabela >= 1000){  
		if( $qtd_proc_guia <> 1){
			$msg = "<script language='javascript' type='text/javascript'>alert('Necess\u00e1rio an\u00e1lise pela Ger\u00eancia de Sa\u00fade.\\nFavor solicitar procedimento em um guia isoladamente.');window.history.back();</script>";
			$dados['msg']  = $msg;
		}else{
			
			$msg = "<script language='javascript' type='text/javascript'>alert('Necess\u00e1rio an\u00e1lise pela Ger\u00eancia de Sa\u00fade.')</script>";
			$dados['go']  = $msg;	
			
			
			
		}    
			
			
			
    }else{
         $dados = false;
    }

  return $dados; 
}

?>