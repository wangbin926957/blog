@extends('admin.layout')

@section('title')
    @lang('app.menu.system_user')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        系统用户管理
        <small>
        </small>
    </h1>
    <!--     <ol class="breadcrumb">
        <li class="active">用户管理</li>
    </ol> -->
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        @if($login_admin->hasPermission('admin_add'))
                            <button class="btn btn-info" id="btn_add" type="button">
                            添加用户
                            </button>
                        @endif
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped table-fixed" id="data_table">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    账号
                                </th>
                                <th>
                                    姓名
                                </th>
                                <th>
                                    角色
                                </th>
                                <th>
                                    手机号
                                </th>
                                <th>
                                    状态
                                </th>
                                <th>
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td>
                                    {{ $item->id }}
                                </td>
                                <td>
                                    <b>
                                        {{ $item['account'] }}
                                    </b>
                                </td>
                                <td>
                                    {{ $item['name'] }}
                                </td>
                                <td>
                                    {{ $item->role_name }}
                                </td>
                                <td>
                                    {{ $item['phone'] }}
                                </td>
                                <td>
                                    @if($item['disabled'] == 0)
                                        <span class='badge bg-green'>
                                            可用
                                        </span>
                                    @elseif($item['disabled'] == 1)
                                        <span class='badge bg-red'>
                                            禁用
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($login_admin->hasPermission('admin_add'))
                                    <button class="btn btn-warning btn-xs btn-edit" data-id="{{ $item['id'] }}" type="button">
                                        修改
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- Modal -->
<div aria-labelledby="myModalLabel" class="modal fade" id="data_modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    用户信息
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="data_form" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <input id="id" name="id" type="hidden" />
                        <input id="group_id" name="group_id" type="hidden" value="1" />
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="account">
                                账号
                            </label>
                            <div class="col-xs-8">
                                <input class="form-control" id="account" maxlength="20" name="account" placeholder="账号" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="password">
                                密码
                            </label>
                            <div class="col-xs-8">
                                <input class="form-control" id="password" maxlength="20" name="password" placeholder="密码" type="password">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="role_id">
                                角色
                            </label>
                            <div class="col-xs-8">
                                <select class="form-control" id="role_id" name="role_id" style="width: 100%;">
                                    @foreach($roles as $item)
                                    <option value="{{ $item['role_id'] }}">
                                        {{ $item['role_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="name">
                                姓名
                            </label>
                            <div class="col-xs-8">
                                <input class="form-control" id="name" maxlength="20" name="name" placeholder="姓名" type="text" value="">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="gender">
                                性别
                            </label>
                            <div class="col-xs-8">
                                <label class="radio-inline">
                                    <input checked="" name="gender" type="radio" value="0">
                                        未设置
                                    </input>
                                </label>
                                <label class="radio-inline">
                                    <input name="gender" type="radio" value="1">
                                        男
                                    </input>
                                </label>
                                <label class="radio-inline">
                                    <input name="gender" type="radio" value="2">
                                        女
                                    </input>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="phone">
                                手机号
                            </label>
                            <div class="col-xs-8">
                                <input class="form-control" id="phone" maxlength="20" name="phone" placeholder="手机号" type="phone">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="email">
                                邮箱
                            </label>
                            <div class="col-xs-8">
                                <input class="form-control" id="email" maxlength="30" name="email" placeholder="邮箱" type="email">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" for="level">
                                禁用
                            </label>
                            <div class="col-xs-8">
                                <label class="radio-inline">
                                    <input checked="" name="disabled" type="radio" value="0">
                                        可用
                                    </input>
                                </label>
                                <label class="radio-inline">
                                    <input name="disabled" type="radio" value="1">
                                        禁用
                                    </input>
                                </label>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    取消
                </button>
                <button class="btn btn-info pull-right" id="btn_submit" type="button">
                    保存
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- page script -->
<script>
    $(function() {
        $('#data_table').DataTable();

        $('#btn_add').click(function() {
            // 重置表单
            document.getElementById('data_form').reset();
            $('#id').val('');
            $('input[name=gender]').removeAttr('checked');
            $("input[name=gender][value="+0+"]").prop('checked',true);

            $('input[name=status]').removeAttr('checked');
            $("input[name=status][value=0]").prop('checked', true);

            $('.form-group').removeClass('has-error');

            $('#data_modal').modal('show');
        });

        $('#btn_submit').click(checkData);

        $(document).on("click", ".btn-edit", function(event) {
            var id = $(this).attr('data-id');
            if (id > 0) {
                getInfo(id);
            }
        });

        var msg = '{{ $msg or '' }}';

        if (msg) {
            layer.alert(msg);
        }
    });

    function checkData() {
        var err_count = 0;

        var account = $.trim($('#account').val());
        $('#account').val(account);

        var phone = $.trim($('#phone').val());
        $('#phone').val(phone);

        var name = $.trim($('#name').val());
        $('#name').val(name);

        var email = $.trim($('#email').val());
        $('#email').val(email);

        var password = $('#password').val();

        // 账号必填
        if (isEmpty(account)) {
            err_count += 1;
            layer.tips('账号不能为空！', '#account', {
                tips: [2, 'red']
                ,tipsMore:true
            });
        }

        // 添加账号 密码必填
        // 修改账号 密码非必填，密码填写，验证
        if ($('#id').val() == '' || $('#password').val() != '') {
            if (!leng(password, 6, 20)) {
                err_count += 1;
                layer.tips('密码长度在6-20位！', '#password', {tips: [2, 'red'],tipsMore:true});
            }
        }

        // 手机号 非必填 填写验证手机号
        if (!isEmpty(phone) && !isMobile(phone)) {
            err_count += 1;
            layer.tips('请输入有效的手机号', '#phone', {tips: [2, 'red'],tipsMore:true});
        }

        // 邮箱 非必填 填写验证
        if (!isEmpty(email) && !isEmail(email)) {
            err_count += 1;
            layer.tips('请输入有效的邮箱', '#email', {tips: [2, 'red'],tipsMore:true});
        }

        if (err_count == 0) {
            submitData();
        }
    }

    function submitData(){

        $('#data_form').ajaxSubmit({
            url: '/admin/save'
            ,type: "post"
            ,dataType: "json"
            ,success: function (res) {
                console.log(res);
                if (res.code == 0) {
                    window.location.reload();
                }
                else if (res.msg) {
                    layer.alert(res.msg);
                }
            }
            ,error: function (error) {
                console.log(error);
            }
        });
    }

    function getInfo(id) {
        if (id > 0 && ajaxing == false) {
            var json_data = {id: id};
            var url = '/admin/info';
            var succ = function(res){
                console.log(res);
                if (res.code == 0 && res.data) {
                    initEdit(res.data);
                }
            }

            ajax(url,json_data,succ);
        }
    }

    function initEdit(data){
        // 重置表单
        document.getElementById('data_form').reset();

        $('#id').val(data.id);
        $('#account').val(data.account);
        $('#password').val('');
        $('#phone').val(data.phone);
        $('#name').val(data.name);
        $('#role_id').val(data.role_id);
        $('#email').val(data.email);

        var gender = data.gender;
        $("input[name=gender][value="+gender+"]").prop('checked',true);
        $('.form-group').removeClass('has-error');

        var disabled = data.disabled;
        $('input[name=disabled]').removeAttr('checked');
        $("input[name=disabled][value="+disabled+"]").prop('checked', true);

        $('#data_modal').modal('show');
    }
</script>
@endsection
