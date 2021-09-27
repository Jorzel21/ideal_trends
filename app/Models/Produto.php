<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Produto extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id', 'nome', 'descricao', 'codBarras', 'valor'];
}
