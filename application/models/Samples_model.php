<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Samples_Model extends CI_Model {
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
	
	
	function getSRTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('sample_id', 'month', 'rejected_samples', 'userName', 'year', 'total_received_samples', 'rejection_percentage', 'target', 'timeStamp');

        //this array result column database
        $aResultColumns = array('sample_id','year', 'month', 'rejected_samples', 'userName', 'total_received_samples', 'rejection_percentage', 'target', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "sample_id";

        /* DB table to use */
        $sTable = "samplerejection";

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
            $row['insights'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/rejection_graph/{$row['year']}'><i class='zoom fa fa-line-chart'></i>{$row['year']}<i class='zoom fa fa-pie-chart'></i> </a>";
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/popupadd/{$row['sample_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['sample_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	function getSamplesTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('id', 'sample_id', 'project', 'sample_type','sample_date', 'userName', 'status', 'timeStamp');

        //this array result column database
        $aResultColumns = array('id','sample_id', 'project', 'sample_type', 'sample_date', 'sample_time', 'status', 'userName', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "samples";

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
            $row['barcode'] = "<a class='various ' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/barcode_popup/{$row['sample_id']}'><i class='zoom fa fa-barcode'></i>{$row['sample_id']}</a>";
            $row['edit'] = "<a class='various btn btn-sm btn-success' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/samples_popup/{$row['id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord btn btn-sm btn-danger' onclick= 'deleteRecord({$row['id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	function receiveSamplesTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('id', 'sample_id', 'project', 'sample_type','sample_date', 'userName', 'status', 'timeStamp');

        //this array result column database
        $aResultColumns = array('id','sample_id', 'project', 'sample_type', 'sample_date', 'sample_time', 'status', 'userName', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "samples";

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
            $row['barcode'] = "<a class='various ' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/barcode_popup/{$row['sample_id']}'><i class='zoom fa fa-barcode'></i>{$row['sample_id']}</a>";
            // $row['receivesample'] = "<a class='various btn btn-sm btn-success' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/receivesample/{$row['id']}'>receive</a>";
            // $row['rejectsample'] = "<a class='various btn btn-sm btn-danger' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/rejectsample/{$row['id']}'>reject</a>";
            // $row['delete'] = "<a class='deleteRecord btn btn-sm btn-danger' onclick= 'deleteRecord({$row['id']})' >delete</a>";
            $row['receivesample'] = "<a class='deleteRecord btn btn-sm btn-success' onclick= 'receiveSample({$row['id']})' >receive</a>";
            $row['rejectsample'] = "<a class='deleteRecord btn btn-sm btn-danger' onclick= 'rejectSample({$row['id']})' >reject</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	function getSampleTypeTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('id',  'sample_type','status', 'userName', 'status', 'timeStamp');

        //this array result column database
        $aResultColumns = array('id', 'sample_type', 'status', 'userName', 'timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "sample_type";

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
            // $row['insights'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/rejection_graph/{$row['year']}'><i class='zoom fa fa-line-chart'></i>{$row['year']}<i class='zoom fa fa-pie-chart'></i> </a>";
            $row['edit'] = "<a class='various btn btn-sm btn-success' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/sampletype_popup/{$row['id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord btn btn-sm btn-danger' onclick= 'deleteRecord({$row['id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	
	function getSRAuditTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('sample_id','sample_audit_id', 'month', 'rejected_samples', 'userName', 'year', 'total_received_samples', 'rejection_percentage', 'target', 'status', 'timeStamp');

        //this array result column database
        $aResultColumns = array('sample_id', 'sample_audit_id', 'year', 'month', 'rejected_samples', 'userName', 'total_received_samples', 'rejection_percentage', 'target','status','timeStamp');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "sample_audit_id";

        /* DB table to use */
        $sTable = "samplerejection_audit";

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
           // $row['view'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/rejection_graph/{$row['year']}'><i class='zoom fa fa-line-chart'></i>{$row['year']}<i class='zoom fa fa-pie-chart'></i> </a>";
            $row['view'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/viewAuditItem/{$row['sample_audit_id']}'>view</a>";
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/samples/popupadd/{$row['sample_audit_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['sample_audit_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getSampledId($samples_id) {
        $sQuery = "SELECT *
                   FROM samplerejection           
                   WHERE sample_id = '{$samples_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }

    function getSampleById($id) {
        $sQuery = "SELECT *
                   FROM samples           
                   WHERE id = '{$id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }

    function getSampleTypeById($id) {
        $sQuery = "SELECT *
                   FROM sample_type           
                   WHERE id = '{$id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }

    function getSampleBySampleId($id) {
        $sQuery = "SELECT *
                   FROM samples           
                   WHERE sample_id = '{$id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
	
	function addRejection($data){
		if($this->db->insert('samplerejection', $data)){
			return true;
		}else{
			return false;
		}

	}
	
	function updateRejection($data){
		extract($data);
		$this->db->where('sample_id', $sample_id);
		if($this->db->update('samplerejection', $data)){
			return true;
		}else{
			return false;
		}
    }
    
	function addSamples($data){
		if($this->db->insert('samples', $data)){
			return true;
		}else{
			return false;
		}

	}
	
	function updateSamples($data){
		extract($data);
		$this->db->where('id', $id);
		if($this->db->update('samples', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function addSampleType($data){
		if($this->db->insert('sample_type', $data)){
			return true;
		}else{
			return false;
		}

	}
	
	function updateSampleType($data){
		extract($data);
		$this->db->where('id', $id);
		if($this->db->update('sample_type', $data)){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteSampleRejection($data){
		extract($data);
		$insert = array(
			'sample_id' => $sample_id,
			'userName' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('sample_id', $sample_id );	
		if($this->db->update('samplerejection', $insert)){
			$this->db->delete('samplerejection', array('sample_id' => $data['sample_id']));
			return true;
		}else{
			return false;
		}
		
	}
	
	function deleteSampleType($data){
		extract($data);
		$insert = array(
			'id' => $id,
			'userName' => $this->session->userdata('userName'),
			'status' => 'deleted',
		);
		$this->db->where('id', $id );	
		if($this->db->update('sample_type', $insert)){
			$this->db->delete('sample_type', array('id' => $data['id']));
			return true;
		}else{
			return false;
		}
		
	}
	
	function getTarget($search){
		$this->db->from('samplerejection');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['target'];
		}else{
			return 0;
		}
	}

	function getRejection($search){
		$this->db->from('samplerejection');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array();
			return $row['rejection_percentage'];
		}else{
			return 0;
		}
	}
	
	function getSummaries($search){ 
		$this->db->select('*');
		$this->db->from('summaries');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row_array();    
		}else{
			return false;
		}		
		
	}
	
	function getConcepts($search){ 
		$this->db->select('*');
		$this->db->from('concepts');
		$this->db->where($search);
		$query = $this->db->get();
		if($query->num_rows()==1){
			return $query->row_array();    
		}else{
			return false;
		}		
		
    }
    
    function getSampleTypes(){
        $query = $this->db->query('SELECT * FROM sample_type');
        return $query->result_array();
    }
    
    function getProjects(){
        $query = $this->db->query('SELECT * FROM projects');
        return $query->result_array();
    }

}
?>
