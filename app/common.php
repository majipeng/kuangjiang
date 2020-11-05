<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
define('DS', DIRECTORY_SEPARATOR);
define('NOW_TIME', time());

if (!function_exists('C')) {
    /**
     * 采有TP5最新助手函数特性实现函数简写方式 S
     * 获取和设置配置参数 支持批量定义
     * @param string|array $name 配置变量
     * @param mixed $value 配置值
     * @param mixed $default 默认值
     * @return mixed
     */
    function C($name=null, $value=null,$default=null) {
        return config($name);
    }
}
/**
 * 获取随机字符串
 * @param int $randLength  长度
 * @param int $addtime  是否加入当前时间戳
 * @param int $includenumber   是否包含数字
 * @return string
 */
function get_rand_str($randLength=6,$addtime=1,$includenumber=0){
    if ($includenumber){
        $chars='abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST123456789';
    }else {
        $chars='abcdefghijklmnopqrstuvwxyz';
    }
    $len=strlen($chars);
    $randStr='';
    for ($i=0;$i<$randLength;$i++){
        $randStr.=$chars[rand(0,$len-1)];
    }
    $tokenvalue=$randStr;
    if ($addtime){
        $tokenvalue=$randStr.time();
    }
    return $tokenvalue;
}

/**
 * 检查手机号码格式
 * @param $mobile 手机号码
 * @return bool
 */
function check_mobile($mobile){
    if(preg_match('/1[345678]\d{9}$/',$mobile))
        return true;
    return false;
}

/**
 * 检查固定电话
 * @param $mobile
 * @return bool
 */
