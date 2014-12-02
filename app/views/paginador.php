<ul class="pagination paginador">
    <?php if ($paginaActual == 1) : ?>
        <li class="disabled">
            <a href="<?=$href.$paginaActual?>">&laquo;</a>
        </li>
    <?php else : ?>
        <li>
            <a href="<?=$href.($paginaActual-1)?>">&laquo;</a>
        </li>
    <?php endif;?>
    <?php for($i = 1; $i<=$numeroPaginas; $i++) : ?>
        <li <?=($i == $paginaActual) ? 'class="active"' : '' ?>>
            <a href="<?=$href.$i?>"><?=$i?></a>
        </li>
    <?php endfor; ?>
    <?php if ($paginaActual == $numeroPaginas) : ?>
        <li class="disabled">
            <a href="<?=$href.$paginaActual?>">&raquo;</a>
        </li>
    <?php else : ?>
        <li>
            <a href="<?=$href.($paginaActual+1)?>">&raquo;</a>
        </li>
    <?php endif;?>
</ul>
