<?php

class ComKutafutaViewTermsHtml extends KViewHtml
{
    public function display()
    {
        $model = clone $this->getModel();
        $model->limit(0);

        $this->assign('totalCount', $model->getList()->count());

        return parent::display();
    }
}