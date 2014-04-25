<? defined('KOOWA') or die('Restricted Access'); ?>

<? foreach($terms as $result) : ?>
    <li>
        <a href="<?= JRoute::_($result->getUrl()); ?>"><?= $result->getRelatedData()->title; ?></a>
    </li>
<? endforeach; ?>