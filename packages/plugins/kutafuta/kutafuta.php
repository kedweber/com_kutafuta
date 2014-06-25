<?php

defined('_JEXEC') or die;

class PlgSearchKutafuta extends JPlugin
{
	public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
	{
        if($text) {
            $rows = array();

            $rowset = KService::get('com://admin/kutafuta.model.terms')->search($text)->getList();

            foreach($rowset as $row) {
                // We have table and row.
                // Row is always multiple but we check non the less.
                $parts = explode('_', $row->table);
                $data = KService::get('com://site/'.$parts[0].'.model.'.KInflector::pluralize($parts[1]))->id($row->row)->getItem();

                if(empty($data->id)) {
                    continue;
                }

                $result = new stdClass();
                $result->title = $data->title;
                $result->metadesc = $data->meta_description;
                $result->metakey = $data->meta_keywords;
                $result->created = $data->created_on;
                $result->text = $data->introtext . $data->fulltext;
                $result->href = 'index.php?option=com_' . $parts[0] . '&view=' . KInflector::singularize($parts[1]) . '&id=' . $row->row;

                $rows[] = $result;
            }

            return $rows;
        }
	}
}