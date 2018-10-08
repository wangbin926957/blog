@extends('admin.layout')

@section('title')
    分配权限
@endsection

@section('content')
<style type="text/css">
    div.pull-right label {
        margin-right: 10px;
    }

    .list-group li.space {
        padding-left: 80px;
    }

    .list-group li.space  label{
        margin-right: 30px;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        分配权限
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                系统管理
            </a>
        </li>
        <li class="active">
            分配权限
        </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{ $role_info['role_name'] }} 权限
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="data_form" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <input name="role_id" type="hidden" value="{{ $role_info['role_id'] }}">
                            <div class="list-group">
                                @foreach($data as $item)
                                    <div style='margin:0 0 10px;'>
                                        <li class="list-group-item list-group-item-warning" href="#">
                                            <label>
                                                {{ $item['name'] }}
                                                <input name='permissions[]' class="minimal parent_permission permission" type="checkbox" value="{{ $item['permission'] }}">
                                                </input>
                                            </label>
                                        </li>
                                        <li class="list-group-item space role" href="#">
                                            @foreach($item['child'] as $child)
                                            <label>
                                                {{ $child['name'] }}
                                                <input name='permissions[]' class="minimal child_permission permission" type="checkbox" value="{{ $child['permission'] }}" parent-permission="{{ $item['permission'] }}">
                                                </input>
                                            </label>
                                            @endforeach
                                        </li>
                                    </div>
                                @endforeach
                            </div>
                        </input>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a class="btn btn-default" href="/role/index">
                            返回
                        </a>
                        <button class="btn btn-primary pull-right" type="submit">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection @section('script')
<!-- iCheck 1.0.1 -->
<script src="/admin-lte/plugins/iCheck/icheck.min.js">
</script>
<script type="text/javascript">

    $(function(){

        // 父权限 选择
        $('.parent_permission').click(function(){
            var permission = $(this).val();
            var is_check = $(this).is(':checked');

            $('input[type="checkbox"][parent-permission="'+permission+'"]').prop("checked",is_check);
        });

        // 子权限选择
        $('.child_permission').click(function(){
            var parent_permission = $(this).attr('parent-permission');
            var child_check_count = $('input[type="checkbox"][parent-permission="'+parent_permission+'"]:checked').length;
            var parent_is_check = $('input[type="checkbox"][value="'+parent_permission+'"]').is(':checked');

            // 选中父权限节点
            if (child_check_count > 0 && parent_is_check == false) {
                $('input[type="checkbox"][value="'+parent_permission+'"]').prop("checked",true);
            }
            else if(child_check_count == 0 && parent_is_check == true){
                $('input[type="checkbox"][value="'+parent_permission+'"]').prop("checked",false);
            }
        });

        // 设置角色权限
        var role_permissions = {!! $role_permissions !!};

        if (role_permissions) {

            $('.permission').each(function(i,e){
                var permission = $(e).val();

                if ($.inArray( permission, role_permissions) > -1) {
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
            });
        }

        var msg = '{{ $msg or '' }}';

        if (msg != '') {
            layer.msg(msg);
        }
    });
</script>
@endsection
