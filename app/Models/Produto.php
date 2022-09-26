<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public $table = 'produtos';

    public $fillable = [
        'nome',
        'codigo'
    ];

    protected $casts = [
        'nome' => 'string',
        'codigo' => 'string'
    ];

    public static $rules = [
        'nome' => 'required|string',
        'codigo' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function categorias(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Categoria::class, 'produto_id');
    }
}
