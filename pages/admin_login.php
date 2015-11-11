<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/11/2015
 * Time: 7:22 PM
 */
// Logical section of page

if(isset($_POST['submit'])){
    $userName = $_POST['email_address'];
    $password = md5($_POST['password']);

    if($userName!='' && $password!=''){

        $sql = "SELECT * FROM tbl_admin WHERE admin_email_address = '".mysql_real_escape_string($userName)."' AND admin_password = '".mysql_real_escape_string($password)."' AND admin_status = '1' ";

        $result = connection::execute($sql,'select');

        if($result){

            $_SESSION['admin_id'] = $result->admin_id;
            $_SESSION['admin_fname'] = $result->admin_fname;
            $_SESSION['admin_lname'] = $result->admin_lname;
            $_SESSION['admin_user'] = $result->admin_email_address;

            header('location:index.php?action=student_list');
            exit;
        }else{
            $failedMsg = "Invalid Username or Password";
        }

    }else{
        $failedMsg = "Username and Password are required";
    }
}?>
<?php if(isset($successMsg) && $successMsg!=''){ ?>
    <p class="msg done"><?php echo $successMsg; ?></p>
<?php } ?>

<?php if(isset($failedMsg) && $failedMsg!=''){ ?>
    <p class="msg error"><?php echo $failedMsg; ?></p>
<?php } ?>

<form name="loginFrm" id="loginForm" action="" method="post">
<table class="login-tbl">
    <tr>
        <td colspan="2" class="main-head">University Management System</td>
    </tr>
    <tr>
        <td ><label for="login-user"><strong>Username:</strong></label></td>
        <td><input type="text" size="45" name="email_address" id="email_address"  /></td>
    </tr>
    <tr>
        <td><label for="login-pass"><strong>Password:</strong></label></td>
        <td><input type="password" name="password" size="45" id="password" /></td>
    </tr>

    <tr>
        <td colspan="2"><input type="submit" id="submit" name="submit" value="Sign In"  /></td>
    </tr>
</table>
</form>
<script type="text/javascript" src="js/jquery.1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#loginForm').validate({
            rules: {
                email_address: {
                    required: true,
                },
                password: {
                    required: true,
                }
            }
        })
    })
</script>