<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Concepts_Model extends CI_Model {
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
	
	
	function getConceptsTable() {

        // this code is daconceptsable js framework. http://www.daconceptsables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('concepts_id', 'table_name', 'objective', 'userName', 'measure', 'reporting_schedule', 'methodology_numerator','methodology_denominator', 'methodology_multiplier', 'status', 'timeStamp');

        //this array result column database
        $aResultColumns = array('concepts_id','measure', 'table_name', 'objective', 'userName', 'reporting_schedule', 'methodology_numerator','methodology_denominator', 'methodology_multiplier', 'status', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "concepts_id";

        /* DB table to use */
        $sTable = "concepts";

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
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/concepts/popupadd/{$row['concepts_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['concepts_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getconceptsId($concepts_id) {
        $sQuery = "SELECT *
                   FROM concepts           
                   WHERE concepts_id = '{$concepts_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
	
	function addConcepts($data){
		if($this->db->insert('concepts', $data)){
			return true;
		}else{
			return false;
		}

	}
	
	function updateConcepts($data){
		extract($data);
		$this->db->where('concepts_id', $concepts_id);
		if($this->db->update('concepts', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteConcepts($data){
		extract($data);
		$insert = array(
			'concepts_id' => $concepts_id,
			'userName' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('concepts_id', $concepts_id );	
		if($this->db->update('concepts', $insert)){
			$this->db->delete('concepts', array('concepts_id' => $data['concepts_id']));
			return true;
		}else{
			return false;
		}
		
	}


}
?>
