<?php
if (!empty($_GET['delete']) && $_GET['delete'] ==1 && !empty($_GET['id'])) {
    $sql = "UPDATE tbl_countries SET is_deleted= '1' WHERE `id` = $_GET[id] ";
    connection::execute($sql,'update');
    $_SESSION['msg'] = 'Record deleted successfully';
    header("Location:index.php?action=manage_country");
    exit;
}
$showForm = false;
if (!empty($_GET['edit']) && $_GET['edit'] ==1 && !empty($_GET['id'])) {
    if (empty($data) && !empty($_GET['edit']) && $_GET['edit'] == 1 && !empty($_GET['id'])) {
        $sql = "SELECT * FROM tbl_countries WHERE id = $_GET[id]";
        $result = connection::execute($sql, 'select');
        $data = (array)$result;
        foreach ($data as $key => $val) {
            $$key = ($val);
        }
    }
    $showForm = true;
} else if (!empty($_GET['add']) && $_GET['add'] ==1) {
    $showForm = true;
}
if(isset($_POST['submit'])) {
    $data = $_POST;
    //Sanitize inputs
    foreach ($data as $key => $val) {
        if (!empty($val)) {
            $$key = mysql_real_escape_string($val);
        }
    }
    //Validate inputs
    foreach ($data as $key => $val) {
        if (empty($val)) {
            $errorMsg = "$key is required field";
            break;
        }
    }
    if (empty($errorMsg)) {
        if (!empty($_POST['student_id'])) {
            $studentId = $_POST['student_id'];
            //Update
            $sql = "UPDATE tbl_countries SET
                    `name` = '$name'
                    WHERE id = $_POST[id]";
            connection::execute($sql, 'update');
            $_SESSION['msg'] = 'Record update successfully';
        } else {
            $sql = "INSERT INTO tbl_countries
         (`name`) VALUES(
            '$name'
         )";
            connection::execute($sql, 'insert');
            $_SESSION['msg'] = 'Record added successfully';
        }
        //echo $sql;
        header("Location:index.php?action=manage_country");
        exit;
    }
}
include_once 'navigation.php';
if ($showForm) {?>
<form name="loginFrm" id="dataForm" action="" method="post">
    <?php echo !empty($_GET['id']) ? '<input type="hidden" name="student_id" value="'.$_GET['id'].'">' : '';?>
    <table class="list students">
        <tr><th class="main" colspan="7"><?php echo !empty($_GET['id']) ? 'Update' : 'Add';?> Country</th></tr>
    </table>
    <table class="login-tbl">
    <?php if (!empty($errorMsg)) {?>
        <tr><td class="error center" colspan="2"><?php echo $errorMsg;?></td></tr>
    <?php }?>
    <?php echo !empty($_GET['id']) ? '<input type="hidden" name="id" value="'.$_GET['id'].'">' : '';?>
    <tr>
        <td ><label><strong>Name:</strong></label></td>
        <td><input type="text" size="45" name="name"  value="<?php echo !empty($name) ? $name : ''?>" /></td>
    </tr>

    <tr>
        <td colspan="2">
            <a href="index.php?action=manage_country">Cancel</a>
            <input type="submit" id="submit" name="submit" value="<?php echo !empty($_GET['id']) ? 'Update' : 'Add';?> Country"  />
        </td>
    </tr>
    </table>
</form>
<?php
} else {?>
<table class="list students">
    <tr><th class="main" colspan="7">Countries List</th></tr>
</table>

<table class="list students" id="search_response">
    <!--<tr><td class="" colspan="7"><a href="index.php?action=add_student">Add Student</a></td></tr>-->
    <?php
    if (!empty($_SESSION['msg'])) {
        ?>
        <tr>
            <td class="msg success" colspan="7"><?php echo $_SESSION['msg']; ?></td>
        </tr>
        <?php
        unset($_SESSION['msg']);
    }
    ?>
    <?php
    $sql = "SELECT *  FROM tbl_countries  WHERE is_active = '1' AND is_deleted = '0' ";
    $result = connection::execute($sql,'select-all');

    if (!empty($result) && is_array($result)) {?>
        <tr>
            <th>
                SI
            </th>
            <th>
                Title
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php
        $i =1;
        foreach($result as $row) {
            echo ($i%3 == 0) ? '<tr>' : '';?>
                <td>
                    <?php echo $i;?>
                </td>
                <td>
                    <?php echo $row->name;?>
                </td>
                <td>
                    <a href="index.php?action=manage_country&edit=1&id=<?php echo $row->id;?>" class="data-edit"  >Edit</a>
                    <a href="index.php?action=manage_country&delete=1&id=<?php echo $row->id;?>" class="data-delete" data-id="<?php echo $row->id;?>" onclick="confirm('Do you really want to delete this record??');">Delete</a>
                </td>
            <?php
            $i++;
            echo ($i%3 == 1) ? '</tr>' : '';
        }
    } else {?>
        <tr><td class="main" colspan="7">No recors found</td></tr><?php
    }?>
</table>
<?php }?>
<script type="text/javascript" src="js/jquery.1.7.1.min.js"></script>
<script type="text/javascript">

    function delete_record(id){
        if (confirm('Do you really want to delete this record??')) {
            jQuery.ajax({
                type: "POST",
                url: 'index.php?action=manage_country&delete=1&id='+id,
                data:formData,
                cache: false,
                success: function(data) {
                    window.location.reload();
                },
            });
        }
    }
</script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dataForm').validate({rules: {name: {required: true}}})
    })
</script>