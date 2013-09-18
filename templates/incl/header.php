<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex8-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">CARNIA DESIGN STUDIO</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex8-collapse">
        <ul class="nav navbar-nav" id="mainNavigation">
            <?php foreach ($headerNavi as $pageSlug => $pageTitle): ?>
                <li id="<?php echo $pageSlug;?>"><a href="/<?php echo "{$lang}/{$pageSlug}"; ?>"><?php echo $pageTitle; ?></a></li>
            <?php endforeach ?>
        </ul>
        <ul class="nav navbar-nav navbar-right" id="languagePick">
            <li id="en"><a href="/en">EN</a></li>
            <li id="mk"><a href="/mk">MK</a></li>
        </ul>
    </div>
</nav>
<script>
    $(function() {
        var lang = location.pathname.split("/")[1];
        var page = location.pathname.split("/")[2];
        if(!lang) {lang = 'en';}
        $('#languagePick li#' + lang).addClass('active');
        if(!page){page = 'home';}
        $('#mainNavigation li#' + page).addClass('active');
    });
</script>