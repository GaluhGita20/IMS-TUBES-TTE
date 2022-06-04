<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signer extends Model
{
    use HasFactory;
    protected $table="signers";
    protected $fillable=[
        'document_id',
        'name',
        'email',
    ];

    public function document(){
        return $this->belongsTo('App\Models\Document', 'document_id');
    }
}
