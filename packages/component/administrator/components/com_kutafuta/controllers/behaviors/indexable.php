<?php

class ComKutafutaControllerBehaviorIndexable extends KControllerBehaviorAbstract
{
    public function _actionIndex(KCommandContext $context)
    {
        // We will get all the items of the database and resave them to index everything.
        set_time_limit(1440);

        $modelIdentifier = clone $context->caller->getIdentifier();
        $modelIdentifier->path = array('model');

        $model = $this->getService($modelIdentifier);
        $items = $model->limit(0)->getList();

        foreach($items as $item)
        {
            // Security Check for files and urls
            if(!empty($item->urls)) {
                $item->urls = json_decode(json_encode($item->urls), true);
            }

            if(!empty($item->files)) {
                $item->files = json_decode(json_encode($item->files), true);
            }

            $item->save();
        }


        JFactory::getApplication()->redirect(KRequest::referrer(), JText::_(count($items) . ' items are reindexed'));
    }
}