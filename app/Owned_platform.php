<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Owned_platform extends Model
{
    protected $fillable =['name'];

    public function games(){
        return $this->hasMany(Owned_game::class);
    }

}
