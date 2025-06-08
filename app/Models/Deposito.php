<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;

    protected $fillable = [
        'plano_id',
        'semana',
        'valor',
        'data',
        'feito',
    ];

    protected $casts = [
        'data' => 'date',
        'feito' => 'boolean',
    ];

    /**
     * Relacionamento com o plano ao qual pertence o depósito.
     */
    public function plano()
    {
        return $this->belongsTo(Plano::class);
    }
}
