<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model{
    /**
     * Get the Roles that can see this State
     */
    public function viewRoles(){
        return $this->belongsToMany('App\Role', 'role_view_state', 'state_id', 'role_id');
    }

    /**
     * Get the Role for this State that send an email
     */
    public function sendsMail(){
        return $this->belongsToMany('App\Role', 'role_state_mail', 'state_id', 'role_id');
    }
}
