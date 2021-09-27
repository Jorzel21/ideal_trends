<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
class Cliente extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id', 'nome', 'cpf', 'email', 'nascimento'];
}
