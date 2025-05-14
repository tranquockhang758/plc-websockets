<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Nếu tên bảng không theo chuẩn (không phải dạng số nhiều), bạn có thể khai báo:
    // protected $table = 'messages';

    /**
     * Các cột có thể gán hàng loạt (Mass Assignment)
     */
    protected $fillable = [
        'sender_id',
        'message',
        'is_read',
    ];

    /**
     * Ép kiểu (cast) dữ liệu
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Quan hệ: Tin nhắn thuộc về người gửi
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Quan hệ: Tin nhắn thuộc về người nhận
     */
    // public function receiver()
    // {
    //     return $this->belongsTo(User::class, 'receiver_id');
    // }
}
