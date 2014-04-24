<?php

class ComKutafutaDatabaseBehaviorSearchable extends KDatabaseBehaviorAbstract
{
	public function _afterTableInsert(KCommandContext $context) {
		$this->updateIndex($context);
	}

	public function _afterTableUpdate(KCommandContext $context) {
		$this->updateIndex($context);
	}

	public function _beforeTableDelete(KCommandContext $context) {
        $table  = $context->data->getTable()->getName();
        $row    = $context->data->id;

        // Remove the existing rows from the table.
        $this->getService('com://admin/kutafuta.model.terms')->table($table)->row($row)->getList()->delete();
	}

	public function updateIndex(KCommandContext $context) {
		$filter = KService::get('koowa:filter.string');
        $table  = $context->data->getTable()->getName();
        $row    = $context->data->id;

        $this->_beforeTableDelete($context);

        if($context->data->enabled) {
            if($context->data->isTranslatable()) {
                if(!$context->data->translated) {
                    return;
                }
            }

            // Saving the title.
            $this->getService('com://admin/kutafuta.database.row.term')->setData(array(
                'table' => $table,
                'row'   => $row,
                'value' => $context->data->title,
                'lang'  => substr(JFactory::getLanguage()->getTag(), 0, 2)
            ))->save();

            // Saving the elements of elementable, only if the value is a string.
            if($context->data->isElementable())
            {
                foreach($context->data->getElements() as $key => $value)
                {
                    if($filter->validate(strip_tags($value->value)) && !empty($value->value))
                    {
                        $this->getService('com://admin/kutafuta.database.row.term')->setData(array(
                            'table' => $table,
                            'row'   => $row,
                            'value' => trim(strip_tags($value->value)),
                            'lang'  => substr(JFactory::getLanguage()->getTag(), 0, 2)
                        ))->save();
                    }
                }
            }
        }
	}
}