<?php $view->extend('::base.html.php'); ?>

    <div class="page-header">
        <div class="left">
            <h1><?= $view->escape($selectedModule->getTitle()); ?></h1>
        </div>
        <div class="right">
            <i class="icon-star-o"></i>
        </div>
    </div>

    <?php if ($moduleOwner) : ?>
        <div class="col-sm-12 margin-bottom-10">
            <a class="btn btn-success" href="<?= $view['router']->generate('Module_Edit', array('moduleId'=>$selectedModule->getID())); ?>">Edit Module</a>
        </div>
    <?php endif; ?>

    <div class="col-sm-8">
        <div class="tabbable">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active">
                    <a href="#moduleDescription" data-toggle="tab">
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
                    <a href="#moduleInstallation" data-toggle="tab">
                        <i class="green icon-wrench bigger-110"></i>
                        Installation
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
                <div class="tab-pane in active" id="moduleDescription"><?= $view->escape($selectedModule->getDescription()); ?></div>

                <div class="tab-pane" id="screenshot">
                    <div class="row">
                        <ul class="ace-thumbnails">
                            <?php foreach ($selectedModule->getScreenshots() as $screenshot) : ?>
                                <li>
                                    <a class="cboxElement" href="<?= $view['assets']->getUrl('screenshots/' . $view->escape($screenshot->getPath())); ?>" data-rel="colorbox">
                                        <img alt="150x150" src="<?= $view['assets']->getUrl('thumbs/' . $view->escape($screenshot->getThumbPath())); ?>"/>
                                    </a>

                                    <!--
                                    <div class="tools tools-top">
                                        <a href="#"><i class="icon-link"></i></a>
                                    </div>
                                    -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="tab-pane" id="moduleInstallation"><?= $view->escape($selectedModule->getInstallationDetails()); ?></div>

                <div class="tab-pane" id="support">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                </div>

                <div class="tab-pane" id="comments">
                    <div class="dialogs">
                        <?php foreach ($selectedModule->getComments() as $comment) : ?>
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

                    <div class="profile-user-info profile-user-info-striped">

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Github Url </div>

                            <div class="profile-info-value">
                                <a href="<?= $selectedModule->getGithubUrl(); ?>" title="Github Url" target="_blank">
                                    <span class="editable editable-click" id="username"><?= $selectedModule->getGithubUrl(); ?></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="col-sm-4">
	<div class="widget-box">
		<div class="widget-header">
			<h4 class="smaller">
				Authors
			</h4>
		</div>

		<div class="widget-body">
			<div class="widget-main">

				<?php foreach ($selectedModule->getAuthors() as $author) : ?>
				<div class="author">
					<img src="<?= $view['assets']->getUrl($author->getImagePath()); ?>" class="users" />
                    <span><?= $view->escape($author->getFirstname()) . ' ' . $view->escape($author->getLastname()); ?></span>
				</div>
				<?php endforeach;?>
				<hr>

				<div class="profile-user-info profile-user-info-striped">
					<div class="profile-info-row">
						<div class="profile-info-name"> Rating </div>

						<div class="profile-info-value">
							<span><?= $selectedModule->getNumStars(); ?></span>
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name"> Requirements </div>
						<div class="profile-info-value">2.1</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name"> Last Updated </div>

						<div class="profile-info-value">
							<span><?= $selectedModule->getLastUpdated()->format('jS F Y \a\t h:i:sA'); ?></span>
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name"> Downloaded </div>

						<div class="profile-info-value">
							<span><?= $view->escape($selectedModule->getNumDownloads()); ?></span>
						</div>
					</div>

					<div class="profile-info-row">
						<div class="profile-info-name"> License: </div>

						<div class="profile-info-value">
							<span>GPL</span>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<?php $view['slots']->start('include_js_body'); ?>
<script type="text/javascript" src="<?= $view['assets']->getUrl('assets/js/markdown/markdown.min.js'); ?>"></script>
<script type="text/javascript">
    $('a.cboxElement').colorbox({close:'X', next:'>', previous:'<'});
    var markedupHTML = markdown.toHTML($('#moduleDescription').html());
    $('#moduleDescription').html(markedupHTML);
    markedupHTML = markdown.toHTML($('#moduleInstallation').html());
    $('#moduleInstallation').html(markedupHTML);
</script>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_css'); ?>
	<style>
		.author {
			margin-bottom: 10px;
		}

		.bold {
			font-weight: bold;
		}

        .margin-bottom-10 {
            margin-bottom: 10px;
        }
	</style>
<?php $view['slots']->stop();?>
