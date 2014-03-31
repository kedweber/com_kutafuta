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
                parse_str(parse_url($row->url, PHP_URL_QUERY), $data);

                $parts = explode('_', $data['option']);

                $data = KService::get('com://site/'.$parts[1].'.model.'.KInflector::pluralize($data['view']))->id($data['id'])->getItem();

                if(empty($data->id)) {
                    continue;
                }

                $result = new stdClass();
                $result->title = $data->title;
                $result->metadesc = $data->meta_description;
                $result->metakey = $data->meta_keywords;
                $result->created = $data->created_on;
                $result->text = $data->introtext . $data->fulltext;
                $result->href = $row->url;

                $rows[] = $result;
            }

            return $rows;
        }
	}
}