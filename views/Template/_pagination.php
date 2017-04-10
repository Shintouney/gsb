<?php
?>
<div class="row">
    <div class="6u -3u">
        <ul class="pagination">
            <?php
            if ($currentPage != 1) {
                echo '<li><a class="page" href="?app=user&page=1">&#10094;&#10094;</a></li>   ';
            } else {
                echo '<li><a class="page active">&#10094;&#10094;</a></li>   ';
            }
            for ($i = 1; $i <= $nbPage; $i++) {
                if($currentPage == $i) {
                    echo '<li><a class="page active">'.$i.'</a></li>';
                } else {
                    echo '<li><a class="page" href="?app=user&page='.$i.'">'.$i.'</a></li>  ';
                }
            }
            if ($currentPage != $nbPage) {
                echo '<li><a class="page" href="?app=user&page='.$nbPage.'">&#10095;&#10095;</a></li>';
            } else {
                echo '<li><a class="page active">&#10095;&#10095;</a>   ';
            }
            ?>
        </ul>
    </div>
</div>
