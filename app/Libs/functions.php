<?php

/**
 * 数字转换为中文
 * @param  string|integer|float  $num  目标数字
 * @param  integer $mode 模式[true:金额（默认）,false:普通数字表示]
 * @param  boolean $sim 使用小写（默认）
 * @return string
 */
function number2chinese($num, $mode = false, $sim = true) {
    if (!is_numeric($num)) {
        return '含有非数字非小数点字符！';
    }

    $char = $sim ? array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九')
    : array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖');
    $unit = $sim ? array('', '十', '百', '千', '', '万', '亿', '兆')
    : array('', '拾', '佰', '仟', '', '萬', '億', '兆');
    $retval = $mode ? '元' : '';
    //小数部分
    if (strpos($num, '.')) {
        list($num, $dec) = explode('.', $num);
        $dec             = strval(round($dec, 2));
        if ($mode) {
            $retval .= "{$char[$dec['0']]}角{$char[$dec['1']]}分";
        } else {
            for ($i = 0, $c = strlen($dec); $i < $c; $i++) {
                $retval .= $char[$dec[$i]];
            }
        }
    }
    //整数部分
    $str = $mode ? strrev(intval($num)) : strrev($num);
    for ($i = 0, $c = strlen($str); $i < $c; $i++) {
        $out[$i] = $char[$str[$i]];
        if ($mode) {
            $out[$i] .= $str[$i] != '0' ? $unit[$i % 4] : '';
            if ($i > 1 and $str[$i] + $str[$i - 1] == 0) {
                $out[$i] = '';
            }
            if ($i % 4 == 0) {
                $out[$i] .= $unit[4 + floor($i / 4)];
            }
        }
    }
    $retval = join('', array_reverse($out)) . $retval;

    return $retval;
}

/**
 * 日期增加天数
 * @param $start_date
 * @param $days
 * @return 增加日期后的日期
 */
function add_days($start_date, $days) {
    $result = date('Y-m-d', strtotime("$start_date +$days day"));
    return $result;
}

/**
 * 计算两个日期相差天数
 * @param $first_date
 * @param $second_date
 * @return 相差天数
 */
function diff_date($first_date, $second_date) {
    $_first_time  = strtotime($first_date);
    $_second_time = strtotime($second_date);

    if ($_first_time && $_second_time) {
        // 向下取整
        $result = floor(($_first_time - $_second_time) / (60 * 60 * 24));

        return (int) $result;
    }
}

/**
 * 判断是否为合法的身份证号码
 * @param $vStr
 * @return boole
 */
function is_credit_no($vStr) {
    $vCity = array(
        '11', '12', '13', '14', '15', '21', '22',
        '23', '31', '32', '33', '34', '35', '36',
        '37', '41', '42', '43', '44', '45', '46',
        '50', '51', '52', '53', '54', '61', '62',
        '63', '64', '65', '71', '81', '82', '91',
    );

    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) {
        return false;
    }

    if (!in_array(substr($vStr, 0, 2), $vCity)) {
        return false;
    }

    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);

    $vLength = strlen($vStr);

    if ($vLength == 18) {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }

    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) {
        return false;
    }

    if ($vLength == 18) {
        $vSum = 0;
        for ($i = 17; $i >= 0; $i--) {
            $vSubStr = substr($vStr, 17 - $i, 1);
            $vSum += (pow(2, $i) % 11) * (($vSubStr == 'a') ? 10 : intval($vSubStr, 11));
        }

        if ($vSum % 11 != 1) {
            return false;
        }

    }

    return true;
}

/**
 * 根据身份证获取生日
 * @param $vStr
 * @return string
 */
