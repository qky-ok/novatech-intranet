<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\UserAdmin;
use App\UserWeb;
use App\UserCall;
use App\UserCas;
use App\UserDeposito;
use App\UserCompras;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    public function getUserRoleId(){
        return $this->roles()->first()->id;
    }

    public function getExtendedData(){
        $id_role        = $this->getUserRoleId();
        $extendedUser   = '';

        switch($id_role){
            case 1:
                $extendedUser = UserAdmin::where('id', $this->id)->first();
            break;
            case 2:
                $extendedUser = UserWeb::where('id', $this->id)->first();
            break;
            case 3:
                $extendedUser = UserCall::where('id', $this->id)->first();
            break;
            case 4:
                $extendedUser = UserCas::where('id', $this->id)->first();
            break;
            case 5:
                $extendedUser = UserDeposito::where('id', $this->id)->first();
            break;
            case 6:
                $extendedUser = UserCompras::where('id', $this->id)->first();
            break;
            default:
                $extendedUser = UserWeb::where('id', $this->id)->first();
        }

        return $extendedUser;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
