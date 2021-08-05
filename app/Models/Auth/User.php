<?php

namespace App\Models\Auth;

use App\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use DefaultDatetimeFormat;
    use SoftDeletes;

    protected $table = 'admin_users';

    protected $fillable = [
        'username',
        'password',
        'name',
        'avatar',
        'permissions',
    ];

    protected $casts = [
        'permissions'  => 'array'
    ];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'admin_role_users', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * 获取头像
     *
     * @param $avatar
     * @return string
     */
    public function getAvatarAttribute($avatar): string
    {
        if (url()->isValidUrl($avatar)) {
            return $avatar;
        }

        $disk = config('admin.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk($disk)->url($avatar);
        }

        $default = config('admin.default_avatar') ?: '/img/user2-160x160.jpg';

        return asset($default);
    }
}
