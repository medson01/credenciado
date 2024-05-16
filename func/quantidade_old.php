<?php

// 1 - REGRA QUANTIDADE
// QUANTIDADE VEZES QUE O MESMO PROCEDIMENTO PODE SER UTILIZADO DENTRO DE UM PERÍODO PELO USUÁRIO NO ANO 
// AQUI A UNIDADE DE TEMPO ESTÁ DEFINIDA EM DIAS, ENTÃO A UNIDADE MÍNIMA DE TEMPO É 1 DIA.

   function quantidade($quantidade ,$id_beneficiarios ,$unid_quantidade ,$pdo ) {

        $unid = $unid_quantidade; 
        global $id_proc, $qtd_proc, $id_especialidade; 
             

        if(!empty($quantidade)){
            $sql = "SELECT * FROM beneficiarios WHERE id=".$id_beneficiarios;
            $stmt = $pdo->prepare($sql);  
            $stmt->execute();
            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
               $data_inclusao = $registro["data_inclusao"];
               $_SESSION["data_inclusao"] = $data_inclusao;
            }
         
            $ano_atual = date("Y"); 
            $ano_inclusao =  date("Y", strtotime($data_inclusao));

            $mes =  date("m", strtotime($data_inclusao));
            $dia =  date("d", strtotime($data_inclusao));


             $idade1 = calc_idade($data_inclusao);
             $idade2 = $ano_atual - $ano_inclusao;  

            // Quantidade, Comparando as Datas
            if ( $idade1 < $idade2 ) {
               // VERDADEIRO => Usuário Não está em quantidade
                $dados['quantidade'] = 1;
                $a  = $ano_atual - 1;
                $b = $dia - 1;
                $data_inicial = $a.'-'.$mes.'-'.$dia;
                $data_final = $ano_atual.'-'.$mes.'-'.$b;

            }else{
               // FALSO => Usuário está em quantidade
                $dados['quantidade'] = 0;  
                $a  = $ano_atual + 1; 
                $b = $dia - 1;
                $data_inicial = $ano_atual.'-'.$mes.'-'.$dia;   
                $data_final = $a.'-'.$mes.'-'.$b;
            }  

     exit();       
            // Verificar quantos procedimentos no ano foram feitos
              $sql = "SELECT sadt_procedimento.qtd_proc, sadt.data_sadt FROM sadt_procedimento 
                     INNER JOIN sadt on sadt.id = sadt_procedimento.id_sadt 
                     INNER JOIN especialidade on especialidade.id = sadt.id_especialidade
                     WHERE 
                     sadt_procedimento.id_proc = ".$id_proc."
                     AND sadt.id_beneficiario =  ".$id_beneficiarios."
                     AND sadt.id_especialidade = ".$id_especialidade."
                     AND sadt.data_sadt BETWEEN '".$data_inicial."' AND '".$data_final."'";
            $stmt = $pdo->prepare($sql);  
            $stmt->execute();

            $qtd = $qtd_proc;
            
            while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){   
               $data_sadt = $registro["data_sadt"];
               $qtd =  $qtd + $registro["qtd_proc"];
            
            }

            //Tabela procedimentos &quantidade
            //Tabela sadt_procedimento $qtd que é $qtd_proc, que tem que somar com o que está sendo solicitado

            if ($qtd <= $quantidade) {

               // ====================================
               // 3 - REGRA PERIODICIDADE
                 if(!empty($data_sadt)){
                  $data_ultomo_proc = $data_sadt;
                 }else{
                  $data_ultomo_proc = 0; 
                 }

                $dados = $data_ultomo_proc;

            }else{
               if(isset($_SESSION['last_id'])){
                  $id = $_SESSION['last_id'];
               }else{
                  $id = 0;
               }

              $msg = "<script language='javascript' type='text/javascript'>alert('Limite anual exedido de procedimentos executados pelo usuario.');window.location.href='painel.php?sadt=1&id=".$id."&matricula=".$_SESSION["matricula"]."&paciente=".$_SESSION["nome"]."&cpf=0&id_beneficiarios=".$_SESSION["id_beneficiarios"]."&data_nascimento=".$_SESSION["data_nasc"]."&deficiente=".$_SESSION["deficiente"]."&data_inclusao=".$_SESSION["data_inclusao"]."'</script>";

               $dados['msg']  = $msg;

            }


      }
    
      // USADO PARA TESTE DE VARIÀVEL
       // $dados['msg'] = $data_sadt;


        return $dados; 
        
}

?>