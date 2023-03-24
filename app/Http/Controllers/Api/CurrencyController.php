<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CurrencyController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Currency $currency)
    {
        //
    }

    public function update(Request $request, Currency $currency)
    {
        $client = new Client();

        $response = $client->request('GET', 'http://api.nbp.pl/api/exchangerates/tables/A');

        $data = json_decode($response->getBody(), true);

        $date = $data[0]['effectiveDate'];

        foreach ($data[0]['rates'] as $rate) {
            //Początkowy test czy zapisuje wszystkie
            $currency = new Currency;
            $currency->name = $rate['Currency'];
            $currency->currency_code = $rate['code'];
            $currency->exchange_rate = $rate['mid'];
            $currency->save();
        }

        return 'Kursy walut zostały zaktualizowane.';
    }

    public function destroy(Currency $currency)
    {
        //
    }
}
