<? defined('KOOWA') or die('Restricted Access'); ?>

<? foreach($terms as $result) : ?>
    <li>
        <a href="<?php echo $result->href; ?>"><?php echo $result->getRelatedData()->title; ?></a>
    </li>
<? endforeach; ?>