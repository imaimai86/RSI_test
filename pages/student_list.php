<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/11/2015
 * Time: 8:00 PM
 */
if (!empty($_GET['delete_student']) && $_GET['delete_student'] ==1 && !empty($_GET['id'])) {
    $sql = "UPDATE tbl_students SET is_deleted= '1' WHERE `id` = $_GET[id] ";
    connection::execute($sql,'update');
    $_SESSION['msg'] = 'Record deleted successfully';
    header("Location:index.php?action=student_list");
    exit;
}
$sql = "SELECT * FROM tbl_countries WHERE is_active = '1' AND is_deleted = '0' ";
$countryList = connection::execute($sql,'select-all');
include_once 'navigation.php';?>
<table class="list students">
<tr><th class="main" colspan="7">Students List</th></tr>
</table>
<form name="loginFrm" id="studentSearchFrm" action="" method="post" enctype="multipart/form-data">
    <table class="login-tbl search-tbl">
        <tr>
            <td ><label><strong>Name:</strong></label></td>
            <td><input type="text" size="25" name="name"  value="<?php echo !empty($name) ? $name : ''?>" /></td>

            <td><label><strong>Gender:</strong></label></td>
            <td>
                <input type="radio" name="gender" value="1" id="gen_male" <?php echo (!empty($gender) && $gender == 1) ? 'checked="checked"' : '';?> />
                <label form="gen_male">Male</label>
                <input type="radio" name="gender" value="2" id="gen_female" <?php echo (!empty($gender) && $gender == 2) ? 'checked="checked"' : '';?> />
                <label for="gen_female">Female</label>
                <label id="gender-error" class="error" for="gender" style="display: none;"></label>
            </td>
            <td><label><strong>Nationality:</strong></label></td>
            <td>

                <select name="nationality">
                    <option value="">Select Country</option>
                    <?php if (!empty($countryList) && is_array($countryList)) {
                        foreach ($countryList as $obj) {
                            echo '<option '.((!empty($nationality) && $nationality == $obj->id) ? 'selected="selected"' : '').' value="'.$obj->id.'">'.$obj->name.'</option>';
                        }
                    }
                    ?>
                </select>
            </td>
            <td><label><strong>City:</strong></label></td>
            <td>
                <select name="city">
                    <option value="">Select City</option>
                    <?php if (!empty($cityList) && is_array($cityList)) {
                        foreach ($cityList as $obj) {
                            echo '<option '.((!empty($city) && $city == $obj->id) ? 'selected="selected"' : '').'  value="'.$obj->id.'">'.$obj->title.'</option>';
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="8">
                <input type="submit" id="submit" name="submit" value="Search"  />
            </td>
        </tr>

    </table>
</form>

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
$sql = "SELECT ts.*, tc.name AS c_name, tct.title AS ct_name
        FROM tbl_students AS ts
        LEFT JOIN tbl_countries tc ON (tc.id = ts.nationality)
        LEFT JOIN tbl_cities tct ON (tct.id = ts.city)
        WHERE ts.is_active = '1' AND ts.is_deleted = '0' ";
$result = connection::execute($sql,'select-all');

if (!empty($result) && is_array($result)) {?>
        <tr>
            <th>
                SI
            </th>
            <th>
                Name
            </th>
            <th>
                Image
            </th>
            <th>
                Gender
            </th>

            <th>
                Nationality
            </th>
            <th>
                City
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php
        $i =1;
        foreach($result as $row) {?>
            <tr>
                <td>
                    <?php echo $i;?>
                </td>
                <td>
                    <?php echo $row->name;?>
                </td>
                <td>
                    <?php if (!empty($row->image) && file_exists($upload_dir.$row->image)){?>
                        <img src="images/<?php echo $row->image;?>" style="max-width: 100px; max-height: 150px;" /><?php
                    }?>
                </td>
                <td>
                    <?php if (!empty($row->gender)){
                        echo ($row->gender == 1) ? 'Male' : 'Female';
                    }?>
                </td>

                <td>
                    <?php echo $row->c_name;?>
                </td>
                <td>
                    <?php echo $row->ct_name;?>
                </td>
                <td>
                    <a href="index.php?action=add_student&edit=1&id=<?php echo $row->id;?>">Edit</a>
                    <a href="index.php?action=student_list&delete_student=1&id=<?php echo $row->id;?>" onclick="return confirm('Do you really want to delete this record??')">Delete</a>
                </td>
            </tr>
        <?php
            $i++;
        }
} else {?>
    <tr><td class="main" colspan="7">No recors found</td></tr><?php
}?>
</table>

<script type="text/javascript" src="js/jquery.1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#studentSearchFrm').validate({
            rules: {
                email: {email:true},
                dob: {date: true},
                telephone: {number: true},
            },
            submitHandler: function (form) {
                $('form').find(":submit").attr("disabled", true).attr("value","Searching...");
                var formData = $('form').serialize();
                jQuery.ajax({
                    type: "POST",
                    url: 'index.php?action=student_search&search=1',
                    data:formData,
                    cache: false,
                    success: function(data) {
                        $('#studentSearchFrm').find(":submit").removeAttr("disabled").attr("value","Search");
                        if (data == '') {
                            $('#search_response').html('<tr><td>No result found</td></tr>').show();
                        } else {
                            $('#search_response').html(data).show();
                        }
                    },
                });
            }
        })
        $('#inp_dob').datepicker({dateFormat:'yy-mm-dd'});
        $('select[name="nationality"]').change(function(){
            loadCity(this);
        })
    })
    function loadCity(obj) {
        jQuery.ajax({
            type: "POST",
            url: 'index.php?action=add_student&get_city=1&country_id='+$(obj).val(),
            cache: false,
            success: function(data) {
                $('select[name="city"]').html($(data));
            },
        });
    }
</script>