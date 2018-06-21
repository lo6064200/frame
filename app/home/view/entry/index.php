<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/8
 * Time: 20:35
 */
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后盾网学生平台</title>
    <!--Core CSS -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./static/css/animate.css">
    <link href="./static/bs3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./static/css/style.css" rel="stylesheet">
    <link href="./static/css/style-responsive.css" rel="stylesheet">

</head>
<body >
<!-- Header Section Start -->
<header id="header_part">
    <div class="header_part" id="head">
        <div class="overlay">
            <div class="start_part">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <!-- Logo Start -->
                                <div class="site_logo">
                                    <a href="#" title=""><img src="./static/images/logo.png" alt="" title=""/></a>
                                </div>
                                <!-- Logo End-->
                                <!-- Site Title start-->
                                <div class="site_title">
                                    <h1>学生信息</h1>
                                    <p><br/><br/></p>
                                </div>
                                <!-- Site Title end-->
                                <!-- Countdown start -->
                                <div class="countdown wow bounceInUp">
                                    <div class="defaultCountdown"></div>
                                </div>
                                <!-- Countdown end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu Start -->
            <div class="menu_area" id="stick_menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <nav class="navbar navbar-default" role="navigation">
                                <div class="container-fluid">
                                    <div class="collapse navbar-collapse mainnavmenu" id="bs-example-navbar-collapse-1">
                                        <div id="menu-center">
                                            <ul class="nav navbar-nav navbar-right mainnav">
                                                <li><a href="#header_part" >首页</a></li>
                                                <li><a href="#welcome_section">学生信息</a></li>
                                                <li><a href="<?php echo "?s=admin/login/index" ?>">后台管理</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Menu End-->
        </div>
    </div>
</header>
<!-- Header Section End -->
<!-- About Section Start -->
<section id="welcome_section">
    <div class="welcome_section">
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center">后盾网学生信息表</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>学生编号</th>
                                <th>学生头像</th>
                                <th>学生姓名</th>
                                <th>学生年龄</th>
                                <th>学生性别</th>
                                <th>学生班级</th>
                                <th>班主任</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data as $v):?>
                                <tr>
                                    <td><?php echo $v['sid']?></td>
                                    <td>
                                            <img style="width: 50px;height: 50px" src="<?php echo $v['mpath']?>" alt="">
                                     </td>
                                    <td><?php echo $v['sname']?></td>
                                    <td><?php echo $v['sage']?></td>
                                    <td><?php echo $v['ssex']?></td>
                                    <td><?php echo $v['gname']?></td>
                                    <td><?php echo $v['teacher']?></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->
<!--Core js-->
<script src="./static/js/jquery.min.js"></script>
<script src="./static/bs3/js/bootstrap.min.js"></script>
<script src="./static/js/jquery.smooth-scroll.js"></script>
<script src="./static/js/wow.min.js"></script>
<script src="./static/js/jquery.nicescroll.min.js"></script>
<script src="./static/js/jquery.countdown.min.js"></script>
<!--common script init for all pages-->
<script src="./static/js/script.js"></script>
</body>
</html>