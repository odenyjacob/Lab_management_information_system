<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scm_Model extends CI_Model {
	function __construct(){ 
		parent::__construct();
		$this->load->database();  
		
		$data = array('logged_in' => TRUE);
		$this->session->set_userdata($data); 
	}	 


	 function getItemList($search){
		//$whereCondition = array('item' =>$search);
		//$this->db->like($whereCondition); 
		$this->db->from('supplies_settings');  
		$this->db->like('item', $search);		
		$this->db->or_like('manufacturer', $search);		
		$this->db->or_like('units', $search);		
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
		}
	 }
	 
	 
	 function insertNewItem($data){
	 	if($this->db->insert('supplies_settings', $data)){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }
	 
	 function getallItems(){
	 	$this->db->from('supplies_settings');
		$query = $this->db->get();
		return $query->result();
	 }
	 
	 function getBrandsDatatable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('brands_id', 'brands_name');

        //this array result column database
        $aResultColumns = array('brands_id', 'brands_name');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "brands_id";

        /* DB table to use */
        $sTable = "brands";

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
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/scm/popupadd/{$row['brands_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['brands_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	 function getSoldItems() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('items_id', 'items_name', 'date', 'date_entered', 'userName');

        //this array result column database
        $aResultColumns = array('id','brands_id', 'models_id', 'items_id', 'items_name', 'type', 'mode', 'unit_cost', 'units', 'discount','total_cost', 'purchase_price','total_discount', 'total_purchase_price', 'operating_balance', 'date', 'date_entered', 'status', 'userName');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "transactions_history";

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
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/scm/popupaddd/{$row['brands_id']}'>edit</a>";
            $row['return'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/scm/itemReturn/{$row['type']}/{$row['id']}'>return</a>";
            $row['delete'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/scm/deleteTransactions/{$row['type']}/{$row['id']}'>delete</a>";
           // $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['brands_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	 function getUserLevel() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('id','empNumber', 'brands_table');

        //this array result column database
        $aResultColumns = array('id','empNumber', 'addEmployee' , 'addEmployee', 'editEmployee', 'brands_table', 'models_table', 'items_table', 'customer_table');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "access_levels";

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
			if($row->add_user =='yes'){}else{};
            $row['revoke'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/main/popupadd/{$row['id']}'>Revoke</a>";
            $row['grant'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/main/popupadd/{$row['id']}'>Grant</a>";
           // $row['grant'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	 function getCustomersDataTable() {

        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        //this array content table sorting row
        $aColumns = array('customerid', 'customername', 'customerphone', 'customeraddress', 'customeraddress', 'customerlocation', 'customeremail');

        //this array result column database
        $aResultColumns = array('customerid', 'customername', 'customerphone', 'customeraddress', 'customeraddress', 'customerlocation', 'customeremail');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "customerid";

        /* DB table to use */
        $sTable = "customers";

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
            $row['edit'] = "<a class='various' data-fancybox-type='iframe' href='" . base_url() . "index.php/scm/addnewcustomer/{$row['customerid']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['customerid']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
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

    function getBrandsId($brands_id) {
        $sQuery = "SELECT *
                   FROM brands           
                   WHERE brands_id = '{$brands_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
	
    function getCustomerId($customerid) {
        $sQuery = "SELECT *
                   FROM customers           
                   WHERE customerid = '{$customerid}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }

    function updateBrands($data) {

        $updateData = array(
            'brands_name' => $data['brands_name']
        );

        $this->db->where('brands_id', $data['brands_id']);
        $this->db->update('brands', $updateData);
    }
	
	function updateCustomers($data) {
        $updateData = array(
            'customername' => $data['customername'],
            'customerphone' => $data['customerphone'],
            'customeraddress' => $data['customeraddress'],
            'customerlocation' => $data['customerlocation'],
            'customeremail' => $data['customeremail'],
            'userName' => $this->session->userdata('userName'),
            'userName' => $this->session->userdata('userName'),
            'time_added' => date('Y-m-d h:i:s:a'),
        );

        $this->db->where('customerid', $data['customerid']);
        $this->db->update('customers', $updateData);
		
		    $updateData = array(
            'customername' => $data['customername'],
            'customerphone' => $data['customerphone'],
            'customeraddress' => $data['customeraddress'],
            'customerlocation' => $data['customerlocation'],
            'customeremail' => $data['customeremail'],
            'userName' => $this->session->userdata('userName'),
            'userName' => $this->session->userdata('userName'),
            'time_added' => date('Y-m-d h:i:s:a'),
        );
        $this->db->insert('customers_history', $updateData);
    }

    function addBrands($data) {
        $this->db->set('brands_name', $data['brands_name']);
		$this->db->set('userName', $this->session->userdata('userName'));
		$this->db->set('time_added', date('Y-m-d h:i:s:a'));
        $this->db->insert('brands');
		 $this->db->set('brands_name', $data['brands_name']);
		$this->db->set('userName', $this->session->userdata('userName'));
		$this->db->set('time_added', date('Y-m-d h:i:s:a'));
		$this->db->insert('brands_history');
    }
    
    function addCustomer($data) {
        $this->db->set('customername', $data['customername']);
        $this->db->set('customerphone', $data['customerphone']);
        $this->db->set('customeraddress', $data['customeraddress']);
        $this->db->set('customerlocation', $data['customerlocation']);
        $this->db->set('customeremail', $data['customeremail']);
		$this->db->set('userName', $this->session->userdata('userName'));
		$this->db->set('time_added', date('Y-m-d h:i:s:a'));
        $this->db->insert('customers');
		
        $this->db->set('customername', $data['customername']);
        $this->db->set('customerphone', $data['customerphone']);
        $this->db->set('customeraddress', $data['customeraddress']);
        $this->db->set('customerlocation', $data['customerlocation']);
        $this->db->set('customeremail', $data['customeremail']);
		$this->db->set('userName', $this->session->userdata('userName'));
		$this->db->set('time_added', date('Y-m-d h:i:s:a'));
        $this->db->insert('customers_history');
    }

    function deleteBrands($data) {
        $this->db->delete('customers', array('customerid' => $data['customerid']));
    }

    function getAllBrands() {
        $this->db->select('*');
        $this->db->order_by("brands_name", "asc");
        $query = $this->db->get('brands');
        $output = $this->convetResultsetToArray($query);
        return $output;
    }
    
    function getModelsDatatable() {
        
        // this code is datatable js framework. http://www.datatables.net/
        // so we have follow some data format.
        
        //this array content table sorting row
        $aColumns = array('models_id','b.brands_name', 'models_name');
        
        //this array result column database
        $aResultColumns = array('m.*','b.brands_name');
        
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "models_id";
        
        
        /* DB table to use */
        $sTable = "models m ";
        
        $sJoin = " JOIN brands b ON b.brands_id = m.brands_id ";

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
           $sJoin
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
           $sJoin    
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
            $row['edit'] = "<a href='".  base_url() ."index.php/scm/newModel/{$row['models_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['models_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

    function getItemsDatatable() {
        
        // this code is datatable js framework. http://www.datatables.net/
        // so, we have to follow some data format.
        
        //this array content table sorting row
        $aColumns = array('items_id','b.brands_name', 'm.models_name','i.items_name','i.unit_cost', 'i.in_stock','i.date_added','i.oem_number' );
        
        //this array result column database
        $aResultColumns = array('i.*','b.brands_name' ,'m.models_name');
        
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "items_id";
        
        
        /* DB table to use */
        $sTable = "items i ";
        
        $sJoin = " JOIN models m ON m.models_id = i.models_id ";
        $sJoin .= " JOIN brands b ON b.brands_id = i.brands_id ";
        

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
           $sJoin
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
           $sJoin    
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
            $row['item_report'] = "<a href='".  base_url() ."index.php/scm/report/{$row['items_id']}/{$row['items_name']}'>View</a>";
			$row['new_sales'] = "<a class='various' data-fancybox-type='iframe' href='".  base_url() ."index.php/scm/add_sales/{$row['items_id']}'>Add Sales</a>";
			$row['addStock'] = "<a class='various' data-fancybox-type='iframe' href='".  base_url() ."index.php/scm/addStock/{$row['items_id']}'>Add Stock</a>";
			$row['edit'] = "<a class='various' data-fancybox-type='iframe' href='".  base_url() ."index.php/scm/additem/{$row['items_id']}'>edit</a>";
            $row['delete'] = "<a class='deleteRecord' onclick= 'deleteRecord({$row['items_id']})' >delete</a>";
            $output['aaData'][] = $row;
        }
        echo json_encode($output);
    }

	function getItemsId($items_id){
        $sQuery = "SELECT *
                   FROM items           
                   WHERE items_id = '{$items_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
   
	
	function itemReport($data){
		extract($data);
		$this->db->from('transactions_history');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();   
	}

	function dailySalesreport($data){
		extract($data);
		$this->db->from('transactions_history');
		$this->db->where($data);
		$query = $this->db->get();
		return $query->result();   
	}
	
	function getAllModels() {
        $this->db->select('*');
        $this->db->order_by("models_name", "asc");
        $query = $this->db->get('models');
        $output = $this->convetResultsetToArray($query);
        return $output;
    }
	
    function getAllCustomers() {
        $this->db->select('*');
        $this->db->order_by("customername", "asc");
        $query = $this->db->get('customers');
        $output = $this->convetResultsetToArray($query);
        return $output;
    }
    
	function getModelsId($models_id){
        $sQuery = "SELECT *
                   FROM models           
                   WHERE models_id = '{$models_id}'
                  ";
        $result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
    }
    
	function updateItems($data){
                
         $updateData = array(
                          'brands_id' => $data['brands_id'],
                          'models_id' => $data['models_id'],
                          'items_name' => $data['items_name'],
						  'unit_cost' => $data['unit_cost']
                        );

        $this->db->where('items_id', $data['items_id']);
        $this->db->update('items', $updateData);
    }
    
    function addItems($data){
        $this->db->set('items_name', $data['items_name']);
        $this->db->set('models_id', $data['models_id']); 
        $this->db->set('brands_id', $data['brands_id']);
		$this->db->set('unit_cost', $data['unit_cost']);
        $this->db->set('date_added', date("Y-m-d H:i:s")); 
        $this->db->insert('items');
    }

    function getOperatingBalance(){
		$this->db->from('transactions');
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array(); 
			return $row['operating_balance'];
		}else{
			return false;
		}
	}
	
	function deleteTransactionProcess($data){
		extract($data);
		$this->db->where('id', $id);
		$this->db->update('transactions_history', $data);
	}
	
	function getTransactioID($id){
		 $sQuery = "SELECT *
                   FROM transactions_history           
                   WHERE id = '{$id}'
                  ";
		$result = $this->db->query($sQuery, FALSE);
        $result = $this->convetResultsetToArray($result);
        return $result;
		
	}
	
    function getStockingBalance($items_id){
		$this->db->from('items');
		$this->db->where('items_id', $items_id);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array(); 
			return $row['in_stock'];
		}else{
			return false;
		}
	}

	function updateTransactions($data){
		$this->db->where('transactions.id',  1);
		$this->db->update('transactions', $data);
		$this->db->insert('transactions_history', $data);
	}
	
	function changereturnStatus($data){
		extract($data);	
		$this->db->where('transactions_history.id', $id);
		$this->db->update('transactions_history', $data);
	}
	
	function updateStock($data){
		extract($data);
		$this->db->where('items_id', $items_id);
		$this->db->update('items', $data);
	}
	
	function InsertStock($data){
		$this->db->insert('stock', $data);
		//$this->db->insert('stock_history', $data);
	}
	
	
    
    function deleteItems($data){
        $this->db->delete('items', array('items_id' => $data['items_id'])); 
    }
	
	function getItemName($items_id){
		$this->db->from('items');
		$this->db->where('items_id', $items_id);
		$query = $this->db->get();
		if($query->num_rows()===1){
			  $row = $query->row_array(); 
			return $row['items_name'];
		}else{
			return false;
		}
	}
	

    function updateModels($data){
                
         $updateData = array(
                          'brands_id' => $data['brands_id'],
                          'models_name' => $data['models_name'],
                          'time_added' => date('Y-m-d h:i:s:a'),
                          'userName' => $this->session->userdata('userName')
                        );

        $this->db->where('models_id', $data['models_id']);
        $this->db->update('models', $updateData);  
		$this->db->insert('models_history', $updateData); 
    }
    
    function addModels($data){
        $this->db->set('models_name', $data['models_name']); 
        $this->db->set('brands_id', $data['brands_id']);
		$this->db->set('userName', $this->session->userdata('userName'));
		$this->db->set('time_added', date('Y-m-d h:i:s:a'));
        $this->db->insert('models');
        $this->db->set('models_name', $data['models_name']); 
        $this->db->set('brands_id', $data['brands_id']);
		$this->db->set('userName', $this->session->userdata('userName'));
		$this->db->set('time_added', date('Y-m-d h:i:s:a'));
        $this->db->insert('models_history');
    }
    
    function deleteModels($data){
        $this->db->delete('models', array('models_id' => $data['models_id'])); 
    }

	 
    function stockingLevels(){
    	$query =$this->db->query("select * from items");
		$result['records'] = $query->result();
		return $result;
    }

	


} 
?>