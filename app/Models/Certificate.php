<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table="certificates";
    protected $fillable=[
        'activity_detail_participant_id',
        'document',
        'tingkatan',
        'status',
        'sending',
        'document_hash',
        'file_id'
    ];
    protected $primaryKey = 'id';

    public function activity_detail_participant(){
        return $this->belongsTo(ActivityDetailParticipant::class);
    }

}
