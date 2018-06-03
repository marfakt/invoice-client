<?php

require_once(__DIR__.'/../lib/Marfakt/InvoiceClient.php');

class InvoiceClientTest extends \PHPUnit_Framework_TestCase
{

    private static $client;

    public function testAdd(){
        $client = self::getInvoiceClient();
        $resp = $client->addInvoice(array(
            'MiejsceWystawienia' => 'Olsztyn',
            'Odbiorca' => array(
                'Nazwa' => 'Jan Kowalski',
                'Ulica' => '',
                'NumerDomu' => '',
                'NumerLokalu' => '',
                'KodPocztowy' => '',
                'Miejscowosc' => '',
                'Wojewodztwo' => '',
                'Kraj' => '',
                'NIP' => '',
                'REGON' => '',
                'PESEL' => '',
                'VIES' => '',
                'VATUE' => '',
                'NumerRachunkuBankowego' => '',
                'Telefon1' => '',
                'Telefon2' => '',
                'Fax' => '',
                'Email' => '',
            ),
            'PozycjaDokumentu' => array(
                array(
                    'Nazwa' => 'Test product',
                    'JednostkaMiary' => 'szt',
                    'Ilosc' => 1,
                    'CenaNetto' => 23.34,
                    'StawkaVAT' => 23,
                )
            )
        ));

        $this->assertTrue($resp['success'] == 1 && $resp['data']['id'] > 1);
    }

    public function testPdfUrl(){
        $client = self::getInvoiceClient();
        $resp = $client->addInvoice(array(
            'Odbiorca' => array(
                'Nazwa' => 'Jan Kowalski',
            ),
            'PozycjaDokumentu' => array(
                array(
                    'Nazwa' => 'Test product',
                    'JednostkaMiary' => 'szt',
                    'Ilosc' => 1,
                    'CenaNetto' => 23.34,
                    'StawkaVAT' => 23,
                )
            )
        ));
        $url = $client->getPdfUrl($resp['data']['id'], $resp['data']['hash']);
        $content = file_get_contents($url, false, stream_context_create(array(
        		"ssl" => array(
        				"verify_peer"=>false,
        				"verify_peer_name"=>false,
        		)
        )));
        $this->assertTrue(strlen($content) > 0);
    }

    public function testList(){
        $client = self::getInvoiceClient();
        $resp = $client->getInvoices(date('Y').'', date('m').'');
        $this->assertTrue($resp['success'] == 1);
    }

    /**
     * @return \Marfakt\InvoiceClient
     * @throws \Exception
     */
    private static function getInvoiceClient(){
        if(!self::$client){
            //self::$client = new \Marfakt\InvoiceClient('3/5ad0f7cfd1ac21e235d5c90fe8479d08', 'http://127.0.0.1:8000');
            self::$client = new \Marfakt\InvoiceClient('1/a31516ab768ae6ca27a562dde692cebd');
        	            
        }
        return self::$client;
    }

}