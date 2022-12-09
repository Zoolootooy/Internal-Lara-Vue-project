<?php

namespace App\Models;

class Mail extends BaseModel
{
    /**
     * @var string
     */
    public static $title = 'subject';

    /**
     * @var array
     */
    protected $fillable = [
        'sender_email',
        'sender_name',
        'subject',
        'body',
        'opened',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'opened' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'opened' => false,
    ];

    /**
     * @var array
     */
    protected $order = [
        'created_at' => 'desc'
    ];

    /**
     * @var array
     */
    protected $search = [
        'id',
        'sender_email',
        'sender_name',
        'subject',
        'body',
    ];

    /**
     * @var string[]
     */
    protected $only = [
        'subject',
        'id',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNew($query)
    {
        return $query->where('opened', false);
    }
}
