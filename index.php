<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 11/11/2015
 * Time: 7:15 PM
 */
session_start();
include_once 'lib/connection.php';
$connection = new connection();
$connection->connect();
$action =!empty($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
    case 'student_list':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/student_list.php';
            break;
        }
    case 'add_student':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/add_student.php';
            break;
        }
    case 'course_list':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/course_list.php';
            break;
        }
    case 'add_course':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/add_course.php';
            break;
        }
    case 'add_country':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/add_country.php';
            break;
        }
    case 'country_list':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/country_list.php';
            break;
        }
    case 'add_city':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/add_city.php';
            break;
        }
    case 'city_list':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/city_list.php';
            break;
        }
    case 'student_search':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/student_search.php';
            break;
        }
    case 'manage_course':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/manage_course.php';
            break;
        }
    case 'manage_country':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/manage_country.php';
            break;
        }
    case 'manage_city':
        if (!empty($_SESSION['admin_id'])) {
            include_once 'pages/manage_city.php';
            break;
        }
    case '':
        if (!empty($_SESSION['admin_id'])) {
            header("Location:index.php?action=student_list");
            exit;
        } else {
            include_once 'pages/admin_login.php';
        }
        break;
    case 'logout':
        session_destroy();
        header("Location:index.php");
        exit;
        break;
    default:
        include_once 'pages/page_404.php';
        break;
}


?>
<style>
    table{width: 100%;}
    .login-tbl tr td:first-child{width: 40%; text-align: right}
    .login-tbl tr td:last-child{width: 60%; text-align: left}
    .login-tbl tr:last-child td{text-align: center;}
    .msg{width: 100%; text-align: center;}
    th.main {  font-size: 20px;  text-align: center;  }
    td{text-align: center;}
    .error{color: red; }
    .center{ text-align: center !important;}
    .success{color: green;}
    table.navigation{width: 100%;}
    table.navigation td{text-align: right;}
    table.navigation {  background-color: #646060;  }
    .navigation a {
        color: #fff;
        text-transform: uppercase;
        text-decoration: none;
        font-weight: bold;
        border-right: 1px solid #fff; padding-right: 10px; margin-left: 10px;
    }
    .search-tbl td {
        height: 50px;
        vertical-align: top;
        min-width: 136px;;
    }
    .main-head {
        text-align: center !important;
        font-size: 20px;
        color: #fff;
        background: #646060;
        height: 50px;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>