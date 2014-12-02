<?php
/**
 * @package ImpressPages
 * @author Jonas Duri OYGO GmbH, Duesseldorf - Germany
 * @email jd@oygo.com
 *
 */
namespace Plugin\BootstrapJumbotron\Widget\BootstrapJumbotron;


class Controller extends \Ip\WidgetController
{
    public function defaultData()
    {
        return array('number' => 1);
    }

    public function getTitle()
    {
        return __('Bootstrap/Jumbotron', 'Ip-admin', false);
    }

    public function update($widgetId, $postData, $currentData)
    {
        $postData['blocks'] = $this->prepareData($widgetId, $currentData);
        $postData['number'] = $currentData['number'];
        return parent::update($widgetId, $postData, $currentData);
    }


    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        $blocks = $this->prepareData($widgetId, $data);
        $data['blocks'] = $blocks;
        $data['revisionId'] = $revisionId;
        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

    private function prepareData($widgetId, $data){
        if (isset($data['blocks']) && is_array($data['blocks'])){
            return $data['blocks'];
        }
        $blocks = array();
        for ($i = 1; $i <= $data['number']; $i++){
            $blocks[] = 'nested'.$widgetId.'_'.$i.'_';
        }
        return $blocks;
    }

    public function duplicate($oldId, $newId, $data){
        $data['blocks'] = $this->prepareData($oldId, $data);
        foreach ($data['blocks'] as $key => $block) {
            $data['blocks'][$key] = str_replace('nested' . $oldId, 'nested' . $newId, $block);
        }
        return $data;
    }
}

