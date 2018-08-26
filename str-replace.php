<?php
/**
 * Created by PhpStorm.
 * User: anqiao
 * Date: 2018/8/26
 * Time: 下午9:52
 */
$str=<<<"AOP"
"<strong>DOOGEE S60 Lite IP68 Waterproof Support Wireless Charge Android 7.0 4G Phone RAM 4GB+ROM 32GB Memory with 5.2 inch Display</strong><br />
<strong>Specification:</strong><br />
Color:  Black; Gold; Silver<br />
Dimension: approx.164*81*15.5 mm/6.45*3.18*0.61''<br />
Operating System : Android 7.0<br />
Processor : MT6750T Octa-Core 4x Cortex-A53, 1.5GHz 4x Cortex-A53,1.0GHz<br />
GPU : Mali-T860<br />
Battery: 5580mAh Built-in Battery 12V/2A  Quick Charge Wireless Charge<br />
<br />
<strong>Memory:</strong><br />
RAM :4GB<br />
ROM: 32GB<br />
External Storage: Micro SD Card (T-Flash Card) Up to 128GB<br />
<br />
<strong>Camera:</strong><br />
Rear Camera: 16.0 MP F2.0 PDAF  LED Flash<br />
Front Camera: 8.0 MPF2.2 88° Wide Angle<br />
Recording: 1080p Video Recording<br />
<br />
<strong>Display: </strong><br />
Size: 5.2-inch<br />
Resolution :1920*1080 FHD<br />
Pixel Density: 294ppi<br />
Panel Technology: Multi-touch<br />
Type: IPS<br />
<br />
<strong>Network:</strong><br />
SIM Card: Dual SIM Cards Standby Two Micro SIM Cards+ One TF Card<br />
2G: GSM: B2/3/5/8<br />
3G: WCDMA: B1/8<br />
4G :FDD: B1/3/7/8/20 <br />
Wi-Fi :Support<br />
Bluetooth :Support<br />
OTA: Support<br />
<br />
<strong>Media: </strong><br />
Video: AVI, MP4, WMV, RMVB, MKV, MOV, ASF, RM, FLV , up to 1080p / 30fps<br />
Audio : MP3, M4A, AAC, MKA, AMR, ALAC, FLAC, APE, WAV<br />
<br />
<strong>GPS and Sensors:</strong><br />
Fingerprint: Back Fingerprint 0.19s Unlock 360° Identification<br />
NFC: Support<br />
GPS: Support<br />
HotKnot : Support<br />
G-sensor : Support<br />
Proximity Sensor : Support<br />
Ambient Light Senor:  Support<br />
Compass : Support<br />
Geomagnetism: Support<br />
Gyroscope: Support<br />
Baroceptor :Support<br />
Others<br />
Languages :English, Spanish, Portuguese (Brazil), Portuguese (Portugal), Italian, German,  French, Russian, Arabic, Malay, Thai, Greek, Ukrainian, Croatian, Czech<br />
<br />
<p>
	<strong>Note: <br />
</strong>
</p>
<p>
	Please ensure local area network is compatible with this model. Please 
check with your carrier/provider before purchasing this item.(This phone
 isn't compatible with Pan American coutries.)  
</p>
Please allow 1-3mm differs due to manual measurement.<br />
Due to the different display and different light, the picture may not show the actual color of the item. Thanks for your understanding.<br />"
AOP;


$data=[];
$delimiters=["Media:","Network:","Specification:","Memory:","Display:","Camera:","Note:"];
$arrs=multiexplode($delimiters,$str);
foreach ($arrs as $key=>$arr)
{
    $str=strip_tags($arr,'<br>');
    $arr_lv2=explode("<br />",$str);
    $arr_lv2=array_filter($arr_lv2);
    foreach ($arr_lv2 as $ar)
    {

        $arr_lv3=explode(":",$ar);
        $arr_lv3[0]=trim($arr_lv3[0]);
        #array_map('trim',$arr_lv3);
        if(!empty($arr_lv3[0])) {
            $arr_lv3[1]=trim($arr_lv3[1]);
            $data[$key][$arr_lv3[0]]=$arr_lv3[1];
        }

    }
    #var_dump($data);die;
}
unset($data["Note:"]);
array_filter($data);
var_dump($data);die;

print_r(array_map('trim',explode(",",$str)));
$arr=explode(":",$str);
print_r($arr);

function multiexplode($delimiters,$string) {

    $arrOccurence = array();
    $arrEnd = array();
    foreach($delimiters as $key => $value){
        $position = strpos($string, $value);
        if($position > -1){
            $arrOccurence[$value] = $position;
        }
    }

    if(count($arrOccurence) > 0){

        asort($arrOccurence);
        $arrEnd = array_values($arrOccurence);
        array_shift($arrEnd);

        $i = 0;
        foreach($arrOccurence as $key => $start){
            $pointer = $start+strlen($key);
            if($i == count($arrEnd)){
                $arrOccurence[$key] = substr($string, $pointer);
            } else {
                $arrOccurence[$key] = substr($string, $pointer, $arrEnd[$i]-$pointer);
            }
            $i++;
        }

    }

    //next part can be left apart if not necessary. In that case key that don't appear in the inputstringwill not be returned
    foreach($delimiters as $key => $value){
        if(!isset($arrOccurence[$value])){
            $arrOccurence[$value] = '';
        }
    }

    return $arrOccurence;
}