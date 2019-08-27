<?php
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];
    require_once 'DB_Functions.php';
    $db       = new DB_Functions();
    
    if ($tag == 'check_imei') {
		echo json_encode($db->check_imei($_POST['imei']));
    } 
	else if ($tag == 'update_points') {		
        echo json_encode($db->updatePoints($_POST['imei'], $_POST['points']));
    } 
	else if ($tag == 'redeem_points') {
        echo json_encode($db->redeem_points($_POST['imei'], $_POST['points']));
    } 
	else if ($tag == 'register') {
        echo json_encode($db->register_user($_POST['username'], $_POST['imei'], $_POST['points'], $_POST['phone_type'], 
								$_POST['phone_manufacturer'], $_POST['sdk_version'], $_POST['gsm_loc'], $_POST['gsm_cid'], 
								$_POST['approved_points'], $_POST['stars']));
    } 
	else if ($tag == 'get_ads') {
        echo json_encode($db->get_ads());
    } 
	else if ($tag == 'status') {
        echo json_encode($db->status($_POST['imei'], $_POST['image_id']));
    } 
	else if ($tag == 'transactions') {
        echo json_encode($db->transactions($_POST['imei'], $_POST['image_id'], $_POST['gsm_location'], $_POST['gsm_cell_id'], 
								$_POST['timestamp'], $_POST['view']));
    } 
	else if ($tag == 'offensive_ad') {
        echo json_encode($db->offensive_ad($_POST['imei'], $_POST['ads_id'], $_POST['timestamp']));
    } 
	else if ($tag == 'new_ad') {
        echo json_encode($db->get_new_ad($_POST['imei']));
    } 
	else if ($tag == 'request_status') {
        echo json_encode($db->request_status($_POST['imei']));
    } 
	else {
        echo "Invalid Request";
    }
} 
else {
    echo "Access Denied";
}
?>