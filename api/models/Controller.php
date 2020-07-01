<?php
// require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// require '../vendor/autoload.php';


class Users{
    //DB Stuff
    private $conn;
    private $table = 'users';

    public $role;
    public $userid;
    public $username;
    public $password;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $state;
    public $address;
    public $confCode;
    public $status;
    public $datereg;

    public $marketid;
    public $marketname;
    public $marketchair;
    public $marketstate;
    public $marketaddress;
    public $marketdescrip;
    public $marketimg;
    public $marketstatus;
    public $created_by;


    public $brandid;
    public $brandtitle;
    public $brandimg;
    public $brandcreated;

    public $file_name;
    public $file_tmp;
    public $file_type;
    public $file_size;

    public $catid;
    public $catname;
    public $catdescription;
    public $created_at;
    public $t_product;

    public $plan;
    public $lastlogin;

    public $title;
    public $body;
    public $generatedlink;
    public $butt;
    /**
     * @var mixed|void
     */
    public $orderid;
    /**
     * @var mixed|void
     */
    public $buyerid;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getUser(){
        return $this->user;
    }

    //create_user
    public function create_user(){
        $this->userid = date('Ymdhms');
        $this->status = 0;
        $this->confCode = 'Starter';


        if($this->isUsernameExit($this->username)) {
            echo 'username';
            return false;
        }

        if($this->isEmailExit()){
            echo 'email';
            return false;
        }

        $query = "INSERT INTO users (userid,agentid,username,email,password,fname,lname,phone,country,state,address,currency,status,role,confirmationCode) VALUES (:userid,:agentid,:username,:email,:password,:fname,:lname,:phone,:country,:state,:address,:currency,:status,:role,:confirmationCode)";

        $stmt = $this->conn->prepare($query);

        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->agentid = htmlspecialchars(strip_tags($this->agentid));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags(password_hash($this->password, PASSWORD_BCRYPT, array("cost" => 12))));
        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->confirmationCode = htmlspecialchars(strip_tags($this->confirmationCode));
        if($this->role == 'Admin' || $this->role == 'Sub Admin'){
            $this->status = 1;
        }

        if($this->role == 'Seller'){
            $this->currency = '#';
        }elseif($this->role == 'International'){
            $this->currency = '$';
        }

        if($this->role == 'Buyer' && $this->country == 'Nigeria'){
            $this->currency = '#';
        }else{
            $this->currency = '$';
        }

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('agentid', $this->agentid);
        $stmt->bindValue('username', $this->username);
        $stmt->bindValue('email', $this->email);
        $stmt->bindValue('password', $this->password);
        $stmt->bindValue('fname', $this->fname);
        $stmt->bindValue('lname', $this->lname);
        $stmt->bindValue('phone', $this->phone);
        $stmt->bindValue('state', $this->state);
        $stmt->bindValue('address', $this->address);
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('country', $this->country);
        $stmt->bindValue('role', $this->role);
        $stmt->bindValue('confirmationCode', $this->confirmationCode);
        $stmt->bindValue('currency', $this->currency);

