<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Repositories\BaseRepository;

class ProdutoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nome',
        'codigo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Produto::class;
    }
}
