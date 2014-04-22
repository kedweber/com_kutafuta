<? defined('KOOWA') or die('Restricted Access'); ?>

<div class="com_search">
    <form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">
        <div class="input-group">
            <input type="text" name="searchword" placeholder="<?php echo JText::_('Keyword'); ?>" id="search-searchword" value="<?= @escape($state->search); ?>" class="form-control" />
            <span name="Search" onclick="getElementById('searchForm').submit()" class="btn hasTooltip input-group-addon" title="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?>">
                <span class="icon-search"></span>
            </span>
        </div>

        <input type="hidden" name="task" value="search" />
    </form>

    <ul class="results" id="container">
        <? foreach($terms as $result) : ?>
            <li>
                <a href="<?php echo $result->href; ?>"><?php echo $result->getRelatedData()->title; ?></a>
            </li>
        <? endforeach; ?>
    </ul>

    <? if ($total > $terms->count()) : ?>
        <?
        $test = $state->getData();
        unset($test['limit']);
        unset($test['offset']);
        $params = http_build_query($test);
        ?>
        <footer>
            <?= @helper('com://site/moyo.template.helper.paginator.pagination', array('total' => $total, 'limit' => $state->limit)); ?>
        </footer>
    <? endif; ?>
</div>