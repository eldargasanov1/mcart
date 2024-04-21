<?php

use Bitrix\Main\EventManager;

EventManager::getInstance()->AddEventHandler("main", "OnAfterUserRegister", Array("RegisterEventsHandler", "AfterUserRegister"));

class RegisterEventsHandler
{
    /**
     * @param array $arFields
     * @return void
     */
    public static function AfterUserRegister(array &$arFields): void
    {
        global $USER;

        $sellersGroupId = 7;
        $buyersGroupId = 6;

        $userGroupId = $arFields["UF_CURRENT_USER_ROLE"] == 5 ? $sellersGroupId : $buyersGroupId;
        if($arFields["USER_ID"]>0) {
            $USER->SetUserGroup($arFields["USER_ID"], [$userGroupId]);
        }
    }
}
