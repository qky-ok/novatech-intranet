<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceAlarm extends Model{
    protected $table = 'service_alarm';

    public function roles(){
        $alarm_users    = $this->alarm_users;
        $roles          = [];

        if(!empty($alarm_users)){
            $alarm_users = (strpos($alarm_users, '|') !== false) ? explode('|', $alarm_users) : [$alarm_users];

            foreach($alarm_users as $alarm_user){
                $roles[] = Role::findOrFail($alarm_user);
            }
        }

        return $roles;
    }
}
