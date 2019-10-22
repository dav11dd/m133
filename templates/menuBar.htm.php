<!--
 * @author Daniel Mosimann
 * @version 2019
 *
 * Menu-Template. Mit Toggler-Button.
 *
-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
    <div class="container">
    <a class="navbar-brand" href="#">MVC GIBS - Kontakte</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <?php echo $printmenu ?>
        </ul>
    </div>
    </div>
</nav>
