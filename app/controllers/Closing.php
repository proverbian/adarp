<?php
class Closing extends Controller {
	
	public function index() {
		echo 'closing';
	}

	public function check() {
		//die('Maintenance!');
	}

	public function remedials() { //update passed remedial takers
		$this->check();

		$date = date('Y-m-d h:i:s');
		$checkvoid = DB::connection('dot2')
		->select(DB::raw('SELECT a.fu_num, a.subject,SUBSTRING(subname, 1, LENGTH(subname) - 1),b.grade FROM remedials a  LEFT JOIN acad_131 b on b.fu_num = a.fu_num WHERE LENGTH(a.fu_num) = 8 AND a.subject_void <> 1 and SUBSTRING(subname, 1, LENGTH(subname) - 1) = a.subject and (b.grade <=3 and b.grade >=1)'));
		foreach ($checkvoid as $id) {
			DB::connection('dot2')
			->update(DB::raw("UPDATE remedials set subject_void = '1',date_void = '$date' WHERE fu_num = '$id->fu_num'"));
		}
	}



	public function clear_or_num() {
		$this->check();
		$valid_orno_start = '201310';
		$void_orno_qry = "UPDATE student SET ok_to_enrl = '' , ORNO = '' "
		." WHERE SUBSTRING(ORNO,1,6) < '$valid_orno_start' AND ok_to_enrl = '1' "
		." AND NOT( TRIM(course) = 'KIN' OR TRIM(course) = 'ELEM' OR TRIM(course) = 'HS' )";
		
		DB::connection('dot2')
		->query($void_or_no_qry);
	}

	public function clearPermits() {
		$this->check();
		
		$sem = '2';

		switch($sem){
			case 'S':
				$updateSql = " ps1 ='', ps2 = '', ps3 = '' ";
				break;
				
			case 1:
				$updateSql = " p111 = '', p112 = '', p113 = '', p121 = '', p122 = '', p123 = '' ";
				break;
			case 2:
				$updateSql = " p211 = '', p212 = '', p213 = '', p221 = '', p222 = '', p223 = '' ";
				break;
			default:
				break;			
		}

		$sql = "UPDATE student SET ".$updateSql;

		DB::connection('dot2')
		->query($sql);
	}



}



?>