<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use SoftDeletes;
    
    protected $table = 'produtos';

    protected $fillable = ['nome', 'descricao', 'categoria_id'];

    public function categoria()
    {
    	return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function fornecedores()
    {
    	return $this->belongsToMany(Fornecedor::class, 'fornecedores_produtos')->withPivot(['preco'])->withTimestamps();
    }
}
