<?php
function valor_procedimento($qtd_proc_guia, $id_proc ,$pdo ) {

    $sql = "SELECT * FROM procedimento WHERE id=".$id_proc;
    $stmt = $pdo->prepare($sql);  
    $stmt->execute();
   
    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
       $valor_tabela = $registro["valor_tabela"];
    }

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