<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table="documents";
    protected $fillable=[
        'document',
        'activity_id',
        'title',
        'message',
        'status',
        'document_hash',
        'file_id'
    ];

    public function signers(){
        return $this->hasMany('App\Models\Signer');
    }

    public function activity(){
        return $this->belongsTo(Activity::class);
    }

    

}
