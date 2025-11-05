<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
    ];

    /**
     * Relasi ke model User
     * Satu item keranjang dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Book
     * Satu item keranjang mengacu pada satu buku.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
