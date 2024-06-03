
<?php 
    // Arquivo de configuração
  require_once "../../config/config.php";
  
 $codigo = isset($_POST["codigo"])? $_POST["codigo"] : '';
 
 $carencia = isset($_POST["carencia"])? $_POST["carencia"] : 'null';
 $unid_carencia = isset($_POST["unid_carencia"])? $_POST["unid_carencia"] : 'null'; 
 $periodicidade = isset($_POST["periodicidade"])? $_POST["periodicidade"] : 'null';
 $unid_periodicidade = isset($_POST["unid_periodicidade"])? $_POST["unid_periodicidade"] : 'null'; 
 $quantidade = isset($_POST["quantidade"])? $_POST["quantidade"] : '';
 $unid_quantidade = isset($_POST["unid_quantidade"])? $_POST["unid_quantidade"] : 'null';

 $valor_tabela = isset($_POST["valor_tabela"])? $_POST["valor_tabela"] : 'null'; 
 $valor_cobrado = isset($_POST["valor_cobrado"])? $_POST["valor_cobrado"] : 'null';
 $complexidade = isset($_POST["complexidade"])? $_POST["complexidade"] : 'null'; 
 $motivo_proc = isset($_POST["motivo_proc"])? $_POST["motivo_proc"] : 'null';
 $bloqueio = isset($_POST["bloqueio"])? $_POST["bloqueio"] : 'null';
 
 $sql = "UPDATE `procedimento` SET   `carencia`=".$carencia.",`unid_carencia`=".$unid_carencia.",`quantidade`=".$quantidade.",`unid_quantidade`=".$unid_quantidade.",`periodicidade`=".$periodicidade.",`unid_periodicidade`=".$unid_periodicidade.",`valor_tabela`=".$valor_tabela.",`valor_cobrado`=".$valor_cobrado.",`complexidade`=".$complexidade.",`bloqueio`=".$bloqueio." WHERE codigo = ".$codigo; 
			
 	    $stmt= $pdo->prepare($sql);
      
        if($stmt->execute()){

          echo"<script language='javascript' type='text/javascript'>alert('Alteração aplicada com sucesso!'); history.go(-1);</script>";
          
        }else{
         
          echo"<script language='javascript' type='text/javascript'>alert('Alteração não aplicada com sucesso!');history.go(-1);</script>";

        }
    
    
?>