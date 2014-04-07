<?php $view->extend('::base.html.php');?>

<div class="page-header">
    <h1>PPI Marketplace</h1>
    <h3>Browse around for a module you like, create your own modules, track modules</h3>
</div>

<div class="col-sm-6">
    <h2><i class="icon-star" style="color:green;"></i> Popular Modules</h2>

    <?php foreach($popularModulesList as $pml): ?>
       <div class="module-entry">
            <div>
                <h4><a href="<?php echo $view['router']->generate('Module_View', array('moduleID'=>$pml->getID())); ?>"><?php echo $pml->getTitle(); ?></a></h4>
            </div>
            <div>
                Created by <?php echo $pml->getAuthorName(); ?> on <?php echo $pml->getCreated()->format('d/m/Y'); ?>
            </div>
            <div class="description">
                <?php echo $pml->getDescription(); ?>
            </div>
       </div>
    <?php endforeach; ?>
</div>

<div class="col-sm-6">
    <h2><i class="icon-refresh" style="color:green;"></i> Recently Updated Modules</h2>

    <?php foreach($updatedModulesList as $uml): ?>
        <div class="module-entry">
            <div>
                <h4><a href="<?php echo $view['router']->generate('Module_View', array('moduleID'=>$uml->getID())); ?>"><?php echo $uml->getTitle(); ?></a></h4>
            </div>
            <div>
                Created by <?php echo $uml->getAuthorName(); ?> on <?php echo $uml->getLastUpdated()->format('d/m/Y'); ?>
            </div>
            <div class="description">
                <?php echo $uml->getDescription(); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<?php $view['slots']->start('include_js_body'); ?>
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
