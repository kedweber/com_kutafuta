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
		if($id = $this->_parseUrlData()) {
			$this->getService('com://admin/kutafuta.model.terms')->route_id($id)->getList()->delete();
		}
	}

	public function updateIndex(KCommandContext $context) {
		$filter = KService::get('koowa:filter.string');

		// Make sure everything is removed
		$this->_beforeTableDelete($context);

		// Saving the title.
		$this->getService('com://admin/kutafuta.database.row.term')->setData(array(
			'route_id' => $this->_parseUrlData(),
			'value' => $context->data->title,
			'lang' => substr(JFactory::getLanguage()->getTag(), 0, 2)
		))->save();

		// Saving the elements of elementable, only if the value is a string.
		if($context->data->isElementable()) {
			foreach($context->data->getElements() as $key => $value) {
				if($filter->validate(strip_tags($value->value)) && !empty($value->value)) {
					$this->getService('com://admin/kutafuta.database.row.term')->setData(array(
						'route_id' => $this->_parseUrlData(),
						'value' => strip_tags($value->value),
						'lang' => substr(JFactory::getLanguage()->getTag(), 0, 2)
					))->save();
				}
			}
		}
	}

	private function _parseUrlData() {
		$uri = JFactory::getURI();

        return $this->getService('com://admin/routes.model.routes')->query($uri->getQuery())->lang(substr(JFactory::getLanguage()->getTag(), 0, 2))->getItem()->id;
	}
}