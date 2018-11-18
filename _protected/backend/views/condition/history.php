<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $model->name ?></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>المساعدة</th>
                    <th style="width: 30px">الكمية</th>
                    <th>تاريخ التسليم</th>
                    <th>التسليم بواسطة</th>
                </tr>
                <?php
                $i=1;
                if(!empty($history)) foreach ($history as $item){ ?>
                <tr>
                    <td><?= $i ?>.</td>
                    <td><?= $item->aid->title ?></td>
                    <td>
                        1
                    </td>
                    <td><?= $item->delivery_time ?></td>
                    <td><?= $item->deliveredBy->username ?></td>
                </tr>
                <?php } else echo '<h5>لم يتم تقديم اي مساعدات لهذه الحالة</h5>' ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        
    </div>
</div>