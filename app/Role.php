<?php

namespace App;

class Role extends \Spatie\Permission\Models\Role
{
    /**
     * Get the States that this Role can see
     */
    public function viewStates(){
        return $this->belongsToMany('App\State', 'role_view_state', 'role_id', 'state_id');
    }

    /**
     * Role can see State
     */
    public function canViewState($state_id){
        $can            = false;
        $roleViewStates = $this->viewStates()->get();

        if(!empty($roleViewStates)){
            foreach($roleViewStates as $roleViewState){
                if($roleViewState->id == $state_id) $can = true;
            }
        }

        return $can;
    }

    public function syncViewStates($states){
        $this->viewStates()->detach();

        if(!empty($states)){
            foreach($states as $state_id){
                $this->viewStates()->attach($state_id);
            }
        }
    }
}
