<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;
use PhpJunior\LaravelGlobalSearch\Traits\GlobalSearchable;
use App\Traits\TimestampTrait;
use App\Traits\BooleanTrait;
use App\Traits\FileTrait;
use App\Traits\CaptionTrait;
use App\Traits\DemoTrait;
use App\Traits\OrderTrait;
use App\Traits\FilterTrait;

abstract class BaseModel extends Model
{
    use Actionable;
    use GlobalSearchable;
    use TimestampTrait;
    use BooleanTrait;
    use DemoTrait;
    use FileTrait;
    use CaptionTrait;
    use OrderTrait;
    use FilterTrait;

    /**
     * @var string
     */
    public static $title = 'name';

    /**
     * @var array
     */
    protected $order = [
        'created_at' => 'asc',
        'id' => 'asc',
    ];

    /**
     * @var string[]
     */
    protected $only = [
        'name',
        'id',
    ];

    /**
     * @return mixed
     */
    public function getEntryTitleAttribute()
    {
        return $this->getAttribute(static::$title);
    }

    /**
     * @return array
     */
    public static function list()
    {
        return static::defaultOrder()->pluck(static::$title, 'id')->toArray();
    }

    /**
     * @return array
     */
    public static function flippedList()
    {
        return array_flip(static::list());
    }
}
