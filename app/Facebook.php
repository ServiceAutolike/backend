<?php
namespace App;
use DateTime;
use DateTimeZone;
class Facebook {
    protected $_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7";
    protected $_curl;
    protected $_fb_dtsg;
    public function __construct(){
        $this->_curl = curl_init();
    }

    public function __destruct(){
        $curl = $this->_curl;
        curl_close($curl);
        $this->_curl = NULL;
        $this->_fb_dtsg = NULL;
    }
    public function login($post_id){
        $curl = $this->_curl;
        $agent = $this->_agent;
        $headers = [];
        $url = "https://www.facebook.com/".$post_id;
        $ch = $curl;
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__)."/cookies.txt");
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__)."/cookies.txt");
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2)
                    return $len;

                $headers[strtolower(trim($header[0]))][] = trim($header[1]);

                return $len;
            }
        );
        $response = curl_exec($ch);
        return $headers;
    }
    private function SetDtsg($source){
        $fbDtsg = substr($source, strpos($source, "name=\"fb_dtsg\""));
        $fbDtsg = substr($fbDtsg, strpos($fbDtsg, "value=") + 7);
        $fbDtsg = substr($fbDtsg, 0, strpos($fbDtsg, "\""));
        $this->_fb_dtsg = $fbDtsg;
    }
    private function GetDtsg(){
        return $this->_fb_dtsg;
    }
    public function GetLocalDateStringFromUTCString($utcLongDateTime) {
        $timestamp = strtotime($utcLongDateTime);   //here you put your string with the tie
        $dtime = new DateTime();
        $dtime->setTimestamp($timestamp);
        $localtz = new DateTimeZone("Asia/Calcutta");         //choose the correct PHP timezone
        $dtime->setTimeZone($localtz);                        //we apply the timezone
        $stringtime = $dtime->format('Y-m-d\TH:i:sO');        //here you return the time in the same format as facebook
        $unixtime = $dtime->format('Y-m-d H:i:s');
        return $unixtime;
    }


}
?>
