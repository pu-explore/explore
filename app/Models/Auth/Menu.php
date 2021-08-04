<?php

namespace App\Models\Auth;

use App\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use SoftDeletes;

    protected $table = 'admin_menus';

    protected $fillable = [
        'group',
        'parent_id',
        'order',
        'title',
        'icon',
        'uri',
    ];
}
