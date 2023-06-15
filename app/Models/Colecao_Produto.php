<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colecao_Produto extends Model
{
    use HasFactory;
    protected $fillable = ['colecao_id', 'produto_id'];
    protected $table = 'colecoes_produtos';

    public function colecao()
    {
        return $this->belongsTo(Colecao::class);
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
