<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteApprove extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quote_id',
        'cost',
        'fee',
        'total_cost',
        'company_comment',
        'company_name',
        'company_address',
        'reject_reason',
        'old_cost',
        'old_fee',
        'old_total_cost',
        'old_company_comment',
        'old_reject_reason',
        'del_reason'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['id', 'created_at'];

    /**
     * Get the quote that owns the approved quote.
     */
    public function quote_request()
    {
        return $this->belongsTo(QuoteRequest::class, 'quote_id');
    }
}
