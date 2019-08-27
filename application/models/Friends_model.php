<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Eqa_Model extends CI_Model {
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
	
	function genius_friends($search){
		$this->db->from('friends');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()>=1){
			  $row = $query->row_array();
			return $row['marks'];
		}else{
			return 0;
		}
	}
	
	function updateFriends($data){
		extract($data);
		$this->db->where('friends_id', $friends_id);
		if($this->db->update('friends', $data)){
			return true;
		}else{
			return false;
		}
	}	
	
	function getFakeFriendsTable() {
        // Following datatables format http://www.datatables.net/ - O'Brian Otieno
        $aColumns = array('friends_id', 'dob', 'country', 'friend_zone_level', 'parameter', 'username','timeStamp'); // These are are sorting and filtering columns - O'Brian Otieno
        
        $aResultColumns = array('friends_id','dob', 'country', 'friend_zone_level', 'userName', 'friends', 'status', 'username', 'timeStamp'); //This array retuns result column from database O'Brian Otieno
        
        $sIndexColumn = "friends_id"; /* Indexed column - for cardinality - O'Brian Otieno*/
       
        $sTable = "friends";  //Specify the Database Table to use - O'Brian Otieno.
		
		$sJoin = ""; //Now let's query multible table here - O'Brian Otieno.

        // this bit of the function finds the start and end limits - O'Brian Otieno
        $sLimit = "";
        if (isset($_REQUEST['iDisplayStart']) && $_REQUEST['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . $this->db->escape_str($_REQUEST['iDisplayStart']) . ", " .
                    $this->db->escape_str($_REQUEST['iDisplayLength']);
        }
        // The section of the function is for sorting - O'Brian Otieno 
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
        // this bit of the function filters records on search - O'Brian Otieno
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
            $row['insights'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/eqa/eqa_graph/{$row['year']}'><i class='zoom fa fa-line-chart'>{$row['year']}<i class='zoom fa fa-bar-chart'> </a>";
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/eqa/popupadd/{$row['eqa_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['eqa_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getEqaId($eqa_id) {
        $sQuery = "SELECT *
                   FROM eqa           
                   WHERE eqa_id = '{$eqa_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
	
	function addEqa($data){
		if($this->db->insert('eqa', $data)){
			return true;
		}else{
			return false;
		}
		
		/*
		$this->db->set('year', $data['year']);
		$this->db->set('month', $data['month']);
		$this->db->set('rejected_samples', $data['rejected_samples']);
		$this->db->set('total_received_samples', $data['total_received_samples']);
		$this->db->set('target', $data['target']);
		$this->db->set('rejection_percentage', 100*($data['rejected_samples']/$data['total_received_samples']));
		$this->db->set('userName', $this->session->userdata('userName'));
		if($this->db->insert('samplerejection')){
			return true;
		}else{
			return false;
		}
		 * 
		 */
	}
	
	function deleteEqa($data){
		extract($data);
		$insert = array(
			'eqa_id' => $eqa_id,
			'userName' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('eqa_id', $eqa_id );	
		if($this->db->update('eqa', $insert)){
			$this->db->delete('eqa', array('eqa_id' => $data['eqa_id']));
			return true;
		}else{
			return false;
		}
		
	}
	
	function getParamTarget($search){
		$this->db->from('eqa');
		$this->db->where($search);
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