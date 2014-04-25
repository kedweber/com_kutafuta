<? defined('KOOWA') or die('Restricted Access'); ?>

<? foreach($terms as $result) : ?>
    <li>
        <a href="<?php echo JRoute::_('index.php?'.$result->getUrl()); ?>"><?= $result->getRelatedData()->title; ?></a>
    </li>
<? endforeach; ?>