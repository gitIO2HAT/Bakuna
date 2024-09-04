<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $table = "vouchers";

    /**
     * apply the fillable fields
     * 
     */
    protected $fillable = [
        'voucher_type_id',
        'infant_id',
        'voucher_code',
        'is_reedeemable',
        'is_redeemed',
        'redeemed_at',
        'created_at',
        'updated_at'
    ];
    
    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class);
    }

    public function infant()
    {
        return $this->belongsTo(Infant::class, 'infant_id', 'id');
    }

    use HasFactory;
}
