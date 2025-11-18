<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'primary_goal',
        'company_name',
        'industry',
        'team_size',
        'feedback',
        'discovery_method'
    ];
}
