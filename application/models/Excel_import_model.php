<?php
class Excel_import_model extends CI_Model
{
	function select()
	{
		$this->db->order_by('CustomerID', 'DESC');
		$query = $this->db->get('tbl_customer');
		return $query;
	}

	function insert_death_home($items, $prov_code)
	{

		$n = 0;
		$table = 'death_home';
		$this->db->trans_start();
		foreach ($items as $item) {
			$insert_query = $this->db->insert_string($table, $item);
			$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
			$rs = $this->db->query($insert_query);
			if ($rs) {
				$n++;
			}
		}
		$this->db->trans_complete();
		$this->update_d_death('home');
		$this->update_ny('home');
		$this->update_group_stat();
		$this->update_ill_define();
		return $n;
	}

	function insert_death_hos($items, $prov_code)
	{

		$n = 0;
		$table = 'death_hos';
		$this->db->trans_start();
		foreach ($items as $item) {
			$insert_query = $this->db->insert_string($table, $item);
			$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
			$rs = $this->db->query($insert_query);
			if ($rs) {
				$n++;
			}
		}
		$this->db->trans_complete();
		$this->update_d_death('hos');
		$this->update_ny('hos');
		return $n;
	}
	function insert_birth($items, $prov_code, $import_year)
	{
		//$this->db->insert_batch('person_survey_test', $data);
		$n = 0;
		$table = 'birth_' . $prov_code;
		$rs = $this->db->where('BYEAR', $import_year)->delete($table);
		$this->db->trans_start();
		foreach ($items as $item) {
			$insert_query = $this->db->insert_string($table, $item);
			$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
			$rs = $this->db->query($insert_query);
			if ($rs) {
				$n++;
			}
		}
		$this->db->trans_complete();
		return $n;
	}

	function update_d_death($table)
	{
		$sql = "UPDATE death_" . $table . " a SET a.D_DEATH = CONCAT(a.DYEAR-543,'-',a.DMON,'-',a.DDATE) WHERE D_DEATH IS NULL;";
		$rs = $this->db->query($sql);
		return $rs;
	}
	function update_ny($table)
	{
		$sql = "UPDATE death_".$table." SET N_YEAR = if(DMON in('10','11','12'),DYEAR+1,DYEAR) WHERE N_YEAR IS NULL;";
		$rs = $this->db->query($sql);
		return $rs;
	}
	function update_group_stat()
	{
		$sql = "CALL update_group_stat_home();";
		$rs = $this->db->query($sql);
		return $rs;
	}
	function update_ill_define()
	{
		$sql = "CALL update_ill_define();";
		$rs = $this->db->query($sql);
		return $rs;
	}
}
