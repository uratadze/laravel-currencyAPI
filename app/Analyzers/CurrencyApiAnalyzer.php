<?php

namespace App\Analyzers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class CurrencyApiAnalyzer
{
    /**
     * @var string
     */
    protected $url = 'https://test-api.tbcbank.ge/v1/exchange-rates/commercial';

    /**
     * Get currency from api.
     * 
     * @param string
     * 
     * @return array
     */
    public function getCurrency($currencyCode=Null)
    {
        try 
            {
                $response = $this->getApiResult(new Client, $this->url, $currencyCode);
                $data = json_decode($response->getBody(), true)['commercialRatesList'];    
            } 
            
        catch (BadResponseException  $exception) 
            {
                $response = $exception->getResponse();
                $data = json_decode($response->getBody()->getContents(), true);                
            }        
        return $this->currencyResponse($response->getStatusCode(), $data);
    }

    /**
     * Collect response data.
     * 
     * @param integer $statusCode
     * @param json $data
     * 
     * @return array
     */
    public function currencyResponse($statusCode, $data)
    {
        return [
            'status' => $statusCode,
            'data'   => $data,
        ];
    }

    /**
     * Get data from api.
     * 
     * @param GuzzleHttp\Client $client
     * @param string $url
     * @param string $currencyCode
     * 
     * @return object
     */
    public function getApiResult($client, $url, $currencyCode)
    {
        return $client->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
                'ApiKey' => config('currency.api'),
            ],
            'form_params'=>[
                'currency' => $currencyCode
            ],
        ]);
    }

}

