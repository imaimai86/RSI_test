<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/10/2015
 * Time: 8:27 PM
 */
if (!empty($_GET['get_city']) && $_GET['get_city'] ==1 && !empty($_GET['country_id'])) {
    $sql = "SELECT * FROM `tbl_cities` WHERE `country_id` = $_GET[country_id] AND is_active = '1' AND is_deleted = '0' ";
    $cityList = connection::execute($sql,'select-all');?>

        <option value="">Select City</option>
        <?php if (!empty($cityList) && is_array($cityList)) {
            foreach ($cityList as $obj) {
                echo '<option value="'.$obj->id.'">'.$obj->title.'</option>';
            }
        }
        ?>
    <?php
    exit;
}
$errorMsg = '';
if(isset($_POST['submit'])){
    $data = $_POST;
    //Sanitize inputs
    foreach ($data as $key => $val) {
        if (is_array($val)) {
            array_map('mysql_real_escape_string', $val);
            $$key = $val;
        } else {
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
    //Upload image
    if (is_dir($upload_dir) && is_writable($upload_dir)) {
        if (!empty($_FILES['image']['name'])) {
            $uploaded_path_parts = pathinfo($_FILES['image']['name']);
            $extension = strtolower($uploaded_path_parts['extension']);

            if (!in_array($extension, $allowedImageTypes)) {
                $errorMsg = "Invalid file type";
            } else {
                $fileName = date('YmdHis') . '_image_' . '.' . $extension;
                $i = 100;
                while (file_exists($upload_dir . $fileName)) {
                    $fileName = date('YmdHis') . '_image_' . $i . '_' . '.' . $extension;
                    $i++;
                }
                move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $fileName);
            }
        } else {
            $fileName = $_POST['image'];
        }
    }

    if (empty($errorMsg)) {
        if (!empty($_POST['student_id'])) {
            $studentId = $_POST['student_id'];
            //Update
            $sql = "UPDATE tbl_students SET
                    `name` = '$name',
                    `dob` ='$dob',
                    `gender` = '$gender',
                    `telephone` = '$telephone',
                    `email` = '$email',
                    `nationality` = '$nationality',
                    `city` = '$city',
                    `image` = '$fileName'
                    WHERE id = $_POST[student_id]";
            connection::execute($sql, 'update');
            $_SESSION['msg'] = 'Record update successfully';
        } else {
            $sql = "INSERT INTO tbl_students
         (`name`, `dob`, `gender`, `telephone`, `email`, `nationality`, `city`, `image`, `created_date_time`, `created_by`) VALUES(
            '$name', '$dob','$gender','$telephone','$email','$nationality','$city','$fileName', '" . date('Y-m-d H:i:s') . "', '$_SESSION[admin_id]'
         )";
            connection::execute($sql, 'insert');
            $studentId = mysql_insert_id();
            $_SESSION['msg'] = 'Record added successfully';
        }
        if (!empty($studentId)) {

            //Update student course map
            $sql = "SELECT * FROM tbl_student_course_map WHERE student_id =  $_GET[id] ";
            $selectedCourseList = connection::execute($sql,'select-all');
            if (!empty($selectedCourseList) && is_array($selectedCourseList)) {
                foreach ($selectedCourseList as $crse) {
                    if (!empty($course_id) && is_array($course_id) && !in_array($crse->course_id, $course_id)) {
                        //Delete entry from db
                        $sql = "Update tbl_student_course_map SET is_deleted = '1'";
                        connection::execute($sql, 'update');
                        if(($key = array_search($crse->course_id, $course_id)) !== false) {
                            unset($course_id[$key]);
                        }
                    } else if (!empty($course_id) && is_array($course_id) && in_array($crse->course_id, $course_id)){
                        //Update existing entry
                        $sql = "UPDATE tbl_student_course_map SET is_active = '1', is_deleted = '0' WHERE id = $crse->id";
                        connection::execute($sql, 'update');
                        if(($key = array_search($crse->course_id, $course_id)) !== false) {
                            unset($course_id[$key]);
                        }
                    }
                    //echo "<br /><br />". $sql;
                }
            }

            if (!empty($course_id) && is_array($course_id)) {
                foreach ($course_id as $crsId) {
                    if (!empty($crsId)) {
                        $sql = "INSERT INTO tbl_student_course_map (`student_id`, `course_id`, `created_by`, `created_date_time`) VALUES (
                    '$studentId', '$crsId', '$_SESSION[admin_id]', '" . date('Y-m-d H:i:s') . "'
                    )";
                        connection::execute($sql, 'insert');
                        //echo "<br /><br />" . $sql;
                    }
                }
            }
            //die("out");
        }
        header("Location:index.php?action=student_list");
        exit;
    }
} else if (empty($data) && !empty($_GET['edit']) && $_GET['edit'] ==1 && !empty($_GET['id'])){
    $sql = "SELECT * FROM tbl_students WHERE id = $_GET[id]";
    $result = connection::execute($sql, 'select');
    $data = (array) $result;
    foreach ($data as $key => $val) {
        $$key = ($val);
    }
    $sql = "SELECT * FROM tbl_student_course_map WHERE is_active = '1' AND is_deleted = '0' AND student_id =  $_GET[id] ";
    $selectedCourseList = connection::execute($sql,'select-all');
    if (!empty($selectedCourseList) && is_array($selectedCourseList)) {
        foreach ($selectedCourseList as $crse) {
            $course_id[] = $crse->course_id;
        }
    }
}
$sql = "SELECT * FROM tbl_countries WHERE is_active = '1' AND is_deleted = '0' ";
$countryList = connection::execute($sql,'select-all');
$sql = "SELECT * FROM tbl_course WHERE is_active = '1' AND is_deleted = '0' ";
$courseList = connection::execute($sql,'select-all');
if (!empty($nationality)) {
    $sql = "SELECT * FROM `tbl_cities` WHERE `country_id` = $nationality AND is_active = '1' AND is_deleted = '0' ";
    $cityList = connection::execute($sql,'select-all');
}
include_once 'navigation.php';?>
<form name="loginFrm" id="studentFrm" action="" method="post" enctype="multipart/form-data">
    <table class="login-tbl">
        <tr><th class="main" colspan="2"><?php echo !empty($_GET['id']) ? 'Update' : 'Add';?> Students</th></tr>
        <?php if (!empty($errorMsg)) {?>
        <tr><td class="error center" colspan="2"><?php echo $errorMsg;?></td></tr>
        <?php }?>
        <?php echo !empty($_GET['id']) ? '<input type="hidden" name="student_id" value="'.$_GET['id'].'">' : '';?>
        <?php echo !empty($_GET['id']) ? '<input type="hidden" name="image" value="'.$image.'">' : '';?>
            <tr>
                <td ><label><strong>Name:</strong></label></td>
                <td><input type="text" size="45" name="name"  value="<?php echo !empty($name) ? $name : ''?>" /></td>
            </tr>
            <tr>
                <td><label><strong>Email:</strong></label></td>
                <td><input type="text" name="email" size="45" value="<?php echo !empty($email) ? $email : ''?>" /></td>
            </tr>
            <tr>
                <td><label><strong>Date of birth:</strong></label></td>
                <td><input type="text" name="dob" id="inp_dob" size="45" placeholder="YYYY-mm-dd" value="<?php echo !empty($dob) ? $dob : ''?>"  /></td>
            </tr>
            <tr>
                <td><label><strong>Gender:</strong></label></td>
                <td>
                    <input type="radio" name="gender" value="1" id="gen_male" <?php echo (!empty($gender) && $gender == 1) ? 'checked="checked"' : '';?> />
                    <label form="gen_male">Male</label>
                    <input type="radio" name="gender" value="2" id="gen_female" <?php echo (!empty($gender) && $gender == 2) ? 'checked="checked"' : '';?> />
                    <label for="gen_female">Female</label>
                    <label id="gender-error" class="error" for="gender" style="display: none;"></label>
                </td>
            </tr>
            <tr>
                <td><label><strong>Telephone:</strong></label></td>
                <td><input type="text" name="telephone" size="45" value="<?php echo !empty($telephone) ? $telephone : ''?>" /></td>
            </tr>
            <tr>
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
            </tr>
            <tr>
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
                <td><label><strong>Course:</strong></label></td>
                <td>
                    <select name="course_id[]" multiple>
                        <option value="">Select Course</option>
                        <?php if (!empty($courseList) && is_array($courseList)) {
                            foreach ($courseList as $obj) {
                                echo '<option '.((!empty($course_id) && in_array($obj->id, $course_id)) ? 'selected="selected"' : '').'  value="'.$obj->id.'">'.$obj->title.'</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label><strong>Image:</strong></label></td>
                <td><input type="file" name="image" size="45"  /></td>
            </tr>

            <tr>
                <td colspan="2">
                    <a href="index.php?action=student_list">Cancel</a>
                    <input type="submit" id="submit" name="submit" value="<?php echo !empty($_GET['id']) ? 'Update' : 'Add';?> Student"  />
                </td>
            </tr>

    </table>
</form>
<link type="text/css" href="js/jquery-ui/css/base/jquery-ui-1.10.4.custom.min.css">
<link type="text/css" href="js/jquery-ui/development-bundle/themes/base/jquery.ui.datepicker.css">
<script type="text/javascript" src="js/jquery.1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#studentFrm').validate({
            rules: {
                name: {required: true},
                email: {required: true,email:true},
                dob: {required: true},
                gender: {required: true},
                telephone: {required: true, number: true},
                nationality: {required: true},
                city: {required: true},
                <?php if (empty($_GET['id'])) {?>
                image: {required: true}
                <?php }?>
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