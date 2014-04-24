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
            $elements = $this->getService('com://admin/cck.model.elements')
                ->cck_fieldset_id($item->cck_fieldset_id)
                ->getList();

            foreach($item->getData() as $key => $value) {
                $element = $elements->find(array('slug' => $key));

                if(!$element->count()) continue;

                if($element->type === 'Urls' || $element->type === 'Files') {
                    $item->$key = json_decode(json_encode($item->$key), true);
                }
            }

            $item->save();
        }

        JFactory::getApplication()->redirect(KRequest::referrer(), JText::_(ucfirst($modelIdentifier->name) . ' reindexed'));
    }
}