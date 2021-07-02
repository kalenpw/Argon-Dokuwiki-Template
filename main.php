<!--
=========================================================
*  Argon Dokuwiki Template
*  Based on the Argon Design System by Creative Tim
*  Ported to Dokuwiki by Anchit (@IceWreck)
=========================================================
-->

<?php
if (!defined('DOKU_INC')) {
    die();
}
/* must be run from within DokuWiki */
@require_once dirname(__FILE__) . '/tpl_functions.php'; /* include hook for template functions */

$showTools = !tpl_getConf('hideTools') || (tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']));
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT == 'show');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>
        <?php tpl_pagetitle() ?> |
        <?php echo strip_tags($conf['title']) ?>
    </title>
    <?php tpl_metaheaders() ?>
    <?php echo tpl_favicon(array(
        'favicon',
        'mobile',
    ))
    ?>

    <?php tpl_includeFile('meta.html') ?>

    <!-- 
        I know the CSS and JS imports can be done within the style.ini and script.js files,
        but I had some issues with styling (and import order) there, so I'm doing those imports here. 
        -->
    <!--     Fonts and icons  -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> -->
    <link href="<?php echo tpl_basedir(); ?>assets/css/fonts.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?php echo tpl_basedir(); ?>assets/css/doku.css" rel="stylesheet" />
    <!-- JS -->
    <script src="<?php echo tpl_basedir(); ?>assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo tpl_basedir(); ?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo tpl_basedir(); ?>assets/js/argon-design-system.min.js" type="text/javascript"></script>

    <style>
        /* sticky footer */
        html,
        body {
            height: 100% !important;
        }

        body {
            display: flex !important;
            flex-direction: column !important;
            font-family: 'Avenir', 'Arial', sans-serif;
            color: #222;
        }

        .table,
        #dokuwiki__content table {
            color: #222;
        }

        #dokuwiki__content .secedit button {
            background-color: #343a40;
            border: 1px solid #343a40;
        }

        #dokuwiki__content .secedit button:hover {
            background-color: #343a40;
            border: 1px solid #343a40;
        }

        #dokuwiki__content .secedit button[title=Table] {
            background-color: white;
            border: 1px solid #343a40;
            color: #222;
        }

        /* kalen overrides  */
        .kpw-header {
            background-color: #343a40 !important;
        }

        .kpw-header-logo {
            font-size: 20px;
            color: white !important;
            font-weight: normal !important;
        }

        .kpw-header-logo:hover {
            text-decoration: none !important;
            color: #eee !important;
        }

        .kpw-footer {
            background-color: #343a40 !important;
            border-radius: 0 !important;
            flex-shrink: 0 !important;
        }

        .kpw-footer svg {
            fill: white !important;
        }

        .kpw-footer svg:hover {
            fill: #ccc !important;
        }

        .kpw-footer li:hover {
            fill: #ccc !important;
        }

        .kpw-footer a:hover {
            color: #ccc !important;
            fill: #ccc !important;
        }

        .kpw-full-menu {
            list-style-type: none;
            display: inline !important;
            padding: 0;
        }

        .kpw-full-menu li {
            display: inline !important;
            margin: 10px !important;
        }

        .kpw-full-menu li a {
            display: inline !important;
        }

        .kpw-content-wrapper {
            flex: 1 0 auto !important;
        }

        .kpw-footer-search input[type=text] {
            margin-left: 0 !important;
        }

        .kpw-footer-search button {
            margin-right: 0 !important;
        }

        #kpw-table-of-contents input,
        button {
            border: 1px solid black !important;
        }

        #kpw-table-of-contents .no {
            width: 50% !important;
            margin: 0 !important;
            margin-right: 5px;
            display: inline;
        }

        #kpw-table-of-contents input {
            width: 50% !important;
            margin: 0 !important;
            margin-right: 5px !important;
            display: inline !important;
        }

        #kpw-table-of-contents button {
            margin: 0 !important;
            float: right !important;
        }

        @media only screen and (max-width: 1000px) {
            .advancedOptions {
                width: 100%;
            }
        }

        .navbar-toggler {
            background-color: #222 !important;
        }
    </style>

