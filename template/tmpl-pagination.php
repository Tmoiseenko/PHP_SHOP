<ul class="shop__paginator paginator">
    <? while ($page++ < $num_pages): ?>
        <? if ($page == $cur_page): ?>
    <span class="paginator__item"><?=$page?></span>
        <? else: ?>
            <a class="paginator__item" href="page=<?=$page?>"><?=$page?></a>
        <? endif ?>
    <? endwhile ?>
</ul>

