<?php

class ComKutafutaTemplateHelperSelect extends ComDefaultTemplateHelperSelect
{
    public function types($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'name' => 'type',
            'list' => array(
                array(
                    'title' => 'ALL_WORDS',
                    'value' => 'all'
                ),
                array(
                    'title' => 'ANY_WORDS',
                    'value' => 'any'
                ),
                array(
                    'title' => 'EXACT_WORDS',
                    'value' => 'exact'
                )
            ),
            'key' => 'value',
            'translate' => true
        ));

        return parent::radiolist($config);
    }
}