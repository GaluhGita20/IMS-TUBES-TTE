<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table="activities";
    protected $fillable=[
        'id',
        'name',
        'desc',
        'start',
        'end',
        'admin_id',
        'status',
    ];
    protected $primaryKey = 'id';

    public function activity_detail_participants(){
        return $this->hasMany('App\Models\ActivityDetailParticipant');
    }

    public function documents(){
        return $this->hasMany('App\Models\Document');
    }
}
