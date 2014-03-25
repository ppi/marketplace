<?php $view->extend('::base.html.php'); ?>

<div class="page-header">
    <h1>Welcome User</h1>
</div>

<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="<?=$view['assets']->getUrl('js/home.js');?>"></script>
<?php $view['slots']->stop(); ?>