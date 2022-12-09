<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use PhpJunior\LaravelGlobalSearch\Traits\GlobalSearchable;
use Laravel\Nova\Actions\Actionable;
use App\Traits\UserTrait;
use App\Traits\TimestampTrait;
use App\Traits\FileTrait;
use App\Traits\CaptionTrait;
use App\Traits\DemoTrait;
use App\Traits\OrderTrait;
use App\Traits\FilterTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use Actionable;
    use Notifiable;
    use GlobalSearchable;
    use UserTrait;
    use TimestampTrait;
    use FileTrait;
    use CaptionTrait;
    use DemoTrait;
    use OrderTrait;
    use FilterTrait;

    const GENDER_NOT_SET = null;
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    const STATUS_BLOCKED = -1;
    const STATUS_NEW = 0;
    const STATUS_VERIFIED = 1;

    /**
     * @var string
     */
    public static $title = 'username';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'country_id',
        'zip',
        'city',
        'address',
        'phone',
        'birthday',
        'gender',
        'status',
        'from_created_at',
        'to_created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'country_id' => 'integer',
        'birthday' => 'date',
        'status' => 'integer',
        'last_login_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'gender' => 'integer',
        'from_created_at' => 'from_date',
        'to_created_at' => 'to_date',
    ];

    /**
     * @var array
     */
    protected $files = [
        'avatar' => 'image',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'status' => self::STATUS_NEW,
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
        'username',
        'email',
        'first_name',
        'last_name',
        'zip',
        'city',
        'address',
        'phone',
    ];

    /**
     * @var string[]
     */
    protected $only = [
        'username',
        'id',
    ];

    /**
     * @return array
     */
    public static function genders()
    {
        return [
            self::GENDER_NOT_SET => __('Not Set'),
            self::GENDER_MALE => __('Male'),
            self::GENDER_FEMALE => __('Female'),
        ];
    }

    /**
     * @return array
     */
    public static function statuses()
    {
        return [
            self::STATUS_BLOCKED => __('Blocked'),
            self::STATUS_NEW => __('New'),
            self::STATUS_VERIFIED => __('Verified'),
        ];
    }

    /**
     * @return array
     */
    public static function statusBadgeClasses()
    {
        return [
            self::STATUS_BLOCKED => 'danger',
            self::STATUS_NEW => 'warning',
            self::STATUS_VERIFIED => 'success',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(Setting::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageCategories()
    {
        return $this->hasMany(PageCategory::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus()
    {
        return $this->hasMany(Menu::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function snippets()
    {
        return $this->hasMany(Snippet::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqCategories()
    {
        return $this->hasMany(FaqCategory::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function faqItems()
    {
        return $this->hasMany(FaqItem::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mediaCategories()
    {
        return $this->hasMany(MediaCategory::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mediaFiles()
    {
        return $this->hasMany(MediaFile::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotes()
    {
        return $this->hasMany(Quote::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sliders()
    {
        return $this->hasMany(Slider::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addedRoles()
    {
        return $this->hasMany(Role::class, 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * return void
     */
    public function getRolesTextAttribute()
    {
        return implode(', ', $this->roles->pluck('name')->toArray());
    }

    /**
     * return void
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(Role::ROLE_SUPER_ADMIN);
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles->where('name', $role)->first();
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    /**
     * @param $permission
     * @return mixed
     */
    public function hasPermission($permission)
    {
        return $this->permissions()->contains($permission);
    }

    /**
     * @param $query
     * @param $status
     * @return mixed
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @param $parentId
     * @return mixed
     */
    public function scopeOfRole($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @return mixed
     */
    public function getGenderTextAttribute()
    {
        return $this::genders()[$this->gender] ?? null;
    }

    /**
     * @return mixed
     */
    public function getStatusTextAttribute()
    {
        return $this::statuses()[$this->status] ?? null;
    }

    /**
     * @return mixed
     */
    public function getStatusBadgeClassAttribute()
    {
        return static::statusBadgeClasses()[$this->status] ?? null;
    }

    /**
     * @param $password
     * @return mixed
     * @throws \Exception
     */
    public function savePassword($password)
    {
        $this->password = Hash::make($password);

        return $this->save();
    }

    /**
     * @throws \Exception
     */
    public function updateLastLogin()
    {
        $this->last_login_at = Carbon::now();
        $this->save();
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

    /**
     * @param $roleName
     * @return mixed
     */
    public static function roleRecords($roleName)
    {
        $role = Role::where('name', $roleName)
            ->firstOrFail();

        return $role->users;
    }
}