        if($stmt->execute()){
            $this->emailConfirmation($this->email, $this->userid);
            $this->userid = $this->userid;
            $this->title = "New ".$this->role." Registration";
            $this->body = "This Seller Just Registered". ' - ' .$this->username;
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();

            if($this->role == 'Seller' || $this->role == 'International'){
                $this->userAcctType($this->userid, 'Starter');
                return true;
            }else if($this->role == 'Buyer'){
                $this->userAcctType($this->userid, 'Buyer');
                return true;
            }
            return true;
        }else{
            echo 'Could not create account, try again later!';
            return false;
        }
    }

    public function emailConfirmation($email, $userid){
      $mail = new PHPMailer(true);

try {
  //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp1.example.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     // SMTP username
    $mail->Password   = 'secret';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    $to = $email;
    $auth_id = $userid;
    $userD = $this->userDetails($userid);
    $name = $userD->fname.' '.$userD->lname;
    //Recipients
        $mail->setFrom('noreply@ojarh.com', 'Mailer');
        $mail->addAddress($to, $name);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');


         $subject = "Email Confirmation";

         $message = "<b>You have to confirm your email before you login into your dashboard:</b><br/>";
         $message .= "<hr>";
         $message .= "<h5>To confirm your email, click or copy the link below to activate your account:</h5>";
         $message .= "<p>Email Confirmation Link: ".BASE_URL."emailconfirmation.php?auth_id=".$auth_id."&conf_id=".$userD->confirmationCode."</p>";
         $message .= "<hr>";

         // $header = "From:noreply@ojarh.com \r\n";
         // $header .= "MIME-Version: 1.0\r\n";
         // $header .= "Content-type: text/html\r\n";

         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = $subject;
         $mail->Body    = $message;

         // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

         $mail->send();

         echo 'Message has been sent';

         } catch (Exception $e) {
             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         }
         // @mail ($to,$subject,$message,$header);

        //  if( $retval == true ) {
        //     echo "Message sent successfully...";
        //     return;
        //  }else {
        //     echo "Message could not be sent...";
        //     return;
        //  }
    }
    public function sendMail($to,$subject,$message){


         $header = "From: noreply@localhost:3000 \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $sent = mail ($to,$subject,$message,$header);

         if( $sent == true ) {
            echo "Message sent successfully...";
            return;
         }else {
            echo "Message could not be sent...";
            return;
         }
    }

    public function confirm_email(){
        $query = "UPDATE users SET status=:status, confirmationCode=:confirmationCode WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->confirmationCode = htmlspecialchars(strip_tags($this->conf_id));
        $this->userid = htmlspecialchars(strip_tags($this->auth_id));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('confirmationCode', $this->confirmationCode);
        $stmt->bindValue('userid', $this->userid);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function userAcctType($userid, $account_type){

            $query = "INSERT INTO account_info (userid,account_type) VALUES (:userid,:account_type)";

            $stmt = $this->conn->prepare($query);

            $stmt->bindValue('userid', $userid);
            $stmt->bindValue('account_type', $account_type);

            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    }



    public function upgrade_plan(){

        if($this->checkCurrentAcctType()){
            echo 'already';
            return false;
        }

        if($this->durate == 1){
            $this->startDate =  date('Y-m-d');
            $this->endDate = date('Y-m-d', strtotime($this->startDate. ' +30 days')); // Y-m-d
        }elseif($this->durate == 6){
            $this->startDate =  date('Y-m-d');
            $this->endDate = date('Y-m-d', strtotime($this->startDate. ' +180 days')); // Y-m-d
        }elseif($this->durate == 12){
            $this->startDate =  date('Y-m-d');
            $this->endDate = date('Y-m-d', strtotime($this->startDate. ' +365 days')); // Y-m-d
        }

        $query = "UPDATE account_info SET account_type=:account_type, durate=:durate, startDate=:startDate, endDate=:endDate WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->plan = htmlspecialchars(strip_tags($this->plan));
        $this->durate = htmlspecialchars(strip_tags($this->durate));
        $this->startDate = htmlspecialchars(strip_tags($this->startDate));
        $this->endDate = htmlspecialchars(strip_tags($this->endDate));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('account_type', $this->plan);
        $stmt->bindValue('durate', $this->durate);
        $stmt->bindValue('startDate', $this->startDate);
        $stmt->bindValue('endDate', $this->endDate);
        $stmt->bindValue('userid', $this->userid);

        if($stmt->execute()){
            $userid = $this->userid;

            $this->userid = $this->userid;
            $this->title = 'Seller Account Upgraded' ;
            $this->body = 'A Seller just upgraded his/her account to: '. $this->plan;
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();
            // $this->updateAcct($this->durate);
            $this->paymentHistory($this->durate, 'Account Upgrade', 'Admin');
            $this->logout();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function checkCurrentAcctType(){
        $query = "SELECT * FROM account_info WHERE userid=:userid AND account_type=:confCode";
        $stmt = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->plan = htmlspecialchars(strip_tags($this->plan));
        $stmt->bindValue(':confCode', $this->plan);
        $stmt->bindValue(':userid', $this->userid);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    public function paymentHistory($durate, $task, $to){

        $this->durate = $durate;
        $this->transid = mt_rand(100000, 999999);

        $query = "INSERT INTO payment_history (transid,userid,task,paymentto,startDate,endDate)
            VALUES (:transid,:userid,:task,:paymentto,:startDate,:endDate)";

        $stmt = $this->conn->prepare($query);
        $this->transid = htmlspecialchars(strip_tags($this->transid));
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->task = htmlspecialchars(strip_tags($task));
        $this->paymentto = htmlspecialchars(strip_tags($to));
        $this->startDate = htmlspecialchars(strip_tags($this->startDate));
        $this->endDate = htmlspecialchars(strip_tags($this->endDate));

        $stmt->bindValue('transid', $this->transid);
        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('task', $task);
        $stmt->bindValue('paymentto', $to);
        $stmt->bindValue('startDate', $this->startDate);
        $stmt->bindValue('endDate', $this->endDate);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function updatePersonalInfo(){

        $query = "UPDATE users SET fname=:fname, lname=:lname, phone=:phone, address=:address, state=:state, country=:country WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('fname', $this->fname);
        $stmt->bindValue('lname', $this->lname);
        $stmt->bindValue('phone', $this->phone);
        $stmt->bindValue('address', $this->address);
        $stmt->bindValue('state', $this->state);
        $stmt->bindValue('country', $this->country);
        $stmt->bindValue('userid', $this->userid);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function createBusinessInfo(){

        if($this->checkBizInfo($this->userid)){
            echo 'update';
            $this->UpdateBusinessInfo();
            return false;
        }

        $this->cardsettings = 1;

        $query = "INSERT INTO business (userid,bizname,bizphone,bizemail,bizstate,bizmarket,bizaddress,service,bizwebsite,bizregdate,cardsettings,status) VALUES (:userid,:bizname,:bizphone,:bizemail,:bizstate,:bizmarket,:bizaddress,:service,:bizwebsite,:bizregdate,:cardsettings,:status)";

        $stmt = $this->conn->prepare($query);

        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->bizname = htmlspecialchars(strip_tags($this->bizname));
        $this->bizphone = htmlspecialchars(strip_tags($this->bizphone));
        $this->bizemail = htmlspecialchars(strip_tags($this->bizemail));
        $this->bizstate = json_encode($this->bizstate);
        $this->bizmarket = json_encode($this->bizmarket);
        $this->bizaddress = htmlspecialchars(strip_tags($this->bizaddress));
        $this->service = htmlspecialchars(strip_tags($this->service));
        $this->bizwebsite = htmlspecialchars(strip_tags($this->bizwebsite));
        $this->bizregdate = htmlspecialchars(strip_tags($this->bizregdate));
        $this->cardsettings = htmlspecialchars(strip_tags($this->cardsettings));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('bizname', $this->bizname);
        $stmt->bindValue('bizphone', $this->bizphone);
        $stmt->bindValue('bizemail', $this->bizemail);
        $stmt->bindValue('bizstate', $this->bizstate);
        $stmt->bindValue('bizmarket', $this->bizmarket);
        $stmt->bindValue('bizaddress', $this->bizaddress);
        $stmt->bindValue('service', $this->service);
        $stmt->bindValue('bizwebsite', $this->bizwebsite);
        $stmt->bindValue('bizregdate', $this->bizregdate);
        $stmt->bindValue('cardsettings', $this->cardsettings);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = "New Business Information Created";
            $this->body = "A new business information has been created!";
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function UpdateBusinessInfo(){


        $this->cardsettings = 1;

        $query = "UPDATE business SET
          bizname=:bizname,
          bizphone=:bizphone,
          bizemail=:bizemail,
          bizstate=:bizstate,
          bizmarket=:bizmarket,
          bizaddress=:bizaddress,
          service=:service,
          bizwebsite=:bizwebsite,
          bizregdate=:bizregdate,
          cardsettings=:cardsettings,
          status=:status
        WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->bizname = htmlspecialchars(strip_tags($this->bizname));
        $this->bizphone = htmlspecialchars(strip_tags($this->bizphone));
        $this->bizemail = htmlspecialchars(strip_tags($this->bizemail));
        $this->bizstate = json_encode($this->bizstate);
        $this->bizmarket = json_encode($this->bizmarket);
        $this->bizaddress = htmlspecialchars(strip_tags($this->bizaddress));
        $this->service = htmlspecialchars(strip_tags($this->service));
        $this->bizwebsite = htmlspecialchars(strip_tags($this->bizwebsite));
        $this->bizregdate = htmlspecialchars(strip_tags($this->bizregdate));
        $this->cardsettings = htmlspecialchars(strip_tags($this->cardsettings));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('bizname', $this->bizname);
        $stmt->bindValue('bizphone', $this->bizphone);
        $stmt->bindValue('bizemail', $this->bizemail);
        $stmt->bindValue('bizstate', $this->bizstate);
        $stmt->bindValue('bizmarket', $this->bizmarket);
        $stmt->bindValue('bizaddress', $this->bizaddress);
        $stmt->bindValue('service', $this->service);
        $stmt->bindValue('bizwebsite', $this->bizwebsite);
        $stmt->bindValue('bizregdate', $this->bizregdate);
        $stmt->bindValue('cardsettings', $this->cardsettings);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = "New Business Information Updated";
            $this->body = "A new business information has been created!";
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function createBusinessForeign(){

        if($this->checkBizInfo($this->userid)){
            echo 'exist';
            return false;
        }

        $this->cardsettings = 1;

        $query = "INSERT INTO business (userid,bizname,bizphone,bizemail,bizmarket,bizstate,bizaddress,bizwebsite,bizregdate,cardsettings,status) VALUES (:userid,:bizname,:bizphone,:bizemail,:bizmarket,:bizstate,:bizaddress,:bizwebsite,:bizregdate,:cardsettings,:status)";

        $stmt = $this->conn->prepare($query);

        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->bizname = htmlspecialchars(strip_tags($this->bizname));
        $this->bizphone = htmlspecialchars(strip_tags($this->bizphone));
        $this->bizemail = htmlspecialchars(strip_tags($this->bizemail));
        $this->bizcountry = htmlspecialchars(strip_tags($this->bizcountry));
        $this->bizstate = htmlspecialchars(strip_tags($this->bizstate));
        $this->bizaddress = htmlspecialchars(strip_tags($this->bizaddress));
        $this->bizwebsite = htmlspecialchars(strip_tags($this->bizwebsite));
        $this->bizregdate = htmlspecialchars(strip_tags($this->bizregdate));
        $this->cardsettings = htmlspecialchars(strip_tags($this->cardsettings));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('bizname', $this->bizname);
        $stmt->bindValue('bizphone', $this->bizphone);
        $stmt->bindValue('bizemail', $this->bizemail);
        $stmt->bindValue('bizmarket', $this->bizcountry);
        $stmt->bindValue('bizstate', $this->bizstate);
        $stmt->bindValue('bizaddress', $this->bizaddress);
        $stmt->bindValue('bizwebsite', $this->bizwebsite);
        $stmt->bindValue('bizregdate', $this->bizregdate);
        $stmt->bindValue('cardsettings', $this->cardsettings);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = "New International Business Information Created";
            $this->body = "A new business information has been created!";
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    /* business Details check */
    public function checkBizInfo($userid){
        $stmtbiz = $this->conn->prepare("SELECT * FROM business WHERE userid=:userid AND status=:status");
        $stmtbiz->bindValue("userid", $this->userid);
        $stmtbiz->bindValue("status", $this->status);
        $stmtbiz->execute();
        if($stmtbiz->rowCount() > 0){
            return true;
        }
    }

    /* business Details */
    public function bizDetails($userid){
        // $this->status = 'Updated';
        $stmtbiz = $this->conn->prepare("SELECT * FROM business WHERE userid=:userid AND (status=:status OR status=:status2)");
        $stmtbiz->bindValue("userid", $userid);
        $stmtbiz->bindValue("status", 'Updated');
        $stmtbiz->bindValue("status2", 'Updateable');
        $stmtbiz->execute();
        if($stmtbiz->rowCount() > 0){
            $data = $stmtbiz->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }else{
            return 'empty';
        }
    }

    public function updatereturnpolicy(){

        $query = "UPDATE business SET returnpolicy=:return_policy WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->return_policy = htmlentities($this->return_policy);
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('return_policy', $this->return_policy);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function updatedisclaimer(){

        $query = "UPDATE business SET disclaimer=:sellerdisclaimer WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->sellerdisclaimer = htmlentities($this->sellerdisclaimer);
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('sellerdisclaimer', $this->sellerdisclaimer);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function updatetimedelivery(){

        $query = "UPDATE business SET timedelivery=:time_delivery WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->time_delivery = htmlentities($this->time_delivery);
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('time_delivery', $this->time_delivery);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function updateprivacy(){

        $query = "UPDATE business SET privacy=:privacy WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->privacy = htmlentities($this->privacy);
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('privacy', $this->privacy);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function requestBAccess(){

        if ($this->get_business_access_check($this->userid) == 1) {
          return false;
        }
        $query = "INSERT INTO business_access (userid,business_id) VALUES (:userid,:business_id)";

        $stmt = $this->conn->prepare($query);

        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->business_id = htmlspecialchars(strip_tags($this->business_id));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('business_id', $this->business_id);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function update_business_access($userid,$access){

        $query = "UPDATE business_access SET access=:access WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->access = htmlentities($access);
        $this->userid = htmlspecialchars(strip_tags($userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('access', $this->access);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function updatevideolink(){

        $query = "UPDATE business SET videolink=:videolink WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->videolink = htmlentities($this->videolink);
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('videolink', $this->videolink);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function addstoreimage(){

        $query = "UPDATE business SET storeimage=:storeimage WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $images = $this->storeimage;
        // print_r($images );

        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('storeimage', $this->storeimage);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //check if give username exist in the database
    public function userLogin($username, $password){

        if($this->isUsernameExit($username)){
            $pdo = getDB();
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? limit 1');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if (password_verify($password, $user['password'])) {
                if ($user['status'] == 1) {
                    $this->user = $user;
                    session_regenerate_id();
                    $_SESSION['userid'] = $user['userid'];
                    $_SESSION['role'] = $user['role'];

                    $this->updateLastLogin();

                    $this->userid = $user['userid'];
                    $this->title = $user['username']. ' ' . 'just logged in!';
                    $this->body = "A User Logged in at ". ' - ' .date('Y-m-d H:i:s');
                    $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
                    $this->notifications();

                    echo $user['role'];
                    return true;
                } else {
                    echo 'Inactive';
                    return false;
                }
            } else {
            echo 'Invalid';
                return false;
            }
        }else{
            echo 'Invalid';
            return false;
        }

    }

    public function updateLastLogin(){

        $this->lastlogin = date('Y-m-d H:i:s');

        $sqli = "UPDATE users SET lastlogin=:lastlogin WHERE userid=:userid";
        $stmti = $this->conn->prepare($sqli);
        $stmti->bindParam(':lastlogin', $this->lastlogin);
        $stmti->bindParam(':userid', $_SESSION['userid']);
        if($stmti->execute()){
            return true;
        }
    }

    public function create_market(){

            $query = "INSERT INTO market (marketid,marketname,marketstate,marketaddress,marketchairman,marketimg,marketstatus,created_by)
                VALUES (:marketid,:marketname,:marketstate,:marketaddress,:marketchairman,:marketimg,:marketstatus,:created_by)";

            $stmt = $this->conn->prepare($query);

            $this->marketid = htmlspecialchars(strip_tags($this->marketid));
            $this->marketname = htmlspecialchars(strip_tags($this->marketname));
            $this->marketstate = htmlspecialchars(strip_tags($this->marketstate));
            $this->marketaddress = htmlspecialchars(strip_tags($this->marketaddress));
            $this->marketchairman = htmlspecialchars(strip_tags($this->marketchairman));
            $this->marketimg = htmlspecialchars(strip_tags($this->marketimg));
            $this->marketstatus = htmlspecialchars(strip_tags($this->marketstatus));
            $this->created_by = htmlspecialchars(strip_tags($this->created_by));

            $stmt->bindValue('marketid', $this->marketid);
            $stmt->bindValue('marketname', $this->marketname);
            $stmt->bindValue('marketstate', $this->marketstate);
            $stmt->bindValue('marketaddress', $this->marketaddress);
            $stmt->bindValue('marketchairman', $this->marketchairman);
            $stmt->bindValue('marketimg', $this->marketimg);
            $stmt->bindValue('marketstatus', $this->marketstatus);
            $stmt->bindValue('created_by', $this->created_by);

            if($stmt->execute()){
                $this->marketcategory($this->marketid, $this->marketstate);
                $this->userid = 'all';
                $this->title = 'New Market Created!';
                $this->body = 'A new market has been created by the Admin. Explore!';
                $this->generatedlink = "market_setting.php?marketid=".$this->marketid;
                $this->notifications();
                return true;

            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    }

    public function marketcategory($marketid, $marketstate){
        $array = $this->marketcategories;
        foreach($array as $item) {
            $this->splititem = explode("-", $item);
            $this->item1 = $this->splititem[0];
            $this->item2 = $this->splititem[1];
            $stmt = $this->conn->prepare("INSERT INTO marketproductid(marketid,categoryid,marketstate,categoryname) VALUES(:marketid,:categoryid,:marketstate,:categoryname)");
            $stmt->bindValue(':marketid', $this->marketid);
            $stmt->bindValue(':categoryid', $this->item2);
            $stmt->bindValue(':marketstate', $this->marketstate);
            $stmt->bindValue(':categoryname', $this->item1);
            $stmt->execute();
        }
    }

    //Get Markets
    public function market_list(){
        $sql = 'SELECT * FROM market ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<li class="list-group-item">
                <div class="todo-indicator bg-info"></div>
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-3">
                            <div class="widget-content-left">
                                <img width="42" class="rounded" src="'.BASE_URL.'seller/marketImage/'.$row['marketname'].'/'.$row['marketimg'].'" alt="">
                            </div>
                        </div>
                        <div class="widget-content-left">
                            <div class="widget-heading">'.$row['marketname'].' ['.$row['marketstate'].']</div>
                            <div class="widget-subheading">'.$row['marketaddress'].'</div>
                        </div>
                        <div class="widget-content-right widget-content-actions">
                            <button class="btn btn-sm btn-info edit_market" id="'.$row['marketid'].'" title="Edit Category">Edit</button>
                            <button class="btn btn-sm btn-danger delete_market" id="'.$row['marketid'].'" title="Delete Category">Delete</button>
                        </div>
                    </div>
                </div>
            </li>';
        }
    }

    //Get Markets into dropdown list
    public function market_dropdown_list($id =''){
        $sql = 'SELECT * FROM market ORDER BY id DESC';
        foreach ($this->conn->query($sql) as $row) {
          if ($id == $row['marketid']) {
            echo '<option value="'.$row['marketid'].'" selected>'.$row['marketname'].'</option>';
          }else {
            echo '<option value="'.$row['marketid'].'">'.$row['marketname'].'</option>';

          }
        }
    }
    //Get All Sellers into dropdown list
    public function seller_dropdown_list($id =''){
        $sql = 'SELECT * FROM users WHERE role="Seller" ORDER BY sn DESC';
        foreach ($this->conn->query($sql) as $row) {
          if($id == $row['userid']){
            echo '<option value="'.$row['userid'].'" selected>'.$row['fname'].' '.$row['lname'].'-'.$row['userid'].'</option>';

          }else {

            echo '<option value="'.$row['userid'].'">'.$row['fname'].' '.$row['lname'].'-'.$row['userid'].'</option>';
          }

        }
    }
    public function catalogue_dropdown_list($id =''){
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->userid.' ORDER BY id DESC';
        $rows = $this->conn->query($sql);
        if (!empty($rows)) {

        foreach ($rows as $row) {

          if ($id == $row['catid']) {
            echo '<option value="'.$row['catid'].'" selected>'.$row['catname_u'].'</option>';
          }else {
            echo '<option value="'.$row['catid'].'">'.$row['catname_u'].'</option>';

          }
          }
        }else {
         return false;
        }
    }
    public function products_cat_dropdown_list($id =''){
        $sql = 'SELECT DISTINCT product_category FROM product_details';
        $rows = $this->conn->query($sql);
        if (!empty($rows)) {

        foreach ($rows as $row) {

          if ($id == $row['product_category']) {
            echo '<option value="'.$row['product_category'].'" selected>'.$row['product_category'].'</option>';
          }else {
            echo '<option value="'.$row['product_category'].'">'.$row['product_category'].'</option>';

          }
          }
        }else {
         return false;
        }
    }

    public function updateprofilepic(){
        if($this->isProPicExist()){
            $sqli = "UPDATE profilepic SET file_name=:file_name WHERE userid=:userid";
            $stmt = $this->conn->prepare($sqli);
            $this->userid = htmlspecialchars(strip_tags($this->userid));
            $this->file_name = htmlspecialchars(strip_tags($this->file_name));
            $stmt->bindValue('userid', $this->userid);
            $stmt->bindValue('file_name', $this->file_name);

            if($stmt->execute()){
                $this->userid = $this->userid;
                $this->title = 'New Profile Picture Update';
                $this->body = 'A user just update his/her profile picture!';
                $this->generatedlink = "user_details?userid=".$this->userid;
                $this->notifications();
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        $query = "INSERT INTO profilepic (userid,file_name,status) VALUES (:userid,:file_name,:status)";
        $stmt = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->file_name = htmlspecialchars(strip_tags($this->file_name));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('file_name', $this->file_name);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'New Profile Picture Update';
            $this->body = 'A user just update his/her profile picture!';
            $this->generatedlink = "user_details?userid=".$this->userid;
            $this->notifications();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function getBrands(){
        $query = "SELECT * FROM brand";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create_brand(){

        $query = "INSERT INTO brand (title,img) VALUES (:title,:img)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':title', htmlspecialchars(strip_tags($this->brandtitle)));
        $stmt->bindValue(':img', htmlspecialchars(strip_tags($this->brandimg)));

        if($stmt->execute()){
            return true;

        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


    public function delete_brand(){
        $query = "DELETE FROM brand WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":id" => $this->brandid))){
            return true;
        }

    }

    //Check if username exit;
    public function isBrandExist(){
        $query = "SELECT * FROM brand WHERE title=:title";
        $stmt = $this->conn->prepare($query);
        $this->brandtitle = htmlspecialchars(strip_tags($this->brandtitle));
        $stmt->bindValue(':title', $this->brandtitle);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            // if(is_dir( "../../seller/marketImage/".$this->marketname )){
            //     return true;
            // }
            return true;
        }
    }

    public function readProfilePix($userid){
        $query = "SELECT * FROM profilepic WHERE userid = :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('userid', $userid);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // print_r(empty($count));
        $user = $this->userDetails($userid);

        if (!empty($row)) {

            if($user->role == 'Buyer'){
                echo '<img src="'.BASE_URL.'buyer/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
                return;
            }elseif($user->role == 'Seller'){
                echo '<img src="'.BASE_URL.'seller/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
                return;
            }elseif($user->role == 'International'){
                echo '<img src="'.BASE_URL.'international/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
                return;
            }else {
              echo '<img src="'.BASE_URL.'images/avatars/avatar.jpg" width="150" alt="Avatar 6">';
              return;
            }
        }else {
            echo '<img src="'.BASE_URL.'images/avatars/avatar.jpg" width="150" alt="Avatar 6">';
            return;
        }
    }

    public function readProfilePix2($userid){
        $query = "SELECT * FROM profilepic WHERE userid = :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('userid', $userid);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $this->userDetails($userid);

        if (!empty($row)) {

          if($user->role == 'Seller'){
                echo '<img src="'.BASE_URL.'seller/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
                return;
            }elseif($user->role == 'Buyer'){
                echo '<img src="'.BASE_URL.'buyer/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
                return;
            }elseif($user->role == 'International'){
                echo '<img src="'.BASE_URL.'seller/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
                return;
            }else {
              echo '<img src="'.BASE_URL.'images/avatars/avatar.jpg" width="50" height="50" alt="Avatar 6">';
              return;
            }
          }else{
                echo '<img src="'.BASE_URL.'images/avatars/avatar.jpg" width="50" height="50" alt="Avatar 6">';
                return;
            }
    }

    public function readProfilePix3($userid){
        $query = "SELECT * FROM profilepic WHERE userid = :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('userid', $userid);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // print_r(empty($count));
        $user = $this->userDetails($userid);

        if (!empty($row)) {

          if($user->role == 'Seller'){
              echo '<img src="'.BASE_URL.'seller/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
              return;
          }elseif($user->role == 'Buyer'){
              echo '<img src="'.BASE_URL.'buyer/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
              return;
          }elseif($user->role == 'International'){
              echo '<img src="'.BASE_URL.'seller/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
              return;
          }else {
            echo '<img src="'.BASE_URL.'images/avatars/avatar.jpg" width="150" alt="Avatar 6">';
            return;
          }
        }else {
          echo '<img src="'.BASE_URL.'images/avatars/avatar.jpg" width="150" alt="Avatar 6">';
          return;
        }
        //     echo '<img src="images/avatars/avatar.jpg" width="50" height="50" alt="Avatar 6">';
        //     return;
        // }else{
        //     echo '<img src="'.BASE_URL.'seller/profilepicture/'.$userid.'/'.$row['file_name'].'"width="100" height="100" class="rounded-circle" alt="Profile Picture">';
        //     return;
        // }
    }

    public function isProPicExist(){
        $query = "SELECT * FROM profilepic WHERE userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $stmt->bindValue(':userid', $this->userid);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    public function add_category(){

        if($this->isCatExist()){
            echo 'exist';
            return false;
        }

        $query = "INSERT INTO category (catid,catname,catdescription,catImage)
            VALUES (:catid,:catname,:catdescription,:catImage)";

        $stmt = $this->conn->prepare($query);

        $this->catid = htmlspecialchars(strip_tags($this->catid));
        $this->catname = htmlspecialchars(strip_tags($this->catname));
        $this->catdescription = htmlspecialchars(strip_tags($this->catdescription));
        $this->file_name = htmlspecialchars(strip_tags($this->file_name));

        $stmt->bindValue('catid', $this->catid);
        $stmt->bindValue('catname', $this->catname);
        $stmt->bindValue('catdescription', $this->catdescription);
        $stmt->bindValue(':catImage', $this->file_name);

        if($stmt->execute()){
            $this->userid = 'all';
            $this->title = 'New Category Created!';
            $this->body = 'A new category has been created by the Admin. Explore!';
            $this->generatedlink = "product_category.php?catid=".$this->catid;
            $this->notifications();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function add_product(){

            $query = "INSERT INTO product_details (productid,userid,product_title,market,countryorigin,expiration,performance,size,color,product_category,product_catalogue,product_type,product_description,pack0,pack1,pack2,pack3,pack4,pack5,pack6,pack7,pack8,img0,img1,img2,img3,img4,img5,img6,status,productavailability,topCatSetting )
                VALUES (:productid,:userid,:product_title,:market,:countryorigin,:expiration,:performance,:size,:color,:product_category,:product_catalogue,:product_type,:product_description,:pack0,:pack1,:pack2,:pack3,:pack4,:pack5,:pack6,:pack7,:pack8,:img0,:img1,:img2,:img3,:img4,:img5,:img6,:status,:productavailability,:topCatSetting )";

            $stmt = $this->conn->prepare($query);

            $this->productid = htmlspecialchars(strip_tags($this->productid));
            $this->userid = htmlspecialchars(strip_tags($this->userid));
            $this->product_title = htmlspecialchars(strip_tags($this->product_title));
            $this->market = htmlspecialchars(strip_tags($this->market));
            $this->countryorigin = json_encode($this->countryorigin);
            $this->expiration = htmlspecialchars(strip_tags($this->expiration));
            $this->performance = htmlspecialchars(strip_tags($this->performance));
            $this->size = htmlentities($this->size);
            $this->color = htmlentities($this->color);
            $this->product_category = htmlspecialchars(strip_tags($this->product_category));
            $this->product_catalogue = htmlspecialchars(strip_tags($this->product_catalogue));
            $this->product_type = htmlspecialchars(strip_tags($this->product_type));
            $this->product_description = htmlentities($this->product_description);
            $this->pack0 = htmlentities($this->pack0);
            $this->pack1 = htmlentities($this->pack1);
            $this->pack2 = htmlentities($this->pack2);
            $this->pack3 = htmlentities($this->pack3);
            $this->pack4 = htmlentities($this->pack4);
            $this->pack5 = htmlentities($this->pack5);
            $this->pack6 = htmlentities($this->pack6);
            $this->pack7 = htmlentities($this->pack7);
            $this->pack8 = htmlentities($this->pack8);
            $this->img0 = htmlspecialchars(strip_tags($this->file_name0));
            $this->img1 = htmlspecialchars(strip_tags($this->file_name1));
            $this->img2 = htmlspecialchars(strip_tags($this->file_name2));
            $this->img3 = htmlspecialchars(strip_tags($this->file_name3));
            $this->img4 = htmlspecialchars(strip_tags($this->file_name4));
            $this->img5 = htmlspecialchars(strip_tags($this->file_name5));
            $this->img6 = htmlspecialchars(strip_tags($this->file_name6));
            $this->status = htmlspecialchars(strip_tags($this->productstatus));
            $this->productavailability = htmlspecialchars(strip_tags($this->productavailability));
            $this->topCatSetting = 0;

            $stmt->bindValue('productid', $this->productid);
            $stmt->bindValue('userid', $this->userid);
            $stmt->bindValue('product_title', $this->product_title);
            $stmt->bindValue('market', $this->market);
            $stmt->bindValue('countryorigin', $this->countryorigin);
            $stmt->bindValue('expiration', $this->expiration);
            $stmt->bindValue('performance', $this->performance);
            $stmt->bindValue('size', $this->size);
            $stmt->bindValue('color', $this->color);
            $stmt->bindValue('product_category', $this->product_category);
            $stmt->bindValue('product_catalogue', $this->product_catalogue);
            $stmt->bindValue('product_type', $this->product_type);
            $stmt->bindValue('product_description', $this->product_description);
            $stmt->bindValue('pack0', $this->pack0);
            $stmt->bindValue('pack1', $this->pack1);
            $stmt->bindValue('pack2', $this->pack2);
            $stmt->bindValue('pack3', $this->pack3);
            $stmt->bindValue('pack4', $this->pack4);
            $stmt->bindValue('pack5', $this->pack5);
            $stmt->bindValue('pack6', $this->pack6);
            $stmt->bindValue('pack7', $this->pack7);
            $stmt->bindValue('pack8', $this->pack8);
            $stmt->bindValue('img0', $this->img0);
            $stmt->bindValue('img1', $this->img1);
            $stmt->bindValue('img2', $this->img2);
            $stmt->bindValue('img3', $this->img3);
            $stmt->bindValue('img4', $this->img4);
            $stmt->bindValue('img5', $this->img5);
            $stmt->bindValue('img6', $this->img6);
            $stmt->bindValue('status', $this->status);
            $stmt->bindValue('productavailability', $this->productavailability);
            $stmt->bindValue('topCatSetting', $this->topCatSetting);

            if($stmt->execute()){
                $this->userid = $this->userid;
                $this->title = 'New Product Created!';
                $this->body = 'A new product has been created by the !'.$this->userid;
                $this->generatedlink = BASE_URL."product_details.php?productid=".$this->productid;
                $this->notifications();

                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    }
    public function remove_product_image(){

            $query = "UPDATE product_details SET img0=:img0,img1=:img1,img2=:img2,img3=:img3,img4=:img4,img5=:img5,img6=:img6
            WHERE productid=:productid";
            $stmt = $this->conn->prepare($query);

            $this->productid = htmlspecialchars(strip_tags($this->productid));

            $this->img0 = htmlspecialchars(strip_tags($this->img0 ?? null));
            $this->img1 = htmlspecialchars(strip_tags($this->img1 ?? null));
            $this->img2 = htmlspecialchars(strip_tags($this->img2 ?? null));
            $this->img3 = htmlspecialchars(strip_tags($this->img3 ?? null));
            $this->img4 = htmlspecialchars(strip_tags($this->img4 ?? null));
            $this->img5 = htmlspecialchars(strip_tags($this->img5 ?? null));
            $this->img6 = htmlspecialchars(strip_tags($this->img6 ?? null));


            $stmt->bindValue('productid', $this->productid);
            $stmt->bindValue('img0', $this->img0);
            $stmt->bindValue('img1', $this->img1);
            $stmt->bindValue('img2', $this->img2);
            $stmt->bindValue('img3', $this->img3);
            $stmt->bindValue('img4', $this->img4);
            $stmt->bindValue('img5', $this->img5);
            $stmt->bindValue('img6', $this->img6);

            if($stmt->execute()){

                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    }
    public function admin_add_product(){

            $query = "INSERT INTO product_details (productid,userid,product_title,market,countryorigin,expiration,performance,size,color,product_category,product_catalogue,product_description,pack0,pack1,pack2,pack3,pack4,pack5,pack6,pack7,pack8,img0,img1,img2,img3,img4,img5,img6,status,productavailability,topCatSetting )
                VALUES (:productid,:userid,:product_title,:market,:countryorigin,:expiration,:performance,:size,:color,:product_category,:product_catalogue,:product_description,:pack0,:pack1,:pack2,:pack3,:pack4,:pack5,:pack6,:pack7,:pack8,:img0,:img1,:img2,:img3,:img4,:img5,:img6,:status,:productavailability,:topCatSetting )";

            $stmt = $this->conn->prepare($query);

            $this->productid = htmlspecialchars(strip_tags($this->productid));
            $this->userid = htmlspecialchars(strip_tags($this->seller));
            $this->product_title = htmlspecialchars(strip_tags($this->product_title));
            $this->market = htmlspecialchars(strip_tags($this->market));
            $this->countryorigin = json_encode($this->countryorigin);
            $this->expiration = htmlspecialchars(strip_tags($this->expiration));
            $this->performance = htmlspecialchars(strip_tags($this->performance));
            $this->size = htmlentities($this->size);
            $this->color = htmlentities($this->color);
            $this->product_category = htmlspecialchars(strip_tags($this->product_category));
            $this->product_catalogue = htmlspecialchars(strip_tags($this->seller_catalogue));
            $this->product_description = htmlentities($this->product_description);
            $this->pack0 = htmlentities($this->pack0);
            $this->pack1 = htmlentities($this->pack1);
            $this->pack2 = htmlentities($this->pack2);
            $this->pack3 = htmlentities($this->pack3);
            $this->pack4 = htmlentities($this->pack4);
            $this->pack5 = htmlentities($this->pack5);
            $this->pack6 = htmlentities($this->pack6);
            $this->pack7 = htmlentities($this->pack7);
            $this->pack8 = htmlentities($this->pack8);
            $this->img0 = htmlspecialchars(strip_tags($this->file_name0));
            $this->img1 = htmlspecialchars(strip_tags($this->file_name1));
            $this->img2 = htmlspecialchars(strip_tags($this->file_name2));
            $this->img3 = htmlspecialchars(strip_tags($this->file_name3));
            $this->img4 = htmlspecialchars(strip_tags($this->file_name4));
            $this->img5 = htmlspecialchars(strip_tags($this->file_name5));
            $this->img6 = htmlspecialchars(strip_tags($this->file_name6));
            $this->status = htmlspecialchars(strip_tags($this->productstatus));
            $this->productavailability = htmlspecialchars(strip_tags($this->productavailability));
            $this->topCatSetting = 0;

            $stmt->bindValue('productid', $this->productid);
            $stmt->bindValue('userid', $this->userid);
            $stmt->bindValue('product_title', $this->product_title);
            $stmt->bindValue('market', $this->market);
            $stmt->bindValue('countryorigin', $this->countryorigin);
            $stmt->bindValue('expiration', $this->expiration);
            $stmt->bindValue('performance', $this->performance);
            $stmt->bindValue('size', $this->size);
            $stmt->bindValue('color', $this->color);
            $stmt->bindValue('product_category', $this->product_category);
            $stmt->bindValue('product_catalogue', $this->product_catalogue);
            $stmt->bindValue('product_description', $this->product_description);
            $stmt->bindValue('pack0', $this->pack0);
            $stmt->bindValue('pack1', $this->pack1);
            $stmt->bindValue('pack2', $this->pack2);
            $stmt->bindValue('pack3', $this->pack3);
            $stmt->bindValue('pack4', $this->pack4);
            $stmt->bindValue('pack5', $this->pack5);
            $stmt->bindValue('pack6', $this->pack6);
            $stmt->bindValue('pack7', $this->pack7);
            $stmt->bindValue('pack8', $this->pack8);
            $stmt->bindValue('img0', $this->img0);
            $stmt->bindValue('img1', $this->img1);
            $stmt->bindValue('img2', $this->img2);
            $stmt->bindValue('img3', $this->img3);
            $stmt->bindValue('img4', $this->img4);
            $stmt->bindValue('img5', $this->img5);
            $stmt->bindValue('img6', $this->img6);
            $stmt->bindValue('status', $this->status);
            $stmt->bindValue('productavailability', $this->productavailability);
            $stmt->bindValue('topCatSetting', $this->topCatSetting);

            if($stmt->execute()){
                $this->userid = $this->userid;
                $this->title = 'New Product Created!';
                $this->body = 'A new product has been created by the !'.$this->userid;
                $this->generatedlink = BASE_URL."product_details.php?productid=".$this->productid;
                $this->notifications();

                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    }
    public function edit_product(){

            $query = "UPDATE product_details SET
              product_title=:product_title,
              userid=:userid,
              market=:market,countryorigin=:countryorigin,expiration=:expiration,performance=:performance,size=:size,
              color=:color,product_category=:product_category,product_type=:product_type,product_catalogue=:product_catalogue,product_description=:product_description,
              pack0=:pack0,pack1=:pack1,pack2=:pack2,pack3=:pack3,pack4=:pack4,pack5=:pack5,
              pack6=:pack6,pack7=:pack7,pack8=:pack8,img0=:img0,img1=:img1,img2=:img2,
              img3=:img3,img4=:img4,img5=:img5,img6=:img6,productavailability=:productavailability,
              topCatSetting=:topCatSetting WHERE productid=:productid";

            $stmt = $this->conn->prepare($query);

            $this->productid = htmlspecialchars(strip_tags($this->productid));
            $this->userid = htmlspecialchars(strip_tags($this->seller));

            $this->product_title = htmlspecialchars(strip_tags($this->product_title));
            $this->market = htmlspecialchars(strip_tags($this->market));
            $this->countryorigin = json_encode($this->countryorigin);
            $this->expiration = htmlspecialchars(strip_tags($this->expiration));
            $this->performance = htmlspecialchars(strip_tags($this->performance));
            $this->size = htmlentities($this->size);
            $this->color = htmlentities($this->color);
            $this->product_category = htmlspecialchars(strip_tags($this->product_category));
            $this->product_type = htmlspecialchars(strip_tags($this->product_type));
            $this->product_catalogue = htmlspecialchars(strip_tags($this->seller_catalogue));
            $this->product_description = htmlentities($this->product_description);
            $this->pack0 = htmlentities($this->pack0);
            $this->pack1 = htmlentities($this->pack1);
            $this->pack2 = htmlentities($this->pack2);
            $this->pack3 = htmlentities($this->pack3);
            $this->pack4 = htmlentities($this->pack4);
            $this->pack5 = htmlentities($this->pack5);
            $this->pack6 = htmlentities($this->pack6);
            $this->pack7 = htmlentities($this->pack7);
            $this->pack8 = htmlentities($this->pack8);
            $this->img0 = htmlspecialchars(strip_tags($this->file_name0));
            $this->img1 = htmlspecialchars(strip_tags($this->file_name1));
            $this->img2 = htmlspecialchars(strip_tags($this->file_name2));
            $this->img3 = htmlspecialchars(strip_tags($this->file_name3));
            $this->img4 = htmlspecialchars(strip_tags($this->file_name4));
            $this->img5 = htmlspecialchars(strip_tags($this->file_name5));
            $this->img6 = htmlspecialchars(strip_tags($this->file_name6));
            $this->productavailability = htmlspecialchars(strip_tags($this->productavailability));
            $this->topCatSetting = 0;

            $stmt->bindValue('productid', $this->productid);
            $stmt->bindValue('userid', $this->userid);

            $stmt->bindValue('product_title', $this->product_title);
            $stmt->bindValue('market', $this->market);
            $stmt->bindValue('countryorigin', $this->countryorigin);
            $stmt->bindValue('expiration', $this->expiration);
            $stmt->bindValue('performance', $this->performance);
            $stmt->bindValue('size', $this->size);
            $stmt->bindValue('color', $this->color);
            $stmt->bindValue('product_category', $this->product_category);
            $stmt->bindValue('product_type', $this->product_type);
            $stmt->bindValue('product_catalogue', $this->product_catalogue);
            $stmt->bindValue('product_description', $this->product_description);
            $stmt->bindValue('pack0', $this->pack0);
            $stmt->bindValue('pack1', $this->pack1);
            $stmt->bindValue('pack2', $this->pack2);
            $stmt->bindValue('pack3', $this->pack3);
            $stmt->bindValue('pack4', $this->pack4);
            $stmt->bindValue('pack5', $this->pack5);
            $stmt->bindValue('pack6', $this->pack6);
            $stmt->bindValue('pack7', $this->pack7);
            $stmt->bindValue('pack8', $this->pack8);
            $stmt->bindValue('img0', $this->img0);
            $stmt->bindValue('img1', $this->img1);
            $stmt->bindValue('img2', $this->img2);
            $stmt->bindValue('img3', $this->img3);
            $stmt->bindValue('img4', $this->img4);
            $stmt->bindValue('img5', $this->img5);
            $stmt->bindValue('img6', $this->img6);
            $stmt->bindValue('productavailability', $this->productavailability);
            $stmt->bindValue('topCatSetting', $this->topCatSetting);

            if($stmt->execute()){

                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
    }

    public function fetch_product($marketid){
        $this->marketid = $marketid;
        $sql = 'SELECT * FROM marketproductid WHERE marketid='.$this->marketid;
        $kinging = $this->conn->query($sql);
        foreach ($kinging as $row) {
            $response[] = $row['categoryname'];
        }
        $tarrifList = json_encode($response);
        echo $tarrifList;
    }
    public function fetch_product_list($cat,$userid){
      $cat = $cat;
      // print_r($cat);
        $sql = "SELECT * FROM product_details WHERE product_category="."'".$cat."'"." AND userid=".$userid."";
        $product = $this->conn->query($sql);
// print_r($product);
      $response =[];
        foreach($product as $row) {
            $response[] = $row['product_title'];
        }
        $tarrifList = json_encode($response);
        echo $tarrifList;
    }
    public function fetch_user_catalogue($sellerid){
        $this->sellerid = $sellerid;
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->sellerid;
        $seller = $this->conn->query($sql);
        foreach ($seller as $row) {
            $response[] = $row['catname_u'];
        }
        $tarrifList = json_encode($response);
        echo $tarrifList;
    }

    public function fetchCountries(){
        $sql = 'SELECT * FROM apps_countries ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<option value="'.$row['country_name'].'">'.$row['country_name'].'</option>';
        }
    }

    function getRealIpAddr()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        $country  = "Unknown";

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $ip_data_in = curl_exec($ch); // string
        curl_close($ch);

        $ip_data = json_decode($ip_data_in,true);
        $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

        if($ip_data && $ip_data['geoplugin_countryName'] != null) {
            $country = $ip_data['geoplugin_countryName'];
        }

        // return 'IP: '.$ip.' # Country: '.$country;
        return $country;
    }

    public function fetchStates(){
        $sql = 'SELECT * FROM naija_states ORDER BY name';
        foreach ($this->conn->query($sql) as $row) {
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        }
    }

    public function fetchStatesData(){
        $sql = 'SELECT * FROM naija_states ORDER BY name';
        $sth = $this->conn->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function add_accountdetails(){

        $this->me = $this->accountdetails($this->userid);
        if($this->me > 0){
            echo 'exist';
            return false;
        }

        $query = "INSERT INTO accountdetails (userid,accountname,accountnumber,bankname,accounttype,status)
            VALUES (:userid,:accountname,:accountnumber,:bankname,:accounttype,:status)";

        $stmt = $this->conn->prepare($query);

        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->bankname = htmlspecialchars(strip_tags($this->bankname));
        $this->accountnumber = htmlspecialchars(strip_tags($this->accountnumber));
        $this->accountname = htmlspecialchars(strip_tags($this->accountname));
        $this->accounttype = htmlentities($this->accounttype);
        $this->status = htmlentities($this->status);

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('accountname', $this->accountname);
        $stmt->bindValue('accountnumber', $this->accountnumber);
        $stmt->bindValue('bankname', $this->bankname);
        $stmt->bindValue('accounttype', $this->accounttype);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'Seller Added Account Details';
            $this->body = 'A seller just updated his/her account details';
            $this->generatedlink = BASE_URL."seller_details.php?userid=".$this->userid;
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function accountdetails($userid){
        $this->userid = $userid;
        $sql = "SELECT count(*) FROM `accountdetails` WHERE userid=:userid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('userid', $userid);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            return $number_of_rows;
        }

    }

    public function acctdetails($userid){

        $stmtbiz = $this->conn->prepare("SELECT * FROM accountdetails WHERE userid=:userid");
        $stmtbiz->bindValue("userid", $userid);
        $stmtbiz->execute();
        if($stmtbiz->rowCount() > 0){
            $data = $stmtbiz->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }else{
            return 'empty';
        }
    }

    public function user_category(){

        if($this->isUserCatExist()){
            echo 'exist';
            return false;
        }

        $this->t_product = 0;

        $query = "INSERT INTO user_category (catid,userid,catname_u,catdescription_u,t_product)
            VALUES (:catid,:userid,:catname,:catdescription,:t_product)";

        $stmt = $this->conn->prepare($query);

        $this->catid = htmlspecialchars(strip_tags($this->catid));
        $this->catname = htmlspecialchars(strip_tags($this->catname));
        $this->catdescription = htmlspecialchars(strip_tags($this->catdescription));
        $this->t_product = htmlspecialchars(strip_tags($this->t_product));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('catid', $this->catid);
        $stmt->bindValue('catname', $this->catname);
        $stmt->bindValue('catdescription', $this->catdescription);
        $stmt->bindValue('t_product', $this->t_product);
        $stmt->bindValue('userid', $this->userid);

        if($stmt->execute()){
            $userid = $this->userid;

            $this->userid = $this->userid;
            $this->title = 'A Seller Create a Catalogue' ;
            $this->body = 'A seller just created a Catalogue!';
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();
            return true;
        }else{
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    //Get Categories
    public function category_list(){
        $sql = 'SELECT * FROM category ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<li class="list-group-item" id="row_'.$row['catid'].'">
                    <div class="todo-indicator bg-info"></div>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img width="42" class="rounded" src="'.BASE_URL.'seller/catImage/'.$row['catid'].'/'.$row['catImage'].'" alt="">
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">'.$row['catname'].'</div>
                                <div class="widget-subheading">'.$row['catdescription'].'</div>
                            </div>
                            <div class="widget-content-right widget-content-actions">
                                <button class="btn btn-sm btn-info edit_category" id="'.$row['catid'].'" title="Edit Category">Edit</button>
                                <button class="btn btn-sm btn-danger delete_category" id="'.$row['catid'].'" title="Delete Category">Delete</button>
                            </div>
                        </div>
                    </div>
                </li>';
        }
    }

    //Get category into dropdown list
    public function category_dropdown_list(){
        $sql = 'SELECT * FROM category ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<option value="'.$row['catname'].'-'.$row['catid'].'">'.$row['catname'].'</option>';
        }
    }

    //Get User Categories List
    public function user_category_list($userid){
        $this->userid = $userid;
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
            $cnt = $this->user_product_catalogue_count($row['userid'], $row['catid']);
            echo '<li id="cat-'. $row['catid'].'" class="list-group-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">'.$row['catname_u'].'</div>
                                <div class="widget-subheading mt-1 opacity-10">
                                    <span class="badge badge-sm badge-pill badge-primary">'.$cnt.' Products</span>
                                </div>
                            </div>
                            <div class="widget-content-right">
                                <div class="fsize-2 text-success">
                                    <button class="btn btn-sm btn-danger" onclick="remove_catalogue('. $row['catid'].')"><i class="fa fa-times"></i></button>
                                    <a href="'.$this->location().'product_catalogue_list.php?catalogid='.$row['catid'].'" class="btn btn-sm btn-info">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>';
        }
    }

    //Get category name
    public function get_catalogue_name($catid){
      $stm = $this->conn->prepare("SELECT catname_u FROM user_category WHERE catid=:catid");
      $stm->bindValue("catid", $catid);
      $stm->execute();
      if($stm->rowCount() > 0){
          $category_details = $stm->fetch(PDO::FETCH_OBJ);
          return $category_details->catname_u;

      }else{
          return null;
      }

    }
    //Get User Categories List
    public function user_category_grid($userid){
        $this->userid = $userid;
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
            $cnt = $this->user_product_count($row['userid'], $row['catname_u']);
            echo '<div>
                    <div class="slider-item">
                        <div class="card-shadow-primary card-border card">
                            <div class="dropdown-menu-header pt-5 text-center">
                                <i class="fa fa-shopping-basket fa-3x text-danger" style="color: #333333;"></i>
                            </div>
                            <div class="p-0" style="height: 120px !important;">
                                <ul class="rm-list-borders list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0 text-center">
                                            <div class="font-size-xlg text-muted">
                                                <h5 style="color: #333333;">'.$row['catname_u'].'</h5>
                                            </div>
                                            <div class="widget-heading">
                                                '.$cnt.'-products
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center d-block card-footer">
                                <a href="'.BASE_URL.'product_catalogue_list.php?catalogid='.$row['catname_u'].'" class="btn btn-danger btn-sm">View all
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
    public function user_catalogue_grid($userid){
        $this->userid = $userid;
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
            $cnt = $this->user_product_catalogue_count($row['userid'], $row['catid']);
            echo '<div>
                    <div class="slider-item">
                        <div class="card-shadow-primary card-border card">
                            <div class="dropdown-menu-header pt-5 text-center">
                                <i class="fa fa-shopping-basket fa-3x text-danger" style="color: #333333;"></i>
                            </div>
                            <div class="p-0" style="height: 120px !important;">
                                <ul class="rm-list-borders list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0 text-center">
                                            <div class="font-size-xlg text-muted">
                                                <h5 style="color: #333333;">'.$row['catname_u'].'</h5>
                                            </div>
                                            <div class="widget-heading">
                                                '.$cnt.'-products
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center d-block card-footer">
                                <a href="'.BASE_URL.'product_catalogue_list.php?catalogid='.$row['catid'].'" class="btn btn-danger btn-sm">View all
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
    public function user_catalogue_pgrid($userid){
        $this->userid = $userid;
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
            $cnt = $this->user_product_catalogue_count($row['userid'], $row['catid']);
            echo '<div>
                    <div class="slider-item">
                        <div class="card-shadow-primary card-border card">
                            <div class="dropdown-menu-header pt-5 text-center">
                                <i class="fa fa-shopping-basket fa-3x text-danger" style="color: #333333;"></i>
                            </div>
                            <div class="p-0" style="height: 120px !important;">
                                <ul class="rm-list-borders list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0 text-center">
                                            <div class="font-size-xlg text-muted">
                                                <h5 style="color: #333333;">'.$row['catname_u'].'</h5>
                                            </div>
                                            <div class="widget-heading">
                                                '.$cnt.'-products
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center d-block card-footer">
                                <a href="'.BASE_URL.'catalogue_list.php?catid='.$row['catid'].'&userid='.$userid.'" class="btn btn-danger btn-sm">View all
                                </a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }

    public function user_product_count($userid, $catname){
        $sql = "SELECT count(*) FROM `product_details` WHERE userid=:userid AND product_category=:product_category";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('userid', $userid);
        $stmt->bindValue('product_category', $catname);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            return $number_of_rows;
            // return;
        }
    }

    public function user_product_catalogue_count($userid, $catid){
        $sql = "SELECT count(*) FROM `product_details` WHERE userid=:userid AND product_catalogue=:product_catalogue";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('userid', $userid);
        $stmt->bindValue('product_catalogue', $catid);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            return $number_of_rows;
            // return;
        }
    }

    public function totaluserproduct($userid){
        $sql = "SELECT count(*) FROM `product_details` WHERE userid=:userid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('userid', $userid);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            echo $number_of_rows;
            return;
        }
    }
    public function totaluserOrder($userid){
        $sql = "SELECT count(*) FROM `order_tbl` WHERE sellerid=:userid";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('userid', $userid);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            echo $number_of_rows;
            return;
        }
    }
    public function totaluserSales($userid){
        $sql = "SELECT SUM(cost) FROM `order_tbl` WHERE sellerid=:userid GROUP BY sellerid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetch();
        if (!empty($row )) {
          while ($row) {
            // number_format($item[1], 2)
            echo $user->currency.number_format($row['SUM(cost)'], 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }
    public function totalAdminSales($userid){

      $sql = "SELECT total_balance FROM `wallet_details` WHERE sellerid=:userid";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('userid', $userid);
      $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo $user->currency.number_format($row, 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }
    public function totaluserIncome($userid){
        $sql = "SELECT SUM(cost) FROM `order_tbl` WHERE sellerid=:userid GROUP BY sellerid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetch();
        if (!empty($row )) {
          while ($row) {
            // number_format($item[1], 2)
            echo $user->currency.number_format($row['SUM(cost)'], 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }

    public function Addtowallet($sellerid,$amount){

      $sql = "SELECT count(*) FROM wallet_details WHERE sellerid=:sellerid GROUP BY sellerid";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('sellerid', $sellerid);
      $stmt->execute();

      if ($stmt->fetchColumn() > 0) {
        $sql = "UPDATE wallet_details SET total_balance=total_balance + :amount, total_payout=total_payout + :amount  where sellerid=:sellerid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('sellerid', $sellerid);
        $stmt->bindValue('amount', $amount);
        $stmt->execute();
      }else {

        $sql = "INSERT INTO wallet_details SET sellerid=:sellerid, total_payout=:amount, total_balance=:balance, total_income=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('sellerid', $sellerid);
        $stmt->bindValue('amount', $amount);
        $stmt->bindValue('balance', $amount);
        $stmt->execute();
      }
    }
    public function Addtowalletincome($sellerid,$amount){

      $sql = "SELECT count(*) FROM wallet_details WHERE sellerid=:sellerid GROUP BY sellerid";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('sellerid', $sellerid);
      $stmt->execute();

      if ($stmt->fetchColumn() > 0) {
        $sql = "UPDATE wallet_details SET total_income=total_income + :amount, total_payout=total_payout - :amount  where sellerid=:sellerid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('sellerid', $sellerid);
        $stmt->bindValue('amount', $amount);
        $stmt->execute();
        return;
      }else {

        return;
      }
    }
    public function RemoveFromAdmiwallet($admin,$amount){

      $sql = "SELECT count(*) FROM wallet_details WHERE sellerid=:sellerid GROUP BY sellerid";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('sellerid', $admin);
      $stmt->execute();

      if ($stmt->fetchColumn() > 0) {
        $sql = "UPDATE wallet_details SET total_income=total_payout + :amount, total_payout=total_balance - :amount  where sellerid=:sellerid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('sellerid', $admin);
        $stmt->bindValue('amount', $amount);
        $stmt->execute();
        return;
      }else {

        return;
      }
    }

    public function totaluserPayout($userid){
        $sql = "SELECT total_payout FROM `wallet_details` WHERE sellerid=:userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo $user->currency.number_format($row, 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }
    public function totalAdminPayout($userid){
      $sql = "SELECT total_payout FROM `wallet_details` WHERE sellerid=:userid";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('userid', $userid);
      $stmt->execute();


        // Print out result
        $currency = "$";
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo $currency.number_format($row, 2);
            return;
          }

        }else {
          echo $currency.number_format(0, 2);
          return;
        }
    }
    public function totaluserBalance($userid){
        $sql = "SELECT total_payout FROM `wallet_details` WHERE sellerid=:userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo $user->currency.number_format($row, 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }

    public function totaladminBalance($userid){
        $sql = "SELECT total_income FROM `wallet_details` WHERE sellerid=:userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo $user->currency.number_format($row, 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }

    public function totaluserBalanceN($userid){
        $sql = "SELECT total_payout FROM `wallet_details` WHERE sellerid=:userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo number_format($row, 2);
            return;
          }

        }else {
          echo number_format(0, 2);
          return;
        }
    }
    public function totaluserWalletIncome($userid){
        $sql = "SELECT total_income FROM `wallet_details` WHERE sellerid=:userid";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->execute();

        // Print out result
        $user = $this->userDetails($userid);
        $row = $stmt->fetchColumn();
        if (!empty($row )) {
          while ($row) {
            echo $user->currency.number_format($row, 2);
            return;
          }

        }else {
          echo $user->currency.number_format(0, 2);
          return;
        }
    }

    //Get User product List
    public function user_product_grid($userid){
        $this->userid = $userid;
        $sellerDetails = $this->userDetails($userid);

        $sql = 'SELECT * FROM product_details WHERE userid='.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
          for ($i=0; $i < 7; $i++) {
            $img = 'img'.$i;
            if (!is_null($row[$img]) && !empty($row[$img])) {
              $image = $row[$img];
              break;
            }
          }
            echo '<div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="card-shadow-primary card-border mb-3 card">
                        <div class="dropdown-menu-header" style="width: 100%; height: 180px; overflow: hidden;">
                            <img src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" style="width: 100% !important; height: auto !important; margin: auto;" alt="Avatar 5">
                        </div>
                        <div class="p-3">
                            <ul class="rm-list-borders list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading"> '. $row['product_title'] .' </div>
                                                <div class="widget-subheading"  style="font-size: 12px !important;">
                                                     '. $row['product_category'] .'
                                                </div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="font-size-sm text-muted">
                                                    <span class="badge badge-warning">'. $row['status'] .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center d-block card-footer">
                            <a href="'.$this->location().'product_details.php?productid='.$row['productid'].'" class="btn btn-warning btn-sm">Details
                            </a>
                            <a href="'.$this->location().'edit_product.php?productid='.$row['productid'].'" class="btn btn-danger btn-sm">Edit Product
                            </a>
                        </div>
                    </div>
                </div>';
        }
    }

    //Get User product Grid
    public function user_product_list($userid){
        $this->userid = $userid;

        if($this->isListExist()){
            echo '<tr>
                    <td>No record found!</td>
                </tr>';
            return true;
        }
        $userRole = $this->userDetails($userid)->role;
        $sql = 'SELECT * FROM product_details WHERE userid='.$this->userid.' ORDER BY id DESC';
        foreach ($this->conn->query($sql) as $row) {
          $item = explode('+',$row['pack0']);
            if($row['status']=='Pending'){
                $butt = 'Waiting for approval!';
            }else{
                if($row['productavailability'] == 'Out of Stock'){
                    $butt = '<button class="btn btn-sm btn-outline-warning">Out of Stock</button>';
                }elseif($row['productavailability'] == 'In Stock'){
                    $butt = '<button class="btn btn-sm btn-outline-danger">In stock</button>';
                }
            }
            for ($i=0; $i < 8; $i++) {
              $park = "pack".$i;
              $price = "price".$i;
              $discount = "discount".$i;
              if (!is_null($row[$park]) && !empty($row[$park])) {
                if ( strpos($row[$park], '+') ) {
                  $item = explode('+',$row[$park]);

                }elseif (strpos($row[$park], '@') ) {

                  $item = explode('@',$row[$park]);
                }else {
                  $item ="";
                }
              }
            }

            echo '<tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><a href="'.BASE_URL.strtolower($userRole).'/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['product_title'].'</td>
                    <td> '.$row['product_type'].'</td>
                    <td>'.$row['product_category'].'</td>
                    <td><strong class="h4">'.$item[1].'</stong>
                    <small style="font-size:x-small">Discount: <i>'.$item[2]. '</i></small>
                    </td>
                    <td>'.$item[0].'</td>
                    <td>'.$row['status'].'</td>
                    <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-default">Choose:</button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -165px, 0px);">
                        <a href="'.BASE_URL.strtolower($userRole).'/product_details.php?productid='.$row['productid'].'" type="button" tabindex="0" class="dropdown-item">Details</a>
                        <a href="'.BASE_URL.strtolower($userRole).'/edit_product.php?productid='.$row['productid'].'" type="button" tabindex="0" class="dropdown-item">Edit Product</a>
                        <button type="button" tabindex="0" class="dropdown-item" onclick="deleteProduct('.$row['productid'].')>Delete</button>
                        <button type="button" tabindex="0" class="dropdown-item" onclick="deactivateProduct('.$row['productid'].', '.$this->userid.')">Deactivate</button>
                        <!--<button type="button" tabindex="0" class="dropdown-item">Activate Product</button>-->
                    </div></td>
                </tr>';
        }
    }
    //Get User product Grid
    public function user_purchase_history($userid){
        // $this->userid = $userid;


        $sql = 'SELECT * FROM order_tbl WHERE userid='.$userid.'';

        foreach ($this->conn->query($sql) as $row) {

          foreach (json_decode($row['orders']) as $key => $value) {
            $product = $this->get_product_details($key);
// print_r($product);
            echo '<tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><a href="'.BASE_URL.'product_details.php?productid='.$product->productid.'">'.$product->productid.'</a></td>
                    <td>'.$product->product_title.'</td>
                    <td>'.$product->product_category.'</td>
                    <td>'.$product->productavailability.'</td>
                    <td>
                    <div class="widget-content-right ml-3">
                                            <div class="text" id="text-'.$row['id'].'">'.ucwords(@$row['status']).' </div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="text">
                                            <select class="form-control" onchange="changeStatus(this.id,'.$row['id'].','.$row['userid'].')" name="status" id="dstatus">
                                            <option> Update Status</option>
                                            <option value="delivered"> Delivered </option>
                                            <option value="awaiting approval"> Awaiting Approval</option>
                                            </select> </div>
                                        </div></td>
                    <td>'.$row['order_date'].'</td>

                </tr>';
        }
    }
    }

    //Get User product Grid
    public function user_product_list_review($userid){
        $this->userid = $userid;

        if($this->isListExist()){
            echo '<tr>
                    <td>No record found!</td>
                </tr>';
            return true;
        }

        $sql = 'SELECT * FROM submit_review_db WHERE userid='.$this->userid;
        $sql2 = 'SELECT count(*) FROM submit_review_db WHERE userid='.$this->userid;
      $count = $this->conn->prepare($sql2);
      $count->execute();
      $count = $count->fetchColumn();

        // print_r($result);
        foreach ($this->conn->query($sql) as $row) {
          $stm = $this->conn->prepare("SELECT * FROM product_details WHERE productid=:productid");
          $stm->bindValue(':productid', $row['productid']);

          $stm->execute();

          $product = $stm->fetch(PDO::FETCH_OBJ);
          // print_r($product->pack0);
            $item = explode('+',$product->pack0);


            if($row['status']=='Pending'){
                $butt = 'Waiting for approval!';
            }else{

                    $butt = $row['status'];

            }

            echo '<tr role="row" class="odd">
                    <td tabindex="0" class="sorting_1"><a href="'.$this->location().'product_details.php?productid='.$product->productid.'">'.$product->productid.'</a></td>
                    <td>'.$product->product_title.'</td>
                    <td>'.$count.'</td>
                    <td>'.$item[0].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$row['date_created'].'</td>
                    <td><button class="btn btn-danger btn-sm" onclick="readreview('.$row['id'].')">Read Reviews</button></td>
                </tr>';
                $output = '';
                $output .='
                <div class="modal fade" id="read_review'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Review Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                        <div class="col-lg-12">
                          <div class="main-card mb-3 card">
                              <ul class="list-group list-group-flush">
                                  <li class="list-group-item">
                                      <div class="widget-content p-0">
                                          <div class="widget-content-wrapper">
                                              <div class="widget-content-left mr-3">
                                                  <img width="42" class="rounded" src="'.BASE_URL.'/images/avatars/avatar.jpg" alt="">
                                              </div>
                                              <div class="widget-content-left">
                                                  <div class="widget-heading">'.$row['r_name'].'</div>
                                                  <div class="widget-subheading">'.$row['r_body'].'</div>
                                              </div>
                                              <div class="widget-content-right">
                                                <div class="widget-heading">';
                                    for ($i=1; $i <=5; $i++) {
                                      if ($i <= $row['rating']) {
                                        $output .='<i class="fa fa-star"></i>';
                                      }else {
                                        $output .='<i class="fa fa-star-o"></i>';
                                      }
                                    }
                                          $output .='</div>
                                                <button class="btn btn-success btn-sm" onclick="viewreview('.$row['id'].')">View</button>';
                                                if ($row['status'] == "Disapproved" || $row['status'] == "Pending" ) {
                                                }else {
                                          $output .='<button class="btn btn-danger btn-sm" onclick="replyreview('.$row['id'].')">Reply</button>';
                                                }
                                          $output .='</div>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </div>
                        </div>
                      </div>
                      <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Send message</button>
                      </div> -->
                    </div>
                  </div>
                </div>

                ';
                echo $output;
                $view = "";
                $view .='
                <div class="modal fade" id="view_review'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reply reviewed message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Review By:</label>
                            <input type="text" class="form-control" id="recipient-name" value="'.$row['r_name'].'" readonly>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Review Message:</label>
                            <textarea class="form-control" id="message-text" readonly>'.$row['r_body'].'</textarea>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Rating:</label>';
                            for ($i=1; $i <=5; $i++) {
                              if ($i <= $row['rating']) {
                                $view .='<i class="fa fa-star"></i>';
                              }else {
                                $view .='<i class="fa fa-star-o"></i>';
                              }
                            }

                          $view .='</div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                ';
                echo $view;

                $reply ="";
                $name = $this->userDetails($_SESSION['userid']);
                // print_r($name->fname );

                $reply .='
                <div class="modal fade" id="reply_review'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reply reviewed message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="" method="post" id="result'.$row['id'].'">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Review By:</label>
                            <input type="text" class="form-control" id="recipient-name" value="'.$row['r_name'].'" readonly>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Review Message:</label>
                            <textarea class="form-control" id="message-text" readonly>'.$row['r_body'].'</textarea>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Rating:</label>';
                            for ($i=1; $i <=5; $i++) {
                              if ($i <= $row['rating']) {
                                $reply .='<i class="fa fa-star"></i>';
                              }else {
                                $reply .='<i class="fa fa-star-o"></i>';
                              }
                            }

                          $reply .='</div>
                          <div class="form-group">
                          <input type="hidden" id="p'.$row['id'].'" name="product_id" value="'.$product->productid.'">
                          <input type="hidden" id="r'.$row['id'].'" name="reviewid" value="'.$row['reviewid'].'">
                          <input type="hidden" id="u'.$row['id'].'" name="user_id" value="'.$_SESSION['userid'].'">
                          <input type="hidden" id="n'.$row['id'].'" name="r_name" value="'.$name->fname .' '.$name->lname.'">
                          <input type="hidden" id="e'.$row['id'].'" name="r_email" value="'.$name->email.'">
                          <input type="hidden" id="t'.$row['id'].'" name="title" value="Seller">
                            <label for="message-text" class="col-form-label">Type Reply:</label>
                            <textarea id="reply'.$row['id'].'"class="form-control" name="r_body" id="message-text"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="replyBtn'.$row['id'].'" onclick="SendReply('.$row['id'].')" class="btn btn-danger">Reply Review</button>
                      </div>
                    </div>
                  </div>
                </div>';
              echo $reply;


        }
    }

    //Get Categories dropdown
    public function category_dropdown(){
        $sql = 'SELECT * FROM category ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<option value="'.$row['catname'].'">'.$row['catname'].'</option>';
        }
    }

    //Get Categories dropdown
    public function category_dropdown_seller($userid){
        $this->userid = $userid;
        // $sql = 'SELECT * FROM user_category WHERE userid: ORDER BY id';
        $sql = 'SELECT * FROM user_category WHERE userid='.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
            echo '<option value="'.$row['catname_u'].'">'.$row['catname_u'].'</option>';
        }
    }

    public function notifications(){
        $this->status = 0;
        $query = "INSERT INTO notifications (userid,title,body,generatedlink,status)
            VALUES (:userid,:title,:body,:generatedlink,:status)";

        $stmt = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->generatedlink = htmlspecialchars(strip_tags($this->generatedlink));

        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('title', $this->title);
        $stmt->bindValue('body', $this->body);
        $stmt->bindValue('generatedlink', $this->generatedlink);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function emailActivation($userid){
        $pdo = $this->conn;
        $stmt = $pdo->prepare('UPDATE users SET status = 1 WHERE userid = ?');
        $stmt->execute([$userid]);
        if ($stmt->rowCount() > 0) {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE userid = ? and status = 1 limit 1');
            $stmt->execute([$userid]);
            $user = $stmt->fetch();

            $this->user = $user;
            session_regenerate_id();
            if (!empty($user['userid'])) {
                $_SESSION['user']['userid'] = $user['userid'];
                $_SESSION['user']['username'] = $user['username'];
                $_SESSION['user']['name'] = $user['name'];
                $_SESSION['user']['email'] = $user['email'];
                return true;
            } else {
                $this->msg = 'Account activitation failed.';
                return false;
            }
        } else {
            $this->msg = 'Account activitation failed.';
            return false;
        }
    }

    //Check if username exit;
    public function isUsernameExit($username){
        $query = "SELECT * FROM users WHERE username=:username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    //Check if username exit;
    public function isMarketExist(){
        $query = "SELECT * FROM market WHERE marketname=:marketname AND marketstate=:marketstate";
        $stmt = $this->conn->prepare($query);
        $this->marketname = htmlspecialchars(strip_tags($this->marketname));
        $this->marketstate = htmlspecialchars(strip_tags($this->marketstate));
        $stmt->bindValue(':marketname', $this->marketname);
        $stmt->bindValue(':marketstate', $this->marketstate);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            // if(is_dir( "../../seller/marketImage/".$this->marketname )){
            //     return true;
            // }
            return true;
        }
    }

    //Check if username exit;
    public function isListExist(){
        $query = "SELECT * FROM product_details WHERE userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $stmt->bindValue(':userid', $this->userid);
        $stmt->execute();
        if($stmt->rowCount() < 1){
                return true;
        }
    }

    public function isCatExist(){
        $query = "SELECT * FROM category WHERE catname=:catname";
        $stmt = $this->conn->prepare($query);
        $this->catname = htmlspecialchars(strip_tags($this->catname));
        $stmt->bindValue(':catname', $this->catname);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    public function isUserCatExist(){
        $query = "SELECT * FROM user_category WHERE catname_u=:catname AND userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->catname = htmlspecialchars(strip_tags($this->catname));
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $stmt->bindValue(':catname', $this->catname);
        $stmt->bindValue(':userid', $this->userid);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    //Check if email exist
    public function isEmailExit(){
        $queryEmail = "SELECT * FROM  users WHERE email=:email";
        $stmtEmail = $this->conn->prepare($queryEmail);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmtEmail->bindValue(':email', $this->email);
        $stmtEmail->execute();
        if($stmtEmail->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    /* User Details */
    public function userDetails($userid){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE userid=:userid");
            $stmt->bindParam("userid", $userid, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /* business Details */
    public function checkAcctType($userid){
        $stmtbiz = $this->conn->prepare("SELECT * FROM account_info WHERE userid=:userid");
        $stmtbiz->bindParam("userid", $userid, PDO::PARAM_INT);
        $stmtbiz->execute();
        $data = $stmtbiz->fetch(PDO::FETCH_OBJ); //User data
        return $data;
                // if($stmtbiz->rowCount() < 1){
        //     echo '<div class="card-body row">
        //             <div class="alert alert-danger show col-md-12" role="alert">
        //             You have to update your business information <a href="business_setting"><button class="btn btn-info btn-sm">Update business profile</button></a>
        //             </div>
        //         </div>';
        // }
    }

    public function logout(){
        $_SESSION['userid'] = null;
        session_regenerate_id();
        return true;
    }

    public function productCount()
    {
        $sth = $this->conn->prepare("SELECT * FROM product_details");
        $sth->execute();
        return $sth->rowCount();
    }

    public function marketCount()
    {
        $sth = $this->conn->prepare("SELECT * FROM market");
        $sth->execute();
        return $sth->rowCount();
    }

    public function categoryCount()
    {
        $sth = $this->conn->prepare("SELECT * FROM category");
        $sth->execute();
        return $sth->rowCount();
    }

    public function updateSettings($column, $value){
        $sth = $this->conn->prepare("UPDATE settings SET {$column}=:value");
        return $sth->execute(array(':value' => $value));
    }

    public function getSettings()
    {
        $sth = $this->conn->prepare("SELECT * FROM settings");
        $sth->execute();
        return $sth->fetch();
    }

    public function getUsersCount($role="")
    {
        $query = "";
        if($role != '')
        {
            $query = 'SELECT * FROM users WHERE role = "'.$role.'" ';
        } else {
            $query = 'SELECT * FROM users WHERE role != "Admin" AND role != "Sub Admin" ';
        }
        $sth = $this->conn->prepare($query);
        $sth->execute();
        return $sth->rowCount();
    }

    public function view_buyers($status = '')
    {
        $query = "";
        switch($status){
            case "active":
                $query = 'SELECT * FROM users WHERE role = "Buyer" AND status = 1 ORDER BY sn';
                break;
            case "inactive":
                $query = 'SELECT * FROM users WHERE role = "Buyer" AND status = 2 ORDER BY sn';
                break;
            case "pending":
                $query = 'SELECT * FROM users WHERE role = "Buyer" AND status = 0 ORDER BY sn';
                break;
            default:
                $query = 'SELECT * FROM users WHERE role = "Buyer" ORDER BY sn';
        }
        $sth = $this->conn->prepare($query);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function view_admins($status = '')
    {
        $query = "";
        switch($status){
            case "active":
                $query = 'SELECT * FROM users WHERE (role = "Sub Admin") AND status = 1 ORDER BY sn';
                break;
            case "inactive":
                $query = 'SELECT * FROM users WHERE (role = "Sub Admin")  AND status = 2 ORDER BY sn';
                break;
            case "pending":
                $query = 'SELECT * FROM users WHERE (role = "Sub Admin")  AND status = 0 ORDER BY sn';
                break;
            default:
                $query = 'SELECT * FROM users WHERE (role = "Sub Admin")  ORDER BY sn';
        }
        $sth = $this->conn->prepare($query);
        $sth->execute();
        return $sth->fetchAll();
    }

    //Get all sellers
    public function view_all($sellertype){

      if ($sellertype == '') {
        $sql = "SELECT * FROM users ORDER BY sn";

      }else {

        $sql = "SELECT * FROM users WHERE role = '$sellertype'  ORDER BY sn";
      }
        foreach ($this->conn->query($sql) as $row) {

            if($row['status']==1){
                $butt = '<span class="badge badge-success">Active</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateSeller('.$row['userid'].')">Deactivate</button>
                        <button onclick="subadmindetails('.$row['userid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>';
            }elseif($row['status']==0){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateSeller('.$row['userid'].')" style="float: left;">Activate</button>
                        <button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateSeller('.$row['userid'].')">Deactivate</button>
                        <button onclick="subadmindetails('.$row['userid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>';
            }elseif($row['status']==2){
                $butt = '<span class="badge badge-danger">Inactive</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-success btn-sm" onclick="activateSeller('.$row['userid'].')">Activate</button>
                        <button onclick="subadmindetails('.$row['userid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>';
            }
            echo '<tr>
                    <td>'.$row['userid'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['fname'].' '.$row['fname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td style="font-size: 13px;">'.$row['date_reg'].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$btt.'</td>
                </tr>';
        }
    }
    //Get all pending seller
    public function view_pending($usertype){

        $sql = "SELECT * FROM users WHERE role = '$usertype' AND status=0 ORDER BY sn";
        foreach ($this->conn->query($sql) as $row) {

            if($row['status']==1){
                $butt = '<span class="badge badge-success">Active</span>';
            }elseif($row['status']==0){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']==2){
                $butt = '<span class="badge badge-danger">Inactive</span>';
            }
            echo '<tr>
                    <td>'.$row['userid'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['fname'].' '.$row['fname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td style="font-size: 13px;">'.$row['date_reg'].'</td>
                    <td>'.$butt.'</td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateSeller('.$row['userid'].')" style="float: left;">Activate</button>
                        <button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateSeller('.$row['userid'].')">Deactivate</button><button onclick="subadmindetails('.$row['userid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button></td>
                </tr>';
        }
    }
    //Get all active seller
    public function view_active($usertype){

        $sql = "SELECT * FROM users WHERE role = '$usertype' AND status=1 ORDER BY sn";
        foreach ($this->conn->query($sql) as $row) {

            if($row['status']==1){
                $butt = '<span class="badge badge-success">Active</span>';
            }elseif($row['status']==0){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']==2){
                $butt = '<span class="badge badge-danger">Inactive</span>';
            }
            echo '<tr>
                    <td>'.$row['userid'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['fname'].' '.$row['fname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td style="font-size: 13px;">'.$row['date_reg'].'</td>
                    <td>'.$butt.'</td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateSeller('.$row['userid'].')">Activate</button> <button onclick="subadmindetails('.$row['userid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button></td>
                </tr>';
        }
    }
    //Get all inactive seller
    public function view_inactive($usertype){

        $sql = "SELECT * FROM users WHERE role = '$usertype' AND status=2 ORDER BY sn";
        foreach ($this->conn->query($sql) as $row) {

           if($row['status']==1){
                $butt = '<span class="badge badge-success">Active</span>';
            }elseif($row['status']==0){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']==2){
                $butt = '<span class="badge badge-danger">Inactive</span>';
            }
            echo '<tr>
                    <td>'.$row['userid'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['fname'].' '.$row['fname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['phone'].'</td>
                    <td style="font-size: 13px;">'.$row['date_reg'].'</td>
                    <td>'.$butt.'</td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" style="float: left;" onclick="activateSeller('.$row['userid'].')">Activate</button> <button onclick="subadmindetails('.$row['userid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button></td>
                </tr>';
        }
    }

    //Get all products
    public function view_all_products(){

        $sql = 'SELECT * FROM product_details ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $userInfo = $this->userDetails($row['userid']);

            if($row['status']=='Active'){
                $butt = '<span class="badge badge-success">Active</span>';
                $btt = '<button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateProduct('.$row['productid'].', '.$userInfo->userid.')">Deactivate</button>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateProduct('.$row['productid'].', '.$userInfo->userid.')">Activate</button>
                        <button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateProduct('.$row['productid'].', '.$userInfo->userid.')">Deactivate</button>
                        ';
            }elseif($row['status']=='Inactive'){
                $butt = '<span class="badge badge-danger">Inactive</span>';
                $btt = '<button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateProduct('.$row['productid'].', '.$userInfo->userid.')">Activate</button>
                        <button class="mb-2 btn btn-shadow btn-info btn-sm">Reject</button>';
            }

            if($row['topCatSetting'] == 1){
                $checkers = 'Checked';
            }elseif($row['topCatSetting']==0){
                $checkers = '';
            }
            echo '<tr>
                    <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['product_title'].'</td>
                    <td>'.$row['product_category'].'</td>
                    <td>'.mb_substr(htmlspecialchars_decode($row['product_description']), 0, 30).'</td>
                    <td>'.$userInfo->username.'</td>
                    <td><input type="checkbox" data-toggle="toggle" onchange="return validate('.$row['productid'].')" id="productSetting" name="productSetting" data-size="mini" '.$checkers.'></td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$btt.'</td>
                </tr>';
        }
    }

    //Get all pending products
    public function view_pending_products(){

        $sql = 'SELECT * FROM product_details WHERE status="Pending" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $userInfo = $this->userDetails($row['userid']);

            if($row['status']=='Active'){
                $butt = '<span class="badge badge-success">Active</span>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']=="Inactive"){
                $butt = '<span class="badge badge-danger">Inactive</span>';
            }
            echo '<tr>
            <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['product_title'].'</td>
                    <td>'.$row['product_category'].'</td>
                    <td>'.mb_substr(htmlspecialchars_decode($row['product_description']), 0, 30).'</td>
                    <td>'.$userInfo->username.'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>
                        <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateProduct('.$row['productid'].', '.$userInfo->userid.')">Activate</button>
                        <button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateProduct('.$row['productid'].', '.$userInfo->userid.')">Deactivate</button>
                        <a href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" class="mb-2 btn btn-shadow btn-info btn-sm"><i class="fa fa-shopping-cart btn-icon-wrapper"></i></a></td>
                </tr>';
        }
    }

    //Get all active products
    public function view_active_products(){

        $sql = 'SELECT * FROM product_details WHERE status="Active" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $userInfo = $this->userDetails($row['userid']);

            if($row['status']=='Active'){
                $butt = '<span class="badge badge-success">Active</span>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']=="Inactive"){
                $butt = '<span class="badge badge-danger">Inactive</span>';
            }

            if($row['topCatSetting'] == 1){
                $checkers = 'Checked';
            }elseif($row['topCatSetting']==0){
                $checkers = '';
            }
            echo '<tr>
            <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['product_title'].'</td>
                    <td>'.$row['product_category'].'</td>
                    <td>'.mb_substr(htmlspecialchars_decode($row['product_description']), 0, 30).'</td>
                    <td>'.$userInfo->username.'</td>
                    <td><input type="checkbox" data-toggle="toggle" onchange="return validate('.$row['productid'].')" id="productSetting" name="productSetting" data-size="mini" '.$checkers.'></td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>
                        <button class="mb-2 btn btn-shadow btn-outline-danger btn-sm" onclick="deactivateProduct('.$row['productid'].', '.$userInfo->userid.')">
                        Deactivate</button>
                    </td>
                </tr>';
        }
    }

    //Get all active products
    public function view_inactive_products(){

        $sql = 'SELECT * FROM product_details WHERE status="Inactive" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $userInfo = $this->userDetails($row['userid']);

            if($row['status']=='Active'){
                $butt = '<span class="badge badge-success">Active</span>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']=="Inactive"){
                $butt = '<span class="badge badge-danger">Inactive</span>';
            }
            echo '<tr>
            <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['product_title'].'</td>
                    <td>'.$row['product_category'].'</td>
                    <td>'.mb_substr(htmlspecialchars_decode($row['product_description']), 0, 30).'</td>
                    <td>'.$userInfo->username.'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>
                        <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateProduct('.$row['productid'].', '.$userInfo->userid.')">
                        Activate</button>
                        </td>
                </tr>';
        }
    }
    public function view_pending_reviews(){

        $sql = 'SELECT * FROM submit_review_db ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
          $stm = $this->conn->prepare("SELECT * FROM product_details WHERE productid=:productid");
          $stm->bindValue(':productid', $row['productid']);

          $stm->execute();

          $product = $stm->fetch(PDO::FETCH_OBJ);
            $userInfo = $this->userDetails($row['userid']);
            $item = explode('+',$product->pack0);

            if($row['status']=='Approved'){
                $butt = '<span class="badge badge-success">Approved</span>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
            }elseif($row['status']=="Disapproved"){
                $butt = '<span class="badge badge-danger">Disapproved</span>';
            }
            echo '<tr>
                    <td>'.$product->productid.'</td>
                    <td>'.$product->product_title.'</td>
                    <td>'.$userInfo->username.'</td>
                    <td>'.$item[0].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$row['date_created'].'</td>
                    <td>
                        <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="approveReview('.$row['reviewid'].', '.$userInfo->userid.')">
                        Approve</button>
                        <button class="mb-2 btn btn-warning btn-sm" onclick="replyreview('.$row['id'].')">Read</button>
                        <button class="mb-2 btn btn-shadow btn-outline-danger btn-sm" onclick="disapprovedReview('.$row['reviewid'].', '.$userInfo->userid.')">Reject</button>
                    </td>
                </tr>';

                $reply ="";
                $name = $this->userDetails($_SESSION['userid']);
                // print_r($name->fname );

                $reply .='
                <div class="modal fade" id="reply_review'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reply reviewed message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="" method="post" id="result'.$row['id'].'">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Review By:</label>
                            <input type="text" class="form-control" id="recipient-name" value="'.$row['r_name'].'" readonly>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Review Message:</label>
                            <textarea class="form-control" id="message-text" readonly>'.$row['r_body'].'</textarea>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Rating:</label>';
                            for ($i=1; $i <=5; $i++) {
                              if ($i <= $row['rating']) {
                                $reply .='<i class="fa fa-star"></i>';
                              }else {
                                $reply .='<i class="fa fa-star-o"></i>';
                              }
                            }

                          $reply .='</div>
                          <div class="form-group">
                          <input type="hidden" id="rt'.$row['id'].'" name="rt'.$row['id'].'" value"'.$row['rating'].'" >
                          <input type="hidden" id="p'.$row['id'].'" name="product_id" value="'.$product->productid.'">
                          <input type="hidden" id="r'.$row['id'].'" name="reviewid" value="'.$row['reviewid'].'">
                          <input type="hidden" id="u'.$row['id'].'" name="user_id" value="'.$_SESSION['userid'].'">
                          <input type="hidden" id="n'.$row['id'].'" name="r_name" value="'.$name->fname .' '.$name->lname.'">
                          <input type="hidden" id="e'.$row['id'].'" name="r_email" value="'.$name->email.'">
                          <input type="hidden" id="t'.$row['id'].'" name="title" value="Admin">
                            <label for="message-text" class="col-form-label">Type Reply:</label>
                            <textarea id="reply'.$row['id'].'"class="form-control" name="r_body" id="message-text"></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="replyBtn'.$row['id'].'" onclick="SendReply('.$row['id'].')" class="btn btn-danger">Reply Review</button>
                      </div>
                    </div>
                  </div>
                </div>';
              echo $reply;

        }
    }

    public function activateSeller(){
        $query = "UPDATE users SET status=:status WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('userid', $this->userid);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'Account Approved' ;
            $this->body = 'Your account has been activate!';
            if ($this->userDetails($this->userid)->role == "Buyer") {

              $this->generatedlink = "#";
            }else{
              $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;

            }
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function deactivateSeller(){
        $query = "UPDATE users SET status=:status WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('userid', $this->userid);

        if($stmt->execute()){
            $userid = $this->userid;

            $this->userid = $this->userid;
            $this->title = 'Account Disapproved' ;
            $this->body = 'Your account has been Disapproved!';
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function activateProduct(){
        $query = "UPDATE product_details SET status=:status WHERE productid=:productid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->productid = htmlspecialchars(strip_tags($this->productid));
        $this->sellerid = htmlspecialchars(strip_tags($this->sellerid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('productid', $this->productid);

        if($stmt->execute()){
            $this->userid = $this->sellerid;
            $this->title = 'Product Approved' ;
            $this->body = 'Your product has been approved!';
            $this->generatedlink = BASE_URL."product_details.php?productid=".$this->productid;
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function update_order_status(){
        $query = "UPDATE order_tbl SET status=:status WHERE id=:orderid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->orderid = htmlspecialchars(strip_tags($this->orderid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('orderid', $this->orderid);

        if($stmt->execute()){
            $this->userid = $this->buyerid;
            $this->title = 'Order Status' ;
            $this->body = 'Your Order status has been changed to '.ucwords($this->status);
            $this->generatedlink = '#';
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function deactivateProduct(){
        $query = "UPDATE product_details SET status=:status WHERE productid=:productid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->productid = htmlspecialchars(strip_tags($this->productid));
        $this->sellerid = htmlspecialchars(strip_tags($this->sellerid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('productid', $this->productid);

        if($stmt->execute()){
            $this->userid = $this->sellerid;
            $this->title = 'Product Disapproved' ;
            $this->body = 'Your product has been disapproved!';
            $this->generatedlink = "#";
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function admin_payout_status($payid,$status)
    {
      $sql = "UPDATE payout_request SET status=:status  where id=:id";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('id', $payid);
      $stmt->bindValue('status', $status);

      if($stmt->execute()){
        $sql = "SELECT amount, userid FROM `payout_request` WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('id', $payid);
        $stmt->execute();
        $row = $stmt->fetch();
        print_r($row['userid']);
        $this->Addtowalletincome($row['userid'],$row['amount']);
        $this->RemoveFromAdmiwallet(1111,$row['amount']);
        return true;
      }
      printf("Error: %s.\n", $stmt->error);
      return false;
    }


    public function payout_request($userid,$amount,$accountname,$accountnumber,$description){

      $sql = "SELECT count(*) FROM payout_request WHERE userid=:userid AND status='Pending'";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindValue('userid', $userid);
      $stmt->execute();

      if ($stmt->fetchColumn() > 0) {
        return false;
      }else {


        $sql = "INSERT INTO payout_request SET userid=:userid, amount=:amount, status=:status, accountname=:accountname,
        accountnumber=:accountnumber, description=:description";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('userid', $userid);
        $stmt->bindValue('amount', $amount);
        $stmt->bindValue('accountname', $accountname);
        $stmt->bindValue('accountnumber', $accountnumber);
        $stmt->bindValue('description', $description);
        $stmt->bindValue('status', 'Pending');
        $stmt->execute();

        if($stmt->execute()){

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
  }

    public function deleteProduct(){
        // $query = "DELETE FROM product_details WHERE productid=:productid";

        $stmt = $this->conn->prepare($query);

        $this->productid = htmlspecialchars(strip_tags($this->productid));

        $stmt->bindValue('productid', $this->productid);

        if($stmt->execute()){

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    //approve review
    public function approveReview(){
        $query = "UPDATE submit_review_db SET status=:status WHERE reviewid=:reviewid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->reviewid = htmlspecialchars(strip_tags($this->reviewid));
        $this->sellerid = htmlspecialchars(strip_tags($this->sellerid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('reviewid', $this->reviewid);

        if($stmt->execute()){
            // $this->userid = $this->sellerid;
            // $this->title = 'Product Approved' ;
            // $this->body = 'Your product has been approved!';
            // $this->generatedlink = BASE_URL."product_details.php?productid=".$this->productid;
            // $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function disapprovedReview(){
        $query = "UPDATE submit_review_db SET status=:status WHERE reviewid=:reviewid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->reviewid = htmlspecialchars(strip_tags($this->reviewid));
        $this->sellerid = htmlspecialchars(strip_tags($this->sellerid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('reviewid', $this->reviewid);

        if($stmt->execute()){
            // $this->userid = $this->sellerid;
            // $this->title = 'Product Disapproved' ;
            // $this->body = 'Your product was not approved!';
            // $this->generatedlink = BASE_URL."product_details.php?productid=".$this->productid;
            // $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // create dispute
    public function create_dispute(){

        $query = "INSERT INTO disputetbl (disputeid,senderid,againstid,subject,priority,details_priority,file_name,status)
            VALUES (:disputeid,:senderid,:againstid,:subject,:priority,:details_priority,:file_name,:status)";

        $stmt = $this->conn->prepare($query);

        $this->disputeid = htmlspecialchars(strip_tags($this->disputeid));
        $this->senderid = htmlspecialchars(strip_tags($this->senderid));
        $this->againstid = htmlspecialchars(strip_tags($this->againstid));
        $this->subject = htmlspecialchars(strip_tags($this->subject));
        $this->priority = htmlspecialchars(strip_tags($this->priority));
        $this->details_priority = htmlspecialchars(strip_tags($this->details_priority));
        $this->file_name = htmlspecialchars(strip_tags($this->file_name));
        $this->status = htmlspecialchars(strip_tags($this->disputestatus));

        $stmt->bindValue('disputeid', $this->disputeid);
        $stmt->bindValue('senderid', $this->senderid);
        $stmt->bindValue('againstid', $this->againstid);
        $stmt->bindValue('subject', $this->subject);
        $stmt->bindValue('priority', $this->priority);
        $stmt->bindValue('details_priority', $this->details_priority);
        $stmt->bindValue('file_name', $this->file_name);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->senderid;
            $this->title = 'New Dispute Created!';
            $this->body = 'A new dispute has been created!';
            $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
            if($this->notifications()){
                $this->userid = $this->againstid;
                $this->title = 'A Dispute Ticket Against You!';
                $this->body = 'A dispute ticket has been created againt you, please respond to it before we take the legal actions!';
                $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
                $this->notifications();
            }

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //Get User dispute  List
    public function user_dispute_list($userid){
        $this->userid = $userid;
        $userRole = $this->userDetails($this->userid)->role;
        $sql = 'SELECT * FROM disputetbl WHERE senderid='.$this->userid.' OR againstid= '.$this->userid;
        foreach ($this->conn->query($sql) as $row) {
            $cnt = @$this->userDetails($row['senderid']);
            $cnt2 = @$this->userDetails($row['againstid']);
            if($row['againstid'] == $_SESSION['userid']){
                $this->againster = "Filed against You";
            }elseif($row['senderid'] == $_SESSION['userid']){
                $this->againster = "You filed against ".ucfirst(@$cnt2->username);
            }

            $this->timestamp = $row['created_at'];
            $this->splitTimeStamp = explode(" ",$this->timestamp);
            $this->date = $this->splitTimeStamp[0];
            $this->time = $this->splitTimeStamp[1];
            if($row['status']=='Resolved'){
                $butt = '<span class="badge badge-success">Resolved</span>';
                $btt = '<a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-outline-success btn-sm">View</a>
                        ';
            }elseif($row['status']=='Cancelled'){
                $butt = '<span class="badge badge-danger">Cancelled</span>';
                $btt = '<a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</i></a>';
            }elseif($row['status']=='In Progress'){
                $butt = '<span class="badge badge-info">In Progress</span>';
                $btt = '
                <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$cnt->userid.', '.$cnt2->userid.')">Resolved</button>
                <a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Reply</a>
                <button class="mb-2 btn btn-shadow btn-outline-warning btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$cnt->userid.', '.$cnt2->userid.')">Cancel</button>';
            }

            echo '<tr>
            <td><a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
            <td>'.@$cnt->username.'</td>
            <td>'.@$cnt2->username.'</td>
            <td>'.$row['subject'].'</td>
            <td>'.$result = mb_substr($row['priority'], 0, 50).'</td>
            <td>'.$row['created_at'].'</td>
            <td>'.$butt.'</td>
            <td>'.$btt.'</td>

                </tr>';
        }
    }

    public function user_dispute_status($userid, $status){
        $this->userid = $userid;
        // $sql = "SELECT * FROM disputetbl WHERE senderid=:senderid";
        $userRole = $this->userDetails($this->userid)->role;
        $stmt =  $this->conn->prepare('SELECT * FROM disputetbl WHERE (senderid=:senderid OR againstid=:senderid) and status =:status ');
        $stmt->execute(['senderid' => $userid,
        'status' =>$status ]);
        if ($status == "Cancelled" ) {
          $title = "List of Cancelled Disputes";
        }
        if ($status == "Resolved" ) {
          $title = "List of Resolved Disputes";
        }
        if ($status == "Pending" ) {
          $title = "List of Pending Disputes";
        }
        if ($status == "In Progress" ) {
          $title = "List of Dispute In Progress";
        }
        echo '
        <div class="container">
            <div class="row m-5">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="heading heading-2 text-center mb-70">
                        <h2 class="heading--title">'.$title.'</h2>
                    </div>
                    <div id="result"></div>
                </div>
            </div>
        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
          <thead>
        <tr>
        <th>Dispute ID</th>
        <th>Complainant</th>
        <th>Against</th>
        <th>Subject</th>
        <th>Priority</th>
        <th>Date Added</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>';
// die(var_dump($userRole));
        while ($row = $stmt->fetch()) {
            $cnt = $this->userDetails($row['senderid']);
            $cnt2 = $this->userDetails($row['againstid']);
            if($row['againstid'] == $_SESSION['userid']){
                $this->againster = "Filed against You";
            }elseif($row['senderid'] == $_SESSION['userid']){
                $this->againster = "You filed against ".ucfirst($cnt2->username);
            }

            $this->timestamp = $row['created_at'];
            $this->splitTimeStamp = explode(" ",$this->timestamp);
            $this->date = $this->splitTimeStamp[0];
            $this->time = $this->splitTimeStamp[1];
            if($row['status']=='Resolved'){
                $butt = '<span class="badge badge-success">Resolved</span>';
                $btt = '<a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-outline-success btn-sm">View</a>
                        ';
            }elseif($row['status']=='Cancelled'){
                $butt = '<span class="badge badge-danger">Cancelled</span>';
                $btt = '<a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</i></a>';
            }elseif($row['status']=='In Progress'){
                $butt = '<span class="badge badge-info">In Progress</span>';
                $btt = '
                <a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Reply</a>
                <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$cnt->userid.', '.$cnt2->userid.')">Resolved</button>
                <button class="mb-2 btn btn-shadow btn-outline-warning btn-sm" onclick="cancelledDispute('.$row['disputeid'].', '.$cnt->userid.', '.$cnt2->userid.')">Cancel</button>';
            }

            echo '<tr>
            <td><a href="'.BASE_URL.strtolower($userRole).'/dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
            <td>'.$cnt->username.'</td>
            <td>'.$cnt2->username.'</td>
            <td>'.$row['subject'].'</td>
            <td>'.$result = mb_substr($row['priority'], 0, 50).'</td>
            <td>'.$row['created_at'].'</td>
            <td>'.$butt.'</td>
            <td>'.$btt.'</td>

                </tr>';

        }

        echo '  </tbody>
      </table></div></div>';
      return;
    }

    // message count
    public function message_count($userid, $ss){
        $this->userid = $userid;
        if ($ss == 'inbox') {
            $sql = "SELECT count(*) FROM `message_seller_pd` WHERE (receiverid=:userid) AND status='Approved'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue('userid', $userid);
        }
        if ($ss == 'sent') {
            $sql = "SELECT count(*) FROM `message_seller_pd` WHERE (userid=:userid) AND status='Approved'";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue('userid', $userid);
        }
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            // echo $number_of_rows;
            return $number_of_rows;
            // return;
        }
    }
    // dispute count
    public function dispute_count($userid, $ss){
        $this->userid = $userid;
        $this->ss = ucfirst($ss);
        $sql = "SELECT count(*) FROM `disputetbl` WHERE (senderid=:userid OR againstid=:userid) AND status=:status";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('userid', $userid);
        $stmt->bindValue('status', $ss);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            echo $number_of_rows;
            return;
            // return;
        }


        // $result = $con->prepare($sql);
        // $result->execute();
        // $number_of_rows = $result->fetchColumn();
    }

    //Get all products
    public function view_all_dispute(){

        $sql = 'SELECT * FROM disputetbl ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $senderid = $this->userDetails($row['senderid']);
            $againstid = $this->userDetails($row['againstid']);

            if($row['status']=='Resolved'){
                $butt = '<span class="badge badge-success">Resolved</span>';
                $btt = '<a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a>';
            }elseif($row['status']=="Pending"){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-outline-success btn-sm">View</a>
                        ';
            }elseif($row['status']=='Cancelled'){
                $butt = '<span class="badge badge-danger">Cancelled</span>';
                $btt = '<a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-outline-success btn-sm">View</a>';
            }elseif($row['status']=='In Progress'){
                $butt = '<span class="badge badge-info">In Progress</span>';
                $btt = '
                <a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Reply</a>
                <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Resolved</button>
                <button class="mb-2 btn btn-shadow btn-outline-warning btn-sm" onclick="cancelledDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Cancel</button>';
            }
            echo '<tr>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
                    <td>'.$senderid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replySender('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$againstid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replyAgainst('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['priority'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$btt.'</td>
                </tr>';
        }
    }

    //Get all products
    public function view_resolved_dispute(){

        $sql = 'SELECT * FROM disputetbl WHERE status="Resolved" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $senderid = $this->userDetails($row['senderid']);
            $againstid = $this->userDetails($row['againstid']);

            echo '<tr>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
                    <td>'.$senderid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replySender('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$againstid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replyAgainst('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['priority'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td><span class="badge badge-success">Resolved</span></td>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a></td>
                </tr>';
        }
    }

    public function view_inprogress_dispute(){

        $sql = 'SELECT * FROM disputetbl WHERE status="In Progress" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $senderid = $this->userDetails($row['senderid']);
            $againstid = $this->userDetails($row['againstid']);

            echo '<tr>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
                    <td>'.$senderid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replySender('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$againstid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replyAgainst('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['priority'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td><span class="badge badge-info">In Progress</span></td>
                    <td><button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Activate</button><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a></td>
                </tr>';
        }
    }

    public function view_public_dispute(){

        $sql = 'SELECT * FROM public_dispute ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $senderid = $this->userDetails($row['senderid']);
            $againstid = $this->userDetails($row['againstid']);

            echo '<tr>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
                    <td>'.$senderid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replySender('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$againstid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replyAgainst('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['priority'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td><button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Activate</button>
                    <button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="cancelledDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Deactivate</button>
                    <a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a></td>
                </tr>';
        }
    }
    public function view_pending_dispute(){

        $sql = 'SELECT * FROM disputetbl WHERE status="Pending" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $senderid = $this->userDetails($row['senderid']);
            $againstid = $this->userDetails($row['againstid']);

            echo '<tr>
                    <td><a href="'.BASE_URL.'admin/dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
                    <td>'.$senderid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replySender('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$againstid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replyAgainst('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['priority'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td>
                    <a href="'.BASE_URL.'admin/dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a>
                    <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="resolvedDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Resolved</button>
                    <button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="cancelledDispute('.$row['disputeid'].', '.$senderid->userid.', '.$againstid->userid.')">Cancel</button>
                    </td>
                </tr>';
        }
    }
    public function view_pending_payout(){

        $sql = 'SELECT * FROM payout_request WHERE status="Pending" ORDER BY id';
        $output ="";
        foreach ($this->conn->query($sql) as $row) {

            // $senderid = $this->userDetails($row['senderid']);
// totaluserWalletIncome($row['userid'])
          // $payout = $this->totaluserPayout($row['userid']);
          // $balance = $this->totaluserSales($row['userid']);
            $output .= '<tr>
                    <td>'.$row['userid'].'</td>
                    <td>'.$row['amount'].'</td>
                    <td>'.$row['accountname'].'</td>
                    <td>'.$row['accountnumber'].'</td>
                    <td>'.$row['description'].'</td>
                    <td>
                    <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="PayoutStatus('.$row['id'].', '.'`'.'Approved'.'`'.')">Resolved</button>
                    <button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="PayoutStatus('.$row['id'].','.'`'.'Disapproved'.'`'.')">Cancel</button>
                    </td>
                </tr>';
        }
        print($output);
    }

    public function view_cancelled_dispute(){

        $sql = 'SELECT * FROM disputetbl WHERE status="Cancelled" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $senderid = $this->userDetails($row['senderid']);
            $againstid = $this->userDetails($row['againstid']);

            echo '<tr>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'">'.$row['disputeid'].'</a></td>
                    <td>'.$senderid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replySender('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$againstid->username.'<button type="button" class="btn btn-shadow btn-outline-info btn-sm" onclick="replyAgainst('.$row['disputeid'].', '.$row['senderid'].', '.$row['againstid'].', this.id)" id="'.$senderid->username.'-'.$againstid->username.'"> <i class="fa fa-reply"></i></button></td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['priority'].'</td>
                    <td>'.$row['created_at'].'</td>
                    <td><span class="badge badge-danger">Cancelled</span></td>
                    <td><a href="'.BASE_URL.'dispute_details.php?disputeid='.$row['disputeid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">View</a></td>
                </tr>';
        }
    }

    //process dispute
    public function processDispute(){

        $query = "INSERT INTO disputeresponse (disputeid,senderid,againstid,messageby,responsemessage)
                VALUES (:disputeid,:senderid,:againstid,:messageby,:responsemessage)";

        $stmt = $this->conn->prepare($query);

        $this->disputeid = htmlspecialchars(strip_tags($this->disputeid));
        $this->senderid = htmlspecialchars(strip_tags($this->senderid));
        $this->againstid = htmlspecialchars(strip_tags($this->againstid));
        $this->messageby = htmlspecialchars(strip_tags($this->messageby));
        $this->dispute_message = htmlspecialchars(strip_tags($this->dispute_message));

        $stmt->bindValue('disputeid', $this->disputeid);
        $stmt->bindValue('senderid', $this->senderid);
        $stmt->bindValue('againstid', $this->againstid);
        $stmt->bindValue('messageby', $this->messageby);
        $stmt->bindValue('responsemessage', $this->dispute_message);

        if($stmt->execute()){
            if($this->updateDisputeStatus($this->disputeid, $this->status)){
                $this->userid = $this->senderid;
                $this->title = 'RE: Your Dispute Ticket Response';
                $this->body = 'You got a response from the dispute ticket u created!';
                $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
                if($this->notifications()){
                    $this->userid = $this->againstid;
                    $this->title = 'RE: Dispute Response Against You';
                    $this->body = 'A dispute ticket has been opened against you!';
                    $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
                    $this->notifications();
                    return true;
                }
            }

        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //process dispute
    public function processDisputeUser(){

        $query = "INSERT INTO disputeresponse (disputeid,senderid,againstid,messageby,responsemessage)
                VALUES (:disputeid,:senderid,:againstid,:messageby,:responsemessage)";

        $stmt = $this->conn->prepare($query);

        $this->disputeid = htmlspecialchars(strip_tags($this->disputeid));
        $this->senderid = htmlspecialchars(strip_tags($this->senderid));
        $this->againstid = htmlspecialchars(strip_tags($this->againstid));
        $this->messageby = htmlspecialchars(strip_tags($this->messageby));
        $this->dispute_message = htmlspecialchars(strip_tags($this->dispute_message));

        $stmt->bindValue('disputeid', $this->disputeid);
        $stmt->bindValue('senderid', $this->senderid);
        $stmt->bindValue('againstid', $this->againstid);
        $stmt->bindValue('messageby', $this->messageby);
        $stmt->bindValue('responsemessage', $this->dispute_message);

        if($stmt->execute()){
          $this->updateDisputeStatus($this->disputeid, "In Progress");
            $this->userid = $this->senderid;
            $this->title = 'RE: Your Dispute Ticket Response';
            $this->body = 'You got a response from the dispute ticket u created!';
            $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
            if($this->notifications()){
                $this->userid = $this->againstid;
                $this->title = 'RE: Dispute Response Against You';
                $this->body = 'A dispute ticket has been opened against you!';
                $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
                $this->notifications();
                return true;
            }

        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //Update dispute status
    public function updateDisputeStatus($disputeid, $status){
        $this->disputeid = $disputeid;
        $this->status = $status;

        $query = "UPDATE disputetbl SET status=:status WHERE disputeid=:disputeid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->disputeid = htmlspecialchars(strip_tags($this->disputeid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('disputeid', $this->disputeid);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    //Update message status
    public function updateMessageStatus($messid, $status){
        $this->messid = $messid;
        $this->status = $status;

        $query = "UPDATE message_seller_pd SET status=:status WHERE messid=:messid";

        $stmt = $this->conn->prepare($query);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->messid = htmlspecialchars(strip_tags($this->messid));

        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('messid', $this->messid);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function readProfilePixController($userid){
        $query = "SELECT * FROM profilepic WHERE userid = :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('userid', $userid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $user = @$this->userDetails($userid);


                if (!empty($row)) {

                  if ($row == true) {
                    if (@$user->role == "Admin") {
                      return BASE_URL."admin/profilepicture/".$userid."/".$row['file_name'];
                    }
                    if (@$user->role == "Buyer") {
                      return BASE_URL."buyer/profilepicture/".$userid."/".$row['file_name'];
                    }
                    if (@$user->role == "Seller") {
                      return BASE_URL."seller/profilepicture/".$userid."/".$row['file_name'];
                    }
                    if (@$user->role == "International") {
                      return BASE_URL."international/profilepicture/".$userid."/".$row['file_name'];
                    }
                    if (@$user->role == "Sub Admin") {
                      return BASE_URL."admin/profilepicture/".$userid."/".$row['file_name'];
                    }

                  }else {
                    return "../images/avatars/avatar.jpg";
                  }
                  // code...
                }else {
                  return "../images/avatars/avatar.jpg";
                }

    }
    public function profilepic_link($userid){
        $query = "SELECT * FROM profilepic WHERE userid = :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('userid', $userid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = $this->userDetails($userid);


        if (!empty($row)) {

          if ($row == true) {
            if ($user->role == "Admin") {
              return BASE_URL."admin/profilepicture/".$row['file_name'];
            }
            if ($user->role == "Buyer") {
              return BASE_URL."buyer/profilepicture/".$row['file_name'];
            }
            if ($user->role == "Seller") {
              return BASE_URL."seller/profilepicture/".$row['file_name'];
            }
            if ($user->role == "International") {
              return BASE_URL."international/profilepicture/".$row['file_name'];
            }
            if ($user->role == "Sub Admin") {
              return BASE_URL."admin/profilepicture/".$row['file_name'];
            }

          }else {
            return false;
          }
          // code...
        }else {
          return false;
        }

    }

    public function disputeinvolver($disputeid){
        $stmt = $this->conn->prepare("SELECT * FROM disputetbl WHERE disputeid=:disputeid");
        $stmt->bindParam("disputeid", $disputeid, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ); //User data

        $senderDetails = $this->userDetails($data->senderid);
        $againstDetails = $this->userDetails($data->againstid);

        echo '<li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-secondary badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="images/avatars/avatar.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-subheading">Super Admin</div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>';

            echo '<li class="nav-item">
                    <button type="button" tabindex="0" class="dropdown-item">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left mr-3">
                                    <div class="avatar-icon-wrapper">
                                        <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                        <div class="avatar-icon"><img src="'.@$this->readProfilePixController($senderDetails->userid).'"width="50" height="50" class="rounded-circle" alt="Profile Picture"></div>
                                    </div>
                                </div>
                                <div class="widget-content-left">
                                    <div class="widget-subheading">'.@$senderDetails->username.'</div>
                                </div>
                            </div>
                        </div>
                    </button>
                </li>';

            echo '<li class="nav-item">
                        <button type="button" tabindex="0" class="dropdown-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3">
                                        <div class="avatar-icon-wrapper">
                                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                                            <div class="avatar-icon"><img src="'.@$this->readProfilePixController($againstDetails->userid).'"width="50" height="50" class="rounded-circle" alt="Profile Picture"></div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-subheading">'.@$againstDetails->username.'</div>
                                    </div>
                                </div>
                            </div>
                        </button>
                    </li>';
    }
    public function dispute_users($disputeid){
        $stmt = $this->conn->prepare("SELECT * FROM disputetbl WHERE disputeid=:disputeid");
        $stmt->bindParam("disputeid", $disputeid, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        return $data;
      }
    public function disputeMessages($disputeid){
        $stmt = $this->conn->prepare("SELECT * FROM disputetbl WHERE disputeid=:disputeid");
        $stmt->bindParam("disputeid", $disputeid, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);

        $senderDetails = $this->userDetails($data->senderid);
        $againstDetails = $this->userDetails($data->againstid);


        echo '<div class="chat-box-wrapper">
                <div>
                    <div class="avatar-icon-wrapper mr-1">
                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                        <div class="avatar-icon avatar-icon-lg rounded">
                        <img src="'.@$this->readProfilePixController($senderDetails->userid).'"width="50" height="50" class="rounded-circle" alt="Profile Picture">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="chat-box bg-success text-white">'.$data->details_priority.'</div>
                </div>
            </div>
            <small class="opacity-6 float-right pr-4" style="margin-top: -20px;"><i class="fa fa-calendar-alt mr-1"></i> '.$data->created_at.'</small>
            <div class="divider"></div>';
        @$this->viewAllDispute(@$disputeid, @$senderDetails->userid, @$againstDetails->userid);
    }

    //Get User dispute  List
    public function viewAllDispute($disputeid, $senderid, $againstid){
        $this->disputeid = $disputeid;
        $sql = 'SELECT * FROM disputeresponse WHERE disputeid='.$this->disputeid.' ORDER BY created_at ASC';
        foreach ($this->conn->query($sql) as $row) {
            if($row['messageby'] == 1111){
                // $this->positiondis = '';
                $this->backgrounddis = 'bg-secondary';
                $this->imager = '<img src="images/avatars/avatar.jpg" alt="">';

            }elseif($row['messageby'] == $senderid){
                // $this->positiondis = '';
                $this->backgrounddis = 'bg-success';
                $this->imager = '<img src="'.@$this->readProfilePixController($senderid).'"width="50" height="50" class="rounded-circle" alt="Profile Picture">';
            }elseif($row['messageby'] == $againstid){
                // $this->positiondis = 'float-right';
                $this->backgrounddis = 'bg-danger';
                $this->imager = '<img src="'.@$this->readProfilePixController($againstid).'"width="50" height="50" class="rounded-circle" alt="Profile Picture">';
            }
            if ($_SESSION['userid'] == $row['messageby']) {
              $this->positiondis = 'float-right';
              echo "

                    <div class='chat-box-wrapper chat-box-wrapper-right float-right'>
                        <div>
                            <div class='chat-box'>".$row['responsemessage']."
                            </div>
                            <small class='opacity-6'>
                                <i class='fa fa-calendar-alt mr-1'></i>
                                ".$row['created_at']."</small>
                            </small>
                        </div>
                        <div>
                            <div class='avatar-icon-wrapper ml-1'>
                                <div class='badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg'></div>
                                <div class='avatar-icon avatar-icon-lg rounded'>".$this->imager."'
                                        alt=''></div>
                            </div>
                        </div>
                    </div>
                ";
            }else {
              $this->positiondis = '';
              echo '<div class="chat-box-wrapper '.$this->positiondis.'">
                      <div>
                          <div class="avatar-icon-wrapper mr-1">
                              <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                              <div class="avatar-icon avatar-icon-lg rounded">
                              '.$this->imager.'
                              </div>
                          </div>
                      </div>
                      <div>
                          <div class="chat-box '.$this->backgrounddis.' text-white">'.$row['responsemessage'].'</div>
                          <small class="opacity-6 float-right pr-4" ><i class="fa fa-calendar-alt mr-1"></i> '.$row['created_at'].'</small>
                      </div>
                  </div>';
            }

        }
    }

    //Check if username exit;
    public function isAgentExist(){
        $query = "SELECT * FROM agents WHERE agentemail=:agentemail";
        $stmt = $this->conn->prepare($query);
        $this->agentemail = htmlspecialchars(strip_tags($this->agentemail));
        $stmt->bindValue(':agentemail', $this->agentemail);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    //Create new agent
    public function create_agent(){

        $query = "INSERT INTO agents (agentid,agentfname,agentlname,agentphone,agentemail,agentaddress,agentstate,agentcountry,agentstatus,agentfile_name,agentpic_name)
        VALUES (:agentid,:agentfname,:agentlname,:agentphone,:agentemail,:agentaddress,:agentstate,:agentcountry,:agentstatus,:agentfile_name,:agentpic_name)";

        $stmt = $this->conn->prepare($query);

        $this->agentid = htmlspecialchars(strip_tags($this->agentid));
        $this->agentfname = htmlspecialchars(strip_tags($this->agentfname));
        $this->agentlname = htmlspecialchars(strip_tags($this->agentlname));
        $this->agentphone = htmlspecialchars(strip_tags($this->agentphone));
        $this->agentemail = htmlspecialchars(strip_tags($this->agentemail));
        $this->agentaddress = htmlspecialchars(strip_tags($this->agentaddress));
        $this->agentstate = htmlspecialchars(strip_tags($this->agentstate));
        $this->agentcountry = htmlspecialchars(strip_tags($this->agentcountry));
        $this->agentstatus = htmlspecialchars(strip_tags($this->agentstatus));
        $this->agentfile_name = htmlspecialchars(strip_tags($this->agentfile_name));
        $this->agentpic_name = htmlspecialchars(strip_tags($this->agentpic_name));

        $stmt->bindValue('agentid', $this->agentid);
        $stmt->bindValue('agentfname', $this->agentfname);
        $stmt->bindValue('agentlname', $this->agentlname);
        $stmt->bindValue('agentphone', $this->agentphone);
        $stmt->bindValue('agentemail', $this->agentemail);
        $stmt->bindValue('agentaddress', $this->agentaddress);
        $stmt->bindValue('agentstate', $this->agentstate);
        $stmt->bindValue('agentcountry', $this->agentcountry);
        $stmt->bindValue('agentstatus', $this->agentstatus);
        $stmt->bindValue('agentfile_name', $this->agentfile_name);
        $stmt->bindValue('agentpic_name', $this->agentpic_name);

        if($stmt->execute()){
            $this->agentid = $this->agentid;
            $this->title = "New Agent Created";
            $this->body = "A new agent has been created!";
            $this->generatedlink = "agent_details.php?sellerid=".$this->agentid;
            // $this->sendAgentEmail($this->agentemail);
            $this->notifications();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function update_agent(){

        $query = "UPDATE agents SET agentfname=:agentfname,agentlname=:agentlname,agentphone=:agentphone,
        agentemail=:agentemail,agentaddress=:agentaddress,agentstate=:agentstate,agentcountry=:agentcountry
        WHERE agentid=:agentid";

        $stmt = $this->conn->prepare($query);

        $this->agentid = htmlspecialchars(strip_tags($this->agentid));
        $this->agentfname = htmlspecialchars(strip_tags($this->agentfname));
        $this->agentlname = htmlspecialchars(strip_tags($this->agentlname));
        $this->agentphone = htmlspecialchars(strip_tags($this->agentphone));
        $this->agentemail = htmlspecialchars(strip_tags($this->agentemail));
        $this->agentaddress = htmlspecialchars(strip_tags($this->agentaddress));
        $this->agentstate = htmlspecialchars(strip_tags($this->agentstate));
        $this->agentcountry = htmlspecialchars(strip_tags($this->agentcountry));

        $stmt->bindValue('agentid', $this->agentid);
        $stmt->bindValue('agentfname', $this->agentfname);
        $stmt->bindValue('agentlname', $this->agentlname);
        $stmt->bindValue('agentphone', $this->agentphone);
        $stmt->bindValue('agentemail', $this->agentemail);
        $stmt->bindValue('agentaddress', $this->agentaddress);
        $stmt->bindValue('agentstate', $this->agentstate);
        $stmt->bindValue('agentcountry', $this->agentcountry);

        if($stmt->execute()){
            $this->agentid = $this->agentid;
            $this->title = "Agent Details updated";
            $this->body = "Agent data has been updated!";
            $this->generatedlink = "agent_details.php?sellerid=".$this->agentid;
            // $this->sendAgentEmail($this->agentemail);
            $this->notifications();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    private function sendAgentEmail($email){
        $pdo = $this->conn;
        $stmt = $pdo->prepare('SELECT * FROM agents WHERE agentemail = ? limit 1');
        $stmt->execute([$email]);
        $code = $stmt->fetch();

        $subject = 'Confirm your registration';
        $message = 'You have register with Ojarh.com to become an agent. This is your Agent ID: ' . $code['agentid'] . '. You will get a notification when you have been accessed and verified.<br>thanks for joining Ojarh.com.';
        $headers = 'X-Mailer: PHP/' . phpversion();

        if (mail($email, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    //Get all active seller
    public function view_verified_agents(){
        // $sql = 'SELECT * FROM agents WHERE agentstatus="Inactive"';
        $sql = "SELECT count(*) FROM agents WHERE agentstatus = 'Activate'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM agents WHERE agentstatus="Activate"';
            foreach ($this->conn->query($sql) as $row) {
                if(count($row) < 1){
                    echo 'No agent registered yet!';
                    return;
                }
                if($row['agentstatus']=='Activate'){
                    $butt = '<span class="badge badge-success">Active</span>';
                }elseif($row['agentstatus']=='Pending'){
                    $butt = '<span class="badge badge-warning">Pending</span>';
                }elseif($row['agentstatus']=='Inactive'){
                    $butt = '<span class="badge badge-danger">Inactive</span>';
                }
                echo '<div class="collect col-md-3 mt-3">
                            <div class="collection-item">
                                <div style="height: 260px; width: 100%; background-image: url(agentprofilepic/'.$row['agentid'].'/'.$row['agentpic_name'].'); background-size: cover;"></div>
                                <img style="width: 70px !important; position: absolute; top: 0; right: 0; margin-right: 15px; opacity: 1;" src="'.BASE_URL.'assets/images/verified.png" class="img-icon"/>
                                <div style="background-color:rgba(50, 50, 50, 0.8); color: #ffffff; border-radius: 3px; padding: 5px; width: auto !important; position: absolute; top: 0; left: 0; margin-left: 15px; opacity: 1;"><strong># '.$row['agentid']. '</strong></div>
                                <div class="collection-name">
                                    <h6>Name: '.$row['agentlname']. ' ' .$row['agentfname'].'</h6>
                                    <h6>Phone: '.$row['agentphone']. '</h6>
                                    <h6>Email: '.$row['agentemail']. '</h6>
                                    <button class="btn btn-danger btn-sm" onclick="agentDetails('.$row['agentid'].')">Agent ID</button>
                                </div>
                            </div>
                        </div>';
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    /* single agent details */
    public function single_agent_details($agentid){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM agents WHERE agentid=:agentid");
            $stmt->bindParam("agentid", $agentid, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function imageCrop(){
        $image = imagecreatefromjpeg($_GET['src']);
        $filename = 'images/cropped_whatever.jpg';

        $thumb_width = 200;
        $thumb_height = 150;

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect )
        {
        // If image is wider than thumbnail (in aspect ratio sense)
        $new_height = $thumb_height;
        $new_width = $width / ($height / $thumb_height);
        }
        else
        {
        // If the thumbnail is wider than the image
        $new_width = $thumb_width;
        $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

        // Resize and crop
        imagecopyresampled($thumb,
                        $image,
                        0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
        imagejpeg($thumb, $filename, 80);
    }

    //Get all agents
    public function view_all_agents(){

        $sql = 'SELECT * FROM agents ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            if($row['agentstatus']=='Activate'){
                $butt = '<span class="badge badge-success">Active</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateAgent('.$row['agentid'].')">Deactivate</button>
                        <button onclick="agentdetails('.$row['agentid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>';
            }elseif($row['agentstatus']=='Pending'){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateAgent('.$row['agentid'].')" style="float: left;">Activate</button>
                        <button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateAgent('.$row['agentid'].')">Deactivate</button>
                        <button onclick="agentdetails('.$row['agentid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>';
            }elseif($row['agentstatus']=='Inactive'){
                $butt = '<span class="badge badge-danger">Inactive</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-success btn-sm" onclick="activateAgent('.$row['agentid'].')">Activate</button>
                        <button onclick="agentdetails('.$row['agentid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</button>';
            }
            echo '<tr>
                    <td>'.$row['agentid'].'</td>
                    <td>'.$row['agentlname'].' '.$row['agentfname'].'</td>
                    <td>'.$row['agentemail'].'</td>
                    <td>'.$row['agentphone'].'</td>
                    <td>'.ucfirst($row['agentaddress']).', '.ucfirst($row['agentstate']).', '.ucfirst($row['agentcountry']).'</td>
                    <td style="font-size: 13px;">'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$btt.'</td>
                </tr>';
        }
    }

    //Get all active agents
    public function view_all_active_agents(){

        $sql = 'SELECT * FROM agents WHERE agentstatus="Activate" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<tr>
                    <td>'.$row['agentid'].'</td>
                    <td>'.$row['agentlname'].' '.$row['agentfname'].'</td>
                    <td>'.$row['agentemail'].'</td>
                    <td>'.$row['agentphone'].'</td>
                    <td>'.ucfirst($row['agentaddress']).', '.ucfirst($row['agentstate']).', '.ucfirst($row['agentcountry']).'</td>
                    <td style="font-size: 13px;">'.$row['created_at'].'</td>
                    <td><span class="badge badge-success">Active</span></td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateAgent('.$row['agentid'].')">Deactivate</button>
                    <button onclick="agentdetails('.$row['agentid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a></td>
                </tr>';
        }
    }

    //Get all deactivated agents
    public function view_all_inactive_agents(){

        $sql = 'SELECT * FROM agents WHERE agentstatus="Inactive" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<tr>
                    <td>'.$row['agentid'].'</td>
                    <td>'.$row['agentlname'].' '.$row['agentfname'].'</td>
                    <td>'.$row['agentemail'].'</td>
                    <td>'.$row['agentphone'].'</td>
                    <td>'.ucfirst($row['agentaddress']).', '.ucfirst($row['agentstate']).', '.ucfirst($row['agentcountry']).'</td>
                    <td style="font-size: 13px;">'.$row['created_at'].'</td>
                    <td><span class="badge badge-danger">Inactive</span></td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-success btn-sm" onclick="activateAgent('.$row['agentid'].')">Activate</button>
                    <button onclick="agentdetails('.$row['agentid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a></td>
                </tr>';
        }
    }

    //Get all pending agents
    public function view_all_pending_agents(){

        $sql = 'SELECT * FROM agents WHERE agentstatus="Pending" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            echo '<tr>
                    <td>'.$row['agentid'].'</td>
                    <td>'.$row['agentlname'].' '.$row['agentfname'].'</td>
                    <td>'.$row['agentemail'].'</td>
                    <td>'.$row['agentphone'].'</td>
                    <td>'.ucfirst($row['agentaddress']).', '.ucfirst($row['agentstate']).', '.ucfirst($row['agentcountry']).'</td>
                    <td style="font-size: 13px;">'.$row['created_at'].'</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateAgent('.$row['agentid'].')" style="float: left;">Activate</button>
                    <button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateAgent('.$row['agentid'].')">Deactivate</button>
                    <button onclick="agentdetails('.$row['agentid'].')" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a></td>
                </tr>';
        }
    }

    public function activateAgent(){
        $query = "UPDATE agents SET agentstatus=:status WHERE agentid=:agentid";
        $stmt = $this->conn->prepare($query);
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->agentid = htmlspecialchars(strip_tags($this->agentid));
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('agentid', $this->agentid);
        if($stmt->execute()){
            $this->userid = $this->agentid;
            $this->title = 'Agent Activated' ;
            $this->body = 'Your account has been activated!';
            $this->generatedlink = "agent_details.php?agentid=".$this->agentid;
            // $this->agentActivationEmailSender($this->agentid);
            $this->notifications();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function deactivateAgent(){
        $query = "UPDATE agents SET agentstatus=:status WHERE agentid=:agentid";
        $stmt = $this->conn->prepare($query);
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->agentid = htmlspecialchars(strip_tags($this->agentid));
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('agentid', $this->agentid);
        if($stmt->execute()){
            $this->userid = $this->agentid;
            $this->title = 'Agent Deactivated' ;
            $this->body = 'Your account has been deactivated!';
            $this->generatedlink = "agent_details.php?agentid=".$this->agentid;
            // $this->agentDeactivationEmailSender($this->agentid);
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    private function agentActivationEmailSender($agentid){
        $pdo = $this->conn;
        $stmt = $pdo->prepare('SELECT * FROM agents WHERE agentid = ? limit 1');
        $stmt->execute([$agentid]);
        $code = $stmt->fetch();

        $this->email = $code['agentemail'];

        $subject = 'Confirm your registration';
        $message = 'You have register with Ojarh.com to become an agent. This is your Agent ID: ' . $code['agentid'] . '. You will get a notification when you have been accessed and verified.<br>thanks for joining Ojarh.com.';
        $headers = 'X-Mailer: PHP/' . phpversion();

        if (mail($this->email, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    private function agentDeactivationEmailSender($agentid){
        $pdo = $this->conn;
        $stmt = $pdo->prepare('SELECT * FROM agents WHERE agentid = ? limit 1');
        $stmt->execute([$agentid]);
        $code = $stmt->fetch();

        $this->email = $code['agentemail'];

        $subject = 'Confirm your registration';
        $message = 'You have register with Ojarh.com to become an agent. This is your Agent ID: ' . $code['agentid'] . '. You will get a notification when you have been accessed and verified.<br>thanks for joining Ojarh.com.';
        $headers = 'X-Mailer: PHP/' . phpversion();

        if (mail($this->email, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    //Check if verification exit;
    public function isVerifyExist(){
        $query = "SELECT * FROM verification WHERE userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $stmt->bindValue(':userid', $this->userid);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    public function submit_verify(){

        $this->t_product = 0;

        $query = "INSERT INTO verification (verifyid,userid,documenttype,verifyfile,verifystatus)
            VALUES (:verifyid,:userid,:documenttype,:verifyfile,:verifystatus)";

        $stmt = $this->conn->prepare($query);

        $this->verifyid = htmlspecialchars(strip_tags($this->verifyid));
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $this->documenttype = htmlspecialchars(strip_tags($this->verificationtype));
        $this->verifyfile = htmlspecialchars(strip_tags($this->file_name));
        $this->verifystatus = htmlspecialchars(strip_tags($this->verifystatus));

        $stmt->bindValue('verifyid', $this->verifyid);
        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('documenttype', $this->documenttype);
        $stmt->bindValue('verifyfile', $this->verifyfile);
        $stmt->bindValue('verifystatus', $this->verifystatus);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'Seller Verification' ;
            $this->body = 'A seller just submitted a ticket for verification!';
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            $this->notifications();
            return true;
        }else{
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    //Get all agents
    public function view_all_verification(){

        $sql = 'SELECT * FROM verification ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

            $userInfo = $this->userDetails($row['userid']);

            if($row['verifystatus']=='Activate'){
                $butt = '<span class="badge badge-success">Verified</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateVerify('.$row['verifyid'].', '.$row['userid'].')">Disapprove</button>
                        <a href="'.BASE_URL.'seller_details.php?userid='.$row['userid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a>';
            }elseif($row['verifystatus']=='Pending'){
                $butt = '<span class="badge badge-warning">Pending</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateVerify('.$row['verifyid'].', '.$row['userid'].')" style="float: left;">Approve</button>
                        <button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateVerify('.$row['verifyid'].', '.$row['userid'].')">Disapprove</button>
                        <a href="'.BASE_URL.'seller_details.php?userid='.$row['userid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a>';
            }elseif($row['verifystatus']=='Deactivate'){
                $butt = '<span class="badge badge-danger">Not Verified</span>';
                $btt = '<button class="mb-2 mr-2 btn btn-shadow btn-success btn-sm" onclick="activateVerify('.$row['verifyid'].', '.$row['userid'].')">Approve</button>
                        <a href="'.BASE_URL.'seller_details.php?userid='.$row['userid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a>';
            }
            echo '<tr>
                    <td>'.$row['verifyid'].'</td>
                    <td>'.$userInfo->lname.' '.$userInfo->fname.'</td>
                    <td>'.$userInfo->email.'</td>
                    <td>'.ucfirst($row['documenttype']).'</td>
                    <td style="font-size: 13px;">'.$row['created_at'].'</td>
                    <td>'.$butt.'</td>
                    <td>'.$btt.'</td>
                </tr>';
        }
    }

    //Get all agents
    public function view_active_verification(){

       $sql = 'SELECT * FROM verification WHERE verifystatus="Activate" ORDER BY id';
       foreach ($this->conn->query($sql) as $row) {
           $userInfo = $this->userDetails($row['userid']);
           echo '<tr>
                   <td>'.$row['verifyid'].'</td>
                   <td>'.$userInfo->lname.' '.$userInfo->fname.'</td>
                   <td>'.$userInfo->email.'</td>
                   <td>'.ucfirst($row['documenttype']).'</td>
                   <td style="font-size: 13px;">'.$row['created_at'].'</td>
                   <td><span class="badge badge-success">Verified</span></td>
                   <td><button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateVerify('.$row['verifyid'].', '.$row['userid'].')">Deactivate</button>
                   <a href="'.BASE_URL.'seller_details.php?userid='.$row['userid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a></td>
               </tr>';
       }
   }

    //Get all agents
    public function view_pending_verification(){

       $sql = 'SELECT * FROM verification WHERE verifystatus="Pending" ORDER BY id';
       foreach ($this->conn->query($sql) as $row) {
           $userInfo = $this->userDetails($row['userid']);
           echo '<tr>
                   <td>'.$row['verifyid'].'</td>
                   <td>'.$userInfo->lname.' '.$userInfo->fname.'</td>
                   <td>'.$userInfo->email.'</td>
                   <td>'.$userInfo->phone.'</td>
                   <td>'.ucfirst($row['documenttype']).'</td>
                   <td style="font-size: 13px;">'.$row['created_at'].'</td>
                   <td><span class="badge badge-warning">Pending</span></td>
                   <td><button class="mb-2 mr-2 btn btn-shadow btn-outline-success btn-sm" onclick="activateVerify('.$row['verifyid'].', '.$row['userid'].')" style="float: left;">Activate</button>
                   <button class="mb-2 mr-2 btn btn-shadow btn-danger btn-sm" onclick="deactivateVerify('.$row['verifyid'].', '.$row['userid'].')">Deactivate</button>
                   <a href="'.$this->location().'seller_details.php?userid='.$row['userid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a></td>
               </tr>';
       }
   }

    //Get all agents
    public function view_cancelled_verification(){
        $sql = 'SELECT * FROM verification WHERE verifystatus="Deactivate" ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            $userInfo = $this->userDetails($row['userid']);
            echo '<tr>
                    <td>'.$row['verifyid'].'</td>
                    <td>'.$userInfo->lname.' '.$userInfo->fname.'</td>
                    <td>'.$userInfo->email.'</td>
                    <td>'.ucfirst($row['documenttype']).'</td>
                    <td style="font-size: 13px;">'.$row['created_at'].'</td>
                    <td><span class="badge badge-danger">Not Verified</span></td>
                    <td><button class="mb-2 mr-2 btn btn-shadow btn-success btn-sm" onclick="activateVerify('.$row['verifyid'].', '.$row['userid'].')">Activate</button>
                    <a href="'.BASE_URL.'seller_details.php?userid='.$row['userid'].'" class="mb-2 btn btn-shadow btn-info btn-sm">Details</a></td>
                </tr>';
        }
    }

    public function activateVerify(){
        $query = "UPDATE verification SET verifystatus=:status WHERE verifyid=:verifyid";
        $stmt = $this->conn->prepare($query);
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->verifyid = htmlspecialchars(strip_tags($this->verifyid));
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('verifyid', $this->verifyid);
        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'Seller Verification' ;
            $this->body = 'Your account has been verified!';
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            // $this->agentActivationEmailSender($this->agentid);
            $this->notifications();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function deactivateVerify(){
        $query = "UPDATE verification SET verifystatus=:status WHERE verifyid=:verifyid";
        $stmt = $this->conn->prepare($query);
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->verifyid = htmlspecialchars(strip_tags($this->verifyid));
        $this->userid = htmlspecialchars(strip_tags($this->userid));
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('verifyid', $this->verifyid);
        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'Seller Verification' ;
            $this->body = 'We counld not verify your details, please re-submit the application!';
            $this->generatedlink = BASE_URL."seller_details.php?sellerid=".$this->userid;
            // $this->agentDeactivationEmailSender($this->agentid);
            $this->notifications();

            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //Get category into dropdown list
    public function main_category_dropdown(){
        $sql = "SELECT * FROM category ORDER BY id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          echo '<li class="vertical-item level1 toggle-menu vertical_drop css_parent" style="padding-top: 7px !important; padding-bottom: 7px !important; border-bottom: 1px solid #cfcfcf;">
                  <a class="menu-link" href="#">
                      <span class="icon_items"><i class="fa fa-sun-o"></i></span>
                      <span class="menu-title" style="font-size: 14px;"><strong>'.$row['catname'].'</strong></span>
                      <span class="caret"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                  </a>
                  <ul class="vertical-drop drop-css drop-lv1 sub-menu" style="width:220px; ">
                    <li class="vertical-item sub-dropdown toggle-menu">
                        <a class="menu-link" href="#" title="">Clothing<span class="caret"><i class="fa fa-angle-down" aria-hidden="true"></i></span></a>
                        <ul class="vertical-drop drop-lv2 dropdown-content sub-menu">
                            <li class="vertical-item level2 "><a href="#" title="">Electronics& Computer</a></li>
                            <li class="vertical-item level2 "><a href="#" title="">Fashion</a></li>
                        </ul>
                    </li>
                  </ul>
              </li>';
        }
    }

    public function sub_main_state(){
        $sql = 'SELECT * FROM category ORDER BY id';
        foreach ($this->conn->query($sql) as $menu){
            echo '<li class="vertical-item level1 toggle-menu vertical_drop css_parent" style="padding-top: 7px !important; padding-bottom: 7px !important; border-bottom: 1px solid #cfcfcf;">';
            echo '<a class="menu-link" href="'.BASE_URL.'category_list.php?catid='.$menu['catid'].'">';
            echo '<span class="icon_items"><i class="fa fa-sun-o"></i></span>';
            echo '<span class="menu-title" style="font-size: 14px;">'.$menu['catname'].'</span>';
            echo '<span class="caret"><i class="fa fa-angle-down" aria-hidden="true"></i></span>';
            echo '</a>';
            echo '<ul class="vertical-drop drop-css drop-lv1 sub-menu" style="width:220px; ">';
            $sql2 = 'SELECT DISTINCT(marketstate), categoryid  FROM marketproductid WHERE categoryid='.$menu['catid'];
            foreach($this->conn->query($sql2) as $submenu){
                echo '<li class="vertical-item sub-dropdown toggle-menu">';
                echo '<a class="menu-link" href="'.BASE_URL.'product_list.php?state='.$submenu['marketstate'].'" title="">'.$submenu['marketstate'].'<span class="caret"><i class="fa fa-angle-down" aria-hidden="true"></i></span></a>';
                echo '<ul class="vertical-drop drop-lv2 dropdown-content sub-menu">';
                    $sql3 = 'SELECT DISTINCT(marketname), marketid FROM market WHERE marketid IN ( SELECT marketid FROM marketproductid WHERE categoryid = "'. $submenu['categoryid'] .'" AND marketstate = "'. $submenu['marketstate'] .'"   )';
                    foreach($this->conn->query($sql3) as $submenu2){
                        echo '<li class="vertical-item level2 "><a href="'.BASE_URL.'product_list.php?marketid='.$submenu2['marketid'].'" title="">'.$submenu2['marketname'].'</a></li>';
                    }
                echo '</ul>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</li>';
        }
    }

    /* User Details */
    // public function marketdetails($userid){
    //     try {
    //         $stmt = $this->conn->prepare("SELECT * FROM users WHERE userid=:userid");
    //         $stmt->bindParam("userid", $userid, PDO::PARAM_INT);
    //         $stmt->execute();
    //         $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
    //         return $data;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }


    //Update dispute status
    public function updateProductSettings(){

        $query = "UPDATE product_details SET topCatSetting=:topCatSetting WHERE productid=:productid";

        $stmt = $this->conn->prepare($query);

        $this->productid = htmlspecialchars(strip_tags($this->productid));
        $this->productsetting = htmlspecialchars(strip_tags($this->productsetting));

        $stmt->bindValue('topCatSetting', $this->productsetting);
        $stmt->bindValue('productid', $this->productid);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //Get all active seller
    public function top_sellers_home_list(){
        $sql = "SELECT count(*) FROM business";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM business';
            foreach ($this->conn->query($sql) as $row) {
                if($this->isUserVerified($row['userid'])){
                    $vrf = '<img style="width: 70px !important; position: absolute; top: 0; right: 0; opacity: 1;" src="'.BASE_URL.'assets/images/verified.png" class="img-icon"/>';
                    $storeimgs = json_decode($row['storeimage']);
                    echo '<div class="collect ">
                        <a href="#" class="collection-item">
                            <img class="collection-img img-responsive lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/seller1.jpg" alt="RT AaShop demo" data-src="'.BASE_URL.'assets/images/seller1.jpg"/>
                            '.$vrf.'
                            <div class="collection-name">
                                <h5 class="float-left pl-4">'.$row['bizname'].'</h5>
                                <a href="'.BASE_URL.'seller_details.php?sellerid='.$row['userid'].'"><button class="btn btn-success btn-sm">Visit Store</button></a>
                            </div>
                        </a>
                    </div>';
                }else{
                    $vrf = '';
                }
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    //Check if verification exit;
    public function isUserVerified($userid){
        $query = "SELECT * FROM verification WHERE userid=:userid AND verifystatus=:verifystatus";
        $stmt = $this->conn->prepare($query);
        $this->userid = $userid;
        $this->verifystatus = 'Activate';
        $stmt->bindValue(':userid', $this->userid);
        $stmt->bindValue(':verifystatus', $this->verifystatus);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }
    //Check if verification exit;
    public function UserVerification($userid){
        $query = "SELECT * FROM verification WHERE userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid = $userid;
        $stmt->bindValue(':userid', $this->userid);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
        return $data;

    }

    //Get all Category details
    public function top_category_home_list(){
        $sql = "SELECT count(*) FROM category";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM category ORDER BY RAND() LIMIT 6';
            foreach ($this->conn->query($sql) as $row) {
                $this->counter = $this->product_count($row['catname']);
                echo '<div class="col-md-4">
                        <div class="item">
                            <div class="product-item" data-id="product-1873555030051">
                                <div class="product-item-container grid-view-item" style="height: 250px !important;">
                                    <div class="left-block">
                                        <div class="product-image-container product-image">
                                            <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'category_list.php?catid='.$row['catid'].'">
                                                <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.'seller/catImage/'.$row['catid'].'/'.$row['catImage'].'" alt=""/>
                                            </a>
                                        </div>
                                        <div class="box-labels">
                                            <span class="label-product label-sale">
                                                <span class="d-none" style="color: white !important;">Sale</span>'.$this->counter.'
                                            </span>
                                        </div>
                                        <div class="button-link pt-5">
                                            <div>
                                                <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'category_list.php?catid='.$row['catid'].'" title="Quick View"><i class="fa fa-eye"></i><span class="hidden">Quick View</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4 class="title-product text-center"><a class="product-name" href="'.BASE_URL.'category_list.php?catid='.$row['catid'].'" style="color: white !important; font-size: 18px !important;">'.$row['catname'].'</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    public function product_count($catname){
        $sql = "SELECT count(*) FROM `product_details` WHERE product_category=:product_category";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue('product_category', $catname);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            return $number_of_rows;
        }
    }

    //Get all Category details
    public function top_selection_home_list(){
        $sql = "SELECT count(*) FROM product_details WHERE status='Active' AND topCatSetting=1";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM product_details WHERE status="Active" AND topCatSetting=1 ORDER BY RAND() LIMIT 6';
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                              $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);
                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="col-md-4">
                        <div class="item">
                            <div class="product-item"
                                data-id="product-'.$row['productid'].'">
                                <div class="product-item-container grid-view-item">
                                    <div class="left-block">
                                        <div class="product-image-container product-image">
                                            <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
                                                <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                            </a>
                                        </div>
                                        <div class="box-labels">
                                            <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                                        </div>
                                        <div class="button-link">
                                            <div class="add-to-wishlist" '.$fav.'>
                                                <div class="default-wishbutton-headphone loading" '.$fav.'>
                                                    <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                                </div>
                                                </div>';
                                                 $cart = array(
                                                  "sellerid" => $row['userid'],
                                                  "productID" => $row['productid'],
                                                  "action" => "1");
                                                  // die(print_r($_COOKIE['cart']));
                                                  if (isset($_COOKIE['cart'])) {
                                                    $stored = [];
                                                    foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                                      $stored[] = array(
                                                        'sellerid' => $id['sellerid'],
                                                        'productID' => $id['productID'],
                                                        'action' => $id['action']
                                                      );
                                                    }
                                                  }
                                                  if(isset($stored) && in_array($cart, $stored)){

                                                $output .='
                                                <div class="btn-button add-to-cart action">
                                                    <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                                </div>';
                                              } else {
                                                $output .='
                                                <div class="btn-button add-to-cart action">
                                                    <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                                </div>';
                                                  }
                                                  $output .='
                                            <div class="">
                                                <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                            </h4>
                                            <div class="price">
                                                <!-- snippet/product-price.liquid -->
                                                <span class="visually">As low as: </span>
                                                <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                            </div>
                                            <div class="custom-reviews hidden-xs">
                                                <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    print($output);
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    public function top_sales_list(){
        $sql = "SELECT count(*) FROM product_details WHERE status='Active' AND topCatSetting=1";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM product_details WHERE status="Active" AND topCatSetting=1 ORDER BY RAND()';
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                              $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);
                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="item">
                        <div class="product-item"
                            data-id="product-'.$row['productid'].'">
                            <div class="product-item-container grid-view-item   ">
                            <div class="left-block">
                            <div class="product-image-container product-image">
                                <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
                                    <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                </a>
                            </div>
                            <div class="box-labels">
                                <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                            </div>
                            <div class="button-link">
                                <div class="add-to-wishlist" '.$fav.'>
                                    <div class="default-wishbutton-headphone loading" '.$fav.'>
                                        <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                    </div>
                                </div>';
                                 $cart = array(
                                  "sellerid" => $row['userid'],
                                  "productID" => $row['productid'],
                                  "action" => "1");
                                  // die(print_r($_COOKIE['cart']));
                                  if (isset($_COOKIE['cart'])) {
                                    $stored = [];
                                    foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                      $stored[] = array(
                                        'sellerid' => $id['sellerid'],
                                        'productID' => $id['productID'],
                                        'action' => $id['action']
                                      );
                                    }
                                  }
                                  if(isset($stored) && in_array($cart, $stored)){

                                $output .='
                                <div class="btn-button add-to-cart action">
                                    <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                </div>';
                              } else {
                                $output .='
                                <div class="btn-button add-to-cart action">
                                    <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                </div>';
                                  }
                                  $output .='
                                <div class="">
                                    <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="right-block">
                            <div class="caption">
                                <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                </h4>
                                <div class="price">
                                    <!-- snippet/product-price.liquid -->
                                    <span class="visually">As low as: </span>
                                    <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                </div>
                                <div class="custom-reviews hidden-xs">
                                    <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                </div>

                            </div>

                        </div>
                            </div>
                        </div>


                    </div>';
                    print($output);
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    public function selling_products(){
        $sql = "SELECT count(*) FROM product_details WHERE status='Active' AND topCatSetting=1";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM product_details WHERE status="Active" AND topCatSetting=1 ORDER BY RAND()';
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                              $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);
                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="col-md-2">
                        <div class="item">
                            <div class="product-item"
                                data-id="product-'.$row['productid'].'">
                                <div class="product-item-container grid-view-item   ">
                                <div class="left-block">
                                <div class="product-image-container product-image">
                                    <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
                                        <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                    </a>
                                </div>
                                <div class="box-labels">
                                    <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                                </div>
                                <div class="button-link">
                                <div class="add-to-wishlist" '.$fav.'>
                                    <div class="default-wishbutton-headphone loading" '.$fav.'>
                                        <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                    </div>
                                    </div>';
                                     $cart = array(
                                      "sellerid" => $row['userid'],
                                      "productID" => $row['productid'],
                                      "action" => "1");
                                      // die(print_r($_COOKIE['cart']));
                                      if (isset($_COOKIE['cart'])) {
                                        $stored = [];
                                        foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                          $stored[] = array(
                                            'sellerid' => $id['sellerid'],
                                            'productID' => $id['productID'],
                                            'action' => $id['action']
                                          );
                                        }
                                      }
                                      if(isset($stored) && in_array($cart, $stored)){

                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                    </div>';
                                  } else {
                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                    </div>';
                                      }
                                      $output .='
                                <div class="">
                                    <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            </div>
                            <div class="right-block">
                                <div class="caption">
                                    <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                    </h4>
                                    <div class="price">
                                        <!-- snippet/product-price.liquid -->
                                        <span class="visually">As low as: </span>
                                        <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                    </div>
                                    <div class="custom-reviews hidden-xs">
                                        <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                    </div>

                                </div>

                            </div>
                                </div>
                            </div>


                        </div>
                    </div>';
                    print($output);
            }
        }else{
            echo 'No record found';
            return;
        }

    }



    public function view_all_transactions(){

        $sql = 'SELECT * FROM payment_history ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {

          $user = $this->userDetails($row['userid']);

            echo '<tr>
                    <td>'.$row['transid'].'</td>
                    <td>'.$user->fname.' '.$user->lname.'</td>
                    <td>'.$user->email.'</td>
                    <td>'.$row['task'].'</td>
                    <td>'.$row['startDate'].'</td>
                    <td>'.$row['endDate'].'</td>
                </tr>';
        }
    }

    //////////////////////////////
    //get product details by id //
    //////////////////////////////
    public function get_product_details($productID){

        $stm = $this->conn->prepare("SELECT * FROM product_details WHERE productid=:productid");
        $stm->bindValue("productid", $productID);
        $stm->execute();
        if($stm->rowCount() > 0){
            $product_details = $stm->fetch(PDO::FETCH_OBJ);
            $product_details = json_encode($product_details);
            $product_details = json_decode($product_details);
            return $product_details;
        }else{
            return null;
        }

    }

    //////////////////////////////
    //get category details by id //
    //////////////////////////////
    public function get_category_id($catname){
        $stm = $this->conn->prepare("SELECT * FROM category WHERE catname=:catname");
        $stm->bindValue("catname", $catname);
        $stm->execute();
        if($stm->rowCount() > 0){
            $category_details = $stm->fetch(PDO::FETCH_OBJ);
            return $category_details;

        }else{
            return null;
        }

    }

    //////////////////////////
    // add product to cart  //
    //////////////////////////
    // public function add_to_cart ($sellerID, $productID) {
    //     if (isset($_SESSION['cart'])) { //first check if cart session is available
    //         $is_available = 0;
    //         foreach($_SESSION['cart'] as $keys => $values){
    //             if($_SESSION['cart'][$keys]['productid'] == $productID && $_SESSION['cart'][$keys]['sellerid'] == $sellerID){
    //                 $is_available++;
    //             }
    //         }
    //         if($is_available == 0){
    //             $item_array = array(
    //                 'productid' => $productID,
    //                 'sellerid' => $sellerID
    //             );
    //             $_SESSION['cart'][] = $item_array;
    //             echo 'Added to cart!';
    //             return true;
    //         }
    //     } else {
    //         $item_array = array(
    //             'productid' => $productID,
    //             'sellerid' => $sellerID
    //         );
    //         $_SESSION['cart'][] = $item_array;
    //         echo 'Added to cart!';
    //         return true;
    //     }

    // }

    public function add_to_cart ($sellerID, $productID,$qty,$price,$pack) {
        if (isset($_SESSION['cart'])) { //first check if cart session is available
            $cart = $_SESSION['cart'];
            if(array_key_exists($sellerID, $cart)) {
                if(!in_array($productID, $cart[$sellerID])){
                    $cart[$sellerID][$productID] = ['qty' => $qty, 'pack_type' => $pack, 'total_price' => $price];
                    echo "Product added to cart";
                    $_SESSION['cart'] = $cart;
                    return true;
                }else{
                    echo "Product already in cart";
                    return;
                }
            } else {
                $cart[$sellerID] = [];
                $cart[$sellerID][$productID] = ['qty' => $qty, 'pack_type' => $pack, 'total_price' => $price];
                $_SESSION['cart'] = $cart;
                if(!isset($_SESSION['order_status'])){
                    $_SESSION['order_status'] = [];
                    if(!array_key_exists($sellerID, $_SESSION['order_status'])) {
                        $item = array(
                            'status' => 0
                        );
                        $_SESSION['order_status'][$sellerID] = $item;
                    }
                }else{
                    if(!array_key_exists($sellerID, $_SESSION['order_status'])) {
                        $item = array(
                            'status' => 0
                        );
                        $_SESSION['order_status'][$sellerID] = $item;
                    }
                }
                echo "Product added to cart";
                return true;
            }

        } else {
            $cart = [];
            $cart[$sellerID] = [];
            $cart[$sellerID][$productID] = ['qty' => $qty, 'pack_type' => 0, 'total_price' => $price];
            $_SESSION['cart'] = $cart;
            if(!isset($_SESSION['order_status'])){
                $_SESSION['order_status'] = [];
                if(!array_key_exists($sellerID, $_SESSION['order_status'])) {
                    $item = array(
                        'status' => 0
                    );
                    $_SESSION['order_status'][$sellerID] = $item;
                }
            }else{
                if(!array_key_exists($sellerID, $_SESSION['order_status'])) {
                    $item = array(
                        'status' => 0
                    );
                    $_SESSION['order_status'][$sellerID] = $item;
                }
            }
            echo "Product added to cart";
            return true;
        }
        return true;
    }

    //////////////////////////
    // remove product from cart  //
    //////////////////////////
    public function remove_from_cart ($sellerID, $productID) {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            if(array_key_exists($sellerID, $cart)) {
                if(array_key_exists($productID, $cart[$sellerID])){
                    unset($cart[$sellerID][$productID]);
                    $_SESSION['cart'] = $cart;
                    return true;
                }
            }
        }
    }

    //////////////////////////
    // remove product from cart  //
    //////////////////////////
    public function update_cart ($sellerID, $productID, $qty, $pack_type, $tot) {
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            if(array_key_exists($sellerID, $cart)) {
                if(array_key_exists($productID, $cart[$sellerID])){
                    $cart[$sellerID][$productID]['qty'] = $qty;
                    $cart[$sellerID][$productID]['pack_type'] = $pack_type;
                    $cart[$sellerID][$productID]['total_price'] = $tot;
                    $_SESSION['cart'] = $cart;
                    echo $productID;
                    return true;

                }
            }
        }
    }



    public function get_product_pack($productID){
    }

    //Get category list for home listing
    public function get_all_category_list(){
        $sql = 'SELECT * FROM category ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
            $cnt = $this->category_count($row['catname']);
            $catID = $this->get_category_id($row['catname']);
            echo '<li><a href="'.BASE_URL.'category_list.php?catid='.$this->get_category_id($row['catname'])->catid.'">'.$row['catname'].'<span class="count">( '.$cnt.' )</span></a></li>';
        }
    }

    public function category_count($catname){
        $sql = "SELECT count(*) FROM `product_details` WHERE product_category=:product_category";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue('product_category', $catname);
        if($stmt->execute()){
            $number_of_rows = $stmt->fetchColumn();
            return $number_of_rows;
            // return;
        }
    }

    public function subscription(){

        if($this->isEmailExit()){
            echo 'You already subscribe to this list!';
            return false;
        }

        $query = "INSERT INTO subscription (email) VALUES (:email)";
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindValue('email', $this->email);

        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function ad_subscriptions(){
        return [
            array('id' => 1, 'title' => '1 Week', 'price' => '1500', 'days' => 7),
            array('id' => 2, 'title' => '2 Weeks', 'price' => '2000', 'days' => 14),
            array('id' => 3, 'title' => '1 Month', 'price' => '3500', 'days' => 30),
            array('id' => 4, 'title' => '3 Months', 'price' => '6000', 'days' => 90),
            array('id' => 5, 'title' => '6 Months', 'price' => '12000', 'days' => 180),
        ];
    }

    public function get_ads(){
        $sth = $this->conn->prepare('SELECT * FROM ad');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function get_ads_home($position){
        $sth = $this->conn->prepare("SELECT * FROM ad WHERE ads_location='$position' ORDER BY RAND() LIMIT 3");
        $sth->execute();
        return $sth->fetchAll();
    }
    public function get_ads_home_one($position){
        $sth = $this->conn->prepare("SELECT * FROM ad WHERE ads_location='$position' ORDER BY RAND() LIMIT 1");
        $sth->execute();
        return $sth->fetchAll();
    }
    public function get_active_ads(){
        $sth = $this->conn->prepare('SELECT * FROM ad WHERE status=1');
        $sth->execute();
        return $sth->fetchAll();
    }
    public function get_inactive_ads(){
        $sth = $this->conn->prepare('SELECT * FROM ad WHERE status=2 or status=3 ');
        $sth->execute();
        return $sth->fetchAll();
    }

    public function get_user_ads($user){
        $sth = $this->conn->prepare('SELECT * FROM ad WHERE userid = :userid');
        $sth->execute(array(':userid' => $user));
        return $sth->fetchAll();
    }
    public function get_business_access($user){
        $sth = $this->conn->prepare('SELECT * FROM business_access WHERE business_id = :userid');
        $sth->execute(array(':userid' => $user));
        return $sth->fetchAll();
    }
    public function get_business_access_check($user){
        $sth = $this->conn->prepare('SELECT * FROM business_access WHERE userid = :userid');
        $sth->execute(array(':userid' => $user));
        return count($sth->fetchAll());
    }
    public function get_business_access_count($user){
        $sth = $this->conn->prepare('SELECT * FROM business_access WHERE business_id = :userid AND access="pending"');
        $sth->execute(array(':userid' => $user));
        $count = count($sth->fetchAll());
          if ($count == 0) {
            $count ='';
          }
        return $count;
    }
    public function get_user_business_access($user=''){
        $sth = $this->conn->prepare('SELECT * FROM business_access WHERE userid = :userid AND access="Approved"');
        $sth->execute(array(':userid' => $user));
        return $sth->fetchAll();
    }


    public function review_ad($ad_id, $status){

        $sth = $this->conn->prepare('UPDATE ad SET status=:status WHERE id=:id');
        if($sth->execute(
            array(

                ':id' => $ad_id,
                ':status' => $status
            )
        )){
            return true;
        }
        return false;
    }
    public function create_ad($link, $adslocation, $img, $end_date, $status){
        $sth = $this->conn->prepare('INSERT INTO ad (userid, link, ads_location, img, end_date, status) VALUES (
          :userid, :link, :ads_location, :img, :end_date, :status)');
        if($sth->execute(
            array(
                ':userid' => $_SESSION['userid'],
                ':link' => $link,
                ':ads_location' => $adslocation,
                ':img' => $img,
                ':end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' +'.$end_date.' days')),
                ':status' => $status
            )
        )){
            return true;
        }
        return false;
    }
    public function contact($name, $email,$phone, $message){
        $sth = $this->conn->prepare('INSERT INTO contact (name, email,phone, message) VALUES
        (:name, :email,:phone, :message)');
        if($sth->execute(
            array(
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':message' => $message
            )
        )){
          $message = "<b>Hi '.$name.'</b><br/>";
          $message .= "<hr>";
          $message .= "<h5>Thanks for contacting us</h5>";
          $message .= "<p> We Would get back to you</p>";
          $message .= "<hr>";
          $message .= "<p>Thanks</p>";
          $message .= "<hr>";

          $subject = "RE: Contact From Ojarh";
          // die("here");
          $this->sendMail($email,$subject,$message);

            return true;
        }
        return false;
    }
    public function renew_ad($ad_id, $end_date, $status){
        $sth = $this->conn->prepare('UPDATE ad SET end_date=:end_date, status=:status WHERE id=:ad_id');
        if($sth->execute(
            array(
                ':ad_id' => $ad_id,
                ':end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' +'.$end_date.' days')),
                ':status' => $status
            )
        )){
            return true;
        }
        return false;
    }
    public function stop_ad($ad_id){

        $sth = $this->conn->prepare('UPDATE ad SET status=:status WHERE id=:ad_id');
        if($sth->execute(
            array(
                ':ad_id' => $ad_id,
                ':status' => '2'
            )
        )){

            return true;
        }
        return false;
    }

    public function subscribe_ad() {
        if($this->durate == 1){
            $this->startDate =  date('Y-m-d');
            $this->endDate = date('Y-m-d', strtotime($this->startDate. ' +30 days')); // Y-m-d
        }elseif($this->durate == 6){
            $this->startDate =  date('Y-m-d');
            $this->endDate = date('Y-m-d', strtotime($this->startDate. ' +180 days')); // Y-m-d
        }elseif($this->durate == 12){
            $this->startDate =  date('Y-m-d');
            $this->endDate = date('Y-m-d', strtotime($this->startDate. ' +365 days')); // Y-m-d
        }
    }

    //Get all Category details
    public function seller_product_list($seller_id){
        $sql = "SELECT count(*) FROM product_details WHERE userid='$seller_id'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM product_details WHERE userid='$seller_id'";
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                              $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);
                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';

                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="item">
                        <div class="product-item"
                            data-id="product-'.$row['productid'].'">
                            <div class="product-item-container grid-view-item   ">
                                <div class="left-block">
                                    <div class="product-image-container product-image">
                                        <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
                                                <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                            </a>
                                    </div>
                                    <div class="box-labels">
                                        <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                                    </div>
                                    <div class="button-link">
                                        <div class="add-to-wishlist" '.$fav.'>
                                            <div class="default-wishbutton-headphone loading" '.$fav.'>
                                                <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                            </div>
                                            </div>';
                                             $cart = array(
                                              "sellerid" => $row['userid'],
                                              "productID" => $row['productid'],
                                              "action" => "1");
                                              // die(print_r($_COOKIE['cart']));
                                              if (isset($_COOKIE['cart'])) {
                                                $stored = [];
                                                foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                                  $stored[] = array(
                                                    'sellerid' => $id['sellerid'],
                                                    'productID' => $id['productID'],
                                                    'action' => $id['action']
                                                  );
                                                }
                                              }
                                              if(isset($stored) && in_array($cart, $stored)){

                                            $output .='
                                            <div class="btn-button add-to-cart action">
                                                <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                            </div>';
                                          } else {
                                            $output .='
                                            <div class="btn-button add-to-cart action">
                                                <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                            </div>';
                                              }
                                              $output .='
                                        <div class="">
                                            <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <div class="caption">
                                        <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                        </h4>
                                        <div class="price">
                                            <!-- snippet/product-price.liquid -->
                                            <span class="visually">As low as: </span>
                                            <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                        </div>
                                        <div class="custom-reviews hidden-xs">
                                            <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>';
                    print($output);
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    /* business Details */
    public function categoryDetails($catid){
        $stmtbiz = $this->conn->prepare("SELECT * FROM category WHERE catid=:catid");
        $stmtbiz->bindValue("catid", $catid);
        $stmtbiz->execute();
        if($stmtbiz->rowCount() > 0){
            $data = $stmtbiz->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }else{
            return 'empty';
        }
    }

    /* business Details */
    public function marketDetails($marketid){
        $stmtbiz = $this->conn->prepare("SELECT * FROM market WHERE marketid=:marketid");
        $stmtbiz->bindValue("marketid", $marketid);
        $stmtbiz->execute();
        if($stmtbiz->rowCount() > 0){
            $data = $stmtbiz->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        }else{
            return 'empty';
        }
    }

    //Get all Category details
    public function catalogue_grid($product_catalogue,$all){
      if (isset($all) && isset($all['product_category'])) {

        $fields = array('product_category', 'product_type', 'size','color', 'userid');
        $conditions = array();

        // loop through the defined fields
        foreach($fields as $field){
          // if the field is set and not empty
          if(isset($all[$field]) && $all[$field] != '') {
            // create a new condition while escaping the value inputed by the user (SQL Injection)
            $conditions[] = "`$field` LIKE '%" . htmlspecialchars($all[$field]) . "%'";
          }
        }
        // builds the query
        $query = "SELECT * FROM product_details ";
        $sql = "SELECT count(*) FROM product_details ";
        // if there are conditions defined
        if(count($conditions) > 0) {
            // append the conditions
            $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
            $sql .= "WHERE " . implode (' AND ', $conditions);
            // die(print_r(  $query));

            $result = $this->conn->prepare($sql);
            $result->execute();
            if($result->fetchColumn() > 0){

              // $sql = "SELECT * FROM product_details WHERE market='$marketid' and product_category='$cat'";
                foreach ($this->conn->query($query) as $row) {
                  if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                    if ( strpos($row['pack0'], '+') ) {
                      $this->splitter = explode('+',$row['pack0']);

                    }elseif (strpos($row['pack0'], '@') ) {

                      $this->splitter = explode('@',$row['pack0']);
                    }else {
                      $this->splitter ="";
                    }
                  }
                    $this->qnt = $this->splitter[0];
                    $this->price = $this->splitter[1];
                    $this->discount = $this->splitter[2];
                    $sellerDetails = $this->userDetails($row['userid']);

                    $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                    if($this->isFavExist($current_user, $row['productid'])){
                        $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                        $favo = 'style="color: white !important;"';
                    }else{
                        $fav = '';
                        $favo = '';
                    }
                    $currency = $sellerDetails->currency;
                    for ($i=0; $i < 7; $i++) {
                      $img = 'img'.$i;
                      if (!is_null($row[$img]) && !empty($row[$img])) {
                        $image = $row[$img];
                        break;
                      }
                    }
                    $output ='';
                    $output .='<div class="product product-layout col-md-3">
                    <div class="product-item">
                        <div class="product-item-container">
                            <div class="left-block">
                                <div class="product-image-container product-image">
                                    <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
                                        <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                    </a>
                                </div>
                                <div class="box-labels">
                                    <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                                </div>
                                <div class="button-link">
                                    <div class="add-to-wishlist" '.$fav.'>
                                        <div class="default-wishbutton-headphone loading" '.$fav.'>
                                            <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                        </div>
                                        </div>';
                                         $cart = array(
                                          "sellerid" => $row['userid'],
                                          "productID" => $row['productid'],
                                          "action" => "1");
                                          // die(print_r($_COOKIE['cart']));
                                          if (isset($_COOKIE['cart'])) {
                                            $stored = [];
                                            foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                              $stored[] = array(
                                                'sellerid' => $id['sellerid'],
                                                'productID' => $id['productID'],
                                                'action' => $id['action']
                                              );
                                            }
                                          }
                                          if(isset($stored) && in_array($cart, $stored)){

                                        $output .='
                                        <div class="btn-button add-to-cart action">
                                            <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                        </div>';
                                      } else {
                                        $output .='
                                        <div class="btn-button add-to-cart action">
                                            <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                        </div>';
                                          }
                                          $output .='
                                    <div class="">
                                        <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="right-block">
                                <div class="caption">
                                    <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                    </h4>
                                    <div class="price">
                                        <!-- snippet/product-price.liquid -->
                                        <span class="visually">As low as: </span>
                                        <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                    </div>
                                    <div class="custom-reviews hidden-xs">
                                        <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>';
                print($output);
                }
    }else{
      echo 'No record found';
      return;
    }
  }
  }else {

        $sql = "SELECT count(*) FROM product_details WHERE product_catalogue='$product_catalogue'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM product_details WHERE product_catalogue='$product_catalogue'";
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);

                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="product product-layout col-md-3">
                <div class="product-item">
                    <div class="product-item-container">
                        <div class="left-block">
                            <div class="product-image-container product-image">
                                <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
                                    <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                </a>
                            </div>
                            <div class="box-labels">
                                <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                            </div>
                            <div class="button-link">
                                <div class="add-to-wishlist" '.$fav.'>
                                    <div class="default-wishbutton-headphone loading" '.$fav.'>
                                        <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                    </div>
                                    </div>';
                                     $cart = array(
                                      "sellerid" => $row['userid'],
                                      "productID" => $row['productid'],
                                      "action" => "1");
                                      // die(print_r($_COOKIE['cart']));
                                      if (isset($_COOKIE['cart'])) {
                                        $stored = [];
                                        foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                          $stored[] = array(
                                            'sellerid' => $id['sellerid'],
                                            'productID' => $id['productID'],
                                            'action' => $id['action']
                                          );
                                        }
                                      }
                                      if(isset($stored) && in_array($cart, $stored)){

                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                    </div>';
                                  } else {
                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                    </div>';
                                      }
                                      $output .='
                                <div class="">
                                    <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="right-block">
                            <div class="caption">
                                <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                </h4>
                                <div class="price">
                                    <!-- snippet/product-price.liquid -->
                                    <span class="visually">As low as: </span>
                                    <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                </div>
                                <div class="custom-reviews hidden-xs">
                                    <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>';
            print($output);
            }
        }else{
            echo 'No record found';
            return;
        }
}
    }
    public function category_grid($product_category='',$all){
      if (isset($all) && isset($all['product_category'])) {
 // die(print_r($all));
        $fields = array('product_category', 'product_type', 'size','color', 'userid','pack0');
        $conditions = array();

        // loop through the defined fields
        foreach($fields as $field){
          // if the field is set and not empty
          if ($field == "pack0" ) {
            if((isset($all['max_price']) || isset($all['min_price'])) && ($all['min_price'] != '' || $all['max_price'] != '')) {
              // create a new condition while escaping the value inputed by the user (SQL Injection)
              $conditions[] = "`pack0` LIKE '%" . htmlspecialchars($all['max_price']) . "%'";
              // die(print_r($conditions));
            }
          }else {

            if(isset($all[$field]) && $all[$field] != '') {
              // create a new condition while escaping the value inputed by the user (SQL Injection)

              $conditions[] = "`$field` LIKE '%" . htmlspecialchars($all[$field]) . "%'";
            }
          }
        }
        // builds the query
        $query = "SELECT * FROM product_details ";
        $sql = "SELECT count(*) FROM product_details ";
        // if there are conditions defined
        if(count($conditions) > 0) {
            // append the conditions
            $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
            $sql .= "WHERE " . implode (' AND ', $conditions);
            // die(print_r(  $query));

            $result = $this->conn->prepare($sql);
            $result->execute();
            if($result->fetchColumn() > 0){

              // $sql = "SELECT * FROM product_details WHERE market='$marketid' and product_category='$cat'";
              foreach ($this->conn->query($query) as $row) {
                if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                  if ( strpos($row['pack0'], '+') ) {
                    $this->splitter = explode('+',$row['pack0']);

                  }elseif (strpos($row['pack0'], '@') ) {

                    $this->splitter = explode('@',$row['pack0']);
                  }else {
                    $this->splitter ="";
                  }
                }
                $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);
                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                  $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                  $favo = 'style="color: white !important;"';
                }else{
                  $fav = '';
                  $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ="";
                $output ='<div class="product product-layout col-md-3">
                <div class="product-item">
                <div class="product-item-container">
                <div class="left-block">
                <div class="product-image-container product-image">
                <a class="grid-view-item__link image-ajax" href="#">
                <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                </a>
                </div>
                <div class="box-labels">
                <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                </div>
                <div class="button-link">
                <div class="add-to-wishlist" '.$fav.'>
                <div class="default-wishbutton-headphone loading" '.$fav.'>
                <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                </div>
                </div>';
                 $cart = array(
                  "sellerid" => $row['userid'],
                  "productID" => $row['productid'],
                  "action" => "1");
                  // die(print_r($_COOKIE['cart']));
                  if (isset($_COOKIE['cart'])) {
                    $stored = [];
                    foreach (json_decode($_COOKIE['cart'], true) as $id) {

                      $stored[] = array(
                        'sellerid' => $id['sellerid'],
                        'productID' => $id['productID'],
                        'action' => $id['action']
                      );
                    }
                  }
                  if(isset($stored) && in_array($cart, $stored)){

                $output .='
                <div class="btn-button add-to-cart action">
                    <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                </div>';
              } else {
                $output .='
                <div class="btn-button add-to-cart action">
                    <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                </div>';
                  }
                  $output .='
                <div class="">
                  <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                </div>
              </div>
            </div>
            <div class="right-block">
              <div class="caption">
                <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                </h4>
                <div class="price">
                  <!-- snippet/product-price.liquid -->
                  <span class="visually">As low as: </span>
                  <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                </div>
                <div class="custom-reviews hidden-xs">
                  <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>';
      print($output);
    }
    }else{
      echo 'No record found';
      return;
    }
  }
  }else {

        $sql = "SELECT count(*) FROM product_details WHERE product_category='$product_category'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM product_details WHERE product_category='$product_category'";
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);

                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="product product-layout col-md-3">
                <div class="product-item">
                    <div class="product-item-container">
                        <div class="left-block">
                            <div class="product-image-container product-image">
                                <a class="grid-view-item__link image-ajax" href="#">
                                    <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                </a>
                            </div>
                            <div class="box-labels">
                                <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                            </div>
                            <div class="button-link">
                                <div class="add-to-wishlist" '.$fav.'>
                                    <div class="default-wishbutton-headphone loading" '.$fav.'>
                                        <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                    </div>
                                    </div>';
                                     $cart = array(
                                      "sellerid" => $row['userid'],
                                      "productID" => $row['productid'],
                                      "action" => "1");
                                      // die(print_r($_COOKIE['cart']));
                                      if (isset($_COOKIE['cart'])) {
                                        $stored = [];
                                        foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                          $stored[] = array(
                                            'sellerid' => $id['sellerid'],
                                            'productID' => $id['productID'],
                                            'action' => $id['action']
                                          );
                                        }
                                      }
                                      if(isset($stored) && in_array($cart, $stored)){

                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                    </div>';
                                  } else {
                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                    </div>';
                                      }
                                      $output .='
                                <div class="">
                                    <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="right-block">
                            <div class="caption">
                                <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                </h4>
                                <div class="price">
                                    <!-- snippet/product-price.liquid -->
                                    <span class="visually">As low as: </span>
                                    <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                </div>
                                <div class="custom-reviews hidden-xs">
                                    <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>';
            print($output);
            }
        }else{
            echo 'No record found';
            return;
        }
}
    }

    //Get all Category details
    public function product_by_market($marketid){
        $sql = "SELECT count(*) FROM product_details WHERE market='$marketid'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM product_details WHERE market='$marketid'";
            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                              $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $sellerDetails = $this->userDetails($row['userid']);
                $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $sellerDetails->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="product product-layout col-md-3">
                <div class="product-item">
                    <div class="product-item-container">
                        <div class="left-block">
                            <div class="product-image-container product-image">
                                <a class="grid-view-item__link image-ajax" href="#">
                                    <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                </a>
                            </div>
                            <div class="box-labels">
                                <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                            </div>
                            <div class="button-link">
                                <div class="add-to-wishlist" '.$fav.'>
                                    <div class="default-wishbutton-headphone loading" '.$fav.'>
                                        <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                    </div>
                                    </div>';
                                     $cart = array(
                                      "sellerid" => $row['userid'],
                                      "productID" => $row['productid'],
                                      "action" => "1");
                                      // die(print_r($_COOKIE['cart']));
                                      if (isset($_COOKIE['cart'])) {
                                        $stored = [];
                                        foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                          $stored[] = array(
                                            'sellerid' => $id['sellerid'],
                                            'productID' => $id['productID'],
                                            'action' => $id['action']
                                          );
                                        }
                                      }
                                      if(isset($stored) && in_array($cart, $stored)){

                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                    </div>';
                                  } else {
                                    $output .='
                                    <div class="btn-button add-to-cart action">
                                        <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                    </div>';
                                      }
                                      $output .='
                                <div class="">
                                    <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="right-block">
                            <div class="caption">
                                <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                </h4>
                                <div class="price">
                                    <!-- snippet/product-price.liquid -->
                                    <span class="visually">As low as: </span>
                                    <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                </div>
                                <div class="custom-reviews hidden-xs">
                                    <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>';
            print($output);
            }
        }else{
            echo 'No record found';
            return;
        }

    }
    public function product_by_filter($filter){
      $category_id = isset($filter['product_category']) ? $filter['product_category'] : "";
      $type = isset($filter['product_type']) ? $filter['product_type'] : "";
      $size = isset($filter['size']) ? $filter['size'] : "";
      $color = isset($filter['color']) ? $filter['color'] : "";
      $seller = isset($filter['userid']) ? $filter['userid'] : "";
      $location = isset($filter['location']) ? $filter['location'] : "";
      $market = isset($filter['marketid']) ? $filter['marketid'] : "";
      $min_price = isset($filter['min_price']) ? $filter['min_price'] : "";
      $max_price = isset($filter['max_price']) ? $filter['max_price'] : "";
      $filter['market'] = isset($filter['marketid']) ? $filter['marketid'] : "";

        // $sql2 = "SELECT DISTINCT(marketstate), marketid  FROM marketproductid WHERE marketstate='$state'";

        // die(print_r($filter['market']));
        $fields = array('product_category', 'product_type', 'size','color', 'userid', 'market','pack0' );
    $conditions = array();

    // loop through the defined fields
    foreach($fields as $field){
        // if the field is set and not empty
        if ($field == "pack0" ) {
          if((isset($all['max_price']) || isset($all['min_price'])) && ($all['min_price'] != '' || $all['max_price'] != '')) {
            // create a new condition while escaping the value inputed by the user (SQL Injection)
            $conditions[] = "`pack0` LIKE '%" . htmlspecialchars($all['max_price']) . "%'";
            // die(print_r($conditions));
          }
        }else {
        if(isset($filter[$field]) && $filter[$field] != '') {
            // create a new condition while escaping the value inputed by the user (SQL Injection)
            $conditions[] = "`$field` LIKE '%" . htmlspecialchars($filter[$field]) . "%'";
        }
    }
  }

    // builds the query
    $query = "SELECT * FROM product_details ";
    $sql = "SELECT count(*) FROM product_details ";
    // if there are conditions defined
    if(count($conditions) > 0) {
        // append the conditions
        $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
        $sql .= "WHERE " . implode (' AND ', $conditions);


        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){

          // $sql = "SELECT * FROM product_details WHERE market='$marketid' and product_category='$cat'";
          foreach ($this->conn->query($query) as $row) {
            if (!is_null($row['pack0']) && !empty($row['pack0'])) {
              if ( strpos($row['pack0'], '+') ) {
                $this->splitter = explode('+',$row['pack0']);

              }elseif (strpos($row['pack0'], '@') ) {

                $this->splitter = explode('@',$row['pack0']);
              }else {
                $this->splitter ="";
              }
            }
            $this->qnt = $this->splitter[0];
            $this->price = $this->splitter[1];
            $this->discount = $this->splitter[2];
            $sellerDetails = $this->userDetails($row['userid']);
            $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
            if($this->isFavExist($current_user, $row['productid'])){
              $fav = 'style="background-color: #C60219 !important; color: white !important;"';
              $favo = 'style="color: white !important;"';
            }else{
              $fav = '';
              $favo = '';
            }
            $currency = $sellerDetails->currency;
            for ($i=0; $i < 7; $i++) {
              $img = 'img'.$i;
              if (!is_null($row[$img]) && !empty($row[$img])) {
                $image = $row[$img];
                break;
              }
            }
            $output ="";
            $output .='<div class="product product-layout col-md-3">
            <div class="product-item">
            <div class="product-item-container">
            <div class="left-block">
            <div class="product-image-container product-image">
            <a class="grid-view-item__link image-ajax" href="#">
            <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
            </a>
            </div>
            <div class="box-labels">
            <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
            </div>
            <div class="button-link">
            <div class="add-to-wishlist" '.$fav.'>
            <div class="default-wishbutton-headphone loading" '.$fav.'>
            <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
            </div>
            </div>';
             $cart = array(
              "sellerid" => $row['userid'],
              "productID" => $row['productid'],
              "action" => "1");
              // die(print_r($_COOKIE['cart']));
              if (isset($_COOKIE['cart'])) {
                $stored = [];
                foreach (json_decode($_COOKIE['cart'], true) as $id) {

                  $stored[] = array(
                    'sellerid' => $id['sellerid'],
                    'productID' => $id['productID'],
                    'action' => $id['action']
                  );
                }
              }
              if(isset($stored) && in_array($cart, $stored)){

            $output .='
            <div class="btn-button add-to-cart action">
                <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
            </div>';
          } else {
            $output .='
            <div class="btn-button add-to-cart action">
                <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
            </div>';
              }
              $output .='
            <div class="">
              <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
            </div>
          </div>
        </div>
        <div class="right-block">
          <div class="caption">
            <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
            </h4>
            <div class="price">
              <!-- snippet/product-price.liquid -->
              <span class="visually">As low as: </span>
              <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
            </div>
            <div class="custom-reviews hidden-xs">
              <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>';
  print($output);
}
}else{
  echo 'No record found';
  return;
}

}else {
  echo 'No record found';
  return;
}

          // die(var_dump($query));

    }

    //Get all Category details
    public function product_by_state($state){
        $sql2 = "SELECT DISTINCT(marketstate), marketid  FROM marketproductid WHERE marketstate='$state'";
            foreach ($this->conn->query($sql2) as $row) {
                $sql = "SELECT count(*) FROM product_details WHERE market='$row[marketid]' AND market != ''";
                $result = $this->conn->prepare($sql);
                $result->execute();
                if($result->fetchColumn() > 0){
                    $sql = "SELECT * FROM product_details WHERE market='$row[marketid]'";
                    foreach ($this->conn->query($sql) as $row) {
                      if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                        if ( strpos($row['pack0'], '+') ) {
                          $this->splitter = explode('+',$row['pack0']);

                        }elseif (strpos($row['pack0'], '@') ) {

                          $this->splitter = explode('@',$row['pack0']);
                        }else {
                          $this->splitter ="";
                        }
                      }
                                              $this->qnt = $this->splitter[0];
                        $this->price = $this->splitter[1];
                        $this->discount = $this->splitter[2];
                        $sellerDetails = $this->userDetails($row['userid']);

                        $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
                        if($this->isFavExist($current_user, $row['productid'])){
                            $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                            $favo = 'style="color: white !important;"';
                        }else{
                            $fav = '';
                            $favo = '';
                        }
                        $currency = $sellerDetails->currency;
                        for ($i=0; $i < 7; $i++) {
                          $img = 'img'.$i;
                          if (!is_null($row[$img]) && !empty($row[$img])) {
                            $image = $row[$img];
                            break;
                          }
                        }
                        $output ='';
                      $output .='<div class="product product-layout col-md-3">
                        <div class="product-item">
                            <div class="product-item-container">
                                <div class="left-block">
                                    <div class="product-image-container product-image">
                                        <a class="grid-view-item__link image-ajax" href="#">
                                            <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($sellerDetails->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                        </a>
                                    </div>
                                    <div class="box-labels">
                                        <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                                    </div>
                                    <div class="button-link">
                                        <div class="add-to-wishlist" '.$fav.'>
                                            <div class="default-wishbutton-headphone loading" '.$fav.'>
                                                <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                            </div>
                                            </div>';
                                             $cart = array(
                                              "sellerid" => $row['userid'],
                                              "productID" => $row['productid'],
                                              "action" => "1");
                                              // die(print_r($_COOKIE['cart']));
                                              if (isset($_COOKIE['cart'])) {
                                                $stored = [];
                                                foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                                  $stored[] = array(
                                                    'sellerid' => $id['sellerid'],
                                                    'productID' => $id['productID'],
                                                    'action' => $id['action']
                                                  );
                                                }
                                              }
                                              if(isset($stored) && in_array($cart, $stored)){

                                            $output .='
                                            <div class="btn-button add-to-cart action">
                                                <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                                            </div>';
                                          } else {
                                            $output .='
                                            <div class="btn-button add-to-cart action">
                                                <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                                            </div>';
                                              }
                                              $output .='
                                        <div class="">
                                            <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <div class="caption">
                                        <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                        </h4>
                                        <div class="price">
                                            <!-- snippet/product-price.liquid -->
                                            <span class="visually">As low as: </span>
                                            <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                        </div>
                                        <div class="custom-reviews hidden-xs">
                                            <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>';
                    print($output);
                    }
                }
            }

    }

    //Get all Category details
    public function top_market(){
        $sql = "SELECT count(*) FROM market";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM market";
            foreach ($this->conn->query($sql) as $row) {
                echo '<div class="collect">
                        <a href="" class="collection-item">
                            <img class="collection-img img-responsive lazyload"
                                data-sizes="auto"
                                src="'.BASE_URL.'assets/images/icon-loadings.svg?466"
                                alt="'.$row['marketname'].'"
                                data-src="'.BASE_URL.'seller/marketImage/'.$row['marketname'].'/'.$row['marketimg'].'">

                            <div class="collection-name">
                                <h4 class="float-left pl-4">'.$row['marketname'].'</h4>
                                <a href="'.BASE_URL.'product_list.php?marketid='.$row['marketid'].'"><button class="btn btn-success btn-sm">Visit Market</button></a>
                            </div>
                        </a>
                    </div>';
            }
        }else{
            echo 'No record found';
            return;
        }

    }

    //Get all Category details
    // public function seller_list($sellerid){
    //     $sql = "SELECT * FROM users WHERE userid like '%$sellerid%'";
    //     foreach ($this->conn->query($sql) as $row) {
    //         echo json_encode(array('<li>'.$row['username'].' ['.$row['userid'].']</li>'));
    //     }
    // }

    public function seller_list($sellerid){
        $sql = "SELECT * FROM users WHERE userid like '%$sellerid%' or fname like '%$sellerid%' or lname like '%$sellerid%' or username like '%$sellerid%'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] =$row['username'].'-'.$row['userid'];
        }
        echo json_encode($data);
    }

    public function all_user_list($user){
        $sql = "SELECT * FROM users WHERE role!='Admin' AND
        (userid like '%$user%' or fname like '%$user%' or lname like '%$user%' or username like '%$user%') ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row['username'].'-'.$row['userid'];
        }
        echo json_encode($data);
    }

    public function get_admin_messages(){
        $sql = "SELECT * FROM public_dispute ORDER BY id DESC";

        $row = $this->conn->query($sql);
         return $row;

             // $sql = 'SELECT * FROM business';
             // foreach ($this->conn->query($sql) as $row) {
             //
        }

        public function get_messages($id){
        $sql = "SELECT * FROM message_seller_pd WHERE receiverid =$id  AND status='Approved' ORDER BY id DESC";

        $row = $this->conn->query($sql);
         return $row;

             // $sql = 'SELECT * FROM business';
             // foreach ($this->conn->query($sql) as $row) {
             //
        }
        public function view_pending_message(){

            $sql = 'SELECT * FROM message_seller_pd WHERE status="Pending" ORDER BY id';
            foreach ($this->conn->query($sql) as $row) {

                $buyer = $this->userDetails($row['userid']);
                $seller = $this->userDetails($row['receiverid']);


                echo '<tr>
                        <td>'.$row['messid'].'</td>
                        <td>'.@$buyer->username.'</td>
                        <td>'.@$seller->username.'</td>
                        <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                        <td>'.$row['b_message'].'</td>
                        <td><span class="badge badge-warning">Pending</span></td>
                        <td>'.$this->get_time_ago( strtotime($row['date_submited'])).'</td>
                        <td>
                        <button class="mb-2 btn btn-shadow btn-outline-success btn-sm" onclick="MessageAction('.$row['messid'].','.'`'.'Approved'.'`'.')">Approve</button>
                        <button class="mb-2 btn btn-shadow btn-danger btn-sm" onclick="MessageAction('.$row['messid'].','.'`'.'Disapproved'.'`'.')">Disapprove</button>
                        </td>
                    </tr>';
            }
        }

        function get_time_ago( $time )
        {
            $time_difference = time() - $time;

            if( $time_difference < 1 ) { return 'less than 1 second ago'; }
            $condition = array( 12 * 30 * 24 * 60 * 60 =>  'yr',
                        30 * 24 * 60 * 60       =>  'mth',
                        24 * 60 * 60            =>  'd',
                        60 * 60                 =>  'h',
                        60                      =>  'm',
                        1                       =>  's'
            );

            foreach( $condition as $secs => $str )
            {
                $d = $time_difference / $secs;

                if( $d >= 1 )
                {
                    $t = round( $d );
                    return 'about ' . $t . ' ' . $str . ( $t > 1 ? '' : '' ) . ' ago';
                }
            }
        }


        public function get_admin_sent_messages($id){
        $sql = "SELECT * FROM public_dispute WHERE userid=$id ";

        $row = $this->conn->query($sql);
         return $row;

             // $sql = 'SELECT * FROM business';
             // foreach ($this->conn->query($sql) as $row) {
             //
        }
    public function get_sent_messages($id){
        $sql = "SELECT * FROM message_seller_pd WHERE userid=$id ";

        $row = $this->conn->query($sql);
         return $row;

             // $sql = 'SELECT * FROM business';
             // foreach ($this->conn->query($sql) as $row) {
             //
        }
    public function get_admin_message($messageid){
      $stm = $this->conn->prepare("SELECT * FROM public_dispute WHERE id=:messageid");
      $stm->bindValue(':messageid', $messageid);

      $stm->execute();

      $message = $stm->fetch(PDO::FETCH_OBJ);
      return $message;

        }
    public function get_admin_message_count(){


          $sql = "SELECT count(*) FROM `public_dispute` WHERE  status='Pending'";
          $stmt = $this->conn->prepare($sql);

      if($stmt->execute()){
          $number_of_rows = $stmt->fetchColumn();
          // echo $number_of_rows;
          return $number_of_rows;
          // return;
      }

        }
    public function get_message($messageid){
      $stm = $this->conn->prepare("SELECT * FROM message_seller_pd WHERE id=:messageid");
      $stm->bindValue(':messageid', $messageid);

      $stm->execute();

      $message = $stm->fetch(PDO::FETCH_OBJ);
      return $message;

        }
    public function get_chat_messages($id){
        $sql = "SELECT * FROM messages WHERE receiverid = ".$id." and senderid = ".$_SESSION['userid']."";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $output = '';
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $img = $this->profilepic_link($row['senderid']);

          if ($row['senderid'] != $_SESSION['userid']) {

          $output .= ' <div class="chat-box-wrapper">
                <div>
                    <div class="avatar-icon-wrapper mr-1">
                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                        <div class="avatar-icon avatar-icon-lg rounded"><img
                                src="'.$img.'"
                                alt=""></div>
                    </div>
                </div>
                <div>
                    <div class="chat-box">'.$row['msg'].'
                    </div>
                    <small class="opacity-6">
                        <i class="fa fa-calendar-alt mr-1"></i>
                        '.$row['date_messaged'].'
                    </small>
                </div>
            </div>';
          }else {
          $output .= '
                <div class="chat-box-wrapper chat-box-wrapper-right float-right" style=" width: 52%;">
                    <div>
                        <div class="chat-box">'.$row['msg'].'</div>
                        <small class="opacity-6">
                            <i class="fa fa-calendar-alt mr-1"></i>
                          '.$row['date_messaged'].'
                        </small>
                    </div>
                    <div>
                        <div class="avatar-icon-wrapper ml-1">
                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon avatar-icon-lg rounded"><img
                                    src="'.$img.'"
                                    alt=""></div>
                        </div>
                </div>
            </div>';
          }

        }
        echo json_encode($output);
    }

    //Get category into dropdown list
    public function fetch_notify($userid){
        $sql = "SELECT count(*) FROM notifications WHERE userid='$userid'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM notifications WHERE userid='$userid' ORDER BY id DESC";
            foreach ($this->conn->query($sql) as $row) {
                echo '<div class="vertical-timeline-item dot-danger vertical-timeline-element">
                        <div>
                            <span class="vertical-timeline-element-icon bounce-in"></span>
                            <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">'.$row['title'].'</h4>
                                <code>'.$row['body'].'</code>
                                <span class="vertical-timeline-element-date"></span>
                            </div>
                        </div>
                    </div>';
            }
        }else{
            echo '<div class="vertical-timeline-item dot-danger vertical-timeline-element">
                        <div>
                            <span class="vertical-timeline-element-icon bounce-in"></span>
                            <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">You do not have notification.</h4>
                                <span class="vertical-timeline-element-date"></span>
                            </div>
                        </div>
                    </div>';
        }
    }

    public function add_to_favourite($userid, $productid){
        if($this->isFavExist($userid, $productid)){
            echo 'You already added this to your favourite!';
            return false;
        }
        $sth = $this->conn->prepare('INSERT INTO favourite (userid, productid) VALUES (:userid, :productid)');
        if($sth->execute(
            array(
                ':userid' => $userid,
                ':productid' => $productid
            )
        )){
            echo 'Added to your favourite!';
            return true;
        }
        return false;
    }

    public function add_to_favourite_anonymous($productID) {

        if (isset($_SESSION['favourite'])) { //first check if favourite session is available

            if(!isset($_SESSION['favourite'][$productID])) { //if the product id is not in favourite
                $_SESSION['favourite'][$productID] = 1; //then assin the product id
                echo 'Added to your favourite';
                return true; //item was successfully added to favourite

            } else {
                echo 'Already on your favourite list';
                return false; //this item is already in favourite, can not add again
            }

        } else { //if cart session does not exist then create it and also add the product id to it
            $_SESSION['favourite'][$productID] = 1;
            echo 'Already on your favourite list';
            return true; //item was successfully added to favourite
        }


    }

     //Check if verification exit;
    public function isFavExist($userid, $productid){
        $query = "SELECT * FROM favourite WHERE userid=:userid AND productid=:productid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userid', $userid);
        $stmt->bindValue(':productid', $productid);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
    }

    //Get User product List
    public function fetch_auth_user_fav($userid){
        $sql2 = "SELECT * FROM favourite WHERE userid='$userid'";
        foreach ($this->conn->query($sql2) as $rowler){
            $productid =  $rowler['productid'];
            $stmt = $this->conn->prepare("SELECT *  FROM product_details WHERE productid='$productid'");
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            $product_user = $this->userDetails($data->userid);
            for ($i=0; $i < 7; $i++) {
              $img = 'img'.$i;
              if (!is_null($data->$img) && !empty($data->$img)) {
                $image = $data->$img;
                break;
              }
            }
                echo '<div class="col-md-12 col-lg-6 col-xl-3">
                        <div class="card-shadow-primary card-border mb-3 card">
                            <div class="dropdown-menu-header" style="width: 100%; height: 180px; overflow: hidden;">
                                <img src="'.BASE_URL.strtolower($product_user->role).'/productimg/'.$data->productid.'/'.$image.'" style="width: 100% !important; height: auto !important; margin: auto;" alt="Avatar 5">
                            </div>
                            <div class="p-3">
                                <ul class="rm-list-borders list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading"> '. $data->product_title .' </div>
                                                    <div class="widget-subheading" style="font-size: 12px !important;">
                                                        '.$data->product_category.'
                                                    </div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="font-size-sm text-muted">
                                                        <span class="badge badge-warning">'. $data->status .'</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center d-block card-footer">
                                <a href="'.BASE_URL.'product_details.php?productid='.$data->productid.'" class="btn btn-secondary btn-sm">View</a>
                                <button class="btn btn-danger btn-sm" id="'.$data->productid.'" onclick="remove_fav(this.id)">Remove</button>
                            </div>
                        </div>
                    </div>';

        }

    }

    public function public_dispute(){

        $query = "INSERT INTO public_dispute (disputeid,complainer_fullname,complainer_email,complainer_phone,against,subject_request,message_inform,status,evidencefile)
        VALUES (:disputeid,:complainer_fullname,:complainer_email,:complainer_phone,:against,:subject_request,:message_inform,:status,:evidencefile)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('disputeid', $this->disputeid);
        $stmt->bindValue('complainer_fullname', $this->complainer_fullname);
        $stmt->bindValue('complainer_email', $this->complainer_email);
        $stmt->bindValue('complainer_phone', $this->complainer_phone);
        $stmt->bindValue('against', $this->uid);
        $stmt->bindValue('subject_request', $this->subject_request);
        $stmt->bindValue('message_inform', $this->message_inform);
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('evidencefile', $this->disputename);

        if($stmt->execute()){
            $this->userid = 'All';
            $this->title = 'Public Dispute Submitted!';
            $this->body = $this->complainer_fullname.' just submitted a dispute request.';
            $this->generatedlink = BASE_URL."dispute_details.php?disputeid=".$this->disputeid;
            $this->notifications();

            $message = "<b>Hi ".$this->complainer_fullname."</b><br/>";
            $message .= "<hr>";
            $message .= "<h5>Your dispute request (".$this->subject_request.") have been received successfully</h5>";
            $message .= "<p> We are taking action, you would be contacted soon </p>";
            $message .= "<hr>";
            $message .= "<p> <b> Dispute Id: <h3>".$this->disputeid."</h3></b> </p>";
            $message .= "<hr>";

            $subject = "Dispute Report";
            // die("here");
            $this->sendMail($this->complainer_email,$subject,$message);

            return true;

        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function location_market($type){
        if($type == "Local"){
            $type = "Seller";
        }
        $sql = "SELECT count(*) FROM users WHERE role='$type'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM users WHERE role='$type'";
            foreach ($this->conn->query($sql) as $row) {
                $bizD = $this->bizDetails($row['userid']);
                if($this->isUserVerified($row['userid'])){
                    $vrf = '<img style="width: 70px !important; position: absolute; top: 0; right: 0; opacity: 1;" src="'.BASE_URL.'assets/images/verified.png" class="img-icon"/>';
                }else{
                    $vrf = '';
                }
                $dd = explode(' ', $row['date_reg']);
                if(isset($bizD->bizname)){
                    $bname = $bizD->bizname;
                    // $description = $bizD->bizname;
                    $baddress = $bizD->bizaddress;
                }else{
                    $bname = ucfirst($row['lname']).' '.ucfirst($row['fname']);
                    $baddress = $row['address'].', '.$row['state'].', '.$row['country'];
                }
                $storeimgs = $this->readforseller($row['userid']);
                $output ="";
                $output .= '<div class="card p-0 m-3 shadowbox" style="width: 22% !important;">
                        '.$storeimgs.'
                        <div class="card-body">
                            <h5 class="card-title">'.ucfirst($row['lname']).' '.ucfirst($row['fname']).'</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Business Name: '.$bname.'</li>
                            <li class="list-group-item">Market Location: '.$baddress.'</li>
                            <li class="list-group-item">Servies: '.@$bizD->service.'</li>
                            <li class="list-group-item">Date Joined: '.$dd[0].'</li>
                        </ul>
                        <div class="card-body">
                            <a href="'.BASE_URL.'seller_details.php?sellerid='.$row['userid'].'" class="btn btn-danger btn-sm">Visit Store</a>';
                             if (!isset($_SESSION['userid'])) {
                          $output .= '<a href="'.BASE_URL.'signin.php?redirect='.$_SERVER['REQUEST_URI'].'" class="btn btn-default btn-sm simpAskQuestionForm-btnOpen">Signin to Message Seller <i class="fa fa-envelope"></i></a>';
                          $output .= '<a href="'.BASE_URL.'signin.php?redirect='.$_SERVER['REQUEST_URI'].'" class="btn btn-danger btn-sm">Signin to Chat <i class="fa fa-comments"></i></a>';
                        }else {
                          $output .= ' <button class="btn btn-default btn-sm simpAskQuestionForm-btnOpen" onclick=messageSeller('.$row['sn'].')> Message Seller <i class="fa fa-envelope"></i></button>';
                          $output .= '<button class="btn btn-danger btn-sm" onclick="openForm(this.id)" id="'.$row['userid'].'"> Live Chat <i class="fa fa-comments"></i></button>';
                        }

                            $output .='</div>
                            </div>';
                            $output .='
                            <div class="modal fade" id="messageSeller-'.$row['sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Message seller</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="" id="">
                                    <div class="form-group">
                                      <textarea required style="resize:none; min-height:86px;" class="form-control" name="b_message'.$row['userid'].'" id="b_message'.$row['userid'].'" placeholder="Type your message here"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <input required type="text" name="b_name'.$row['userid'].'" value="" placeholder="Your Name" class="form-control" id="b_name'.$row['userid'].'">
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-md-6">
                                        <input required type="text" name="b_phone'.$row['userid'].'" value="" placeholder="Your Phone Number" class="form-control" id="b_phone'.$row['userid'].'">
                                      </div>
                                      <div class="col-md-6">
                                        <input required type="email" name="b_email'.$row['userid'].'" value="" placeholder="Your Email" class="form-control" id="b_email'.$row['userid'].'">
                                      </div>
                                    </div>
                                    <div class="p-3 form-group row mmm">
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <div class="simpAskSubmitForm">
                                    <div class="text-center" id="info"></div>
                                    <input type="hidden" id="productid" name="productid" value="">
                                    <input class="button button-primary btn btn-primary btn btn--fill btn--color" type="button" id="'.$row['userid'].'" onclick="sendMultiseller(this.id)" value=" Submit">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                                    <div class="clear"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>';

                          $output .='
                          <div class="chat-popup" id="myForm-'.$row['userid'].'">
                            <div class="form-container">
                              <h6 style="padding-top: 7px; padding-bottom: 7px;">Message Seller/Admin/Buyer</h6>
                              <hr>
                              <div class="form-group">
                                  <label for="msg"><b>User/Seller</b></label>
                                  <input type="text" class="form-control" value="'.ucfirst($row['lname']).' '.ucfirst($row['fname']).'" placeholder="'.ucfirst($row['lname']).' '.ucfirst($row['fname']).'" readonly>
                                  <input type="hidden" id="userid-'.$row['userid'].'" value="'.$row['userid'].'" placeholder="'.ucfirst($row['lname']).' '.ucfirst($row['fname']).'" readonly>

                              </div>
                              <div id="chat-box'.$row['userid'].'" class="chatbox" style="overflow: scroll;
                              max-height: 150px;"></div>
                              <div class="form-group">
                                  <label for="msg"><b>Message</b></label>
                                  <textarea placeholder="Type message.." id="c_message'.$row['userid'].'" name="c_message" onfocus="loadChatbox('.$row['userid'].')" rows="2" required></textarea>
                              </div>
                              <button type="submit" onclick="ReplymultiChatbox('.$row['userid'].')"class="btn btn-sm">Send</button>
                              <button type="button" class="btn btn-sm cancel" onclick="closeForm('.$row['userid'].')">Close</button>

                          </div>
                          </div>';
                            print($output);
                          }
                        }else{
            echo 'No record found';
            return;
        }
    }

    public function readforseller($userid){
        $query = "SELECT * FROM profilepic WHERE userid = :userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('userid', $userid);
        $stmt->execute();
        $user = $this->userDetails($userid);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // return $row['file_name'];
        if(isset($row['file_name'])){
            return '<img class="collection-img img-responsive lazyload" data-sizes="auto" src="'.BASE_URL.strtolower($user->role).'/profilepicture/'.$userid.'/'.$row['file_name'].'"  data-src="'.BASE_URL.strtolower($user->role).'/profilepicture/'.$userid.'/'.$row['file_name'].'"/>';
        }else{
            return '<img class="collection-img img-responsive lazyload mt-2" data-sizes="auto" src="'.BASE_URL.'assets/images/seller1.jpg" style="width: 100%; height: 270px; overflow-y: hidden;" data-src="'.BASE_URL.'assets/images/seller1.jpg"/>';
        }

    }

    public function remove_from_fav($userid, $productid){
        $query = "DELETE FROM favourite WHERE userid=:userid AND productid=:productid";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":userid" => $userid, ':productid' => $productid))){
            echo 'You have remove the product from your favourite list!';
            return true;
        }
    }
    public function remove_from_user_catalogue($catid){
        $query = "DELETE FROM user_category WHERE catid=:catid";

        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(':catid' => $catid))){
            echo 'Catalogue successfully removed';
            return true;
        }
    }

    public function message_seller_pd(){

        $query = "INSERT INTO message_seller_pd (messid,userid,receiverid,productid,b_name,b_phone,b_email,b_message,status)
        VALUES (:messid,:userid,:receiverid,:productid,:b_name,:b_phone,:b_email,:b_message,:status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('messid', $this->messid);
        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('receiverid', $this->receiverid);
        $stmt->bindValue('productid', $this->productid);
        $stmt->bindValue('b_name', $this->b_name);
        $stmt->bindValue('b_phone', $this->b_phone);
        $stmt->bindValue('b_email', $this->b_email);
        $stmt->bindValue('b_message', $this->b_message);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->userid;
            $this->title = 'New Message';
            $this->body = $this->b_name.' just sent you a message.';
            $this->generatedlink = BASE_URL."message_details.php?messid=".$this->messid;
            $this->notifications();
            return true;

        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
    public function reply_chat_messages($receiverid,$b_message,
        $status,$date_message){

        $query = "INSERT INTO messages (messageid,senderid,receiverid,msg,status)
        VALUES (:messageid,:senderid,:receiverid,:msg,:status)";

        $stmt = $this->conn->prepare($query);
        $messageid = mt_rand(100000, 999999);
        $senderid = $_SESSION['userid'];

        $stmt->bindValue('messageid', $messageid);
        $stmt->bindValue('senderid', $senderid);
        $stmt->bindValue('receiverid', $receiverid);
        $stmt->bindValue('msg', $b_message);
        $stmt->bindValue('status', $status);

        $name = $this->userDetails($_SESSION['userid']);
        if($stmt->execute()){
            $this->userid = $name->userid;
            $this->title = 'New Message';
            $this->body = $name->fname.' '.$name->lname .'just sent you a message.';
            $this->generatedlink = BASE_URL."message.php?messid=".$messageid;
            $this->notifications();
            return true;

        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function submit_review(){
        $query = "INSERT INTO submit_review_db (reviewid,productid,userid,reply,r_name,r_email,rating,r_title,r_body,status)
        VALUES (:reviewid,:product_id,:user_id,:reply,:r_name,:r_email,:rating,:r_title,:r_body,:status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('reviewid', $this->reviewid);
        $stmt->bindValue('product_id', $this->product_id);
        $stmt->bindValue('user_id', $this->user_id);
        $stmt->bindValue('reply', $this->reply);
        $stmt->bindValue('r_name', $this->r_name);
        $stmt->bindValue('r_email', $this->r_email);
        $stmt->bindValue('rating', $this->rating);
        $stmt->bindValue('r_title', $this->r_title);
        $stmt->bindValue('r_body', $this->r_body);
        $stmt->bindValue('status', $this->status);

        if($stmt->execute()){
            $this->userid = $this->user_id;
            $this->title = 'New Review';
            $this->body = $this->r_name.' just sent a review.';
            $this->generatedlink = BASE_URL."review_details.php?reviewid=".$this->reviewid;
            $this->notifications();
            return true;

        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //Get category into dropdown list
    public function fetch_review($productid){
        $sql = "SELECT count(*) FROM submit_review_db WHERE productid='$productid'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM submit_review_db WHERE productid='$productid' AND reply IS NULL ORDER BY id DESC";
            foreach ($this->conn->query($sql) as $row) {

                if($row['rating'] == 1){
                    $rating = '<i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>';
                }elseif($row['rating'] == 2){
                    $rating = '<i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>';
                }elseif($row['rating'] == 3){
                    $rating = '<i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>';
                }elseif($row['rating'] == 4){
                    $rating = '<i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star-empty"></i>';
                }elseif($row['rating'] == 5){
                    $rating = '<i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>
                    <i class="spr-icon spr-icon-star"></i>';
                }
                $reviewid = $row["reviewid"];
                $sql2 = "SELECT * FROM submit_review_db WHERE productid='$productid' AND reply ='$reviewid' ORDER BY id DESC";
                $output ="";
                $output .= '<ul class="spr-review">
                        <li style="list-style: none;">
                        <div class="spr-review-header">
                            <span class="spr-starratings spr-review-header-starratings" aria-label="4 of 5 stars" role="img">
                                '.@$rating.'
                            </span>
                            <h3 class="spr-review-header-title">'.@$row['r_title'].'</h3>
                            <span class="spr-review-header-byline">
                                <strong>'.@$row['r_name'].'</strong> on <strong>'.$row['date_created'].'</strong>
                            </span>
                        </div>
                        <div class="spr-review-content">
                            <p class="spr-review-content-body">'.@$row['r_body'].'</p>
                        </div>
                        </li>';

                        $output .= '<ul class="spr-review">';
                    foreach ($this->conn->query($sql2) as $row2) {
                      $output .= '<li style="list-style: none;">

                              <div class="spr-review-header">

                                  <h3 class="spr-review-header-title">'.@$row2['r_title'].'</h3>
                                  <span class="spr-review-header-byline">
                                      <strong>'.@$row2['r_name'].'</strong> on <strong>'.$row2['date_created'].'</strong>
                                  </span>
                              </div>
                              <div class="spr-review-content">
                                  <p class="spr-review-content-body">'.@$row2['r_body'].'</p>
                              </div>
                          </li>';
                    }
                    $output .= '</ul>';
                    $output .= '</ul>';
                    printf($output);
                  }


        }else{
            echo '<div class="spr-review">
                    <div class="spr-review-header">
                    <h3 class="spr-review-header-title">No review yet</h3>
                    </div>
                </div>';
        }
    }

    //Get User product List
    public function user_cat_products($userid, $catid){
        $sql = "SELECT * FROM product_details WHERE userid='$userid' AND product_catalogue='$catid'";
        foreach ($this->conn->query($sql) as $row) {
          for ($i=0; $i < 7; $i++) {
            $img = 'img'.$i;
            if (!is_null($row[$img]) && !empty($row[$img])) {
              $image = $row[$img];
              break;
            }
          }
            echo '<div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="card-shadow-primary card-border mb-3 card">
                        <div class="dropdown-menu-header" style="width: 100%; height: 180px; overflow: hidden;">
                            <img src="'.$this->location().'productimg/'.$row['productid'].'/'.$image.'" style="width: 100% !important; height: auto !important; margin: auto;" alt="Avatar 5">
                        </div>
                        <div class="p-3">
                            <ul class="rm-list-borders list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading"> '. $row['product_title'] .' </div>
                                                <div class="widget-subheading"  style="font-size: 12px !important;">
                                                     '. $row['product_category'] .'
                                                </div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="font-size-sm text-muted">
                                                    <span class="badge badge-warning">'. $row['status'] .'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="text-center d-block card-footer">
                            <a href="'.$this->location().'product_details.php?productid='.$row['productid'].'" class="btn btn-warning btn-sm">Details</a>
                            <a href="'.$this->location().'edit_product.php?productid='.$row['productid'].'" class="btn btn-danger btn-sm">Edit Product</a>
                        </div>
                    </div>
                </div>';
        }
    }
    public function location()
    {
      if ($_SESSION['role'] == "Seller") {
        return $this->locator = SELLER_URL;
      }
      if ($_SESSION['role'] == "International") {
        return $this->locator = INTERNATIONAL_URL;
      }
      if ($_SESSION['role'] == "Buyer") {
        return $this->locator = BUYER_URL;
      }
      if ($_SESSION['role'] == "Admin") {
        return $this->locator = ADMIN_URL;
      }
      if ($_SESSION['role'] == "Sub Admin") {
        return $this->locator = ADMIN_URL;
      }
      // code...
    }
    public function updatePassword(){
        $this->newpass = password_hash($this->newpass, PASSWORD_BCRYPT, array("cost" => 12));
        if($this->checkOldPass($this->userid, $this->oldpass)){
            echo "Your old password is incorrect!";
            return;
        }
        $query = "UPDATE users SET password=:newpass WHERE userid=:userid";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('newpass', $this->newpass);
        if($stmt->execute()){ return true; }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function checkOldPass($userid, $oldpassword){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userid=:userid");
        $stmt->bindParam("userid", $userid, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
        if(!password_verify($oldpassword, $data->password)){
          return true;
        }
    }

    public function process_checkout(){
        $output = '<table class="table table-responsive table-bordered">
                    <thead class="cart__row cart__header">
                    <th class="text-left" colspan="2">Product</th>
                    <th>Seller name(ID)</th>
                    <th>Pack Type: <br><small>Pack/Quantity (Price) (discount)</small></th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">Action</th>
                    </thead>
                    <tbody>';

            $total_item = 0;
            if(!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $sellerids => $productids) { //get product details of each cart items
                    $sellerD = $this->userDetails($sellerids);
                    $sellerBizD = $this->bizDetails($sellerids);
                    foreach($_SESSION['cart'][$sellerids] as $productid => $values){

                        $productD = $this->get_product_details($productid);
                        for ($i=0; $i < 7; $i++) {
                          $img = 'img'.$i;
                          if (!is_null($productD->$img) && !empty($productD->$img)) {
                            $image = $productD->$img;
                            break;
                          }
                        }
                        $product_id = $productD->productid;
                        $product_name = $productD->product_title;
                        $product_img = $image;
                        $product_vendor = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;
                        $vendorid = $sellerD->userid;
                        $currency = $sellerD->currency;
// print_r($currency);
// print_r($productD->pack0);
for ($i=0; $i < 8; $i++) {
  $park = "pack".$i;
  $price = "price".$i;
  $discount = "discount".$i;
  if (!is_null($productD->$park) && !empty($productD->$park)) {
    if ( strpos($productD->$park, '+') ) {
      $item = explode('+',$productD->$park);

    }elseif (strpos($productD->$park, '@') ) {

      $item = explode('@',$productD->$park);
    }else {
      $item ="";
    }
      $packets = '<option value="'.$item[0].'@'.$item[1].'@'.$item[2].'">per-'.$item[0].' ('.$currency.number_format($item[1], 2).') ('.$item[2].'%)</option>';
    }

}

                        if($currency == '$'){
                            $summing = 'Dolar';
                        }elseif($currency == 'N'){
                            $summing = 'Naira';
                        }

                        if (isset($_SESSION['cart'][$sellerids])) { //first check if cart session is available
                            $cart = $_SESSION['cart'][$sellerids];
                            if(array_key_exists($productid, $cart)) {
                                $qty_set = $cart[$productid]['qty'];
                                $pack_type_set = $cart[$productid]['pack_type'];
                                $pack_type_set_val = $cart[$productid]['pack_type'];
                                $tot_set = $cart[$productid]['total_price'];
                            }else{
                                $qty_set = 0;
                                $pack_type_set = 'Choose...';
                                $pack_type_set_val = '';
                                $tot_set = 0;
                            }
                        }else{
                            $qty_set = 0;
                            $pack_type_set = 'Choose...';
                            $pack_type_set_val = '';
                            $tot_set = 0;
                        }

                        $output .='<tr class="cart__row border-bottom line1 cart-flex border-top" id="item_'.$productid.'">
                                        <td class="cart__image-wrapper cart-flex-item">
                                        <a href="#">
                                        <img class="img img-thumbnail" width="100" height="auto" src="'.BASE_URL.strtolower($sellerD->role).'/productimg/'.$product_id.'/'.$product_img.'">
                                        </a>
                                        </td>
                                        <td class="cart__meta small--text-left cart-flex-item">
                                        <div class="list-view-item__title">
                                            <a href="#">
                                            '.$product_name.'(#'.$productid.')
                                            </a>
                                        </div>
                                        </td>
                                        <td><strong>'.$product_vendor.'(#'.$vendorid.')</strong></td>
                                        <td class="cart__price-wrapper cart-flex-item">';
                                        $item = explode('@',$pack_type_set);
                                        $output .='
                                        <select class="form-control" id="packaging_'.$productid.'" name="packaging[]">
                                            <option value="'.@$item[0].'@'.@$item[1].'@'.@$item[2].'">per-'.@$item[0].' ('.@$currency.@$item[1].') ('.@$item[2].'%)(default)</option>';
                                            for ($i=0; $i < 8; $i++) {
                                              $park = "pack".$i;
                                              $price = "price".$i;
                                              $discount = "discount".$i;
                                              if (!is_null($productD->$park) && !empty($productD->$park)) {
                                                if ( strpos($productD->$park, '+') ) {
                                                  $item = explode('+',$productD->$park);

                                                }elseif (strpos($productD->$park, '@') ) {

                                                  $item = explode('@',$productD->$park);
                                                }else {
                                                  $item ="";
                                                }
                                                  $output .= '<option value="'.$item[0].'@'.$item[1].'@'.$item[2].'">per-'.$item[0].' ('.$currency.number_format($item[1], 2).') ('.$item[2].'%)</option>';
                                                }

                                            }
                                  $output .='
                                        </select>
                                        <input type="hidden" id="sellerid" name="sellerid" value="'.$sellerids.'" >
                                        <input type="hidden" id="productid" name="productid" value="'.$productid.'" >
                                        </td>
                                        <td class="cart__update-wrapper cart-flex-item text-left">
                                        <div class="cart__qty row">
                                            <label class="cart__qty-label col-4">Quantity</label>
                                            <input class="form-control col-3" type="number" name="qty" id="qty_'.$productid.'" min="0" pattern="[0-9]*" value="'.$qty_set.'">
                                            <button type="button" name="update" class="btn btn-sm btn-danger col-3" id="'.$sellerids.'" onclick="calculate('.$productid.', this.id)">Update</button>
                                        </div>
                                        </td>
                                        <td class="text-left small--hide">
                                        <div>
                                            <input type="number" class="form-control '.$summing.'" id="Tmoney_'.$productid.'" name="subtotal[]" value="'.$tot_set.'" readonly>
                                        </div>
                                        </td>
                                        <td class="text-left small--hide"><button type="button" class="btn btn-sm btn-danger" id="'.$sellerids.'" onclick="AddCartmini(this.id, '.$productid.',0)"><i class="fa fa-times"></i></button></td>
                                    </tr>';

                    }
                }

            } else {
                $output .='<tr class="cart__row border-bottom line1 cart-flex border-top">
                    <td colspan="7" class="cart__image-wrapper cart-flex-item">
                        Your cart is empty.
                    </tdc>
                </tr>';
            }
        $output .='</tbody></table>';
        if(!empty($_SESSION['cart'])){
            $output .='<footer class="cart__footer">
                <div class="row">
                    <div class="col-sm-6 col-12 offset-6 text-right small--text-center medium-up--one-half">
                        <div class="cart_border">
                        <div>
                            <span class="cart__subtotal-title"><span id="bk-cart-subtotal-label">Grand Total (N)</span></span>
                            <span class="cart__subtotal"><span id="bk-cart-subtotal-price"><input class="grand_total_naira"  value="" id="grand_total_naira" name="grand_total_naira" readonly></span></span>
                        </div>
                        <hr>
                        <div>
                            <span class="cart__subtotal-title"><span id="bk-cart-subtotal-label">Grand Total ($)</span></span>
                            <span class="cart__subtotal"><span id="bk-cart-subtotal-price"><input class="grand_total_dollar"  value="" id="grand_total_dollar" name="grand_total_dollar" readonly></span></span>
                        </div>
                        <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                        <a href="'.BASE_URL.'" class="btn btn-danger cart__update cart__continue--large small--hide" >Continue shopping</a>
                        <a href="make_pay.php" type="submit" name="proceed_checkout" class="btn btn-success">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </footer>';
        }
        echo $output;

    }
    public function process_checkout2(){
        $output = ' <div class="table-responsive">
<table class="table">
                    <thead class="cart__row cart__header">
                    <th class="text-left" colspan="2">Product</th>
                    <th>Seller name(ID)</th>
                    <th>Price</th>
                    <th>Pack Type: <br><small>Pack/Quantity (Price) (discount)</small></th>
                    <th class="text-left">Quantity</th>
                    <th class="text-left">Total</th>
                    <th class="text-left">Action</th>
                    </thead>
                    <tbody>
                    ';

            $total_item = 0;
            if(isset($_COOKIE['cart']) && !empty(json_decode($_COOKIE['cart'], true))) { //if cart is available
              foreach (json_decode($_COOKIE['cart'], true) as $id) { //get product details of each cart items
                    $sellerD = $this->userDetails($id['sellerid']);
                    $sellerBizD = $this->bizDetails($id['sellerid']);
                    // foreach($_SESSION['cart'][$sellerids] as $productid => $values){

                    $productD = $this->get_product_details($id['productID']);
                    for ($i=0; $i < 7; $i++) {
                      $img = 'img'.$i;
                      if (!is_null($productD->$img) && !empty($productD->$img)) {
                        $image = $productD->$img;
                        break;
                      }
                    }
                    $product_id = $productD->productid;
                    $product_name = $productD->product_title;

                    $product_img = $image;
                    $product_vendor = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;
                    $vendorid = $sellerD->userid;
                    $currency = $sellerD->currency;
                    // print_r($currency);
                    // print_r($productD->pack0);
                    for ($i=0; $i < 8; $i++) {
                      $park = "pack".$i;
                      $price = "price".$i;
                      $discount = "discount".$i;
                      if (!is_null($productD->$park) && !empty($productD->$park)) {
                        if ( strpos($productD->$park, '+') ) {
                          $item = explode('+',$productD->$park);

                        }elseif (strpos($productD->$park, '@') ) {

                          $item = explode('@',$productD->$park);
                        }else {
                          $item ="";
                        }
                        $packets = '<option value="'.$item[0].'@'.$item[1].'@'.$item[2].'">per-'.$item[0].' ('.$currency.number_format($item[1], 2).') ('.$item[2].'%)</option>';
                      }

                    }
                  for ($i=0; $i < 8; $i++) {
                      $park = "pack".$i;
                      $price = "price".$i;
                      $discount = "discount".$i;

                      if (!is_null($productD->$park) && !empty($productD->$park)) {
                          if ( strpos($productD->$park, '+') ) {
                              $item = explode('+',$productD->$park);

                          }elseif (strpos($productD->$park, '@') ) {

                              $item = explode('@',$productD->$park);
                          }else {
                              $item ="";
                          }
                          $product_price = $currency.number_format($item[1], 2);
                      }

                  }

                  if($currency == '$'){
                      $summing = 'Dollar';
                    }elseif($currency == 'N'){
                      $summing = 'Naira';
                    }
                    if (isset($id['pack']) && isset($id['qty']) && isset($id['price'])) { //first check if cart session is available
                        $qty_set = $id['qty'] ?? 1;
                        $pack_type_set = $id['pack'];
                        $tot_set = $id['price'];
                      }else{
                        $qty_set = 1;
                        $pack_type_set = 'Choose...';
                        // $pack_type_set_val = '';
                        $tot_set = 0;
                    }

                    $output .='<tr class="cart__row border-bottom line1 cart-flex border-top" id="item_'.$id['productID'].'">
                      <td class="cart__image-wrapper cart-flex-item">
                        <a href="#">
                          <img class="img img-thumbnail" width="100" height="auto" src="'.BASE_URL.strtolower($sellerD->role).'/productimg/'.$product_id.'/'.$product_img.'">
                        </a>
                      </td>
                      <td class="cart__meta small--text-left cart-flex-item">
                        <div class="list-view-item__title">
                          <a href="#">
                            '.$product_name.'(#'.$id['productID'].')
                          </a>
                        </div>
                      </td>
                      <td><strong>'.$product_vendor.'(#'.$vendorid.')</strong></td>
                      <td>
                        <strong>'.$product_price.'</strong>
                      </td>
                      <td class="cart__price-wrapper cart-flex-item">';
                        $item = explode('@',$pack_type_set);
                        $output .='
                        <select class="form-control" id="packaging_'.$id['productID'].'" name="packaging[]" onchange="calculate('.$id['productID'].')">
                          <option value="'.@$item[0].'@'.@$item[1].'@'.@$item[2].'">per-'.@$item[0].' ('.@$currency.@$item[1].') ('.@$item[2].'%)(default)</option>';
                          for ($i=0; $i < 8; $i++) {
                            $park = "pack".$i;
                            $price = "price".$i;
                            $discount = "discount".$i;
                            if (!is_null($productD->$park) && !empty($productD->$park)) {
                              if ( strpos($productD->$park, '+') ) {
                                $item = explode('+',$productD->$park);

                              }elseif (strpos($productD->$park, '@') ) {

                                $item = explode('@',$productD->$park);
                              }else {
                                $item ="";
                              }
                              $output .= '<option value="'.$item[0].'@'.$item[1].'@'.$item[2].'">per-'.$item[0].' ('.$currency.number_format($item[1], 2).') ('.$item[2].'%)</option>';
                            }

                          }
                          $output .='
                        </select>
                        <input type="hidden" id="sellerid" name="sellerid[]" value="'.$id['sellerid'].'" >
                        <input type="hidden" id="productid" name="productid[]" value="'.$id['productID'].'" >
                      </td>
                      <td class="cart__update-wrapper cart-flex-item text-left">
                        <div class="cart__qty row">
                          <label class="cart__qty-label col-4">Quantity</label>
                          <input class="form-control col-3" type="number" name="qty[]" id="qty_'.$id['productID'].'" min="0" pattern="[0-9]*" value="'.$qty_set.'" min="1" onchange="calculate('.$id['productID'].')">
                          
                        </div>
                      </td>
                      <td class="text-left small--hide">
                        <div>
                          <input type="number" class="form-control each" currency="'.$summing.'" id="Tmoney_'.$id['productID'].'" name="subtotal[]" value="'.$tot_set.'" readonly>
                        </div>
                      </td>
                      <td class="text-left small--hide"><button type="button" class="btn btn-sm btn-danger" id="'.$id['sellerid'].'" onclick="AddCartmini(this.id, '.$id['productID'].',0)"><i class="fa fa-times"></i></button></td>
                    </tr>';

                    //}
                }

            } else {
                $output .='<tr class="cart__row border-bottom line1 cart-flex border-top">
                    <td colspan="8" class="cart__image-wrapper cart-flex-item">
                        Your cart is empty.
                    </tdc>
                </tr>';
            }
        $output .='</form></tbody></table></div>';
        // die(print_r(json_decode($_COOKIE['cart'])));
        if(isset($_COOKIE['cart']) && !empty(json_decode($_COOKIE['cart'], true))) { //if cart is available
            $output .='<footer class="cart__footer">
                <div class="row">
                    <div class="col-sm-6 col-12 offset-6 text-right small--text-center medium-up--one-half">
                        <div class="cart_border">
                        <div>
                            <span class="cart__subtotal-title"><span id="bk-cart-subtotal-label">Grand Total (N)</span></span>
                            <span class="cart__subtotal"><span id="bk-cart-subtotal-price"><input class="grand_total_naira"  value="" id="grand_total_naira" name="grand_total_naira" readonly></span></span>
                        </div>
                        <hr>
                        <div>
                            <span class="cart__subtotal-title"><span id="bk-cart-subtotal-label">Grand Total ($)</span></span>
                            <span class="cart__subtotal"><span id="bk-cart-subtotal-price"><input class="grand_total_dollar"  value="" id="grand_total_dollar" name="grand_total_dollar" readonly></span></span>
                        </div>
                        <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                        <a href="'.BASE_URL.'" class="btn btn-danger cart__update cart__continue--large small--hide" >Continue shopping</a>
                        <button type="submit" name="proceed_checkout" class="btn btn-success">Proceed to Checkout</button>
                        </div>
                    </div>
                </div>
            </footer>';
        }
        echo $output;

    }

    public function addordertemp(){
        $query = "INSERT INTO order_temp(orderid,sellerid,productid,packaging,qty,subtotal,status)
            VALUES (:orderid,:sellerid,:productid,:packaging,:qty,:subtotal,:status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('orderid', $this->orderid);
        $stmt->bindValue('sellerid', $this->sellerid);
        $stmt->bindValue('productid', $this->productid);
        $stmt->bindValue('packaging', $this->packaging);
        $stmt->bindValue('qty', $this->qty);
        $stmt->bindValue('subtotal', $this->subtotal);
        $stmt->bindValue('status', $this->status);

        $stmt->execute();
    }

    public function send_messager(){
        $query = "INSERT INTO messages(messageid,senderid,receiverid,msg,status)
            VALUES (:messageid,:senderid,:receiverid,:msg,:status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('messageid', $this->messageid);
        $stmt->bindValue('senderid', $this->senderid);
        $stmt->bindValue('receiverid', $this->receiverid);
        // $stmt->bindValue('subj', $this->subj);
        $stmt->bindValue('msg', $this->msg);
        $stmt->bindValue('status', $this->status);
        $stmt->execute();
    }

    public function fetch_user_messages($userid){
        $sql = "SELECT count(*) FROM messages WHERE senderid='$userid' OR receiverid='$userid'";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = "SELECT * FROM messages WHERE senderid='$userid' OR receiverid='$userid' ORDER BY id DESC";
            foreach ($this->conn->query($sql) as $row) {
                $senderinfo = $this->userDetails($row['senderid']);
                $receiverinfo = $this->userDetails($row['receiverid']);
                if($row['status'] == 0){
                    $sta = 'Pending';
                }elseif($row['status'] == 1){
                    $sta = 'Read';
                }
                echo '<tr>
                        <td class="text-center" style="width: 78px;">
                            <strong>'.$senderinfo->username.'</strong>
                        </td>
                        <td class="text-center">
                            <strong>'.$receiverinfo->username.'</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-danger">'.$sta.'</span>
                        </td>
                        <td class="text-center">
                            <small>'.$row['date_messaged'].'</small>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-outline-danger btn-sm" onclick="replyMessage('.$row['messageid'].'")>Reply</button>
                        </td>
                    </tr>';
            }
        }else{
            echo '<tr>
            <td class="text-center" style="width: 78px;">
                <div class="custom-checkbox custom-control">
                    You have no messages
                </div>
            </td></tr';
        }
    }

    public function payment_page(){

            if(!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $sellerids => $productids) { //get product details of each cart items
                    $sellerD = $this->userDetails($sellerids);
                    $sellerBizD = $this->bizDetails($sellerids);
                        $product_vendor = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;
                        $currency = $sellerD->currency;

                        if($currency == 'N'){
                            $summing = 'Dolar';
                        }elseif($currency == '$'){
                            $summing = 'Naira';
                        }

                    $output = '<table class="table table-striped">
                            <h2>'.$product_vendor.' - #'.$sellerids.'</h2>
                            <span style="float: right;" id="info_'.$sellerids.'"></span>
                            <thead>
                            <tr>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Pack Type</th>
                                <th scope="col">Total Quantity</th>
                                <th scope="col">Sub-Total</th>
                                <th scope="col">Payment Status</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $total_price = 0;
                            foreach($_SESSION['cart'][$sellerids] as $productid => $values){
                                $productD = $this->get_product_details($productid);
                                for ($i=0; $i < 7; $i++) {
                                  $img = 'img'.$i;
                                  if (!is_null($productD->$img) && !empty($productD->$img)) {
                                    $image = $productD->$img;
                                    break;
                                  }
                                }
                                $product_id = $productD->productid;
                                $product_name = $productD->product_title;
                                $product_img = $image;
                                $vendor_biz = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;
                                $vendor_fname = $sellerD->fname;
                                $vendor_lname = $sellerD->lname;
                                $vendor_email = $sellerD->email;
                                $vendor_phone = $sellerD->phone;
                                $currency = $sellerD->currency;

                                if($currency == 'N'){
                                    $summing = 'Dolar';
                                }elseif($currency == '$'){
                                    $summing = 'Naira';
                                }

                                $cart = $_SESSION['cart'][$sellerids];
                                $qty_set = $cart[$productid]['qty'];
                                $pack_type_set = $cart[$productid]['pack_type'];
                                $packType = explode('@', $pack_type_set);
                                $packType = $packType[0];
                                $tot_set = $cart[$productid]['total_price'];
                                $total_price  += $tot_set;

                                // print_r($tot_set);
                                if (isset($_SESSION['order'])) {
                                    $cart = $_SESSION['order'];
                                    if(array_key_exists($sellerids, $cart)) {
                                        if($cart[$sellerids]['status']==2){
                                            $pay_status = 'PAID';
                                            $sss = '<tr><td colspan="7"><span class="badge badge-success">Your order has been place!</span></td></tr>';
                                        }elseif($cart[$sellerids]['status']==1){
                                            $pay_status = 'Pay on Arrival';
                                            $sss = '<tr align="right"><td colspan="7" align="right"><span class="alert alert-danger">Your order placed!</span></td></tr>';
                                        }
                                    }else{
                                        $pay_status = 'NOT PAID';
                                        $sss = '<tr>
                                        <td colspan="5">';
                                        if ($currency == "$") {
                                          $sss .= '<div id="paypal-button-container'.$sellerids.'" sellerid="'.$sellerids.'" productid="'.$productid.'" qty="'.$qty_set.'" details="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'"><button id="'.$sellerids.'" class="btn btn-success pull-right" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paypal('.$sellerids.');">Pay with paypal</button></div>';
                                        }else {
                                          $sss .= '<button class="btn btn-success pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paywithcard('.$sellerids.', this.id);">Pay with Card</button>';
                                        }

                                        $sss .= ' <span id="success'.$sellerids.'" style="display:none;" class="badge badge-success">Your order has been place!</span></td>

                                        <td colspan="2"><button class="btn btn-danger pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 7px !important; font-size: 16px !important; background-color: red; text-align: right !important;" onclick="payondelivery('.$sellerids.', this.id)">Pay on Delivery</button></td></tr>';
                                    }
                                }else{
                                    $pay_status = 'NOT PAID';
                                    $sss = '<tr>
                                    <td colspan="5">';
                                    if ($currency == "$") {
                                      $sss .= '<div id="paypal-button-container'.$sellerids.'" sellerid="'.$sellerids.'" productid="'.$productid.'" qty="'.$qty_set.'" details="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'"><button id="'.$sellerids.'" class="btn btn-success pull-right" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paypal('.$sellerids.');">Pay with paypal</button></div>';
                                    }else {
                                      $sss .= '<button class="btn btn-success pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paywithcard('.$sellerids.', this.id);">Pay with Card</button>';
                                    }

                                    $sss .= '</td>

                                        <td colspan="2"><button class="btn btn-danger pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 7px !important; font-size: 16px !important; background-color: red; text-align: right !important;" onclick="payondelivery('.$sellerids.', this.id)">Pay on Delivery</button></td></tr>';
                                }

                               $output .= '<tr align="center">
                                            <td scope="row"><img class="img img-thumbnail" width="50" height="auto" src="'.BASE_URL.strtolower($sellerD->role).'/productimg/'.$product_id.'/'.$product_img.'"></td>
                                            <td>#'.$productid.'</td>
                                            <td>'.$product_name.'</td>
                                            <td><em>per-</em>'.$packType.'</td>
                                            <td>'.$qty_set.'</td>
                                            <td>'.$currency.''.number_format($tot_set, 2).'</td>
                                            <td>'.$pay_status.'</td>
                                        </tr>';
                            }

                    $output .= '<tr>
                                    <td  style="text-align: right;" colspan="5"><h2>Grand Total</h2></td>
                                    <td colspan="2">'.$currency.number_format($total_price, 2).'</td>
                                </tr>
                                '.$sss.'
                            </tbody>
                        </table><br><br>';
                    echo $output;
                }

            }
    }
    public function payment_page2(){

      if(isset($_COOKIE['checkout']) && !empty(json_decode($_COOKIE['checkout'], true))) { //if cart is available
        foreach (json_decode($_COOKIE['checkout'], true)[0]['orders'] as $sellerids => $productids) {
          //get product details of each cart items

                    $sellerD = $this->userDetails($sellerids);
                    $sellerBizD = $this->bizDetails($sellerids);
                        $product_vendor = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;
                        $currency = $sellerD->currency;

                        if($currency == 'N'){
                            $summing = 'Dolar';
                        }elseif($currency == '$'){
                            $summing = 'Naira';
                        }

                    $output = '<table class="table table-striped">
                            <h2>'.$product_vendor.' - #'.$sellerids.'</h2>
                            <span style="float: right;" id="info_'.$sellerids.'"></span>
                            <thead>
                            <tr>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Pack Type</th>
                                <th scope="col">Total Quantity</th>
                                <th scope="col">Sub-Total</th>
                                <th scope="col">Payment Status</th>
                            </tr>
                            </thead>
                            <tbody>';
                            $total_price = 0;
                            // foreach ($productids as $key => $values) {
                            //   print_r( $key);
                            //   // code...
                            // }
                            foreach($productids as $productid => $values){
                                $productD = $this->get_product_details($productid);
                                for ($i=0; $i < 7; $i++) {
                                  $img = 'img'.$i;
                                  if (!is_null($productD->$img) && !empty($productD->$img)) {
                                    $image = $productD->$img;
                                    break;
                                  }
                                }
                                $product_id = $productD->productid;
                                $product_name = $productD->product_title;
                                $product_img = $image;
                                $vendor_biz = isset($sellerBizD->bizname) ? $sellerBizD->bizname : $sellerD->username;
                                $vendor_fname = $sellerD->fname;
                                $vendor_lname = $sellerD->lname;
                                $vendor_email = $sellerD->email;
                                $vendor_phone = $sellerD->phone;
                                $currency = $sellerD->currency;

                                if($currency == 'N'){
                                    $summing = 'Dolar';
                                }elseif($currency == '$'){
                                    $summing = 'Naira';
                                }
                                $qty_set = $values['qty'];
                                $pack_type_set = $values['pack_type'];
                                $pack_type_set = explode('@', $pack_type_set);

                                $packType = $pack_type_set[0];
                                $packPrice = $pack_type_set[1];
                                $tot_set = $values['total_price'];
                                $total_price  += $tot_set;

                                // print_r($_SESSION);
                                  // $seller =[];
                                if (isset($_COOKIE['order'])) {
                                    $cart =  array(json_decode($_COOKIE['order'], true));
                                    $seller = array('seller' => $sellerids);
                                    // print_r($cart);
                                    foreach ($cart as $key => $value) {
                                      // print_r(in_array($seller, $value));
                                      // code...

                                    // print_r(in_array($seller, $cart));
                                    if(in_array($seller, $value)) {
                                            $pay_status = 'PAID';
                                            // $sss = '<tr><td colspan="7"><span class="badge badge-success">Your order has been place!</span></td></tr>';
                                            $sss = '<tr align="right"><td colspan="7" align="right"><span class="alert alert-danger">Your order placed!</span></td></tr>';


                                    }else{
                                        $pay_status = 'NOT PAID';
                                        $sss = '<tr>
                                        <td colspan="5">';
                                        if ($currency == "$") {
                                          $sss .= '<div id="paypal-button-container'.$sellerids.'" sellerid="'.$sellerids.'" productid="'.$productid.'" qty="'.$qty_set.'" details="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'"><button id="'.$sellerids.'" class="btn btn-success pull-right" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paypal('.$sellerids.');">Pay with paypal</button></div>';
                                        }else {
                                          $sss .= '<button class="btn btn-success pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paywithcard('.$sellerids.', this.id);">Pay with Card</button>';
                                        }

                                        $sss .= ' <span id="success'.$sellerids.'" style="display:none;" class="badge badge-success">Your order has been place!</span></td>

                                        <td colspan="2"><button class="btn btn-danger pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set. '" style="padding: 7px !important; font-size: 16px !important; background-color: #ff0000; text-align: right !important;" onclick="payondelivery(' .$sellerids.', this.id)">Pay on Delivery</button></td></tr>';
                                    }
                                  }
                                }else{
                                    $pay_status = 'NOT PAID';
                                    $sss = '<tr>
                                    <td colspan="5">';
                                    if ($currency == "$") {
                                      $sss .= '<div id="paypal-button-container'.$sellerids.'" sellerid="'.$sellerids.'" productid="'.$productid.'" qty="'.$qty_set.'" details="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'"><button id="'.$sellerids.'" class="btn btn-success pull-right" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paypal('.$sellerids.');">Pay with paypal</button></div>';
                                    }else {
                                      $sss .= '<button class="btn btn-success pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 8px !important; font-size: 16px !important; text-align: right !important;" onclick="paywithcard('.$sellerids.', this.id);">Pay with Card</button>';
                                    }

                                    $sss .= '</td>

                                        <td colspan="2"><button class="btn btn-danger pull-right" id="'.$total_price.'~'.$vendor_fname.'~'.$vendor_lname.'~'.$vendor_email.'~'.$vendor_phone.'~'.$currency.'~'.$productid.'~'.$qty_set.'" style="padding: 7px !important; font-size: 16px !important; background-color: red; text-align: right !important;" onclick="payondelivery('.$sellerids.', this.id)">Pay on Delivery</button></td></tr>';
                                }

                               $output .= '<tr align="center">
                                            <td scope="row"><img class="img img-thumbnail" width="50" height="auto" src="'.BASE_URL.strtolower($sellerD->role).'/productimg/'.$product_id.'/'.$product_img.'"></td>
                                            <td>#'.$productid.'</td>
                                            <td>'.$product_name.'</td>
                                            <td>'.$currency.''.number_format($packPrice, 2).'</td>
                                            <td><em>per-</em>'.$packType.'</td>
                                            <td>'.$qty_set.'</td>
                                            <td>'.$currency.''.number_format($tot_set, 2).'</td>
                                            <td>'.$pay_status.'</td>
                                        </tr>';
                            }

                    $output .= '<tr>
                                    <td  style="text-align: right;" colspan="5"><h2>Grand Total</h2></td>
                                    <td colspan="2">'.$currency.number_format($total_price, 2).'</td>
                                </tr>
                                '.$sss.'
                            </tbody>
                        </table><br><br>';
                    echo $output;
                }

                // die(print_r($currency));
            }
    }

    public function place_order(){
        $query = "INSERT INTO order_tbl(orderid,userid,sellerid,orders,currency,location,cost,pay_status,pickup_code)
            VALUES (:orderid,:userid,:sellerid,:orders,:currency,:location,:cost,:pay_status,:pickup_code)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('orderid', $this->orderid);
        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('sellerid', $this->sellerid);
        $stmt->bindValue('orders', $this->orders);
        $stmt->bindValue('currency', $this->currency);
        $stmt->bindValue('location', $this->billing_address);
        $stmt->bindValue('cost', $this->total_amount);
        $stmt->bindValue('pay_status', $this->pay_status);
        $stmt->bindValue('pickup_code', $this->pickup_code);
        if($stmt->execute()){
            return true;
        }
    }
    public function place_qorder(){
        $query = "INSERT INTO quick_ordertbl (orderid,sellerid,productcategory,productid,quantity,fullname,email,phone,delivery_address,order_description)
            VALUES (:orderid,:sellerid,:productcategory,:productid,:quantity,:fullname,:email,:phone,:delivery_address,:order_description)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('orderid', $this->orderid);
        $stmt->bindValue('sellerid', $this->sellerid);
        $stmt->bindValue('productcategory', $this->productcategory);
        $stmt->bindValue('productid', $this->productid);
        $stmt->bindValue('quantity', $this->quantity);
        $stmt->bindValue('fullname', $this->fullname);
        $stmt->bindValue('email', $this->email);
        $stmt->bindValue('phone', $this->phone);
        $stmt->bindValue('delivery_address', $this->delivery_address);
        $stmt->bindValue('order_description', $this->order_description);
        if($stmt->execute()){
            return true;
        }
    }
    public function transactions(){
        $query = "INSERT INTO transactions (payer,payee,productid,amount,status,details)
            VALUES (:payer,:payee,:productid,:amount,:status,:details)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('payer', $this->buyer_name);
        $stmt->bindValue('payee', $this->sellerid);
        $stmt->bindValue('productid', $this->productid);
        $stmt->bindValue('amount', $this->total_amount);
        $stmt->bindValue('status', $this->status);
        $stmt->bindValue('details', json_encode($this->details));
        if($stmt->execute()){
            return true;
        }
    }

    public function view_all_wallet(){

        $sql = 'SELECT * FROM wallet ORDER BY id';
        foreach ($this->conn->query($sql) as $row) {
          $address = json_decode($row['location']);

            echo '<tr role="row" class="odd">
                    <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['buyer_name'].'</td>
                    <td>'.$row['billing_address'].'</td>
                    <td>'.$row['sellerid'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>'.$row['product_price'].'</td>
                    <td>'.$row['total'].'</td>
                    <td>'.@$address->address_line_1.'</td>
                    <td>'.$row['payment_method'].'</td>
                    <td>'.$row['paid_date'].'</td>
                    <td>'.$row['payment_status'].'</td>
                </tr>';
        }
    }
    public function view_seller_wallet($userid){

        $sql = "SELECT * FROM wallet WHERE sellerid='$userid' ORDER BY id";
        foreach ($this->conn->query($sql) as $row) {
          $address = json_decode($row['location']);

            echo '<tr role="row" class="odd">
                    <td><a href="'.BASE_URL.'admin/product_details.php?productid='.$row['productid'].'">'.$row['productid'].'</a></td>
                    <td>'.$row['buyer_name'].'</td>
                    <td>'.$row['billing_address'].'</td>
                    <td>'.$row['sellerid'].'</td>
                    <td>'.$row['qty'].'</td>
                    <td>'.$row['product_price'].'</td>
                    <td>'.$row['total'].'</td>
                    <td>'.@$address->address_line_1.'</td>
                    <td>'.$row['payment_method'].'</td>
                    <td>'.$row['paid_date'].'</td>
                    <td>'.$row['payment_status'].'</td>
                </tr>';
        }
    }

    public function wallet(){
        $query = "INSERT INTO wallet(productid,buyer_name,billing_address,sellerid,qty,product_price,total,location,payment_method,paid_date,payment_status)
            VALUES (:productid,:buyer_name,:billing_address,:sellerid,:qty,:product_price,:total,:location,:payment_method,:paid_date,:payment_status)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue('productid', $this->productid);
        $stmt->bindValue('buyer_name', $this->buyer_name);
        $stmt->bindValue('billing_address', $this->billing_address);
        $stmt->bindValue('sellerid', $this->sellerid);
        $stmt->bindValue('qty', $this->qty);
        $stmt->bindValue('product_price', $this->product_price);
        $stmt->bindValue('total', $this->total_amount);
        $stmt->bindValue('location', json_encode($this->location));
        $stmt->bindValue('payment_method', $this->payment_method);
        $stmt->bindValue('paid_date', date("Y-m-d H:i:s"));
        $stmt->bindValue('payment_status', $this->status);
        if($stmt->execute()){
            return true;
        }
    }

    public function get_orders($userid){

        $sql = 'SELECT * FROM order_tbl WHERE sellerid='.$userid.' ORDER BY id DESC';
        $rows = $this->conn->query($sql);
        $seller = $this->userDetails($userid);
        foreach ($rows as $row) {
            foreach (json_decode($row['orders']) as $key => $value) {
              // code...
              $product = $this->get_product_details($key);
              for ($i=0; $i < 7; $i++) {
                $img = 'img'.$i;
                if (!is_null($product->$img) && !empty($product->$img)) {
                  $image = $product->$img;
                  break;
                }
              }
              $buyer = $this->userDetails($row['userid']);
              $profilepic = $this->profilepic_link($row['userid']);
              // print_r(json_decode($row['orders']));
              // print_r( $this->profilepic_link($row['userid']));
              // readProfilePixController($row['userid'])

            }

            $output ='';
            $output .='

            <div class="col-md-6">
                <div class="main-card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <img width="100" height="autp" class="rounded" src="'.BASE_URL.strtolower($seller->role).'/productimg/'.$product->productid.'/'.$image.'" alt="">
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">ORDER: '.$row['orderid'].'</div>
                                            <div class="widget-subheading opacity-10">
                                                <span><b class="text-success">'.$row['currency'].''.$value->total_price.'</b></span><br>
                                                ';
                                                // print_r(count((array)json_decode($row['orders'])));
                                                $count = count((array)json_decode($row['orders']));
                                                $i=0;
                                                $newcount = $count - 1;
                                                foreach (json_decode($row['orders']) as $key => $value) {
                                                  $i++;
                                                  $product = $this->get_product_details($key);
                                                  $output .='<span class="pr-2">';
                                                  $output .='<b>'.$value->qty.'</b> '.$product->product_title;
                                                  if ($i <= $newcount) {
                                                    $output .=',</span><br>';
                                                  }
                                                }
                                                $output .='

                                            </div>
                                        </div>
                                        <div class="widget-content-right text-right mr-3">
                                            <span class="badge badge-success">'.@$row['status'].'</span>
                                            <div class="text"><b>'.date( "d/m/Y", strtotime($row['order_date'])).'</b></div>
                                            <button onclick="orderdetails('.$row['id'].');" class="btn btn-dark btn-sm">View Details</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            ';
            $output .='
            <div class="modal fade" id="order_details-'.$row['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-12">
                      <div class="main-card mb-3 card">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" style="height: 250px !important; width:100% !important;">';

                                for ($i=0; $i < 7; $i++) {
                                  $img = "img".$i;
                                  if (!is_null($product->$img) && !empty($product->$img)) {

                                    $output .='<div class="carousel-item ';
                                    if($i==0){$output .='active';}
                                    $output .='">
                                      <img class="d-block w-100" src="'.BASE_URL.strtolower($seller->role).'/productimg/'.$product->productid.'/'.$product->$img.'" alt="slide'.$i.'">
                                    </div>';

                              }else {
                                break;
                              }
                            }

                                $output .='
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </div>
                            </li>
                              <li class="list-group-item">
                                  <div class="widget-content p-0">
                                      <div class="widget-content-wrapper">
                                          <div class="widget-content-left mr-3">
                                              <img width="42" class="rounded" src="'.@$profilepic.'" alt="">
                                          </div>
                                          <div class="widget-content-left">
                                              <div class="widget-heading">'.@$buyer->fname.' '.@$buyer->lname.'</div>
                                              <div class="widget-subheading">'.@$buyer->address.'</div>
                                          </div>
                                          <div class="widget-content-right">
                                              <button class="btn btn-danger btn-sm" onclick="buyerdetails('.$row['userid'].')">View Details</button>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Billing address</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="text">'.@$row['location'].'</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Customer name</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="badge badge-pill badge-success">'.@$buyer->fname.' '.@$buyer->lname.'</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Price</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="badge badge-pill badge-success">'.@$row['currency'].''.@$value->total_price.'</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Contact details:</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="badge badge-pill badge-success">'.@$buyer->phone.'</div><br>
                                            <div class="badge badge-pill badge-success">'.@$buyer->email.'</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Quantity:</div>
                                        </div>
                                        <div class="widget-content-right ml-3">';

                                        foreach (json_decode($row['orders']) as $key => $value) {
                                          $i++;
                                          $product = $this->get_product_details($key);

                                          $output .='<div class="badge badge-pill badge-success">'.$product->product_title.': '.$value->qty.'</div>';

                                        }
                                          $output .='</div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Payment method:</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="badge badge-pill badge-success">'.$row['pay_status'].'</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Request Location:</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="badge badge-pill badge-success">'.$row['location'].'</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Message:</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="text"> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Status:</div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="text" id="text-'.$row['id'].'">'.ucwords(@$row['status']).' </div>
                                        </div>
                                        <div class="widget-content-right ml-3">
                                            <div class="text">
                                            <select class="form-control" onchange="changeStatus(this.id,'.$row['id'].','.$row['userid'].')" name="status" id="dstatus">
                                            <option> Update Status</option>
                                            <option value="delivered"> Delivered </option>
                                            <option value="awaiting approval"> Awaiting Approval</option>
                                            <option value="on transit"> On Transit</option>
                                            <option value="payment not confirmed"> Payment not Confirmed</option>
                                            </select> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                          </ul>
                      </div>
                  </div>
                    </div>
                  </div>
                  <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                  </div> -->
                </div>
              </div>
            </div>
';
            print($output);
        }
    }

    public function update_category($catname, $catdescription, $catImage, $catid){
        $query = "UPDATE category SET catname=:catname, catdescription=:catdescription, catImage=:catImage WHERE catid=:catid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":catname" => $catname, ":catdescription" => $catdescription, ":catImage" => $catImage, ':catid' => $catid))){
            echo 'Category updated!';
            return true;
        }
    }

    public function update_category_withoutimg($catname, $catdescription, $catid){
        $query = "UPDATE category SET catname=:catname, catdescription=:catdescription WHERE catid=:catid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":catname" => $catname, ":catdescription" => $catdescription, ':catid' => $catid))){
            echo 'Category updated!';
            return true;
        }
    }

    public function delete_category($catid){
        $query = "DELETE FROM category WHERE catid=:catid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":catid" => $catid))){
            echo 'Category deleted.';
            return true;
        }
    }

    public function fetch_cat_details($catid){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM category WHERE catid=:catid");
            $stmt->bindParam("catid", $catid, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            echo json_encode($data);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete_market($marketid){
        $query = "DELETE FROM market WHERE marketid=:marketid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":marketid" => $marketid))){
            echo 'Market deleted.';
            return true;
        }
    }

    public function fetch_market_details($marketid){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM market WHERE marketid=:marketid");
            $stmt->bindParam("marketid", $marketid, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            $array1 = [$data];
            $array2 = [$marketid => $this->fetch_product_under_market($marketid)];
            $arrayall = array_merge($array1, $array2);
            echo json_encode($arrayall);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function fetch_product_under_market($marketid){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM marketproductid WHERE marketid=:marketid");
            $stmt->bindParam("marketid", $marketid, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update_market(){
        $query = "UPDATE market SET marketname=:marketname, marketstate=:marketstate, marketaddress=:marketaddress, marketchairman=:marketchairman, marketimg=:marketimg WHERE marketid=:marketid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":marketname" => $this->marketname, ":marketstate" => $this->marketstate, ":marketaddress" => $this->marketaddress, ":marketchairman" => $this->marketchairman, ":marketimg" => $this->file_name, ':marketid' => $this->marketid))){
            $this->marketcategoryupdate();
            return true;
        }
    }

    public function update_market_2(){
        $query = "UPDATE market SET marketname=:marketname, marketstate=:marketstate, marketaddress=:marketaddress, marketchairman=:marketchairman WHERE marketid=:marketid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":marketname" => $this->marketname, ":marketstate" => $this->marketstate, ":marketaddress" => $this->marketaddress, ":marketchairman" =>$this->marketchairman, ':marketid' => $this->marketid))){
            $this->marketcategoryupdate();
            return true;
        }
    }

    public function marketcategoryupdate(){
        if($this->delete_ame($this->marketid)){
            $array = $this->marketcategories;
            foreach($array as $item) {
                $this->splititem = explode("-", $item);
                $this->item1 = $this->splititem[0];
                $this->item2 = $this->splititem[1];
                $stmt = $this->conn->prepare("INSERT INTO marketproductid(marketid,categoryid,marketstate,categoryname) VALUES(:marketid,:categoryid,:marketstate,:categoryname)");
                $stmt->bindValue(':marketid', $this->marketid);
                $stmt->bindValue(':categoryid', $this->item2);
                $stmt->bindValue(':marketstate', $this->marketstate);
                $stmt->bindValue(':categoryname', $this->item1);
                $stmt->execute();
            }
        }

    }

    public function delete_ame($marketid){
        $query = "DELETE FROM marketproductid WHERE marketid = :marketid";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute(array(":marketid" => $marketid))){
            return true;
        }

    }

    public function fetch_subadmin_details($id){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE userid=:userid");
            $stmt->bindParam("userid", $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_OBJ); //User data
            echo json_encode($data);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update_users(){
        $query = "UPDATE users SET username=:username, email=:email, password=:password, fname=:fname, lname=:lname, phone=:phone, country=:country, state=:state, address=:address WHERE userid=:userid";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue('userid', $this->userid);
        $stmt->bindValue('username', $this->username);
        $stmt->bindValue('email', $this->email);
        $stmt->bindValue('password', password_hash($this->password, PASSWORD_BCRYPT, array("cost" => 12)));
        $stmt->bindValue('fname', $this->fname);
        $stmt->bindValue('lname', $this->lname);
        $stmt->bindValue('phone', $this->phone);
        $stmt->bindValue('state', $this->state);
        $stmt->bindValue('address', $this->address);
        $stmt->bindValue('country', $this->country);

        if($stmt->execute()){
            $this->emailConfirmation($this->email, $this->userid);
            $this->userid = $this->userid;
            $this->title = "New ".$this->role." Registration";
            $this->body = "A user's details has been updated";
            $this->generatedlink = "user_details.php?userid=".$this->userid;
            $this->notifications();
            return true;
        }else{
            echo 'Could not create account, try again later!';
            return false;
        }
    }

    // Get all Category details
    // public function search($value){
    //     $sql = "SELECT * FROM product_details WHERE product_title LIKE '%$value%' OR productid  LIKE '%$value%' OR userid  LIKE '%$value%' OR market LIKE '%$value%' OR countryorigin LIKE '%$value%' OR expiration	 LIKE '%$value%' OR size  LIKE '%$value%' OR color LIKE '%$value%' OR product_category LIKE '%$value%' OR product_catalogue  LIKE '%$value%' OR product_description	 LIKE '%$value%' OR status = 'Active' OR productavailability LIKE '%$value%' OR topCatSetting = 1 ORDER BY RAND()";
    //         foreach ($this->conn->query($sql) as $row) {
    //             $this->splitter = explode('@', $row['pack0']);
    //             $this->qnt = $this->splitter[0];
    //             $this->price = $this->splitter[1];
    //             $this->discount = $this->splitter[2];
    //             $sellerDetails = $this->userDetails($row['userid']);
    //             $current_user = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
    //             if($this->isFavExist($current_user, $row['productid'])){
    //                 $fav = 'style="background-color: #C60219 !important; color: white !important;"';
    //                 $favo = 'style="color: white !important;"';
    //             }else{
    //                 $fav = '';
    //                 $favo = '';
    //             }
    //             $currency = $sellerDetails->currency;
    // for ($i=0; $i < 7; $i++) {
    //   $img = 'img'.$i;
    //   if (!is_null($row[$img]) && !empty($row[$img])) {
    //     $image = $row[$img];
    //     break;
    //   }
    // }
    //             echo '<div class="col-md-4">
    //                     <div class="item">
    //                         <div class="product-item"
    //                             data-id="product-1873555030051">
    //                             <div class="product-item-container grid-view-item">
    //                                 <div class="left-block">
    //                                     <div class="product-image-container product-image">
    //                                         <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">
    //                                             <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="seller/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
    //                                         </a>
    //                                     </div>
    //                                     <div class="box-labels">
    //                                         <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
    //                                     </div>
    //                                     <div class="button-link">
    //                                         <div class="add-to-wishlist" '.$fav.'>
    //                                             <div class="default-wishbutton-headphone loading" '.$fav.'>
    //                                                 <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
    //                                             </div>
    //                                         </div>
    //                                         <div class="btn-button add-to-cart action">
    //                                             <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="add2cart(this.id, '.$row['productid'].')" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
    //                                         </div>
    //                                         <div class="">
    //                                             <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                                 <div class="right-block">
    //                                     <div class="caption">
    //                                         <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
    //                                         </h4>
    //                                         <div class="price">
    //                                             <!-- snippet/product-price.liquid -->
    //                                             <span class="visually">As low as: </span>
    //                                             <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
    //                                         </div>
    //                                         <div class="custom-reviews hidden-xs">
    //                                             <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
    //                                         </div>

    //                                     </div>

    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>';
    //         }

    // }

    //Get all Category details
    public function search($value){
        $sql = "SELECT count(*) FROM product_details";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
          $stmt = $this->conn->prepare("SELECT * FROM users WHERE
            (username LIKE '%$value%' OR
            fname LIKE '%$value%' OR
            lname LIKE '%$value%')  AND (status = '1')
            limit 1");
          $stmt->execute();
          $user = $stmt->fetch();
          if (!empty($user['userid'])) {
            $value = $user['userid'];
          }
            $sql = "SELECT * FROM product_details WHERE
            (product_title LIKE '%$value%' OR
            productid  LIKE '%$value%' OR
            userid  LIKE '%$value%' OR
            market LIKE '%$value%' OR
            countryorigin LIKE '%$value%' OR
            expiration	 LIKE '%$value%' OR
            size  LIKE '%$value%' OR
            color LIKE '%$value%' OR
            product_category LIKE '%$value%' OR
            product_catalogue  LIKE '%$value%' OR
            product_description	 LIKE '%$value%' OR
            productavailability LIKE '%$value%') AND
            (status LIKE 'active')
            ORDER BY RAND()";

            foreach ($this->conn->query($sql) as $row) {
              if (!is_null($row['pack0']) && !empty($row['pack0'])) {
                if ( strpos($row['pack0'], '+') ) {
                  $this->splitter = explode('+',$row['pack0']);

                }elseif (strpos($row['pack0'], '@') ) {

                  $this->splitter = explode('@',$row['pack0']);
                }else {
                  $this->splitter ="";
                }
              }
                $this->qnt = $this->splitter[0];
                $this->price = $this->splitter[1];
                $this->discount = $this->splitter[2];
                $product_user = $this->userDetails($row['userid']);
                $current_user = @$_SESSION['userid'];
                if($this->isFavExist($current_user, $row['productid'])){
                    $fav = 'style="background-color: #C60219 !important; color: white !important;"';
                    $favo = 'style="color: white !important;"';
                }else{
                    $fav = '';
                    $favo = '';
                }
                $currency = $product_user->currency;
                for ($i=0; $i < 7; $i++) {
                  $img = 'img'.$i;
                  if (!is_null($row[$img]) && !empty($row[$img])) {
                    $image = $row[$img];
                    break;
                  }
                }
                $output ='';
                $output .='<div class="product product-layout col-md-3">
                <div class="product-item">
                    <div class="product-item-container">
                        <div class="left-block">
                            <div class="product-image-container product-image">
                                <a class="grid-view-item__link image-ajax" href="#">
                                    <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.strtolower($product_user->role).'/productimg/'.$row['productid'].'/'.$image.'" alt="headphone"/>
                                </a>
                            </div>
                            <div class="box-labels">
                                <span class="label-product label-sale"><span class="d-none">Discount</span>'.$this->discount.'%</span>
                            </div>
                            <div class="button-link">
                                <div class="add-to-wishlist" '.$fav.'>
                                    <div class="default-wishbutton-headphone loading" '.$fav.'>
                                        <a class="add-in-wishlist-js" style="cursor: pointer;" onclick="addFav('.$row['productid'].')"><i '.$favo.' class="fa fa-heart-o"></i><span class="tooltip-label">Add to Favourite</span></a>
                                    </div>
                                </div>';
                                $cart = array(
                                 "sellerid" => $row['userid'],
                                 "productID" => $row['productid'],
                                 "action" => "1");
                                 // die(print_r($_COOKIE['cart']));
                                 if (isset($_COOKIE['cart'])) {
                                   $stored = [];
                                   foreach (json_decode($_COOKIE['cart'], true) as $id) {

                                     $stored[] = array(
                                       'sellerid' => $id['sellerid'],
                                       'productID' => $id['productID'],
                                       'action' => $id['action']
                                     );
                                   }
                                 }
                                 if(isset($stored) && in_array($cart, $stored)){

                               $output .='
                               <div class="btn-button add-to-cart action">
                                   <a class="btn-addToCart grl btn_df" style="background-color: #C60219 !important; color: white !important;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',0)" title="Remove from cart"><i class="fa fa-shopping-basket" style="color: white !important;"></i><span class="">Remove from cart</span></a>
                               </div>';
                             } else {
                               $output .='
                               <div class="btn-button add-to-cart action">
                                   <a class="btn-addToCart grl btn_df" style="cursor: pointer;" id="'.$row['userid'].'" onclick="AddCartmini(this.id, '.$row['productid'].',1)" title="Add to cart"><i class="fa fa-shopping-basket"></i><span class="">Add to cart</span></a>
                               </div>';
                                 }
                                 $output .='

                                <div class="">
                                    <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'" title="View Product Details"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="right-block">
                            <div class="caption">
                                <h4 class="title-product"><a class="product-name" href="'.BASE_URL.'product_details.php?productid='.$row['productid'].'">'.$row['product_title'].'</a>
                                </h4>
                                <div class="price">
                                    <!-- snippet/product-price.liquid -->
                                    <span class="visually">As low as: </span>
                                    <span class="price-new"><span class=money>'.$currency.number_format($this->price, 2).'<small>/per '.$this->qnt.'</small> </span></span>
                                </div>
                                <div class="custom-reviews hidden-xs">
                                    <span class="shopify-product-reviews-badge" data-id="1873555030051"></span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>';
            print($output);
            }
        }else{
            echo 'No record found';
            return;
        }

    }


    public function all_category(){
        $sql = "SELECT count(*) FROM category";
        $result = $this->conn->prepare($sql);
        $result->execute();
        if($result->fetchColumn() > 0){
            $sql = 'SELECT * FROM category ORDER BY RAND() LIMIT 6';
            foreach ($this->conn->query($sql) as $row) {
                $this->counter = $this->product_count($row['catname']);
                echo '<div class="col-md-3">
                        <div class="item">
                            <div class="product-item">
                                <div class="product-item-container grid-view-item" style="height: 250px !important;">
                                    <div class="left-block">
                                        <div class="product-image-container product-image">
                                            <a class="grid-view-item__link image-ajax" href="'.BASE_URL.'category_list.php?catid='.$row['catid'].'">
                                                <img class="img-responsive s-img lazyload" data-sizes="auto" src="'.BASE_URL.'assets/images/product-loading.svg?466" data-src="'.BASE_URL.'seller/catImage/'.$row['catid'].'/'.$row['catImage'].'" alt=""/>
                                            </a>
                                        </div>
                                        <div class="box-labels">
                                            <span class="label-product label-sale">
                                                <span class="d-none" style="color: white !important;">Sale</span>'.$this->counter.'
                                            </span>
                                        </div>
                                        <div class="button-link pt-5">
                                            <div>
                                                <a class="quickview iframe-link d-none d-xl-block btn_df" href="'.BASE_URL.'category_list.php?catid='.$row['catid'].'" title="Quick View"><i class="fa fa-eye"></i><span class="hidden">Quick View</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4 class="title-product text-center"><a class="product-name" href="'.BASE_URL.'category_list.php?catid='.$row['catid'].'" style="color: white !important; font-size: 18px !important;">'.$row['catname'].'</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        }else{
            echo 'No record found';
            return;
        }

    }



}
