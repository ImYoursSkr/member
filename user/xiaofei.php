<?php
/**
 * 用户消费记录功能实现
 */

/**
 * 开启session
 */
session_start();

/**
 * 开启检查用户是否登陆
 */
if (empty($_SESSION['user']['isUserLogin'])) {
    header("Location:../index.php");
}

/**
 * 引入数据库链接配置文件
 */
include '../config/config.inc.php';

/**
 * 查询签到记录
 */
$sql = "SELECT u_xiaos.id,u_xiaos.ymd,u_xiaos.jf,u_users.username FROM u_xiaos  join u_users where u_xiaos.uid= u_users.id and u_users.id={$_SESSION['user']['id']} order by u_xiaos.id DESC";
$res = $pdo->query($sql);


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit"><!--告诉360用极速模式-->
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>会员管理系统</title>
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


<div class="container">
    <?php include 'header.php'; ?>
    <div class="row">
        <div class="col-sm-9" align="center">
            <div class="panel" style="border-radius: 0;min-height:450px;">
                <div class="panel-heading" style="background-color:#1abc9c;color:white;border-radius:0;">消费记录</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th style="text-align: center;">用户名</th>
                            <th style="text-align: center;">消费时间</th>
                            <th style="text-align: center;">剩余积分</th>
                            <th style="text-align: center;">扣除积分</th>
                        </tr>

                        <?php
                        while (list($id, $ymd, $jf, $username) = $res->fetch(PDO::FETCH_NUM)) {
                            $ymd = date('Y-m-d H:i:s', $ymd);
                            echo "<tr>";
                            echo "<td style=\"text-align: center;\">$username</td>";
                            echo "<td style=\"text-align: center;\">$ymd</td>";
                            echo "<td style=\"text-align: center;\">$jf</td>";
                            echo "<td style=\"text-align: center;\">-1</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include 'right.php'; ?>
    </div>
</div>


</body>
</html>