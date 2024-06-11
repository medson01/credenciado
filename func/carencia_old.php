 <?php

// 1 - REGRA CARÊNCIA
// TEMPO ESTIMADO PARA COMEÇAR A USAR O PLANO

   function carencia($carencia ,$id_beneficiarios ,$unid_carencia ,$pdo ) {

      global $id_proc; 

        $unid = $unid_carencia; 

        switch ($unid) {
           case 'ano':
              $unid = "year";
              break;
           case 'mes':
              $unid = "month";
              break;
           case 'dia':
              $unid = "day";
              break;
           
           default:
              $unid = 0;
              break;
        }


        $dados = array('carencia' => null, 'msg' => null );
        global $a,$quantidade, $unid_quantidade; 
        
        if(!empty($carencia)){
            $sql = "SELECT * FROM beneficiarios WHERE id=".$id_beneficiarios;
            $stmt = $pdo->prepare($sql);  
            $stmt->execute();
            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
               $data_inclusao = $registro["data_inclusao"];
            }

            //$data_inclusao = "2021-08-14 13:20:00";
            $data_atual = strtotime(date("Y-m-d H:i:s")); 
            $data_uso = strtotime($data_inclusao. ' + '.$carencia.''.$unid);

            // CARÊNCIA, Comparando as Datas
            if ( $data_atual > $data_uso ) {
               
                $dados = 0; 


            }else{
               // FALSO => Usuário está em carencia    
                 $msg = "<script language='javascript' type='text/javascript'>alert('Usuario em carencia.');window.location.href='painel.php?sadt=1&id=0&matricula=".$_SESSION["matricula"]."&paciente=".$_SESSION["nome"]."&cpf=0&id_beneficiarios=".$_SESSION["id_beneficiarios"]."&data_nascimento=".$_SESSION["data_nasc"]."&deficiente=".$_SESSION["deficiente"]."'</script>";

                  $dados['msg'] = $msg;
            }  
      }
    
  
    
  


      // USADO PARA TESTE DE VARIÀVEL
      //  $dados['msg'] = $msg;


        return $dados; 
        
}

?>