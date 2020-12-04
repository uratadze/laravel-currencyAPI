<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Analyzers\CurrencyApiAnalyzer as Analyzer;

class CurrencyController extends Controller
{
    /**
     * Get currency api.
     *
     * @return array
     */
    public function index(Request $request, Analyzer $analyzer)
    {
        return $analyzer->getCurrency($request->code);
    }
   
}