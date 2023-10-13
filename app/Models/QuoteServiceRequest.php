<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteServiceRequest extends Model
{
    use HasFactory;

    const PAYMENT_COMPLETED = 1;
    const PAYMENT_PENDING = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'pickup',
        // 'delivery',
        // 'pickupDate',
        // 'deliveryDate',
        'id_alias',
        'location',
        'commodity',
        'dimension',
        'dateData',
        'selectLoad'
        // 'weight',
        // 'temperature',
        // 'equipment',
        // 'trailerSize',
        // 'comment',
        // 'status',
        // 'payment_status',
        // 'transaction_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['updated_at'];

    /**
     * Get the approved Quote associated with the requested Quote.
     */
    public function quote_approve()
    {
        return $this->hasOne(QuoteApprove::class, 'quote_id');
    }

    /**
     * Compare orginal model and modified Model
     */
                                        
    public function equals(QuoteServiceRequest $quoteReq)
    {
        return $this->id == $quoteReq->id &&
            // $this->pickup == $quoteReq->pickup &&

            // $this->delivery == $quoteReq->delivery &&
            // date('Y-m-d', strtotime($this->pickupDate)) == date('Y-m-d', strtotime($quoteReq->pickupDate)) &&
            // date('Y-m-d', strtotime($this->deliveryDate)) == date('Y-m-d', strtotime($quoteReq->deliveryDate)) &&
            $this->location == $quoteReq->location &&
            $this->commodity == $quoteReq->commodity &&
            $this->dimension == $quoteReq->dimension &&
            date('Y-m-d', strtotime($this->dateData)) == date('Y-m-d', strtotime($quoteReq->dateData)) &&
            $this->selectLoad ==$quoteReq->selectLoad;
            // $this->weight == $quoteReq->weight &&
            // $this->temperature == $quoteReq->temperature &&
            // $this->equipment == $quoteReq->equipment &&
            // $this->trailerSize == $quoteReq->trailerSize;
    }
}
