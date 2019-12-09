<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function users()
    {
        return $this
            ->belongsToMany('App\User')
            ->withTimestamps();
    }

    public function challenges()
    {
        return $this
            ->belongsToMany('App\Challenge')
            ->withTimestamps();
    }

   public function getClassroomChallenges($id){
        foreach ($this->challenges as $challenge){
            if($challenge->id===$id)
                return true;
        }
        return false;
    }

}
