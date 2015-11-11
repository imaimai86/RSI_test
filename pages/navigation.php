<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/11/2015
 * Time: 2:37 PM
 */
if (!empty($_SESSION['admin_id'])) {?>
    <table class="navigation">
        <tr>
            <td class="main-head">University Management System</td>
        </tr>
        <tr>
        <td>
            <a href="index.php?action=student_list">Students List</a>
            <a href="index.php?action=add_student">Add Students</a>
            <a href="index.php?action=manage_course">Courses</a>
            <a href="index.php?action=manage_course&add=1">Add Courses</a>
            <a href="index.php?action=manage_country">Countries</a>
            <a href="index.php?action=manage_country&add=1">Add Country</a>
            <a href="index.php?action=manage_city">Cities</a>
            <a href="index.php?action=manage_city&add=1">Add City</a>

            <a href="index.php?action=logout">Logout</a>
        </td>
        </tr>
    </table><?php
}