<?php

class ComKutafutaTemplateHelperHighlight extends KTemplateHelperAbstract
{
    /**
     * This function will highlight the search term in kutafuta.
     * The behavior is exactly the same as in the Joomla search.
     * 
     * @param array $config
     * @return String The text with the search term highlighted.
     */
    public function match($config = array())
    {
        $config = new KConfig($config);
        $config->append(array(
            'text'              => '',
            'term'              => '',
            'type'              => '',
            'highlight_start'   => '<span class="highlight">',
            'highlight_end'     => '</span>'
        ));
        
        switch($config->type) {
            case 'all':
            case 'any':
                $words = explode(' ', $config->term);

                foreach($words as $word)
                {
                    $config->text = str_replace($word, $config->highlight_start . $word . $config->highlight_end, $config->text);
                }
                break;
            case 'exact':
                $config->text = str_replace($config->term, $config->highlight_start . $config->term . $config->highlight_end, $config->text);
                break;
        }
        
        return $config->text;
    }
}