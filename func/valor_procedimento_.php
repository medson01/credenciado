<?php
function valor_procedimento($id_proc ,$pdo ) {



     $sql = "SELECT * FROM procedimento WHERE id=".$id_proc;
    $stmt = $pdo->prepare($sql);  
    $stmt->execute();
    
    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
        $valor_tabela = $registro["valor_tabela"];
    }

    if($valor_tabela >= 1000){
        
        $_SESSION["url"] = str_replace("id=1","id=0000",$_SESSION["url"]);
        
        $msg = "<script language='javascript' type='text/javascript'>alert('Limite de perioticidade exedido pelo usuario.');location.href=\"".$_SESSION["url"]."\"</script>";

      echo  $dados['msg'] = $msg;
            $dados['status'] = 0;

    }else{

        $dados = 1;
    }


  return $dados; 
}

?>