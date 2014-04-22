<?php

class ComKutafutaDatabaseRowTerm extends KDatabaseRowDefault
{
    public function getRelatedData()
    {
        parse_str($this->query, $data);
        $parts = explode('_', $data['option']);
        return $this->getService('com://site/'.$parts[1].'.model.'.KInflector::pluralize($data['view']))->id($data['id'])->getItem();
    }
}