<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scm extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->library(array('form_validation', 'session', 'table', 'bcrypt', 'encrypt', 'email', 'typography'));
		$this->load->model(array('main_model', 'hcm_model', 'fms_model', 'scm_model'));
		$this->load->helper(array('date', 'array', 'html', 'url', 'form'));
		
		$this->view_data = array();
		

	}
	
	
		var $brands_id = '';
    	var $brands_name = '';
   		var $models_name = '';
    	var $models_id = '';
    	var $allBrands = '';
		var $allModels = '';
		var $items_id = ''; 
    	var $items_name = '';
    	var $date_added = '';
	//header
	function dashboard(){
		$empNumber = $this->session->userdata('empNumber');
		$data['access'] = $this->main_model->getAccess($empNumber);
		$data['stocking'] = $this->scm_model->stockingLevels();
		$this->load->view('dash', $data);			
	}
	
		// Login View
	function login(){
		$data['title'] = 'ERP | LOGIN';
		$this->load->view('login', $data);
		//$this->load->view('login'); 
	}
	
	
	
	//Showing success page
	function success(){
		$this->load->view('success');
	}
	
		
	function dberror(){

		$this->dashboard();
		$this->load->view('dberror');
	}
	
	function registernewItem(){
		$data['title'] = 'ERP | Supplies - Register New Item';
		$this->dashboard();
		$this->load->view('scm/registernewItem', $data);
	}
	
	function addNewItem(){
		$data['title'] = 'ERP | Supplies - Add New Item';
		$data['item'] = $this->scm_model->getallItems();
		$this->dashboard();
		$this->load->view('scm/newItem', $data);
	}
	
	function pnItem(){
		$search=  $this->input->post('item');
		$query = $this->scm_model->getItemList($search);  
		echo json_encode ($query);
		//$this->load->view('fms/employeeBenefits', $query);
	}
	
	function pNewItem(){
		$data = array(
			'item' => $this->input->post('item'),
			'manufacturer' => $this->input->post('manufacturer'),
			'pack_size' => $this->input->post('pack_size'),
			'units' => $this->input->post('units'),
		);
		
		if($this->scm_model->insertNewItem($data)){
			echo json_encode($data);
		}else{
			
		}
		
	}
	
	
	/* Handliing Brands */
	
	function brandstable(){
		$data['title'] = 'ERP | Item List';
		$this->dashboard();
		$this->load->view('scm/brands_list', $data);
	}
	
	function userleverTable(){
		$data['title'] = 'User level List';
		$this->dashboard();
		$this->load->view('scm/userlevel_list', $data);
	}
	
		
	
	/*
	public function addItem() {
        $this->load->helper('url'); 
        $this->load->view('templates/header');
        $this->load->view('templates/commonJs');
        $this->load->view('brands_list1');
        $this->load->view('templates/footer');
    }
*/
    //this function data tabel
    public function dataTable() {
        $this->scm_model->getBrandsDatatable();
    }
	
	function user_level(){
		$this->scm_model->getUserLevel();
	}

    public function add($brand_id = '') {
        $this->brands_id = $brand_id;

        $this->load->helper('url');
        $this->load->database();
        $this->load->model('scm_model');

        // fetch record from db when edit records
        $result = $this->scm_model->getBrandsId($this->brands_id);
        $this->brands_name = isset($result[0]['brands_name']) ? $result[0]['brands_name'] : "";

        //loading view
        $this->load->view('templates/header');
        $this->load->view('templates/commonJs');
        $this->load->view('brands_form');
        $this->load->view('templates/footer');
    }

    // this for popup
    public function popupadd($brand_id = '') {
        $this->brands_id = $brand_id;

        $this->load->helper('url');
        $this->load->database();
        $this->load->model('scm_model');

        // fetch record from db when edit records
        $result = $this->scm_model->getBrandsId($this->brands_id);
        $this->brands_name = isset($result[0]['brands_name']) ? $result[0]['brands_name'] : "";

        //loading view
        //$this->load->view('templates/header');
       // $this->load->view('templates/commonJs');
       $data['title'] = "ERP | Add New Brand";
       //$this->dashboard();
       $this->load->view('scm/brands_popupform', $data);
        //$this->load->view('templates/footer');
    }

    public function addnewcustomer($customerid = '') {
        $this->customerid = $customerid;
		
        // fetch record from db when edit records
        $result = $this->scm_model->getCustomerId($this->customerid);
        $this->customerid = isset($result[0]['customerid']) ? $result[0]['customerid'] : "";
        $this->customername = isset($result[0]['customername']) ? $result[0]['customername'] : "";
        $this->customerphone = isset($result[0]['customerphone']) ? $result[0]['customerphone'] : "";
        $this->customeraddress = isset($result[0]['customeraddress']) ? $result[0]['customeraddress'] : "";
        $this->customerlocation = isset($result[0]['customerlocation']) ? $result[0]['customerlocation'] : "";
        $this->customeremail = isset($result[0]['customeremail']) ? $result[0]['customeremail'] : "";

        //loading view
        //$this->load->view('templates/header');
       // $this->load->view('templates/commonJs');
       $data['title'] = "ERP | Add New Brand";
       //$this->dashboard();
       $this->load->view('scm/customers_popupform', $data);
        //$this->load->view('templates/footer');
    }

 	public function additem($items_id = ''){
        $this->items_id = $items_id;
       
       // $this->load->helper('url');
       // $this->load->database();
        
       // $this->load->model('brands_model');
        //$this->load->model('models_model');
       // $this->load->model('items_model');
        
        //all brands.
        $this->allBrands = $this->scm_model->getAllBrands();
        $this->allModels = $this->scm_model->getAllModels();
        
        // fetch record from db when editing records
        $result = $this->scm_model->getItemsId($this->items_id);
        $this->brands_id = isset($result[0]['brands_id']) ? $result[0]['brands_id'] : "";
        $this->models_id = isset($result[0]['models_id']) ? $result[0]['models_id'] : "";
        $this->items_name = isset($result[0]['items_name']) ? $result[0]['items_name'] : "";
		 $this->unit_cost = isset($result[0]['unit_cost']) ? $result[0]['unit_cost'] : "";
        
        //loading view
		$data['title'] = 'Add New Item';
        $this->load->view('scm/items_popupform', $data);
        //$this->load->view('templates/commonJs');
        //$this->load->view('items_form');
        //$this->load->view('templates/footer');
    }

    public function process() {

        $this->load->helper('url');
        $this->load->database();
        $this->load->model('scm_model');

        $data = $_REQUEST;

        // this for add new records
        if ($data['type'] == 'addBrands') {
            $this->scm_model->addBrands($data);
        }
        // this for update records
        else if ($data['type'] == 'updateBrands') {
            $this->scm_model->updateBrands($data);
        }

        if ($data['popup'] == "true") {

            $output['success'] = 1;
            $output['msg'] = "data process completed successfully";
            echo json_encode($output);
        } else {
            header("Location: " . base_url() . "/index.php/main/success");
            exit();
        }
    }
	
    public function customerprocess() {

        $data = $_REQUEST;

        // this for add new records
        if ($data['type'] == 'addCustomer') {
            $this->scm_model->addCustomer($data);
        }
        // this for update records
        else if ($data['type'] == 'updateCustomer') {
            $this->scm_model->updateCustomers($data);
        }

        if ($data['popup'] == "true") {

            $output['success'] = 1;
            $output['msg'] = "data process completed successfully";
            echo json_encode($output);
        } else {
            header("Location: " . base_url() . "/index.php/main/success");
            exit();
        }
    }

    // delete record functions
    public function deleteModels() {

        $this->load->helper('url');
        $this->load->database();
        $this->load->model('scm_model');

        $data = $_REQUEST;
        $this->scm_model->deleteBrands($data);

        $output['success'] = 1;
        $output['msg'] = "Record deleted successfully";

        echo json_encode($output);
    }
	
	/* Handling models */
	

    
    public function models() {
        //$this->load->helper('url');
        //$this->load->view('templates/header');
        //$this->load->view('templates/commonJs');
        //$this->load->view('model	xs_list');
        //$this->load->view('templates/footer');
       $this->dashboard();
        //$empNumber = $this->session->userdata('userName');
        //$data['access'] = $this->main_model->getAccess($empNumber);
        $data['title'] = 'ERP | Supplies Models';
        $this->load->view('scm/modelslist', $data);
    }
	
	public function modelsprocessing() {
        $this->load->helper('url');
        $this->load->database();
        $this->scm_model->getModelsDatatable();
    }
	
	public function customerTable() {
        $this->load->helper('url');
        $this->load->database();
        $this->scm_model->getCustomersDataTable();
    }

	
	/* Handling Items */	
	
	public function items() {
        //$this->load->helper('url');
        //$this->load->view('templates/header');
        //$this->load->view('templates/commonJs');
        //$this->load->view('items_list');
        //$this->load->view('templates/footer');
        $data['title'] = 'ERP - Supplies Items';
        $this->dashboard();
        $this->load->view('scm/items', $data);
    }
	
	public function itemsprocessing() {
        $this->scm_model->getItemsDatatable();
    }

	public function getSoldItems() {
        $this->scm_model->getSoldItems();
    }
	
 	public function processnewItem(){
        $data = $_REQUEST;
        
        // this for adding new records
        if( $data['type'] == 'addItems' ){
            $this->scm_model->addItems($data);
        }
        // this for updating records
        else if($data['type'] == 'updateItems'){
            $this->scm_model->updateItems($data);
        }
        
       header("Location: " .base_url()."index.php/scm/items");
       //$this->items();
        exit();
        
    }
	
	function report(){		
		$data = array(
			'items_id' =>$this->uri->segment(3),
		);
		$data['result'] = $this->scm_model->itemReport($data);
		$data['item'] = str_replace('%20', ' ', $this->uri->segment(4));
		$data['title'] = 'Item Report';
		$this->dashboard();
		$this->load->view('scm/report', $data);		
		
	}
	
	function pullReport(){
		$data['title'] = "Reports";
		$this->dashboard();
		$this->load->view('scm/report_various', $data);
	}
	
	function dailySalesreport(){		
		$data = array(
			//'date' =>$this->uri->segment(3),
			'date' =>$this->input->post('date'),
		);
		$data['result'] = $this->scm_model->dailySalesreport($data);
		$data['item'] = str_replace('%20', ' ', $this->uri->segment(4));
		$data['title'] = 'Daily Report';
		$this->dashboard();
		$this->load->view('scm/daily_report', $data);		
		
	}
	
	function notifications(){
		$data['title']= "Stocking Notification";
		$data['result'] = $this->scm_model->stockingLevels();
		$this->dashboard();
		$this->load->view('scm/stockinglevels', $data);
	}
	
	function dailySales(){		
		$data = array(
			//'date' =>$this->uri->segment(3),
			'date' =>$this->input->post('date'),
			'type' => 'Sales',
		);
		$data['result'] = $this->scm_model->dailySalesreport($data);
		$data['item'] = str_replace('%20', ' ', $this->uri->segment(4));
		$data['title'] = 'Daily Report';
		$this->dashboard();
		$this->load->view('scm/daily_report', $data);		
		
	}
	
	function dailyPurchases(){		
		$data = array(
			//'date' =>$this->uri->segment(3),
			'date' =>$this->input->post('date'),
			'type' => 'Purchases',
		);
		$data['result'] = $this->scm_model->dailySalesreport($data);
		$data['item'] = str_replace('%20', ' ', $this->uri->segment(4));
		$data['title'] = 'Daily Report';
		$this->dashboard();
		$this->load->view('scm/daily_report', $data);		
		
	}
	
	public function newModel($models_id = ''){
        $this->models_id = $models_id;
        
        //all brands.
        $this->allBrands = $this->scm_model->getAllBrands();
        
        // fetch record from db when edit records
        $result = $this->scm_model->getModelsId($this->models_id);
        $this->brands_id = isset($result[0]['brands_id']) ? $result[0]['brands_id'] : "";
        $this->models_name = isset($result[0]['models_name']) ? $result[0]['models_name'] : "";
        
        //loading view
        $this->dashboard();
		$this->load->view('scm/models_popupform');
    }
	
	
	function customers(){
		$data['title'] = 'Customers Table';
		$this->dashboard();
		$this->load->view('scm/customerslist', $data);
	}
		
    public function modelProcess(){
        
        $this->load->helper('url');
        
        $data = $_REQUEST;
        
        // this for add new records
        if( $data['type'] == 'addModels' ){
            $this->scm_model->addModels($data);
        }
        // this for update records
        else if($data['type'] == 'updateModels'){
            $this->scm_model->updateModels($data);
        }
		
		$this->models();
        /*
        header("Location: " .base_url()."index.php/models/");
        exit();
        
		 * 
		 */
    }
	
	    // delete record functions
    public function deleteBrands() {

        $data = $_REQUEST;
        $this->scm_model->deleteBrands($data);

        $output['success'] = 1;
        $output['msg'] = "delete successfully records";

        echo json_encode($output);
    }
	
    public function deleteCustomers() {

        $data = $_REQUEST;
        $this->scm_model->deleteCustomers($data);

        $output['success'] = 1;
        $output['msg'] = "delete successfully records";

        echo json_encode($output);
    }
	
	public function add_sales($items_id = ''){
        $this->items_id = $items_id;
        
        //all brands.
        $this->allBrands = $this->scm_model->getAllBrands();
        $this->allModels = $this->scm_model->getAllModels();
        
        // fetch record from db when editing records
        $result = $this->scm_model->getItemsId($this->items_id);
        $this->brands_id = isset($result[0]['brands_id']) ? $result[0]['brands_id'] : "";
        $this->models_id = isset($result[0]['models_id']) ? $result[0]['models_id'] : "";
        $this->items_name = isset($result[0]['items_name']) ? $result[0]['items_name'] : "";
		$this->unit_cost = isset($result[0]['unit_cost']) ? $result[0]['unit_cost'] : "";
		$this->in_stock = isset($result[0]['in_stock']) ? $result[0]['in_stock'] : "";
		$this->purchase_price = isset($result[0]['purchase_price']) ? $result[0]['purchase_price'] : "";
        
        //loading view
		$data['title'] = 'Sales';
      //  $this->load->view('templates/header', $data);
       //$this->load->view('templates/commonJs');
       // $this->load->view('sales_form');
        //$this->load->view('templates/footer');
        $this->load->view('scm/salesform', $data);
    }
	
	public function sales_process(){
		//get the operating stock. 
		$items_id = $this->input->post('items_id');      
        $operating_stock = $this->scm_model->getStockingBalance($items_id);
		$data = array(
			'items_id' => $this->input->post('items_id'),
			'in_stock' => $this->scm_model->getStockingBalance($items_id)-$this->input->post('units'),
		);
		  
		  $this->scm_model->updateStock($data);
		        
		//get the operating balance.
        $operating_balance = $this->scm_model->getOperatingBalance();
        $unit_cost = $this->input->post('unit_cost');
		$units = $this->input->post('units');
		$totaldiscount = $units * $this->input->post('discount');
		$total_cost = ($unit_cost * $units)-$totaldiscount;
		$new_balance = ($operating_balance + $total_cost)- $totaldiscount;
		
		
		$data = array(
			'brands_id' => $this->input->post('brands_id'),
			'models_id' => $this->input->post('models_id'),			
			'items_id' => $this->input->post('items_id'),
			'items_name' => $this->input->post('items_name'),
			'unit_cost' => $this->input->post('unit_cost'),
			'units' => $this->input->post('units'),
			'mode' => $this->input->post('mode'),
			'discount' => $this->input->post('discount'),
			'purchase_price' => $this->input->post('purchase_price'),
			'total_purchase_price' => $this->input->post('purchase_price')*$this->input->post('units'),
			'total_discount' => $totaldiscount,
			'total_cost' => $total_cost,
			'operating_balance' => $new_balance,
			'date' => $this->input->post('date'),
			'type' => 'Sales',
            'userName' => $this->session->userdata('userName'),
			
		);
		
		$this->scm_model->updateTransactions($data);
		
		//getStockingBalance($items_id)
    
        echo "<script>window.close();</script>";
      //  header("Location: " .base_url()."index.php/scm/items");
        exit();
        
    }

	public function return_process(){
			if($this->input->post('type')==='Sales'){
		//get the operating stock. 
		$items_id = $this->input->post('items_id');      
        $operating_stock = $this->scm_model->getStockingBalance($items_id);
		$data = array(
			'items_id' => -$this->input->post('items_id'),
			'in_stock' => $this->scm_model->getStockingBalance($items_id)+$this->input->post('units'),
		);
		  
		  $this->scm_model->updateStock($data);
		        
		//get the operating balance.
        $operating_balance = $this->scm_model->getOperatingBalance();
        $unit_cost = $this->input->post('unit_cost');
		$units = $this->input->post('units');
		$totaldiscount = $units * $this->input->post('discount');
		$total_cost = ($unit_cost * $units)-$totaldiscount;
		$new_balance = ($operating_balance - $total_cost)+ $totaldiscount;
		
		
		$data = array(
			'brands_id' => $this->input->post('brands_id'),
			'models_id' => $this->input->post('models_id'),			
			'items_id' => $this->input->post('items_id'),
			'items_name' => $this->input->post('items_name'),
			'unit_cost' => $this->input->post('unit_cost'),
			'units' => $this->input->post('units'),
			'mode' => $this->input->post('mode'),
			'discount' => -$this->input->post('discount'),
			'purchase_price' => $this->input->post('purchase_price'),
			'total_purchase_price' => $this->input->post('purchase_price')*$this->input->post('units'),
			'total_discount' => -$totaldiscount,
			'total_cost' => -$total_cost,
			'operating_balance' => $new_balance,
			'date' => $this->input->post('date'),
			'return_reason' => $this->input->post('return_reason'),
			'type' => 'Returned Sales',
			'returned_id' => $this->input->post('id'),
            'userName' => $this->session->userdata('userName'),
			
		);
		
		$this->scm_model->updateTransactions($data);
		
		$data = array(
			'id' => $this->input->post('id'),
			'status' =>'Returned',
		);
		
		$this->scm_model->changereturnStatus($data);
		$this->sold();
		
        }
	if($this->input->post('type')==='Purchases'){
		//get the operating stock. 
		$items_id = $this->input->post('items_id');      
        $operating_stock = $this->scm_model->getStockingBalance($items_id);
		$data = array(
			'items_id' => -$this->input->post('items_id'),
			'in_stock' => $this->scm_model->getStockingBalance($items_id)-$this->input->post('units'),
		);
		  
		  $this->scm_model->updateStock($data);
		        
		//get the operating balance.
        $operating_balance = $this->scm_model->getOperatingBalance();
        $unit_cost = $this->input->post('unit_cost');
		$units = $this->input->post('units');
		$totaldiscount = $units * $this->input->post('discount');
		$total_cost = ($unit_cost * $units)-$totaldiscount;
		$new_balance = ($operating_balance + $total_cost)- $totaldiscount;
		
		
		$data = array(
			'brands_id' => $this->input->post('brands_id'),
			'models_id' => $this->input->post('models_id'),			
			'items_id' => $this->input->post('items_id'),
			'items_name' => $this->input->post('items_name'),
			'unit_cost' => $this->input->post('unit_cost'),
			'units' => $this->input->post('units'),
			'mode' => $this->input->post('mode'),
			'discount' => -$this->input->post('discount'),
			'purchase_price' => $this->input->post('purchase_price'),
			'total_purchase_price' => $this->input->post('purchase_price')*$this->input->post('units'),
			'total_discount' => $totaldiscount,
			'total_cost' => $total_cost,
			'operating_balance' => $new_balance,
			'date' => $this->input->post('date'),
			'return_reason' => $this->input->post('return_reason'),
			'type' => 'Returned Purchases',
			'returned_id' => $this->input->post('id'),
            'userName' => $this->session->userdata('userName'),
			
		);
		
		$this->scm_model->updateTransactions($data);
		
		$data = array(
			'id' => $this->input->post('id'),
			'status' =>'Returned',
		);
		
		$this->scm_model->changereturnStatus($data);
		$this->sold();
		
        }
        
    }

	public function stock_process(){        
		//get the operating stock. 
		$items_id = $this->input->post('items_id');      
        $operating_stock = $this->scm_model->getStockingBalance($items_id);
		$units = $this->input->post('units');
		$new_stock = ($operating_stock + $units);
		
		
		$data = array(		
			'items_id' => $this->input->post('items_id'),
			'suppliersname' => $this->input->post('suppliersname'),
			'purchase_price' => $this->input->post('purchase_price'),
			'oem_number' => $this->input->post('oem_number'),
			'in_stock' => $new_stock,
			'date_updated' => $this->input->post('date'),
            'userName' => $this->session->userdata('userName'),
			
		);
		
		$this->scm_model->updateStock($data);
		$data = array(
			'items_id' => $this->input->post('items_id'),
			'suppliers_id' => $this->input->post('suppliersname'),
			'purchase_price' => $this->input->post('purchase_price'),
			'oem_number' => $this->input->post('oem_number'),
			'date_added' => $this->input->post('date'),
            'userName' => $this->session->userdata('userName'),
			
		);
		$this->scm_model->InsertStock($data);	
			
		$items_id =  $this->input->post('items_id');
		$Items_name = $this->scm_model->getItemName($items_id);
		$data = array(
			'brands_id' => $this->input->post('brands_id'),
			'models_id' => $this->input->post('models_id'),
			'items_id' => $this->input->post('items_id'),
			'items_name' => $this->input->post('items_name'),
			'oem_number' => $this->input->post('oem_number'),
			'type' => 'Purchases',
			'unit_cost' => -($this->input->post('purchase_price')),
			'units' => $this->input->post('units'),
			'total_cost' => $this->input->post('units')* -($this->input->post('purchase_price')),
			'date' => $this->input->post('date'),
			'operating_balance' => ($this->input->post('units')* -($this->input->post('purchase_price'))) + $this->scm_model->getOperatingBalance(),
            'userName' => $this->session->userdata('userName'),
			
		);
		$this->scm_model->updateTransactions($data);
		
		
		
		$this->success();
    
      //  echo "<script>window.close();</script>";
      //  header("Location: " .base_url()."index.php/scm/items");
        exit();
        
    }
	
	public function deleteItem() {
        
        $data = $_REQUEST;
        $this->scm_model->deleteItems($data);
        
        $output['success'] = 1;
        $output['msg'] = "Records deleted successfully";
        
        echo json_encode($output);
    }

	function sold(){
		$data['title'] = 'Sold Items';
		$this->dashboard();
		$this->load->view('scm/sold', $data);
	}
	
	function itemReturn(){
		$type = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		$data['result'] =  $this->scm_model->getTransactioID($id);
        
        //all brands.
        $this->allBrands = $this->scm_model->getAllBrands();
        $this->allModels = $this->scm_model->getAllModels();
        
        // fetch record from db when editing records
        $result = $this->scm_model->getTransactioID($id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : "";
        $this->brands_id = isset($result[0]['brands_id']) ? $result[0]['brands_id'] : "";
        $this->models_id = isset($result[0]['models_id']) ? $result[0]['models_id'] : "";
        $this->items_name = isset($result[0]['items_name']) ? $result[0]['items_name'] : "";
		$this->unit_cost = isset($result[0]['unit_cost']) ? $result[0]['unit_cost'] : "";
		$this->units = isset($result[0]['units']) ? $result[0]['units'] : "";
		$this->date = isset($result[0]['date']) ? $result[0]['date'] : "";
		$this->in_stock = isset($result[0]['in_stock']) ? $result[0]['in_stock'] : "";
		$this->discount = isset($result[0]['discount']) ? $result[0]['discount'] : "";
		$this->mode = isset($result[0]['mode']) ? $result[0]['mode'] : "";
		$this->purchase_price = isset($result[0]['purchase_price']) ? $result[0]['purchase_price'] : "";
        
        //loading view
		$data['title'] = 'Returned Items';		
		$data['type'] = $this->uri->segment(3);
		$this->dashboard();
		$this->load->view('scm/returns', $data);
	}

	function deleteTransactions(){
		$type = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		
		$data['result'] =  $this->scm_model->getTransactioID($id);
        
        //all brands.
        $this->allBrands = $this->scm_model->getAllBrands();
        $this->allModels = $this->scm_model->getAllModels();
        
        // fetch record from db when editing records
        $result = $this->scm_model->getTransactioID($id);
        $this->id = isset($result[0]['id']) ? $result[0]['id'] : "";
        $this->brands_id = isset($result[0]['brands_id']) ? $result[0]['brands_id'] : "";
        $this->models_id = isset($result[0]['models_id']) ? $result[0]['models_id'] : "";
        $this->items_name = isset($result[0]['items_name']) ? $result[0]['items_name'] : "";
		$this->unit_cost = isset($result[0]['unit_cost']) ? $result[0]['unit_cost'] : "";
		$this->units = isset($result[0]['units']) ? $result[0]['units'] : "";
		$this->date = isset($result[0]['date']) ? $result[0]['date'] : "";
		$this->in_stock = isset($result[0]['in_stock']) ? $result[0]['in_stock'] : "";
		$this->discount = isset($result[0]['discount']) ? $result[0]['discount'] : "";
		$this->mode = isset($result[0]['mode']) ? $result[0]['mode'] : "";
		$this->purchase_price = isset($result[0]['purchase_price']) ? $result[0]['purchase_price'] : "";
        
        //loading view
		$data['title'] = 'Returned Items';		
		$data['type'] = $this->uri->segment(3);
		$this->dashboard();
		$this->load->view('scm/deleteTransactions', $data);
	}
	
	function deleteTransactionProcess(){
		$data = array(
			'id' => $this->input->post('id'),
			'status' => 'Deleted',
			'return_reason' => $this->input->post('return_reason'),
		);
		
		$this->scm_model->deleteTransactionProcess($data);
		$this->sold();
	}



	function addStock($items_id = ''){
		$this->items_id = $items_id;
        
        //all brands.
        $this->allBrands = $this->scm_model->getAllBrands();
        $this->allModels = $this->scm_model->getAllModels();
		$this->allCustomers = $this->scm_model->getAllCustomers();
        
        // fetch record from db when editing records
        $result = $this->scm_model->getItemsId($this->items_id);
        $this->brands_id = isset($result[0]['brands_id']) ? $result[0]['brands_id'] : "";
        $this->models_id = isset($result[0]['models_id']) ? $result[0]['models_id'] : "";
		$this->unit_cost = isset($result[0]['unit_cost']) ? $result[0]['unit_cost'] : "";
        $this->items_name = isset($result[0]['items_name']) ? $result[0]['items_name'] : "";
        $this->oem_number = isset($result[0]['oem_number']) ? $result[0]['oem_number'] : "";
        
        //loading view
		$data['title'] = 'Add New Stock';
      //  $this->load->view('templates/header', $data);
       //$this->load->view('templates/commonJs');
       // $this->load->view('sales_form');
        //$this->load->view('templates/footer');
        $this->dashboard();
        $this->load->view('scm/stocksform', $data);
	}
	// Function to withdraw amout from the operating balance. 
	function withdraw(){
		$data['title'] = 'Take Amount';
		$this->dashboard();
		$this->load->view('scm/withdraw', $data);
	}
	
	
	function processWithdrawal(){
		//function handling the withdrawl process when the submit button is fired. 
		$operating_balance = $this->scm_model->getOperatingBalance();
        $amount = $this->input->post('amount');
		if($operating_balance >= $amount){			
			$new_balance = ($operating_balance - $amount);
			$data = array(
				'type' => 'Withdrawal',
				'units' => 1,
				'total_cost' => $amount,
				'operating_balance' => $new_balance,
				
			);
		$this->scm_model->updateTransactions($data);
		
		$output['success'] = 1;
        $output['msg'] = "Amount withdrawn successfully";
		header("Location: " .base_url());	
		
		}	
		
	}
    
	
	
	
	


	


}

?>