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
		if($id = $this->_parseUrlData($context->data)) {
			$this->getService('com://admin/kutafuta.model.terms')->route_id($id)->getList()->delete();
		}
	}

	public function updateIndex(KCommandContext $context) {
		$filter = KService::get('koowa:filter.string');

		// Make sure everything is removed
		$this->_beforeTableDelete($context);

        $route_id = $this->_parseUrlData($context->data);

		// Saving the title.
		$this->getService('com://admin/kutafuta.database.row.term')->setData(array(
			'route_id' => $route_id,
			'value' => $context->data->title,
			'lang' => substr(JFactory::getLanguage()->getTag(), 0, 2)
		))->save();

		// Saving the elements of elementable, only if the value is a string.
		if($context->data->isElementable()) {
			foreach($context->data->getElements() as $key => $value) {
				if($filter->validate(strip_tags($value->value)) && !empty($value->value)) {
					$this->getService('com://admin/kutafuta.database.row.term')->setData(array(
						'route_id' => $route_id,
						'value' => strip_tags($value->value),
						'lang' => substr(JFactory::getLanguage()->getTag(), 0, 2)
					))->save();
				}
			}
		}
	}

	private function _parseUrlData($data) {
		$identifier = $data->getIdentifier();

        return $this->getService('com://admin/routes.model.routes')->query('option=com_' . $identifier->package . '&view=' . $identifier->name . '&id=' . $data->id)->lang(substr(JFactory::getLanguage()->getTag(), 0, 2))->getItem()->id;
	}
}