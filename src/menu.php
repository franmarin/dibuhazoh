<?php
use Dibuhazoh\Config;
?>
<input type="hidden" id="max-batch-items" value="<?php echo Config::MAX_BATCH_ITEMS; ?>"/>
<nav class="main-nav" id="main-nav">
    <ul>
        <li>
            <label>Bajados?</label>
            <ul class="filter" id="<?php echo Config::FIELD_DOWNLOADED; ?>">
                <li class="selected">S&iacute;</li>
                <li>No</li>
                <li>Todos</li>
            </ul>
        </li>
        <li>
            <label>Con imagen?</label>
            <ul class="filter" id="<?php echo Config::FIELD_IMAGE; ?>">
                <li class="selected">S&iacute;</li>
                <li>No</li>
                <li>Todos</li>
            </ul>
        </li>
        <li>
            <label>A&ntilde;o</label>
            <ul class="filter" id="<?php echo Config::FIELD_YEAR; ?>">
                <li class="selected">Todos</li>
                <li>&lt;1980</li>
                <li>1980-1989</li>
                <li>1990-1995</li>
                <li>>1995</li>
            </ul>
        </li>
        <li>
            <label>Tipo</label>
            <ul class="filter" id="<?php echo Config::FIELD_TYPE; ?>">
                <li class="selected">Todos</li>
                <li>Dibujos</li>
                <li>Real</li>
                <li>Animatronia</li>
                <li>Plastilina</li>
                <li>Marionetas</li>
            </ul>
        </li>
        <li>
            <label>Formato</label>
            <ul class="filter" id="<?php echo Config::FIELD_FORMAT; ?>">
                <li class="selected">Todos</li>
                <li>Serie</li>
                <li>Pel&iacute;culas</li>
                <li>Programa</li>
                <li>Concurso</li>
            </ul>
        </li>
        <li>
            <label>Productora</label>
            <ul class="filter" id="<?php echo Config::FIELD_PRODUCER; ?>">
                <li class="selected">Todas</li>
                <li>Hanna-Barbera</li>
                <li>Warner Bros</li>
                <li>Filmation</li>
                <li>Toei Animation</li>
                <li>Por asignar</li>
            </ul>
        </li>
    </ul>
</nav>
