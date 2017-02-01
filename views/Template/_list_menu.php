<header class="major">
    <h2><?= $header ?></h2>
</header>
<ul>
    <?php foreach ($items as $item) {
        include '_current_page_link.php';
        ?>
    <li><a <?= $class?> href="<?= $item['url'] ?>"> <?= $item['text'] ?></a></li>
    <?php };?>
</ul>
<br/>