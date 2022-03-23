<?php

namespace App\Service\Permissions;

trait User
{
    protected function getUserRoles($user)
    {
        $roles = $this->security->getUser()->getRoles();
        return $roles;
    }

    public function getNameofRole($role)
    {
        $name = "";
        switch($role) {
            case "ROLE_WORKER": 
                $name = "Pracownik biura";
            break;
            case "ROLE_SUPERVISOR":
                $name = "Dyrektor biura";
            break;
            case "ROLE_MANAGER":  
                $name = "Dyrektor BPB";
            break;
            case "ROLE_ADMIN":
                $name = "Administrator";
            break;
            case "ROLE_SUPER_ADMIN":
                $name = "Super Administrator";
            break;
        }
        
        return $name;
    }

    public function getStringOfActivity($status)
    {
        $str = "";

        if($status == 1) {
            $str = "Aktywny";
        }
        else {
            $str = "Nieaktywny";
        }
        
        return $str;
    }
}