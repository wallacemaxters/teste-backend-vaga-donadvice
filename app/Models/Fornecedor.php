<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{

    use SoftDeletes;
    
    protected $table = 'fornecedores';

    protected $fillable = ['cnpj', 'nome_fantasia', 'razao_social'];


    public function produtos()
    {
    	return $this->belongsToMany(Produto::class, 'fornecedores_produtos')->withPivot(['preco'])->withTimestamps();
    }

    public function endereco()
    {
        return $this->hasOne(FornecedorEndereco::class);
    }

    public function telefones()
    {
        return $this->hasMany(FornecedorTelefone::class);
    }
}
