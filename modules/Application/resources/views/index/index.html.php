<?php $view->extend('::base.html.php'); ?>

    <div class="page-header">
        <h1>Title Of Module</h1>
    </div>

    <div class="col-sm-7">
        <div class="tabbable">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#home" data-toggle="tab">
                        <i class="green icon-home bigger-110"></i>
                        Description
                    </a>
                </li>

                <li>
                    <a href="#screenshot" data-toggle="tab">
                        <i class="green icon-desktop bigger-110"></i>
                        Screenshots
                    </a>
                </li>

                <li>
                    <a href="#support" data-toggle="tab">
                        <i class="green icon-wrench bigger-110"></i>
                        Support
                    </a>
                </li>

                <li>
                    <a href="#comments" data-toggle="tab">
                        <i class="green icon-group bigger-110"></i>
                        Comments
                    </a>
                </li>

                <li>
                    <a href="#source" data-toggle="tab">
                        <i class="green icon-code bigger-110"></i>
                        Source
                    </a>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane in active" id="home">
                    <?= nl2br($view->escape($selectedModule->getDescription())); ?>
                </div>

                <div class="tab-pane" id="screenshot">
                    <div class="row">
                        <ul class="ace-thumbnails">
                            <?php foreach($selectedModule->getScreenshots() as $screenshot): ?>
                            <li>
                                <a href="/assets/screenshotos/module_<?=$selectedModule->getID();?>/<?=$view->escape($screenshot->getPath());?>" data-rel="colorbox">
                                    <img alt="150x150" src="/assets/images/gallery/thumb-2.jpg"/>
                                </a>

                                <div class="tools tools-top">
                                    <a href="#"><i class="icon-link"></i></a>

                                    <a href="#">
                                        <i class="icon-remove red"></i>
                                    </a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="tab-pane" id="support">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                </div>

                <div class="tab-pane" id="comments">
                    <div class="dialogs">
                        <?php foreach ($selectedModule->getComments() as $comment): ?>
                            <div class="itemdiv dialogdiv">
                                <div class="user">
                                    <img alt="Alexa's Avatar" src="/assets/avatars/avatar1.png">
                                </div>

                                <div class="body">
                                    <div class="time">
                                        <i class="icon-time"></i>
                                        <span
                                            class="green"><?= $comment->getCreated()->format('jS F Y \a\t h:i:sA'); ?></span>
                                    </div>

                                    <div class="name">
                                        <a href="#"><?= $view->escape($comment->getName()); ?></a>
                                    </div>
                                    <div class="text"><?= $view->escape($comment->getComment()); ?></div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

                <div class="tab-pane" id="source">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        <div class="widget-box">
            <div class="widget-header">
                <h4 class="smaller">
                    Authors
                </h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">

                    <hr>

                </div>
            </div>
        </div>
    </div>

<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/home.js'); ?>"></script>
<?php $view['slots']->stop(); ?>