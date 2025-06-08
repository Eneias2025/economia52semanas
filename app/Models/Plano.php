<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'meta',
        'user_id',
    ];

    /**
     * Relacionamento com os depósitos semanais.
     */
    public function depositos()
    {
        return $this->hasMany(Deposito::class);
    }

    /**
     * Relacionamento com o usuário criador do plano.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
