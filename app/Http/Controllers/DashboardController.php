<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Analyzers\CurrencyApiAnalyzer;

class DashboardController extends Controller
{
    /**
     * Show currency list.
     * 
     * @param App\Analyzers\CurrencyApiAnalyzer
     * 
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function index(CurrencyApiAnalyzer $analyzer)
    {
        return view('welcome')->with('currency', $analyzer->getCurrency());
    }
}
