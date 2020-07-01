<?php
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "images/".$_FILES['userImage']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img class="image-preview" src="<?php echo $targetPath; ?>" class="upload-preview" />
<?php
}
}
}
?>



public function logon($username, $password){
        try{
            $pdo = $this->conn;
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username=:username");
            $stmt->bindParam("username", $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            if (password_verify($password, $user->password)) {
                if ($user->status == 1) {
                    $this->user = $user;
                    session_regenerate_id();
                    $_SESSION['user']['userid'] = $user->userid;
                    $_SESSION['user']['role'] = $user->role;
                    echo $_SESSION['user']['role'];
                    return true;
                } else {
                    echo 'Inactive';
                    return false;
                }
            } else {
                //$this->registerWrongLoginAttemp($email);
                echo 'Invalid';
                return false;
            }
        }catch(PDOException $e) {
            echo $e->getMessage();
        }
    }