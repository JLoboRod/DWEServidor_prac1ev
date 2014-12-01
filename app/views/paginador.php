<ul class="pagination paginador">
    <?php
    echo ($paginaActual == 1)? '<li class="disabled">' : '<li>';
    echo '<a href="'.$href;
    echo ($paginaActual == 1)? $paginaActual:($paginaActual-1);
    echo '">&laquo;</a></li>';
    for($i = 1; $i <= $numeroPaginas; $i++)
    {
        echo '<li';
        if($i == $paginaActual)
            echo ' class="active"';
        echo '><a href="'.$href.$i.'">'.$i.'</a></li>';
    }

    echo ($paginaActual == $numeroPaginas)? '<li class="disabled">' : '<li>';
    echo '<a href="'.$href;
    echo ($paginaActual == $numeroPaginas)?$paginaActual:($paginaActual+1);
    echo '">&raquo;</a></li>';
    ?>
</ul>