</head>

<body class="docs ">
    <div class="kpw-content-wrapper" id="dokuwiki__site">


        <header class="navbar navbar-horizontal navbar-expand navbar-dark flex-row align-items-md-center ct-navbar bg-primary py-2 kpw-header">

            <a class="kpw-header-logo" href="/" class="">
                <?= $conf['title'] ?>
            </a>

            <div class="d-none d-md-block ml-auto">
                <ul class="navbar-nav ct-navbar-nav flex-row align-items-center">

                    <?php
                    $menu_items = (new \dokuwiki\Menu\UserMenu())->getItems();
                    foreach ($menu_items as $item) {
                        echo '<li>'
                            . '<a class="nav-link" href="' . $item->getLink() . '" title="' . $item->getTitle() . '">'
                            . '<i class="argon-doku-navbar-icon">' . inlineSVG($item->getSvg()) . '</i>'
                            . '<span class="a11y">' . $item->getLabel() . '</span>'
                            . '</a></li>';
                    }
                    ?>


                    <li class="nav-item">
                        <div class="search-form">
                            <?php tpl_searchform() ?>
                        </div>
                    </li>


                </ul>
            </div>
            <button class="navbar-toggler ct-search-docs-toggle d-block d-md-none ml-auto ml-sm-0" type="button" data-toggle="collapse" data-target="#kpw-table-of-contents" aria-controls="ct-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </header>



        <div class="container-fluid">
            <div class="row flex-xl-nowrap">


                <?php
                // Render the content initially
                ob_start();
                tpl_content(false);
                $buffer = ob_get_clean();
                ?>


                <!-- center content -->
                <main class="col-12 col-md-12 offset-lg-1 col-lg-10 offset-xl-2 col-xl-8 py-md-3 pl-md-5 ct-content" role="main">

                    <div id="dokuwiki__top" class="site
                        <?php echo tpl_classes(); ?>
                        <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
                    </div>

                    <?php html_msgarea() ?>
                    <?php tpl_includeFile('header.html') ?>


                    <!-- Trace/Navigation -->
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <?php if ($conf['youarehere']) { ?>
                                <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                            <?php } ?>
                            <?php if ($conf['breadcrumbs']) { ?>
                                <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                            <?php } ?>
                        </ol>
                    </nav>

                    <div id="kpw-table-of-contents" class="collapse navbar-collapse kpw-table-of-contents">
                        <?php
                            tpl_searchform();
                        ?>
                    </div>

                    <!-- Wiki Contents -->
                    <div id="dokuwiki__content">
                        <div class="pad">

                            <div class="page">

                                <?php echo $buffer ?>
                            </div>
                        </div>
                    </div>

                    <?php tpl_indexerWebBug(); ?>
                </main>

            </div>
        </div>
    </div>
    <!-- Footer -->
    <div class="card footer-card kpw-footer">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div id="dokuwiki__footer">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="kpw-footer-search footer-search">
                        <?php tpl_searchform() ?>
                    </div>

                </div>
                <br />
                <div class="row" style="justify-content: center">
                    <ul class="kpw-full-menu aargon-doku-footer-fullmenu">
                        <?php

                        $menu_items = (new \dokuwiki\Menu\MobileMenu())->getItems();
                        foreach ($menu_items as $item) {
                            echo '<li>'
                                . '<a class="" href="' . $item->getLink() . '" title="' . $item->getTitle() . '">'
                                . '<i class="">' . inlineSVG($item->getSvg()) . '</i>'
                                . '<span class="a11y">' . $item->getLabel() . '</span>'
                                . '</a></li>';
                        }
                        ?>

                    </ul>
                    <?php tpl_includeFile('footer.html') ?>
                </div>

            </div>

        </div>
    </div>
</body>

</html>
