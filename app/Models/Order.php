<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'alamat',
        'nomor_telepon',
        'metode_pembayaran',
        'total_harga',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}