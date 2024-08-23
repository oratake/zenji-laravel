<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Danka extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bouzu_id');
    }

    public static function isLoginBouzu($bouzu_id) : bool
    {
        return $bouzu_id === Auth::id();
    }

    public static function hasNoContactInfo($danka_info) : bool
    {
        return $danka_info['email'] === null && $danka_info['phone_number'] === null;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'family_head_last_name',
        'family_head_first_name',
        'family_head_last_name_kana',
        'family_head_first_name_kana',
        'email',
        'postcode',
        'address',
        'phone_number',
        'note',
        'bouzu_id',
    ];
}
