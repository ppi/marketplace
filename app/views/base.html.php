<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>PPI - Marketplace</title>

    <meta name="description" content="overview &amp; stats"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- basic styles -->

    <link href="<?php echo $view['assets']->getUrl('assets/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/font-awesome.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/colorbox.css'); ?>"/>

    <!--[if IE 7]>
    <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css"/>
    <![endif]-->

    <!-- page specific plugin styles -->

    <!-- fonts -->

    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/ace-fonts.css'); ?>"/>

    <!-- ace styles -->

    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/ace.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/ace-rtl.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/ace-skins.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo $view['assets']->getUrl('assets/css/dropzone.css'); ?>"/>

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/assets/css/ace-ie.min.css"/>
    <![endif]-->

    <!-- inline styles related to this page -->
    <?php $view['slots']->output('include_css'); ?>

    <!-- ace settings handler -->

    <script src="<?php echo $view['assets']->getUrl('assets/js/ace-extra.min.js'); ?>"></script>	
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }

        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }

        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }

    </script>

    <?php $view['slots']->output('include_js_head'); ?>

</head>

<body>
    <div class="navbar navbar-default" id="navbar">

        <div class="navbar-container" id="navbar-container">

            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                        <i class="icon-bar-chart"></i>
                        PPI Marketplace
                    </small>
                </a><!-- /.brand -->
            </div>
            <!-- /.navbar-header -->


            <div class="navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="light-blue">
                        <?php if($view['security']->isLoggedIn()): ?>
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="/assets/avatars/user.jpg" alt="Jason's Photo"/>
                            <span class="user-info">
                                <small>Welcome,</small>
                                <?=$view->escape($view['security']->getUser()->getFullName());?>
                            </span>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li class="divider"></li>
                            <li><a href="<?=$view['router']->generate('UserAuth_Logout');?>"><i class="icon-off"></i> Logout</a></li>
                        </ul>
                        <?php else: ?>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span>Login Via</span>
                                <i class="icon-caret-down"></i>
                            </a>
                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li><a href="<?=$view['router']->generate('UserAuth_Login');?>"><i class="icon-github"></i> GitHub</a></li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
                <!-- /.ace-nav -->

            </div>
            <!-- /.navbar-header -->

        </div>
        <!-- /.container -->
    </div>

    <div class="main-container" id="main-container">

        <div class="main-container-inner">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>

            <div class="sidebar" id="sidebar">

                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                        <button class="btn btn-success">
                            <i class="icon-signal"></i>
                        </button>

                        <button class="btn btn-info">
                            <i class="icon-pencil"></i>
                        </button>

                        <button class="btn btn-warning">
                            <i class="icon-group"></i>
                        </button>

                        <button class="btn btn-danger">
                            <i class="icon-cogs"></i>
                        </button>
                    </div>

                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <span class="btn btn-success"></span>
                        <span class="btn btn-info"></span>
                        <span class="btn btn-warning"></span>
                        <span class="btn btn-danger"></span>
                    </div>
                </div>
                <!-- #sidebar-shortcuts -->

                <ul class="nav nav-list">
                    <li id="dashboard" class="active">
                        <a href="index.html">
                            <i class="icon-dashboard"></i>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    
                    <li id="search">
                        <a href="<?php echo $view['router']->generate('Module_Search'); ?>">
                            <i class="icon-search"></i>
                            <span class="menu-text"> Search </span>
                        </a>
                    </li>

                    <?php if(isset($view['navigation'])): ?>
                        <?php foreach($view['navigation']->getItems() as $navItem): ?>
                            <li>
                                <a href="<?=$navItem->getHref();?>">
                                    <i class="icon-<?=$navItem->getIconSuffix();?>"></i>
                                    <span class="menu-text"><?=$view->escape($navItem->getTitle());?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </ul>
                <!-- /.nav-list -->

            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
            </div>

            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'collapsed')
                } catch (e) {
                }
            </script>
            </div>

            <div class="main-content">
                <div class="breadcrumbs" id="breadcrumbs">
                    <script type="text/javascript">
                        try {
                            ace.settings.check('breadcrumbs', 'fixed')
                        } catch (e) {
                        }
                    </script>

                    <ul class="breadcrumb">
                        <li>
                            <i class="icon-home home-icon"></i>
                            <a href="/" title="Dashboard">Dashboard</a>
                        </li>

                    </ul>
                    <!-- .breadcrumb -->

                    <div class="nav-search" id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Search ..." class="nav-search-input"
                                       id="nav-search-input" autocomplete="off"/>
                                <i class="icon-search nav-search-icon"></i>
                            </span>
                        </form>
                    </div>
                    <!-- #nav-search -->
                </div>

                <div class="page-content">

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <?php $view['slots']->output('_content'); ?>
                            <!-- PAGE CONTENT ENDS -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.page-content -->
            </div>
            <!-- /.main-content -->

        </div>
        <!-- /.main-container-inner -->

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="icon-double-angle-up icon-only bigger-110"></i>
        </a>

    </div>
    <!-- /.main-container -->

    <!--[if !IE]> -->
    <script type="text/javascript">
        window.jQuery || document.write("<script src='<?php echo $view['assets']->getUrl('assets/js/jquery-2.0.3.min.js'); ?>'>" + "<" + "/script>");
    </script>
    <!-- <![endif]-->

    <!--[if IE]>
    <script type="text/javascript">
        window.jQuery || document.write("<script src='/assets/js/jquery-1.10.2.min.js'>" + "<" + "/script>");
    </script>
    <![endif]-->

    <script type="text/javascript">
        if ("ontouchend" in document) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/typeahead-bs2.min.js'); ?>"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
    <script src="/assets/js/excanvas.min.js"></script>
    <![endif]-->

    <script src="<?php echo $view['assets']->getUrl('assets/js/jquery-ui-1.10.3.custom.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/jquery.ui.touch-punch.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/jquery.easy-pie-chart.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/jquery.sparkline.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/flot/jquery.flot.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/flot/jquery.flot.pie.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/flot/jquery.flot.resize.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/dropzone.min.js'); ?>"></script>

    <!-- ace scripts -->

    <script src="<?php echo $view['assets']->getUrl('assets/js/ace-elements.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('assets/js/ace.min.js'); ?>"></script>

    <!-- ace fuelux wizard -->
    <script src="<?php echo $view['assets']->getUrl('/assets/js/fuelux/fuelux.wizard.min.js'); ?>"></script>

    <script src="<?php echo $view['assets']->getUrl('/assets/js/bootbox.min.js'); ?>"></script>
    <script src="<?php echo $view['assets']->getUrl('/assets/js/jquery.colorbox-min.js'); ?>"></script>
    

    <!-- inline scripts related to this page -->
    <?php $view['slots']->output('include_js_body'); ?>
</body>
</html>
