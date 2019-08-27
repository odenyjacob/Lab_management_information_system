<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Satisfaction_Model extends CI_Model {
	function __construct(){  
		parent::__construct();
		$this->load->database(); 
		
		$data = array('logged_in' => TRUE);
		$this->session->set_userdata($data);
	}	
	
	
function convetResultsetToArray($Q) {
        $data = array();
        //var_dump($Q);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        //var_dump($data); 
        $Q->free_result();
        return $data;
    }
	
	
	function getSatisfactionTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('satisfaction_id', 'year', 'expectation_met', 'userName', 'expectation_not_met','number_interviewed', 'pc_expectation_met', 'status', 'target', 'timeStamp');

        //this array result column database
        $aResultColumns = array('satisfaction_id','year', 'expectation_met', 'expectation_not_met','number_interviewed', 'userName', 'pc_expectation_met', 'status', 'target', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "satisfaction_id";

        /* DB table to use */
        $sTable = "satisfaction";

        // this code for start and end limt
        $sLimit = "";
        if (isset($_REQUEST['iDisplayStart']) && $_REQUEST['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . $this->db->escape_str($_REQUEST['iDisplayStart']) . ", " .
                    $this->db->escape_str($_REQUEST['iDisplayLength']);
        }

        // this for sorting 
        if (isset($_REQUEST['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_REQUEST['iSortingCols']); $i++) {
                if ($_REQUEST['bSortable_' . intval($_REQUEST['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_REQUEST['iSortCol_' . $i])] . "
				 	" . $this->db->escape_str($_REQUEST['sSortDir_' . $i]) . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }


        $sWhere = "";
        // this for search code
        if ($_REQUEST['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_str($_REQUEST['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }


        for ($i = 0; $i < count($aColumns); $i++) {
            if ($_REQUEST['bSearchable_' . $i] == "true" && $_REQUEST['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $this->db->escape_str($_REQUEST['sSearch_' . $i]) . "%' ";
            }
        }

        // generate sql query 
        $sQuery = "SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aResultColumns)) . "
	   FROM   $sTable
	   $sWhere
	   $sOrder
	   $sLimit
	";
        $rResult = $this->db->query($sQuery, FALSE);
        $rResult = $this->convetResultsetToArray($rResult);


        //searching records
        $sQuery = "SELECT FOUND_ROWS()";

        $aResultFilterTotal = $this->db->query($sQuery, FALSE);
        $aResultFilterTotal = $this->convetResultsetToArray($aResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0]["FOUND_ROWS()"];

        //count record query from fliter
        $sQuery = "SELECT COUNT(" . $sIndexColumn . ")
           FROM   $sTable              
	  ";

        $aResultTotal = $this->db->query($sQuery, FALSE);
        $aResultTotal = $this->convetResultsetToArray($aResultTotal);
        $iTotal = $aResultTotal[0]["COUNT(" . $sIndexColumn . ")"];

        $output = array(
            "sEcho" => intval($_REQUEST['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        for ($i = 0; $i < count($rResult); $i++) {
            $row = array();
            $row = $rResult[$i];
            $row['insights'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/satisfaction/satisfaction_graph/{$row['year']}'>{$row['year']} graph </a>";
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/satisfaction/popupadd/{$row['satisfaction_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['satisfaction_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getSatisfactionId($satisfaction_id) {
        $sQuery = "SELECT *
                   FROM satisfaction           
                   WHERE satisfaction_id = '{$satisfaction_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
	
	function addSatisfaction($data){
		if($this->db->insert('satisfaction', $data)){
			return true;
		}else{
			return false;
		}
	
	}
	
	function updateSatisfaction($data){
		extract($data);
		$this->db->where('satisfaction_id', $satisfaction_id);
		if($this->db->update('satisfaction', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteSatisfaction($data){
		extract($data);
		$insert = array(
			'satisfaction_id' => $satisfaction_id,
			'userName' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('satisfaction_id', $satisfaction_id );	
		if($this->db->update('satisfaction', $insert)){
			$this->db->delete('satisfaction', array('satisfaction_id' => $data['satisfaction_id']));
			return true;
		}else{
			return false;
		}	
	}
	
	function getExpectationMet($year){
		$this->db->from('satisfaction');
		$this->db->where($year);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['pc_expectation_met'];
		}else{
			return 0;
		}
	}
	
	function getTarget($year){
		$this->db->from('satisfaction');
		$this->db->where($year);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['target'];
		}else{
			return 0;
		}
	}
	
	

}
?>