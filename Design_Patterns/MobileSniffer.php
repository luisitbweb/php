<?php
// user agent as property of object

class MobileSniffer{
    private $userAgent, $device, $browser, $deviceLength, $browserLength;
    
    public function __construct() {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->userAgent = strtolower($this->userAgent);
        
        $this->device = ['Windows NT 10.0; WOW64', 'iphone', 'ipad', 'android', 'silk', 'blackberry', 'touch'];
        $this->browser = ['firefox', 'chrome', 'opera', 'msie', 'safari', 'blackberry', 'trident'];
        $this->deviceLength = count($this->device);
        $this->browserLength = count($this->browser);
    }
    
    public function findDevice(){
        for($uaSniff = 0; $uaSniff < $this->deviceLength; $uaSniff++){
            if (strstr($this->userAgent, $this->device[$uaSniff])){
                return $this->device[$uaSniff];
            }
        }
    }
    
    public function findBrowser(){
        for($uaSniff = 0; $uaSniff < $this->browserLength; $uaSniff++){
            if (strstr($this->userAgent, $this->browser[$uaSniff])){
                return $this->browser[$uaSniff];
            }
        }
    }
}