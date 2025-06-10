<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjudaController extends Controller
{
    /**
     * Exibe a página de ajuda.
     */
    public function index()
    {
        return view('ajuda');
    }
}
