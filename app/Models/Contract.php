<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
        'house_id','establishment','deadline','last_pay','pay_duration','type'
    ];

}
