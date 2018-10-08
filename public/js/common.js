// ajax 发送标记
var ajaxing = false;
// 省市区数据存储对象
var provinces;
// 当前城市数据
var citys;
// 当前区域数据
var areas;
// 有效金额检查
function isMoney(str) {
    var reg = /^([1-9][\d]{0,7}|0)(\.[\d]{1,2})?$/;
    var result = reg.test(str); //true
    return result;
}
// 手机号检查
function isMobile(str) {
    var reg = /^1[3-9][0-9]{9}$/;
    var result = reg.test(str); //true
    return result;
}

function isEmpty(str) {
    var result = false;
    if (str == null || str == undefined) {
        str = '';
    } else {
        str = $.trim(str);
    }
    if (str == '') {
        result = true;
    }
    return result;
}

function isEmail(str) {
    var result = false;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (filter.test(str)) {
        result = true;
    }
    return result;
}
// 验证身份证
function isCardNo(card) {
    var pattern = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
    return pattern.test(card);
}

function leng(str, min, max) {
    var result = false;
    if (str != null && str != undefined) {
        str = $.trim(str);
    } else {
        str = '';
    }
    if (str.length >= min && str.length <= max) {
        result = true;
    }
    return result;
}

function ajax(url, json_data, succ, type, async) {
    if (async != false) {
        async = true;
    }
    if (type != 'get') {
        type = 'post';
    }
    if (url && ajaxing == false) {
        if (!json_data) {
            json_data = {};
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: url,
            data: json_data,
            dataType: "json",
            async: async,
            beforeSend: function() {
                ajaxing == true;
                layer.load(2, {
                    shade: [0.15, '#393D49']
                });
            },
            success: succ,
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
            },
            complete: function(XMLHttpRequest, textStatus) {
                ajaxing == false;
                setTimeout(function() {
                    layer.closeAll('loading');
                }, 500);
            }
        });
    }
}

function initProvince(pro_dom, show_default, default_option) {
    if (!provinces) {
        var url = '/ajax/getRegion';
        var json_data = {};
        var succ = function(res) {
            provinces = res;
            // console.log(res);
        };
        ajax(url, json_data, succ, 'get', false);
    }
    $(pro_dom).empty();
    if (show_default == true) {
        var tmp = "<option value='-1'>--- 省 ---</option>";
        $(pro_dom).append(tmp);
    }
    for (var i = 0; i < provinces.length; i++) {
        var tmp = "<option value='" + provinces[i].id + "'> " + provinces[i].name + "</option>";
        $(pro_dom).append(tmp);
    }
    // 设置默认
    if (default_option > 0) {
        $(pro_dom).val(default_option);
    }
}

function initCity(province_id, city_dom, show_default, default_option) {
    if (!provinces) {
        var url = '/ajax/getRegion';
        var json_data = {};
        var succ = function(res) {
            provinces = res;
        };
        ajax(url, json_data, succ, 'get', false);
        console.log('initCity');
    }
    $(city_dom).empty();
    if (show_default == true) {
        var tmp = "<option value='-1'>--- 市 ---</option>";
        $(city_dom).append(tmp);
    }
    for (var i = 0; i < provinces.length; i++) {
        if (provinces[i].id == province_id) {
            citys = provinces[i].child;
            for (var j = 0; j < citys.length; j++) {
                var tmp = "<option value='" + citys[j].id + "'> " + citys[j].name + "</option>";
                $(city_dom).append(tmp);
            }
        }
    }
    // 设置默认
    if (default_option > 0) {
        $(city_dom).val(default_option);
    }
}

function initArea(city_id, area_dom, show_default) {
    $(area_dom).empty();
    if (show_default == true) {
        var tmp = "<option value='-1'>--- 区 ---</option>";
        $(area_dom).append(tmp);
    }
    if (citys && citys.length > 0) {
        for (var j = 0; j < citys.length; j++) {
            if (citys[j].id == city_id) {
                var area = citys[j].child;
                for (var k = 0; k < area.length; k++) {
                    var tmp = "<option value='" + area[k].id + "'> " + area[k].name + "</option>";
                    $(area_dom).append(tmp);
                }
            }
        }
    }
}
/*
    @function     JsonSort 对json排序
    @param        json     用来排序的json
    @param        key      排序的键值
*/
function JsonSort(json, key) {
    //console.log(json);
    for (var j = 1, jl = json.length; j < jl; j++) {
        var temp = json[j],
            val = temp[key],
            i = j - 1;
        while (i >= 0 && json[i][key] > val) {
            json[i + 1] = json[i];
            i = i - 1;
        }
        json[i + 1] = temp;
    }
    //console.log(json);
    return json;
}