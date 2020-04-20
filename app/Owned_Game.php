<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Owned_game extends Model
{
    protected $fillable =['name','score','owned_platform_id', 'art_url'];

    public function owned_platform(){
        return $this->belongsTo(Owned_platform::class);
    }

}
