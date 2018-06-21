<?php include "../app/admin/view/common/header.php" ?>
    <!--右侧主体区域部分 start-->
    <div class="col-xs-12 col-sm-9 col-lg-10">
        <!-- TAB NAVIGATION -->
        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab1" >学生列表</a></li>
            <li><a href="<?php echo u('add')?>" >学生添加</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">学生列表</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>学生编号</th>
                        <th>学生头像</th>
                        <th>学生姓名</th>
                        <th>学生性别</th>
                        <th>学生年龄</th>
                        <th>学生班级</th>
                        <th>班主任</th>
                        <th>操作</th>
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
                            <td><?php echo $v['ssex']?></td>
                            <td><?php echo $v['sage']?></td>
                            <td><?php echo $v['gname']?></td>
                            <td><?php echo $v['teacher']?></td>
                            <td>
                                <div class="btn-group btn-group-xs">
                                    <a href="<?php echo u('edit',['sid'=>$v['sid']])?>" class="btn btn-primary">编辑</a>
                                    <a href="javascript:;" onclick="del(<?php echo $v['sid']?>)" class="btn btn-danger">删除</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function del(sid) {
//            var url = "<?php //echo  u('del')?>//" + "&gid="+gid;
//            modal(url);
            if(confirm('确认删除吗？')){
               location.href  = "<?php echo u('del')?>" + '&sid=' + sid;
            }
        }

    </script>
    <!--右侧主体区域部分结束 end-->
<?php include "../app/admin/view/common/footer.php" ?>