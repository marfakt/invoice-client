<?php
namespace Marfakt;

class InvoiceClient {

    private static $baseUrl = 'http://marfakt.pl';
    private $lastResult;
    private $apiToken;

    public function __construct($apiToken, $baseUrl = null){
        $this->apiToken = $apiToken;
        if($baseUrl){
            self::$baseUrl = $baseUrl;
        }
    }

    public function addInvoice($data){
        return $this->requestToken('POST', '/invoice.json', $data);
    }

    public static function pdfUrl($id, $hash){
        return self::$baseUrl.'/invoice/'.$hash.'/'.$id.'/Faktura-'.$id.'.pdf';
    }

    public function getPdfUrl($id, $hash){
        return self::pdfUrl($id, $hash);
    }

    public function getInvoices($year, $month){
        return $this->requestToken('GET', '/invoice-list/'.$year.'/'.$month);
    }

    private function requestToken($method, $url, $parameters = array()){
        return $this->request($method, $url.'?api_token='.$this->apiToken, $parameters);
    }

    private function request($method, $url, $parameters = array()){
        $result = null;
        $url = self::$baseUrl . $url;
        if($method == 'POST'){
            $postdata = json_encode($parameters);
            $opts = array(
            		"ssl" => array(
            				"verify_peer"=>false,
            				"verify_peer_name"=>false,
            		),
            		'http' => array(
		                    'method'  => 'POST',
		                    'header'  => 'Content-Type: application/json; charset=UTF-8',
		                    'content' => $postdata
	                )
            );
            $context = stream_context_create($opts);
            $result = file_get_contents($url, false, $context);
        }else{
            $result = file_get_contents($url);
        }
        $this->lastResult = $result;
        return json_decode($result, true);
    }
}
