<?php include "../app/admin/view/common/header.php" ?>
    <!--右侧主体区域部分 start-->
    <div class="col-xs-12 col-sm-9 col-lg-10">
        <!-- TAB NAVIGATION -->
        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab1" >班级列表</a></li>
            <li><a href="<?php echo u('add')?>" >班级添加</a></li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">班级列表</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>班级编号</th>
                        <th>班级名称</th>
                        <th>班级人数</th>
                        <th>班主任</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data as $v):?>
                        <tr>
                            <td><?php echo $v['gid']?></td>
                            <td><?php echo $v['gname']?></td>
                            <td><?php echo $v['number']?></td>
                            <td><?php echo $v['teacher']?></td>
                            <td>
                                <div class="btn-group btn-group-xs">
                                    <a href="<?php echo u('edit',['gid'=>$v['gid']])?>" class="btn btn-primary">编辑</a>
                                    <a href="javascript:;" onclick="del(<?php echo $v['gid']?>)" class="btn btn-danger">删除</a>
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
        function del(gid) {
//            var url = "<?php //echo  u('del')?>//" + "&gid="+gid;
//            modal(url);
//            if(confirm('确认删除吗？')){
//               location.href  = "<?php //echo u('del')?>//" + '&gid=' + gid;
//            }
            modal();
        }
    function modal(url) {
        var str = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">\n' +
            '        <div class="modal-dialog" role="document">\n' +
            '            <div class="modal-content">\n' +
            '                <div class="modal-header">\n' +
            '                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>\n' +
            '                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>\n' +
            '                </div>\n' +
            '                <div class="modal-body">\n' +
            '                    ...\n' +
            '                </div>\n' +
            '                <div class="modal-footer">\n' +
            '                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>\n' +
            '                    <a type="button" class="btn btn-primary">Save changes</a>\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>';
        $('body').append(str);
        $('#myModal').modal('show')
    }
    </script>
    <!--右侧主体区域部分结束 end-->
<?php include "../app/admin/view/common/footer.php" ?>