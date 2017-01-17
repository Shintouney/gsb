<nav class="navbar navbar-inverse navbar-gsb">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img class="nav-logo" src="img/logo-tr-sm.png"/></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if ($template === "frais" ) { ?> class="active"<?php } ?> > <a href="#">Appli Frais</a></li>
                <li <?php if ($template === "cr" ) { ?>class="active"<?php } ?>><a href="#about">Gestion compte-rendu</a></li>
                <li <?php if ($template === "incidents" ) { ?> class="active"<?php } ?> ><a href="#contact">Gestion incidents</a></li>
                <li <?php if ($template === "admin" ) { ?> class="active"<?php } ?>>
                    <a href="?page=user&action=index">Administration</a>
                </li>
                <li><a href="?page=user&action=logout">logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>