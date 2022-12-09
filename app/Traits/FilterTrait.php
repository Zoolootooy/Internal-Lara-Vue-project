<?php
namespace App\Traits;

use Schema;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait FilterTrait
{
    /**
     * @var array
     */
    protected static $prefixes = [
        'from_',
        'to_',
    ];

    /**
     * @var string
     */
    protected static $sessionModel = 'filterModel';

    /**
     * @var string
     */
    protected static $sessionFilters = 'filters';

    /**
     * @var string
     */
    protected static $sessionClear = 'clear';

    /**
     * @param $query
     * @return mixed
     */
    public function scopeFilter($query)
    {
        $where = [];
        $filters = $this->getFilters();

        foreach ($filters as $filed => $value) {
            if (isset($value) && $this->hasColumn($filed)) {
                $type = $this->columnType($filed);
                $filed = $this->filedWithoutPrefix($filed);
                switch ($type) {
                    case 'string':
                        $where[] = [$filed, 'like', '%' . $value . '%'];
                        break;
                    case 'boolean':
                    case 'integer':
                        $where[$filed] = (int) $value;
                        break;
                    case 'float':
                        $where[$filed] = (float) $value;
                        break;
                    case 'date':
                    case 'datetime':
                        $where[$filed] = $value;
                        break;
                    case 'from_date':
                        $where[] = [$filed, '>=', $value];
                        break;
                    case 'to_date':
                        $where[] = [$filed, '<', Carbon::parse($value)->addDay()];
                        break;
                }
            }
        }

        return $query->where($where);
    }

    /**
     * return null
     */
    public function resetFilters()
    {
        $modelName = $this->modelName();
        $mustClear = (bool) request(static::$sessionClear);

        if ($modelName != session(static::$sessionModel) || $mustClear) {
            session([static::$sessionModel => $modelName]);
            session([static::$sessionFilters => []]);
        }
    }

    /**
     * return null
     */
    public function setupFilters()
    {
        $filters = request()->all();

        if (count($filters) > 0) {
            session([static::$sessionFilters => $filters]);
        }
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public function getFilters()
    {
        $this->resetFilters();
        $this->setupFilters();

        return session(static::$sessionFilters, []);
    }

    /**
     * @param $filed
     * @return mixed
     */
    private function hasColumn($filed)
    {
        $filed = $this->filedWithoutPrefix($filed);

        return Schema::hasColumn($this->getTable(), $filed);
    }

    /**
     * @param $filed
     * @return string
     */
    private function columnType($filed)
    {
        return $this->casts[$filed] ?? 'string';
    }

    /**
     * @param $filed
     * @return string
     */
    private function filedWithoutPrefix($filed)
    {
        if (Str::startsWith($filed, static::$prefixes)) {
            $filed = Str::after($filed, '_');
        }

        return $filed;
    }

    /**
     * @return string
     */
    private function modelName()
    {
        return Str::ucfirst(class_basename($this));
    }
}