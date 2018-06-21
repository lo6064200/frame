<?php
/**
 * Created by PhpStorm.
 * User: 张帆
 * Date: 2017/9/12
 * Time: 16:58
 */
?>
<?php include "../app/admin/view/common/header.php" ?>
    <!--右侧主体区域部分 start-->
    <div class="col-xs-12 col-sm-9 col-lg-10">
        <!-- TAB NAVIGATION -->
        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li ><a href="<?php echo u('Index.class')?>" >班级列表</a></li>
            <li class="active"><a href="<?php echo u('add')?>" >班级修改</a></li>
        </ul>
        <form action="" method="POST" class="form-horizontal" role="form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">班级修改</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">班级名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="gname" id="" placeholder="" value="<?php echo $oldData["gname"] ?>">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">班级人数</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="number" id="" placeholder="" value="<?php echo $oldData["number"] ?>">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">班主任</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="teacher" id="" placeholder="" value="<?php echo $oldData["teacher"] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
    <!--右侧主体区域部分结束 end-->
<?php include "../app/admin/view/common/footer.php" ?>
