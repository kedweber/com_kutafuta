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
                    $pattern = '/(' . $word . ')/i';
                    $replace = $config->highlight_start . '${1}' . $config->highlight_end;

                    $config->text = preg_replace($pattern, $replace, $config->text);
                }
                break;
            case 'exact':
                $pattern = '/(' . $config->term . ')/i';
                $replace = $config->highlight_start . '${1}' . $config->highlight_end;

                $config->text = preg_replace($pattern, $replace, $config->text);
                break;
        }

        return $config->text;
    }
}