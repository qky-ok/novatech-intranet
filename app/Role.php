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
     * Get the States for this Role that send an email
     */
    public function sendsMail(){
        return $this->belongsToMany('App\State', 'role_state_mail', 'role_id', 'state_id');
    }

    /**
     * Role State can send Email
     */
    public function canSendEmail($state_id){
        $can                = false;
        $roleCanSendEmails  = $this->sendsMail()->get();

        if(!empty($roleCanSendEmails)){
            foreach($roleCanSendEmails as $roleCanSendEmail){
                if($roleCanSendEmail->id == $state_id) $can = true;
            }
        }

        return $can;
    }

    /**
     * Sync Role's States that can send Email
     */
    public function syncSendEmail($states){
        $this->sendsMail()->detach();

        if(!empty($states)){
            foreach($states as $state_id){
                $this->sendsMail()->attach($state_id);
            }
        }
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

    /**
     * Sync Role's States
     */
    public function syncViewStates($states){
        $this->viewStates()->detach();

        if(!empty($states)){
            foreach($states as $state_id){
                $this->viewStates()->attach($state_id);
            }
        }
    }

    public function sendStateChangeEmal(){

    }
}
