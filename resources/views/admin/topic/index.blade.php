@extends("admin.layout.main")
@section("content")
            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">专题列表</h3>
                    </div>
                    <a type="button" class="btn " href="/admin/topics/create" >增加专题</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>专题名称</th>
                                <th>操作</th>
                            </tr>
                                                            <tr>
                                    <td>1</td>
                                    <td>旅游</td>
                                    <td>
                                        <a type="button" class="btn resource-delete" delete-url="/admin/topics/1" href="#" >删除</a>
                                    </td>
                                </tr>
                                                            <tr>
                                    <td>2</td>
                                    <td>轻松</td>
                                    <td>
                                        <a type="button" class="btn resource-delete" delete-url="/admin/topics/2" href="#" >删除</a>
                                    </td>
                                </tr>
                                                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
    </div>
@endsection