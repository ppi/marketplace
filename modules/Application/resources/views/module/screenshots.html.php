<h2>Uploaded Screenshots</h2>
<?php if (count($screenshots) > 0) : ?>
    <ul class="ace-thumbnails">
        <?php foreach ($screenshots as $screenshot) : ?>
            <li>
                <a class="cboxElement" href="<?= $view['assets']->getUrl('screenshots/' . $view->escape($screenshot->getPath())); ?>" data-rel="colorbox">
                    <img alt="150x150" src="<?= $view['assets']->getUrl('thumbs/' . $view->escape($screenshot->getThumbPath())); ?>"/>
                </a>

                <div class="tools tools-top">
                    <a class="delete-screenshot" rel="<?= $screenshot->getId(); ?>">
                        <i class="icon-remove red"></i>
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <input type="hidden" id="moduleId" value="<?= $moduleId ?>" />
<?php else : ?>
    <p>No Screenshots have been uploaded</p>
<?php endif;
