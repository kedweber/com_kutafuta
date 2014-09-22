<? defined('KOOWA') or die('Restricted Access'); ?>

<div class="com_search">
    <form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_kutafuta&view=terms');?>" method="get">
        <div class="input-group">
            <input type="text" name="search" placeholder="<?php echo JText::_('Keyword'); ?>" id="search-searchword" value="<?= @escape($state->search); ?>" class="form-control" />
            <span name="Search" onclick="getElementById('searchForm').submit()" class="btn hasTooltip input-group-addon" title="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?>">
                <span class="icon-search"></span>
            </span>
        </div>
    </form>

    <? if($state->search && strlen($state->search) > 3 && count($terms) > 0) : ?>
        <ul class="results" id="container">
            <? foreach($terms as $result) : ?>
                <li>
                    <a href="<?= JRoute::_($result->getUrl()); ?>"><?= $result->getRelatedData()->title; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
    <? elseif($state->search && strlen($state->search) <= 3) : ?>
        <p>
            <?= @text('AT_LEAST_4_CHARACTERS'); ?>
        </p>
    <? elseif(count($terms) <= 0) : ?>
        <p>
            <?= @text('NO_MATCHES_FOUND'); ?>
        </p>
    <? elseif(!$state->search) : ?>
        <p>
            <?= @text('EMPTY_SEARCH_STRING'); ?>
        </p>
    <? endif; ?>

    <? if ($total > $terms->count() && $state->search && strlen($state->search) > 3) : ?>
        <?
        $test = $state->getData();
        unset($test['limit']);
        unset($test['offset']);
        $params = http_build_query($test);
        ?>

        <footer>
            <?= @helper('com://site/moyo.template.helper.paginator.pagination', array('total' => $totalCount, 'ajax' => true, 'limit' => $state->limit, 'url' => @route('option=com_kutafuta&view=terms&'.$params.'&layout=results&format=raw'), 'height' => 200)); ?>
        </footer>
    <? endif; ?>
</div>