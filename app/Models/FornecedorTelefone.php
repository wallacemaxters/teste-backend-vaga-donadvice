<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FornecedorTelefone extends Model
{
    use SoftDeletes;
    
    protected $table = 'fornecedor_telefones';

    protected $fillable = ['ddd', 'numero'];

    public $timestamps = false;

    public function fornecedor()
    {
    	return $this->belongsTo(Fornecedor::class, 'fornecedor_id');
    }
}
