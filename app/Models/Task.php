<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    /* ---------- Mass-assignment ---------- */
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    /* ---------- Default attributes ---------- */
    protected $attributes = [
        'status' => 'Pending',   // DB-এর ডিফল্টের সাথে মিলিয়ে
    ];

    /* ---------- Casts ---------- */
    protected $casts = [
        'status' => 'string',    // enum(Pending|Completed) – স্ট্রিং হিসেবেই রিটার্ন
    ];

    /* ---------- Relationships ---------- */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);   // প্রত্যেক টাস্ক একটি ইউজারের
    }

    /* ---------- Query Scope (ঐচ্ছিক) ---------- */
    public function scopeOwnedBy($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}
