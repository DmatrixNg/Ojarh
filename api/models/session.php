<?php
	if(isset($_SESSION['userid']) || !empty($_SESSION['userid']))
	{
		$userid=$_SESSION['userid'];
		$userrole=$_SESSION['role'];
		include_once('Controller.php');
		$db = getDB();
		$userClass = new Users($db);
		if($userrole=='Admin' || $userrole=='Sub Admin'){
			$userDetails = $userClass->userDetails($userid);
			$bizdata = $userClass->bizDetails($userid);
			$acctdetails = $userClass->acctdetails($userid);
			$acctType = $userClass->checkAcctType($userid);
			// $userAcctType = $acctType->account_type;
			// $userAcctenddate = $acctType->end_date;
		}elseif($userrole=='Seller'){
			$userDetails = $userClass->userDetails($userid);
			$bizdata = $userClass->bizDetails($userid);
			$acctdetails = $userClass->acctdetails($userid);
			$acctType = $userClass->checkAcctType($userid);
			$userAcctType = $acctType->account_type;
			$userAcctenddate = $acctType->endDate;
		}elseif ($userrole=='International') {
			$userDetails = $userClass->userDetails($userid);
			$bizdata = $userClass->bizDetails($userid);
			$acctdetails = $userClass->acctdetails($userid);
			$acctType = $userClass->checkAcctType($userid);
			$userAcctType = $acctType->account_type;
			$userAcctenddate = $acctType->endDate;
		}elseif ($userrole=='Buyer') {
			$userDetails = $userClass->userDetails($userid);
			$bizdata = $userClass->bizDetails($userid);
			$acctdetails = $userClass->acctdetails($userid);
			$acctType = $userClass->checkAcctType($userid);
			$userAcctType = $acctType->account_type;
			$userAcctenddate = $acctType->endDate;
		}

	}else{
		session_destroy();
		session_unset();
		header("Location: " . BASE_URL);
	}
?>
