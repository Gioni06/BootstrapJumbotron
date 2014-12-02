<?php

namespace Plugin\BootstrapJumbotron;


class Event {
    public static function ipWidgetDuplicated($data){
        $oldId = $data['oldWidgetId'];
        $newId = $data['newWidgetId'];
        $newRevisionId = ipDb()->selectValue('widget', 'revisionId', array('id' => $newId));
        $widgetTable = ipTable('widget');
        $sql = "
            UPDATE
                $widgetTable
            SET
                `blockName` = REPLACE(`blockName`, 'nested" . (int)$oldId . "_', 'nested" . (int)$newId . "_')
            WHERE
                `revisionId` = :newRevisionId
            ";
        ipDb()->execute($sql, array('newRevisionId' => $newRevisionId));
    }

}