function check_telephone($mobile){
    if(preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/',$mobile))
        return true;
    return false;
}

/**
 * 检查邮箱地址格式
 * @param $email 邮箱地址
 * @return bool
 */
function check_email($email){
    if(filter_var($email,FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}

/**
 *  实现中文字串截取无乱码的方法
 * @param $string
 * @param $start
 * @param $length
 * @return string
 */
function getSubstr($string, $start, $length) {
    if(mb_strlen($string,'utf-8')>$length){
        $str = mb_substr($string, $start, $length,'utf-8');
        return $str.'...';
    }else{
        return $string;
    }
}
//php获取中文字符拼音首字母
function getFirstCharter($str){
    if(empty($str))
    {
        return '';
    }
    $fchar=ord($str{0});
    if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
    $s1=iconv('UTF-8','gb2312//TRANSLIT//IGNORE',$str);
    $s2=iconv('gb2312','UTF-8//TRANSLIT//IGNORE',$s1);
    $s=$s2==$str?$s1:$str;
    $asc=ord($s{0})*256+ord($s{1})-65536;
    if($asc>=-20319&&$asc<=-20284) return 'A';
    if($asc>=-20283&&$asc<=-19776) return 'B';
    if($asc>=-19775&&$asc<=-19219) return 'C';
    if($asc>=-19218&&$asc<=-18711) return 'D';
    if($asc>=-18710&&$asc<=-18527) return 'E';
    if($asc>=-18526&&$asc<=-18240) return 'F';
    if($asc>=-18239&&$asc<=-17923) return 'G';
    if($asc>=-17922&&$asc<=-17418) return 'H';
    if($asc>=-17417&&$asc<=-16475) return 'J';
    if($asc>=-16474&&$asc<=-16213) return 'K';
    if($asc>=-16212&&$asc<=-15641) return 'L';
    if($asc>=-15640&&$asc<=-15166) return 'M';
    if($asc>=-15165&&$asc<=-14923) return 'N';
    if($asc>=-14922&&$asc<=-14915) return 'O';
    if($asc>=-14914&&$asc<=-14631) return 'P';
    if($asc>=-14630&&$asc<=-14150) return 'Q';
    if($asc>=-14149&&$asc<=-14091) return 'R';
    if($asc>=-14090&&$asc<=-13319) return 'S';
    if($asc>=-13318&&$asc<=-12839) return 'T';
    if($asc>=-12838&&$asc<=-12557) return 'W';
    if($asc>=-12556&&$asc<=-11848) return 'X';
    if($asc>=-11847&&$asc<=-11056) return 'Y';
    if($asc>=-11055&&$asc<=-10247) return 'Z';
    return null;
}
/**
 * 获取整条字符串汉字拼音首字母
 * @param $zh
 * @return string
 */
function pinyin_long($zh){
    $ret = "";
    $s1 = iconv("UTF-8","gb2312", $zh);
    $s2 = iconv("gb2312","UTF-8", $s1);
    if($s2 == $zh){$zh = $s1;}
    for($i = 0; $i < strlen($zh); $i++){
        $s1 = substr($zh,$i,1);
        $p = ord($s1);
        if($p > 160){
            $s2 = substr($zh,$i++,2);
            $ret .= getFirstCharter($s2);
        }else{
            $ret .= $s1;
        }
    }
    return $ret;
}

/**
 * dump打印优化可视化数据
 * @param mixed $val 任意数据
 * @return mixed
 */
function dd($val){
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
    exit;
}

/**
 * 当前请求是否是https
 * @return type
 */
function is_https()
{
    return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off';
}

function mobile_hide($mobile){
    return substr_replace($mobile,'****',3,4);
}

/**
 * 传时间戳
 * @param $time
 * @return bool|string
 */
function time_to_str($time){
    if ($time > strtotime(date("Y-m-d"))) {
        $text = '今天 ' . date("H:i", $time);
    } elseif ($time > strtotime(date("Y-m-d", strtotime('-1 day')))) {
        $text = '昨天 ' . date("H:i", $time);
    } elseif (empty($time)) {
        $text = '';
    } else {
        $text = date("Y-m-d H:i:s", $time);
    }
    return $text;
}

//无限极分类
function getTree($list, $pid = 0, $itemprefix = '')
{
    static $icon = array('', '└', '└');
    static $nbsp = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    static $arr = array();
    $number = 1;
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $brotherCount = 0;
            //判断当前有多少个兄弟分类
            foreach ($list as $r) {
                if ($row['pid'] == $r['pid']) {
                    $brotherCount++;
                }
            }
            if ($brotherCount > 0) {
                $j = $k = '';
                if ($number == $brotherCount) {
                    $j .= $icon[2];
                    $k = $itemprefix ? $nbsp : '';
                } else {
                    $j .= $icon[1];
                    $k = $itemprefix ? $icon[0] : '';
                }
                $spacer = $itemprefix ? $itemprefix . $j : '';
                $row['title'] = $spacer . $row['title'];
                $arr[] = $row;
                $number++;
                getTree($list, $row['id'], $itemprefix . $k . $nbsp);
            }
        }
    }
    return $arr;
}
function getTreeT($list, $pid = 0, $itemprefix = '')
{
    static $icon = array('', '└', '└');
    static $nbsp = "  ";
    static $arr = array();
    $number = 1;
    foreach ($list as $row) {
        if ($row['pid'] == $pid) {
            $brotherCount = 0;
            //判断当前有多少个兄弟分类
            foreach ($list as $r) {
                if ($row['pid'] == $r['pid']) {
                    $brotherCount++;
                }
            }
            if ($brotherCount > 0) {
                $j = $k = '';
                if ($number == $brotherCount) {
                    $j .= $icon[2];
                    $k = $itemprefix ? $nbsp : '';
                } else {
                    $j .= $icon[1];
                    $k = $itemprefix ? $icon[0] : '';
                }
                $spacer = $itemprefix ? $itemprefix . $j : '';
                $row['title'] = $spacer . $row['title'];
                $arr[] = $row;
                $number++;
                getTreeT($list, $row['id'], $itemprefix . $k . $nbsp);
            }
        }
    }
    return $arr;
}
function generateTree(&$data, $parentId = 0)
{
    $tree = [];
    foreach($data as $k => $v)
    {
        if($v['pid'] == $parentId)
        {   
            //父亲找到儿子
            $v['children'] = generateTree($data, $v['id']); //封装成函数的时候，需要去掉self::这个标识。  
            if(empty($v['children']))
            {
                unset($v['children']);
            }
            $tree[] = $v;
        }
    }
    return $tree;
}
