<?php
// A FUNÇÃO RETRIÇÃO CONTROLA O VALOR, COMPLEXIDADE E O BLOQUEIO CASO EXISTA NO PROCEDIMENTO
function restricao($id_proc ,$pdo ) {

    $sql = "SELECT * FROM procedimento WHERE id=".$id_proc;
    $stmt = $pdo->prepare($sql);  
    $stmt->execute();
    
    while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
        $valor_tabela = $registro["valor_tabela"];
        $bloqueio = $registro["bloqueio"];
        $complexidade = $registro["complexidade"];
    }



    // RESTRIÇÃO DEVIDO O VALOR
    if($valor_tabela >= 1000){
       $_SESSION["url"] = str_replace("id=1","id=0000",$_SESSION["url"]);

        $msg = "<script language='javascript' type='text/javascript'>alert('Procedimento precisa de autorização.');location.href=\"".$_SESSION["url"]."\"</script>";

        $dados['msg'] = $msg;
           
    }// RESTRIÇÃO DEVIDO A COMPLEXIDADE
    elseif($complexidade == 1){   
          $_SESSION["url"] = str_replace("id=1","id=0000",$_SESSION["url"]);

        $msg = "<script language='javascript' type='text/javascript'>alert('Procedimento de alta complexidade, precisa de autorização.');location.href=\"".$_SESSION["url"]."\"</script>";

      $dados['msg'] = $msg;
           
    }// RESTRIÇÃO DEVIDO AO BLOQUEIO
    elseif($bloqueio == 1){   
        $_SESSION["url"] = str_replace("id=1","id=0000",$_SESSION["url"]);

        $msg = "<script language='javascript' type='text/javascript'>alert('Procedimento bloqueado!.');location.href=\"".$_SESSION["url"]."\"</script>";

        $dados['msg'] = $msg;
        
    }else{

        $dados = 0;
    }


  return $dados; 
}

?>