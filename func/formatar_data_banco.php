<?php
// TRANSFORMA DO FORMATO BRA PARA USA
     function formatar_data_banco($data) {
	 	$data = implode('-',array_reverse(explode('/',$data)));
        $mes = date('m', strtotime($data));
		$dia= date('d', strtotime($data));
		$ano = date('Y', strtotime($data));
		$data = $ano.'-'.$mes.'-'.$dia;
		
        return $data; 
    }

// TRANSFORMA DO FORMATO USA PARA BRA
     function formatar_banco_data($data) {
        $mes = date('m', strtotime($data));
		$dia= date('d', strtotime($data));
		$ano = date('Y', strtotime($data));
		$data = $dia.'/'.$mes.'/'.$ano;
		
        return $data; 
    }
?>