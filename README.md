# Klient API do fakturowania

Zarejestruj się na http://faktury.mardraze.waw.pl



Wystawianie faktur

```
$client = new InvoiceClient('api_token');
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
```

Pobieranie listy faktur z danego miesiąca


```
$resp = $client->getInvoices(date('Y').'', date('m').'');
```

