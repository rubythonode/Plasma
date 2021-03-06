<?php

/**
 * MySQL에 접속하여 결과를 배열로 가져옵니다.
 */
function mysql_get_list($query) {
	
	global $plasma_config;
	
	// 코드 트래킹
	if ($plasma_config['is_dev_mode'] === true) {
		$backtrace = debug_backtrace();
		show_debug_msg($backtrace[0]['args'][0].' # '.$backtrace[0]['file'].', line:'.$backtrace[0]['line']);
	}
	
	$conn = mysqli_connect($plasma_config['mysql']['server'], $plasma_config['mysql']['username'], $plasma_config['mysql']['password'], $plasma_config['mysql']['database']);

	$result = mysqli_query($conn, $query);

	$i = 0;
	$return = [];
	while ($row = mysqli_fetch_assoc($result)) {
		foreach ($row as $key => $data) {
			$return[$i]->$key = $data;
		}
		$i++;
	}

	mysqli_close($conn);
	
	return $return;
}
