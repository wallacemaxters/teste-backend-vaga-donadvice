<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FornecedorEndereco extends Model
{
    use SoftDeletes;
    
    protected $table = 'fornecedor_enderecos';

    protected $fillable = ['cep', 'logradouro', 'cidade', 'uf', 'bairro', 'complemento', 'numero', 'fornecedor_id'];

    public $timestamps = false;

    public function fornecedor()
    {
    	return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }
}
