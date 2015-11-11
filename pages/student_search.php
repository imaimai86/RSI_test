<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/11/2015
 * Time: 8:00 PM
 */
if (!empty($_GET['search']) && $_GET['search'] ==1) {
    $data = $_POST;
    foreach ($data as $key => $val) {
        if (is_array($val)) {
            array_map('mysql_real_escape_string', $val);
            $$key = $val;
        } else {
            $$key = mysql_real_escape_string($val);
        }
    }
    $where = "ts.is_active = '1' AND ts.is_deleted='0'";
    if (!empty($name)) {
        $where .= " AND ts.name LIKE '%$name%'";
    }
    if (!empty($gender)) {
        $where .= " AND ts.gender LIKE '%$gender%'";
    }
    if (!empty($nationality)) {
        $where .= " AND tc.id LIKE '%$nationality%'";
    }
    if (!empty($city)) {
        $where .= " AND tct.id LIKE '%$city%'";
    }
    //print_r($_POST);
    $sql = "SELECT ts.*, tc.name AS c_name, tct.title AS ct_name
        FROM tbl_students AS ts
        LEFT JOIN tbl_countries tc ON (tc.id = ts.nationality)
        LEFT JOIN tbl_cities tct ON (tct.id = ts.city)
        WHERE $where  ";
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
    }
    exit;
}
