<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Iqc_Model extends CI_Model {
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
	
	
	function getIqcTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('iqc_id', 'month', 'iqcs_passed_firstRun', 'userName', 'year', 'iqcs_done', 'pc_iqcs_passed_firstRun', 'target', 'timeStamp');

        //this array result column database
        $aResultColumns = array('iqc_id','year', 'month', 'iqcs_passed_firstRun', 'userName', 'iqcs_done', 'pc_iqcs_passed_firstRun', 'target', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "iqc_id";

        /* DB table to use */
        $sTable = "iqc";

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
            $row['insights'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/iqc/iqc_graph/{$row['year']}'> <i class='zoom fa fa-line-chart'></i> {$row['year']} <i class='zoom fa fa-pie-chart'> </a>";
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/iqc/popupadd/{$row['iqc_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['iqc_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getSampledId($iqc_id) {
        $sQuery = "SELECT *
                   FROM iqc           
                   WHERE iqc_id = '{$iqc_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
	
	function addIqc($data){
		if($this->db->insert('iqc', $data)){
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
	
	function updateIqc($data){
		extract($data);
		$this->db->where('iqc_id', $iqc_id);
		if($this->db->update('iqc', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteIqc($data){
		extract($data);
		$insert = array(
			'iqc_id' => $iqc_id,
			'userName' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('iqc_id', $iqc_id );	
		if($this->db->update('iqc', $insert)){
			$this->db->delete('iqc', array('iqc_id' => $data['iqc_id']));
			return true;
		}else{
			return false;
		}
		
	}

	function getTarget($search){
		$this->db->from('iqc');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['target'];
		}else{
			return 0;
		}
	}

	function getPcIqc($search){
		$this->db->from('iqc');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['pc_iqcs_passed_firstRun'];
		}else{
			return 0;
		}
	}
	
	
}
?>