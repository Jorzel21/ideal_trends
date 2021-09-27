<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class PedidoProduto extends Model
{
    use HasFactory, Sortable;

    protected $table = 'pedidos_produtos';

    public $sortable = ['id', 'pedido_id'];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id');
    }
}
