<?php $view->extend('::base.html.php'); ?>

<?php 
    echo '<pre>' . print_r($listings, true) . '</pre>';
?>

<div class="main-container">
    <div class="search-panel">
        <form method="get" action="<?php echo $view['router']->generate('Module_Search'); ?>">
            <input name="q" value="<?php echo $query; ?>" />
            <input type="submit" value="Search" />
        </form>
    </div>
    <hr/>
    
    <div class="search-listings">
        <?php if(count($listings)>0): ?>
            <?php foreach($listings as $listing): ?>
                <div>
                    <?php echo $listing->getTitle(); ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
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
        
    </style>
<?php $view['slots']->stop();?>
