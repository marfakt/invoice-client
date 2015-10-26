# Klient API do fakturowania

Zarejestruj się na http://marfakt.pl aby uzyskać api_token

Instalacja

```
php -r "readfile('https://getcomposer.org/installer');" | php
php composer.phar require "marfakt/invoice-client" "dev-master"
echo "require __DIR__ . '/vendor/autoload.php';" > test.php
```

Został utworzony plik test.php w którym możemy testować klienta.

Wystawianie faktur

```
$client = new \Marfakt\InvoiceClient('api_token');
$response = $client->addInvoice(array(
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
```
W zmiennej $response mamy id oraz hash potrzebny do utworzenia publicznego linku do pliku PDF z fakturą.

Publiczny link do pliku PDF dodanej wcześniej faktury

```
$url = \Marfakt\InvoiceClient::pdfUrl($id, $hash);
```

Pobieranie listy faktur z danego miesiąca

```
$resp = $client->getInvoices(date('Y'), date('m'));
```
