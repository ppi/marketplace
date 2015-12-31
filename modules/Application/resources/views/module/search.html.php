<?php $view->extend('::base.html.php'); ?>

<div class="main-container">

    <div class="search-panel" id="nav-search">
        <form class="form-search" method="get" action="<?php echo $view['router']->generate('Module_Search'); ?>">
            <span class="input-icon">
                <input name="q" value="<?php echo $query; ?>" type="text" placeholder="Search ..." class="nav-search-input"
                       id="nav-search-input" autocomplete="off"/>
                <i class="icon-search nav-search-icon"></i>
            </span>
            <input class="btn btn-sm btn-success" type="submit" value="Search" />
        </form>
    </div>

    <hr/>

    <div class="search-listings">
        <?php if (count($listings) > 0) : ?>
            <div class="col-sm-12">
                <?php foreach ($listings as $listing) : ?>
                    <div class="module-entry">
                        <div>
                            <h4><a href="<?= $view['router']->generate('Module_View', array('moduleId'=>$listing->getID())); ?>"><?= $view->escape($listing->getTitle()); ?></a></h4>
                        </div>
                        <div>Created by <?= $view->escape($listing->getAuthorName()); ?> Updated on <?= $listing->getLastUpdated()->format('d/m/Y'); ?></div>
                        <div class="description"><?= $view->escape($listing->getShortDescription()); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div>No Modules Avaliable At This Time!</div>
        <?php endif; ?>
    </div>
</div>


<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript">
        $('.active').removeClass('active');
        $('#search').addClass('active');
    </script>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_css'); ?>
    <style>
        .module-entry {
            border-top: 1px dotted darkgray;
            border-bottom: 1px dotted darkgray;
            padding:10px;
        }

        .module-entry .description {
            margin-top:10px;
        }
    </style>
<?php $view['slots']->stop();?>
