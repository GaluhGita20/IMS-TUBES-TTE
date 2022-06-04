<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table="templates";
    protected $fillable=[
        'file',
        'status_trigger',
        'activity_id',
        'status_template'
    ];
    protected $primaryKey = 'id';
}
