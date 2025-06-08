<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plano;
use App\Models\Deposito;
use Carbon\Carbon;

class PlanoController extends Controller
{
    public function index()
    {
        $planos = Auth::user()->planos()->with('depositos')->get();
        return view('plano.index', compact('planos'));
    }

    public function create()
    {
        return view('plano.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'meta' => 'required|numeric|min:1',
        ]);

        $user = Auth::user();

        if ($user->planos()->count() >= 3) {
            return redirect()->route('plano.index')->with('error', 'Você já atingiu o limite de 3 planos.');
        }

        $meta = $request->meta;
        $nome = $request->nome;

        $plano = Plano::create([
            'user_id' => $user->id,
            'nome' => $nome,
            'meta' => $meta,
        ]);

        $totalSemanas = 52;
        $somaPesos = ($totalSemanas * ($totalSemanas + 1)) / 2;
        $dataInicial = Carbon::now();

        for ($semana = 1; $semana <= $totalSemanas; $semana++) {
            $peso = $semana;
            $valor = ($peso / $somaPesos) * $meta;

            Deposito::create([
                'plano_id' => $plano->id,
                'semana' => $semana,
                'valor' => round($valor, 2),
                'data' => $dataInicial->copy()->addWeeks($semana - 1),
                'feito' => false,
            ]);
        }

        return redirect()->route('plano.index')->with('success', 'Plano criado com sucesso!');
    }

    public function destroy(Plano $plano)
    {
        if ($plano->user_id !== Auth::id()) {
            return redirect()->route('plano.index')->with('error', 'Ação não autorizada.');
        }

        $plano->depositos()->delete();
        $plano->delete();

        return redirect()->route('plano.index')->with('success', 'Plano excluído com sucesso.');
    }
}