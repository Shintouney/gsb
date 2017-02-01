<?php
    $class = array();
    if (isset($item['icon'])) $class[] = 'icon fa-'.$item['icon'];
    if ((isset($item['page']) && $pageName === $item['page']) || $pageName === $item['text']) {
        $class[] = 'current_page';
    }

    $class = empty($class)? '' : 'class="'.implode(' ', $class).'" ';
