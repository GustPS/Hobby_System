<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    use HasFactory;
    protected $fillable = ['colecao_id', 'nome', 'descricao'];

    public function colecao()
    {
        return $this->belongsTo(Colecao::class);
    }
}
