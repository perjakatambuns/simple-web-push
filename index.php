<?php
	header('Content-Type: application/json; charset=utf-8');
	if(file_exists('log/log_ssh_'.date("j.n.Y").'.log')){
		$file = fopen('log/log_ssh_'.date("j.n.Y").'.log','r');
		$nodes['status'] = true;
		$nodes['data'] = array();
		while (($line = stream_get_line($file, 1024 * 1024, "\n")) !== false) {
			$data = explode('|',$line);
			$nodes['data'][$data[1]]['total_attempts'] += $data[2];
			if($data[3] == 'SUCCESS'){
				$nodes['data'][$data[1]]['success_attempts'] += $data[2];
			}else{
				$nodes['data'][$data[1]]['success_attempts'] += 0;
			}
			if($data[3] == 'FAILED'){
				$nodes['data'][$data[1]]['failed_attempts'] += $data[2];
			}else{
				$nodes['data'][$data[1]]['failed_attempts'] += 0;
			}
			
			$nodes['data'][$data[1]]['detail_access'][] = array(
													"status" => $data[3],
													"attempts" => $data[2],
													"user" => $data[4],
													"ip" => $data[5],
													"resolver" => base64_decode($data[6]),
													"time" => base64_decode($data[7])
												);
		}
		fclose($file);
		echo json_encode($nodes);
	}else{
		$nodes['status'] = false;
		$nodes['data'] = [];
		echo json_encode($nodes);
	}
?>
