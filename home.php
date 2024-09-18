<?php 
require_once "controllerUserData.php"; 

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if($email != false && $password != false){
    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM usertable WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $run_Sql = $stmt->get_result();
    
    if($run_Sql){
        $fetch_info = $run_Sql->fetch_assoc();
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
                exit();
            }
        }else{
            header('Location: user-otp.php');
            exit();
        }
    } else {
        echo "Error: Could not fetch user data.";
    }
}else{
    header('Location: login-user.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($fetch_info['name']); ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Brand name</a>
        <a href="logout-user.php" class="btn btn-light btn-logout">Logout</a>
    </nav>
    <h1>Welcome <?php echo htmlspecialchars($fetch_info['name']); ?></h1>
</body>
</html>
