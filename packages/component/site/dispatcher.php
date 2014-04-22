<?php

class ComKutafutaDispatcher extends ComDefaultDispatcher
{
    public function _initialize(KConfig $config)
    {
        $config->append(array(
            'controller' => 'terms'
        ));

        parent::_initialize($config);
    }
}