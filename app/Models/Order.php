<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 0;
    const STATUS_WAIT = 1;
    const STATUS_SEND = 2;
    const STATUS_CANCELED = 3;
    const STATUS_DELIVERED = 4;
    const PAYMENT_ERROR = 5;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'address',
        'extern_cards',
        'transaction_id',
        'status',
    ];

    public static function status()
    {
        return [
            self::STATUS_NEW => __('New'),
            self::STATUS_WAIT => __('Awaiting dispatch'),
            self::STATUS_SEND => __('Send'),
            self::STATUS_DELIVERED => __('Delivered'),
            self::STATUS_CANCELED => __('Canceled'),
            self::PAYMENT_ERROR => __('Payment error'),
        ];
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        $status = $this->getAttribute('status');
        return static::status()[$status] ?? null;
    }
}
