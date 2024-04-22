<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\Entity\Event;

EventManager::getInstance()->AddEventHandler("main", "OnAdd", Array("HBEventsHandler", "clearCache"));
EventManager::getInstance()->AddEventHandler("main", "OnUpdate", Array("HBEventsHandler", "clearCache"));
EventManager::getInstance()->AddEventHandler("main", "OnDelete", Array("HBEventsHandler", "clearCache"));

class HBEventsHandler
{
    /**
     * @param array $arFields
     * @return void
     */
    public static function clearCache(Event $event): void
    {
        $entity = $event->getEntity();
        $tableName = $entity->getDBTableName();

        $taggedCache = Application::getInstance()->getTaggedCache();
        $taggedCache->clearByTag('hlblock_table_name_' . $tableName);
    }
}
