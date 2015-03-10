<?php

class ComKutafutaControllerBehaviorIndexable extends KControllerBehaviorAbstract
{
    public function _actionIndex(KCommandContext $context)
    {
        // We will get all the items of the database and resave them to index everything.
        set_time_limit(1440);

        $modelIdentifier = clone $context->caller->getIdentifier();
        $modelIdentifier->path = array('model');
        $modelIdentifier->name = KInflector::pluralize($modelIdentifier->name);

        $model = $this->getService($modelIdentifier);
        $items = $model->limit(0)->getList();

        foreach($items as $item)
        {
            $item->save();
        }

        JFactory::getApplication()->redirect(KRequest::referrer(), JText::_(ucfirst($modelIdentifier->name) . ' reindexed'));
    }
}