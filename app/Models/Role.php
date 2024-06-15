<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MailerSend\Common\Permissions;

class Role extends Model
{
    use HasFactory;
    public function permisstion()
    {
        return $this->belongsToMany(Permissions::class);
    }
}
