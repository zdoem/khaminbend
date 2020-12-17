<?php
$dayTH = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
$monthTH = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
$monthTH_brev = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];

function str_check($str)
{ 
    $str = str_replace("_", "", $str);

    $str = str_replace("%", "", $str);

    $str = str_replace("=", "", $str);

    $str = str_replace("<", "", $str);

    $str = str_replace(">", "", $str);

    $str = str_replace("\'", "", $str);

    $str = str_replace("-", "", $str);

    $str = str_replace(";", "", $str);

    $str = str_replace("select", "", $str);

    $str = str_replace("update", "", $str);

    $str = str_replace("delete", "", $str);

    $str = str_replace("insert", "", $str);

    $str = str_replace("union", "", $str);

    $str = str_replace("--", "", $str);

    $str = str_replace("$", "", $str);

    $str = str_replace("#", "", $str); 
    return $str;
}
function misc_parsestring($text, $allowchr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    if (empty($allowchr)) {
        $allowchr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    if (empty($text)) {
        return false;
    }
    $size = strlen($text);
    for ($i = 0; $i < $size; $i++) {
        $tmpchr = substr($text, $i, 1);
        if (strpos($allowchr, $tmpchr) === false) {
            return false;
        }
    }
    return true;
}
function splitMyArray(array $input_array, int $size, $preserve_keys = null): array
{
    $nr = (int)ceil(count($input_array) / $size);

    if ($nr > 0) {
        return array_chunk($input_array, $nr, $preserve_keys);
    }

    return $input_array;
}
function thai_date_and_time($time){   // 19 ธันวาคม 2556 เวลา 10:10:43
    global $dayTH,$monthTH;   
    $thai_date_return = date("j",$time);   
    $thai_date_return.=" ".$monthTH[date("n",$time)];   
    $thai_date_return.= " ".(date("Y",$time)+543);   
    $thai_date_return.= " เวลา ".date("H:i:s",$time);
    return $thai_date_return;   
} 
function thai_time($time){   // 10:10:43
    $thai_date_return= date("H:i:s",$time);
    return $thai_date_return;   
} 
function thai_date_and_time_short($time){   // 19  ธ.ค. 2556 10:10:4
    global $dayTH,$monthTH_brev;   
    $thai_date_return = date("j",$time);   
    $thai_date_return.=" ".$monthTH_brev[date("n",$time)];   
    $thai_date_return.= " ".(date("Y",$time)+543);   
    $thai_date_return.= " ".date("H:i:s",$time);
    return $thai_date_return;   
} 
function thai_date_short($time){   // 19  ธ.ค. 2556a
    global $dayTH,$monthTH_brev;   
    $thai_date_return = date("j",$time);   
    $thai_date_return.=" ".$monthTH_brev[date("n",$time)];   
    $thai_date_return.= " ".(date("Y",$time)+543);   
    return $thai_date_return;   
} 
function thai_date_fullmonth($time){   // 19 ธันวาคม 2556
    global $dayTH,$monthTH;   
    $thai_date_return = date("j",$time);   
    $thai_date_return.=" ".$monthTH[date("n",$time)];   
    $thai_date_return.= " ".(date("Y",$time)+543);   
    return $thai_date_return;   
} 
function thai_date_short_number($time){   // 19-12-56
    global $dayTH,$monthTH;   
    $thai_date_return = date("d",$time);   
    $thai_date_return.="-".date("m",$time);   
    $thai_date_return.= "-".substr((date("Y",$time)+543),-2);   
    return $thai_date_return;   
}  
function IsNullOrEmptyString($str){
    return (!isset($str) || trim($str) === ''); 
}
function DateConvert($type,$bformart,$strDate,$symbol){
    // bformart=ค่าของ date ที่จะแปลง symbol ที่จะแปลงเข้า 
    //strDate เป็น string date ที่จะแปลง, tops ค.ศ. เป็น พ.ศ. ,toad= พ.ศ. เป็น  ค.ศ.
    try {
        $t_date = DateTime::createFromFormat($bformart, $strDate);  
        // var_dump(($t_date->format('Y')+ 543).$symbol.$t_date->format('m').$symbol.$t_date->format('d'));exit();
        switch ($type) {
            case 'db':   return $t_date->format('Y-m-d H:i:s'); break;
            case 'tops': return ($t_date->format('Y')+ 543).$symbol.$t_date->format('m').$symbol.$t_date->format('d'); break;
            case 'toad': return ($t_date->format('Y')-543).$symbol.$t_date->format('m').$symbol.$t_date->format('d'); break; 
            case 'topsre': return $t_date->format('d').$symbol.$t_date->format('m').$symbol.($t_date->format('Y')+ 543);   break;
            case 'toadre': return $t_date->format('d').$symbol.$t_date->format('m').$symbol.($t_date->format('Y')- 543); break; 
        } 
       } catch (\Exception $e) { 

      }
     return '';
} 
?>