function get_birthday_by_credit_no($vStr) {
    $vCity = array(
        '11', '12', '13', '14', '15', '21', '22',
        '23', '31', '32', '33', '34', '35', '36',
        '37', '41', '42', '43', '44', '45', '46',
        '50', '51', '52', '53', '54', '61', '62',
        '63', '64', '65', '71', '81', '82', '91',
    );

    if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $vStr)) {
        return false;
    }

    if (!in_array(substr($vStr, 0, 2), $vCity)) {
        return false;
    }

    $vStr = preg_replace('/[xX]$/i', 'a', $vStr);

    $vLength = strlen($vStr);

    if ($vLength == 18) {
        $vBirthday = substr($vStr, 6, 4) . '-' . substr($vStr, 10, 2) . '-' . substr($vStr, 12, 2);
    } else {
        $vBirthday = '19' . substr($vStr, 6, 2) . '-' . substr($vStr, 8, 2) . '-' . substr($vStr, 10, 2);
    }

    if (date('Y-m-d', strtotime($vBirthday)) != $vBirthday) {
        return false;
    }

    return $vBirthday;
}

// 根据日期获取星期几
function get_week_info($date = null) {
    $weeks = array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");

    $result = [];
    $time   = 0;

    // 日期字符串
    if (is_string($date)) {
        $time = strtotime($date);
    }
    // 时间戳
    else if (is_int($date)) {
        $time = $date;
    }

    if ($time) {
        $index = (int) date("w", $time);

        if (isset($weeks[$index])) {
            $result['index'] = $index;
            $result['name']  = $weeks[$index];
        }
    }

    return $result;
}

// 读取csv
function read_csv_lines($csv_file = '', $lines = 0, $offset = 0) {
    $row    = 0;
    $result = [];
    $handle = fopen($csv_file, "r");
    while (!feof($handle)) {
        $data = fgetcsv($handle);

        if ($row == 0) {
            $keys = $data;
        } else {
            $tmp = [];

            foreach ($data as $k => $value) {
                if (!empty($keys[$k])) {
                    $tmp[$keys[$k]] = $value;
                }
            }

            $result[] = $tmp;
        }

        $row++;
    }

    return $result;
}

// 获取随机字符串
function get_rand_str($length = 6) {
    $str    = null;
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max    = strlen($strPol) - 1;

    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}

// 获取随机数
function get_rand_numb($length = 6) {
    $str    = '';
    $strPol = "0123456789";
    $max    = strlen($strPol) - 1;

    for ($i = 0; $i < $length; $i++) {
        $str .= $strPol[rand(0, $max)];
    }

    return $str;
}

// 密码验证正则 6-20位 数字+字母
function check_password($str) {
    $result = false;
    $preg   = '/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/';
    $r      = preg_match($preg, $str);

    if ($r) {
        $result = true;
    }

    return $result;
}

// 验证手机号
function is_mobile($str) {
    $result = false;
    $preg   = '/^1[3-9][0-9]{9}$/';
    $r      = preg_match($preg, $str);

    if ($r) {
        $result = true;
    }

    return $result;
}

// 验证邮箱
function is_email($str) {
    $result = false;
    $preg   = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    $r      = preg_match($preg, $str);

    if ($r) {
        $result = true;
    }

    return $result;
}

// 获取访问IP
function get_ip() {
    $ip = '';

    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR')) {
        $ip = getenv('REMOTE_ADDR');
    } else {
        $ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
    }

    return $ip;
}

/**
 * 返回可读性更好的文件尺寸
 */
function human_file_size($bytes, $decimals = 2) {
    $size   = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

/**
 * 返回随机不重复的字符串
 * @param string $str 长度
 * @return string
 */
function get_id_rand_str($str = '') {
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((double) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true) . $str));
        $hyphen = chr(45);
        $uuid   = substr($charid, 0, 8) . $hyphen
        . substr($charid, 8, 4) . $hyphen
        . substr($charid, 12, 4) . $hyphen
        . substr($charid, 16, 4) . $hyphen
        . substr($charid, 20, 12);
        return $uuid;
    }
}

// 图片转base64
function base64_encode_image($image_file) {
    $base64_image = '';
    $image_info   = getimagesize($image_file);
    $image_data   = fread(fopen($image_file, 'r'), filesize($image_file));
    $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));

    return $base64_image;
}
