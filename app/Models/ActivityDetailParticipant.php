<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDetailParticipant extends Model
{
    use HasFactory;
    protected $table="activity_detail_participants";
    protected $fillable=[
        'id',
        'user_id',
        'activity_id',
        'status',
    ];

    public function certificates(){
        return $this->hasMany(Certificate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function activity(){
        return $this->belongsTo(Activity::class);
    }

}
