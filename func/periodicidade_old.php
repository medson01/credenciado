 <?php

// 1 - REGRA PERIODICIDADE
// PERÍODO DE MÍNIMO ENTRE UM PROCEDIMENTO EXECUTADO PELO E OUTRO UTILIZADO PELO USUÁRIO.
   function periodicidade($data_ultomo_proc) {

      global $unid_perioticidade, $perioticidade, $id;  

       if(!empty($data_ultomo_proc)){
         $date = new DateTime($data_ultomo_proc);

         $data_inicial = $date->format('Y-m-d');
         $data_final = date("Y-m-d"); 

         // Calcula a diferença em segundos entre as datas
         $diferenca = strtotime($data_final) - strtotime($data_inicial);

         //Calcula a diferença em dias
         $dias = floor($diferenca / (60 * 60 * 24));


         // O USUARIOS PODE FAZER OS PROCEDIMENTOS SE A DIFERENÇA ENTRE OS DIAS FOR MAIOR QUE O DA PERIODICIDADE, OU SEJA, CARÊNCIA ENTRE A ULTIMO PROCEDIMENTO E
         if ($dias >= $perioticidade) {
            $dados = 0;

         // PARA TESTE
         // $dados['msg'] = $data_ultomo_proc;   

         }else{

           if (isset($_SESSION['last_id'])){ 
               $msg = "<script language='javascript' type='text/javascript'>alert('Limite de perioticidade exedido pelo usuario.');window.location.href='painel.php?sadt=1&id=".$_SESSION['last_id']."'</script>";
            }else{

              $_SESSION["url"] = str_replace("id=1","id=0000",$_SESSION["url"]);

               $msg = "<script language='javascript' type='text/javascript'>alert('Limite de perioticidade exedido pelo usuario.');location.href=\"".$_SESSION["url"]."\"</script>";
            }

            $dados['msg']  = $msg;
          
         }


      }else{

         $dados = 0;


      }  


      // USADO PARA TESTE DE VARIÀVEL
      // $dados['msg'] = "diferença entre os dias: ".$data_ultomo_proc;


       return $dados; 
}        