<?php

class ComKutafutaTemplateHelperPaginator extends ComMoyoTemplateHelperPaginator
{
    protected function _bootstrap_link($page, $title, $attribs = array())
    {
        echo '<pre>';
        	print_r($page);
        echo '</pre>';
        die();

        $url   = clone KRequest::url();
        $query = $url->getQuery(true);

        //For compatibility with Joomla use limitstart instead of offset
        $query['limit']      = $page->limit;
        $query['limitstart'] = $page->offset;

        $url->setQuery($query);

        $html = '<a class="" href="'.$url.'"  data-query="'.http_build_query(array('limit' => $page->limit, 'offset' => $page->offset)).'">'.$this->translate($title).'</a>';

        return $html;
    }
}