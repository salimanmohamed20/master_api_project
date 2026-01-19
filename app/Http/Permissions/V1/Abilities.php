<?php

namespace App\Http\Permissions\V1;

use App\Models\User;



final class Abilities
{


    public const CreateTicket='ticket:create';
    public const CreateOwnTicket='ticket:create-own';
    public const UpdateTicket='ticket:update';
    public const DeleteTicket='ticket:delete';
    public const ViewTicket='ticket:view';
    public const ReplaceTicket='ticket:replace';
    public const UpdateOwnTicket='ticket:update-own';
    public const ViewOwnTicket='ticket:view-own';
    public const DeleteOwnTicket='ticket:delete-own';
public static function  getAbilities(User $user){


    if($user->isManager){
        return [
            self::CreateTicket,
            self::UpdateTicket,
            self::DeleteTicket,
            self::ViewTicket,
            self::ReplaceTicket,
        ];
    }else{
        return [
            self::UpdateOwnTicket,
            self::ViewOwnTicket,
            self::DeleteOwnTicket,
            self::CreateOwnTicket,
        ];
    }

}
}
