<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colecao extends Model

{
    use HasFactory;
    protected $fillable = ['user_id', 'nome', 'descricao'];
    protected $table = 'colecoes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
