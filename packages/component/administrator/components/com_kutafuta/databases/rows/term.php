<?php

class ComKutafutaDatabaseRowTerm extends KDatabaseRowDefault
{
    public function getRelatedData()
    {
        $parts = explode('_', $this->table);

        return $this->getService('com://site/' . $parts[0] . '.model.' . $parts[1])->id($this->row)->getItem();
    }

    public function getUrl()
    {
        $parts = explode('_', $this->table);
        $parts[1] = KInflector::singularize($parts[1]);

        return 'index.php?option=com_' . $parts[0] . '&view=' . $parts[1] . '&id=' . $this->row;
    }
}