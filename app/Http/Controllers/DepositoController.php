<?php

namespace App\Http\Controllers;
use App\Models\Deposito;
use Illuminate\Http\Request;

class DepositoController extends Controller
{
    //
    public function marcarComoFeito($id)
{
    $deposito = Deposito::findOrFail($id);
    $deposito->feito = true;
    $deposito->save();

    return redirect()->back()->with('success', 'Depósito marcado como feito!');
}

public function desfazer($id)
{
    $deposito = Deposito::findOrFail($id);
    $deposito->feito = false;
    $deposito->save();

    return redirect()->back()->with('success', 'Depósito desfeito com sucesso.');
}

}
