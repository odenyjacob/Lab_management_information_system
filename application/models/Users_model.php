<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_Model extends CI_Model {
	function __construct(){  
		parent::__construct();
		$this->load->database(); 
		
		$data = array('logged_in' => TRUE);
		$this->session->set_userdata($data);
	}	
	
	
    function convertResultsetToArray($Q) {
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
	
	
	function getUsersTable() {

        // this code is daconceptsable js framework. http://www.daconceptsables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('id', 'FName', 'LName', 'userName', 'username');

        //this array result column database
        $aResultColumns = array('id','FName', 'LName', 'userName', 'username');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "users";

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
        $rResult = $this->convertResultsetToArray($rResult);


        //searching records
        $sQuery = "SELECT FOUND_ROWS()";

        $aResultFilterTotal = $this->db->query($sQuery, FALSE);
        $aResultFilterTotal = $this->convertResultsetToArray($aResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0]["FOUND_ROWS()"];

        //count record query from fliter
        $sQuery = "SELECT COUNT(" . $sIndexColumn . ")
           FROM   $sTable              
	  ";

        $aResultTotal = $this->db->query($sQuery, FALSE);
        $aResultTotal = $this->convertResultsetToArray($aResultTotal);
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
            $row['edit'] = "<a class='various btn btn-sm btn-success' data-fancybox-type='iframe' href='" . base_url() . "index.php/users/popupadd/{$row['id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord btn btn-sm btn-danger' onclick= 'deleteRecord({$row['id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	function getBranchesTable() {

        // this code is daconceptsable js framework. http://www.daconceptsables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('id', 'center', 'branch','status', 'userName');

        //this array result column database
        $aResultColumns = array('id','center', 'branch', 'status', 'userName');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "branches";

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
        $rResult = $this->convertResultsetToArray($rResult);


        //searching records
        $sQuery = "SELECT FOUND_ROWS()";

        $aResultFilterTotal = $this->db->query($sQuery, FALSE);
        $aResultFilterTotal = $this->convertResultsetToArray($aResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0]["FOUND_ROWS()"];

        //count record query from fliter
        $sQuery = "SELECT COUNT(" . $sIndexColumn . ")
           FROM   $sTable              
	  ";

        $aResultTotal = $this->db->query($sQuery, FALSE);
        $aResultTotal = $this->convertResultsetToArray($aResultTotal);
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
            $row['edit'] = "<a class='various btn btn-sm btn-success' data-fancybox-type='iframe' href='" . base_url() . "index.php/centers/branch_popupadd/{$row['id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord btn btn-sm btn-danger' onclick= 'deleteRecord({$row['id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getUserId($id) {
        $sQuery = "SELECT *
                   FROM users           
                   WHERE id = '{$id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convertResultsetToArray($result);
        return $result;
    }
     
	
	function addUser($data){
		if($this->db->insert('users', $data)){
			return true;
		}else{
			return false;
		}

	} 
	
	function updateUser($data){
		extract($data);
		$this->db->where('id', $id);
		if($this->db->update('users', $data)){
			return true;
		}else{
			return false;
		}
	}
	 	
	function deleteUser($data){ 
		extract($data);
		$insert = array(
			'id' => $id, 
		);
		$this->db->where('id', $id );	
		if($this->db->update('users', $insert)){
			$this->db->delete('users', array('id' => $data['id'])); 
			return true;
		}else{
			return false;
		}
		
	}
	
	function deleteBranch($data){ 
		extract($data);
		$insert = array(
			'id' => $id,
			'username' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('id', $id );	
		if($this->db->update('branches', $insert)){
			$this->db->delete('branches', array('id' => $data['id'])); 
			return true;
		}else{
			return false;
		}
		
	}
	
	function getAllcenters(){
		$this->db->from('centers');
		$query = $this->db->get();
		return $query->result();
    }
    
    function getCenters(){
        $query = $this->db->query('SELECT * FROM centers');
        return $query->result_array();
    }
	
	function getBranches(){
		$query = $this->db->query('select * from branches'); 
		return $query->result_array();
	}
	
	function getAffiliatedInstitution(){
		$this->db->from('affiliatedinstitutions');
		$query = $this->db->get();
		return $query->result();
    }



}
?>
