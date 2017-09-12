<?php include "../app/admin/view/common/header.php" ?>
        <!--右侧主体区域部分 start-->
        <div class="col-xs-12 col-sm-9 col-lg-10">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li ><a href="#tab1" >用户信息</a></li>
                <li class="active"><a href="#tab1" >信息修改</a></li>
            </ul>
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">修改密码</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">用户名</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control"  disabled value="<?php echo $_SESSION['username'] ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">旧密码</label>
                            <div class="col-sm-10">
                                <input type="password" name="xj_password" class="form-control"  placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">新密码</label>
                            <div class="col-sm-10">
                                <input type="password" name="xg_password" class="form-control"  placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">再次输入新密码</label>
                            <div class="col-sm-10">
                                <input type="password" name="xg_password1" class="form-control"  placeholder="" >
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">提交数据</button>
            </form>
        </div>
    <!--右侧主体区域部分结束 end-->
<?php include "../app/admin/view/common/footer.php" ?>
