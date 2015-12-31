<?php $view->extend('::base.html.php'); ?>

<div data-target="#step-container" class="row-fluid" id="fuelux-wizard">
    <ul class="wizard-steps">
        <li class="active" data-target="#step1">
            <span class="step">1</span>
            <span class="title">Module Information</span>
        </li>

        <li data-target="#step2" class="">
            <span class="step">2</span>
            <span class="title">Module Description</span>
        </li>

        <li data-target="#step3" class="">
            <span class="step">3</span>
            <span class="title">Screenshots</span>
        </li>

        <li data-target="#step4" class="">
            <span class="step">4</span>
            <span class="title">Finish</span>
        </li>
    </ul>
</div>

<div id="step-container" class="step-content row-fluid position-relative">
    <div id="step1" class="step-pane active">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">Module Wizard</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form action="<?php echo $view['router']->generate('Module_Save_Information'); ?>" method="post"
                          id="module-create-form">
                        <div class="form-group">
                            <label for="module-title"
                                   class="col-xs-12 col-sm-3 control-label no-padding-right">Name</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="module-title" name="moduleName" class="width-100"
                                           value="<?= $wizardModule->getTitle(); ?>">
                                    <i class="icon-info-sign"></i>
                                </span>
                            </div>
                            <div class="help-block col-xs-12 col-sm-reset inline"> Enter the module title!</div>
                        </div>

                        <div class="form-group">
                            <label for="github-url" class="col-xs-12 col-sm-3 control-label no-padding-right">Github
                                URL</label>

                            <div class="col-xs-12 col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="github-url" name="githubUrl" class="width-100"
                                           value="<?= $wizardModule->getGithubUrl(); ?>">
                                    <i class="icon-info-sign"></i>
                                </span>
                            </div>
                            <div class="help-block col-xs-12 col-sm-reset inline"> Enter Github URL!</div>
                        </div>
                        <input type="hidden" name="moduleId" value="<?= $wizardModule->getID(); ?>" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="step2" class="step-pane">

        <div class="widget-box">
            <div class="widget-header widget-header-small header-color-blue"></div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <form action="<?= $view['router']->generate('Module_Save_Description'); ?>" method="post"
                          id="module-desc-form">

                        <textarea name="moduleDescription"
                            data-provide="markdown"
                            rows="10"
                            id="description"><?= $wizardModule->getDescription(); ?></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="step3" class="step-pane">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">Module Wizard</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form action="<?php echo $view['router']->generate('Module_Save_Screenshots'); ?>"
                          class="dropzone">
                        <div id="screenshot-dropzone" class="row">
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </div>
                    </form>

                    <div id="current-screenshots" class="col-sm-12 well">
                        <h2>Uploaded Screenshots</h2>
                        <?php if (count($wizardModule->getScreenshots()) > 0) : ?>
                            <ul class="ace-thumbnails">
                                <?php foreach ($wizardModule->getScreenshots() as $screenshot) : ?>
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
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="step4" class="step-pane">
        <div class="center">
            <h3 class="green">Sweet!</h3>
            Your module is ready to be created! Click finish to continue!
        </div>
    </div>

</div>
<hr>
<div class="row-fluid wizard-actions">
    <button class="btn btn-prev" disabled="disabled">
        <i class="icon-arrow-left"></i>Prev
    </button>

    <button data-last="Finish " class="btn btn-success btn-next">
        Next<i class="icon-arrow-right icon-on-right"></i>
    </button>
</div>
</div>

<?php $view['slots']->start('include_js_body'); ?>

<script type="text/javascript" src="<?= $view['assets']->getUrl('assets/js/markdown/markdown.min.js'); ?>"></script>
<script type="text/javascript" src="<?= $view['assets']->getUrl('assets/js/markdown/bootstrap-markdown.min.js'); ?>"></script>

<script type="text/javascript">
    var createdModule = false;

    $(document).ready(function () {
        // @todo - if loading existing module, disable the step1 fields
        var createForm = $('#module-create-form');
        if (createForm.data('existing') == true) {
            $('#module-title').attr('disabled', 'disabled').addClass('disabled');
            $('#github-url').attr('disabled', 'disabled').addClass('disabled');
        }

        $("div#screenshot-dropzone").dropzone({url: '<?php echo $view['router']->generate('Module_Save_Screenshots'); ?>'});
        $('#fuelux-wizard').ace_wizard()
            .on('change', function (e, info) {

                var changeStep = true;

                if (info.step == 1 && !createdModule) {

                    if (createForm.data('existing') == true) {
                        return true;
                    }
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        url: createForm.attr('action'),
                        async: false,
                        data: createForm.serialize(),
                        success: function (response) {

                            if (response.code == 'E_MODULE_NAME_EXISTS') {
                                bootbox.dialog({
                                    closeButton: false,
                                    message: "Your module name already exists.",
                                    buttons: {
                                        "success": {
                                            label: "Let's change it!",
                                            className: "btn-sm btn-primary",
                                            callback: function () {
                                                $('#module-title').focus();
                                            }
                                        }
                                    }
                                });
                                changeStep = false;

                            } else if (response.code == 'E_ERROR') {
                                bootbox.dialog({
                                    closeButton: false,
                                    message: "An unknown error has occurred. Please contact the site administrators.",
                                    buttons: {
                                        "success": {
                                            label: "Try again!",
                                            className: "btn-sm btn-primary"
                                        }
                                    }
                                });

                                changeStep = false;

                            } else if (response.code == 'OK') {
                                createdModule = true;
                                $('#module-title').attr('disabled', 'disabled').addClass('disabled');
                                $('#github-url').attr('disabled', 'disabled').addClass('disabled');

                                // @todo - if description comes back, populate step 2 TinyMCE editor
                                if (response.description !== undefined && response.description.length > 0) {
                                    $('#description').val(response.description);
                                }
                            }

                        }


                    }); // End of $.ajax()

                    return changeStep;
                }

                // Lets always presume we're going to continue to next step
                changeStep = true;
                if (info.step == 2) {

                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        url: $('#module-desc-form').attr('action'),
                        async: false,
                        data: $('#module-desc-form').serialize(),
                        success: function (response) {
                            if (response.code != 'OK') {
                                changeStep = false;
                                bootbox.dialog({
                                    closeButton: false,
                                    message: "Unable to update description.",
                                    buttons: {
                                        "success": {
                                            label: "Try again!",
                                            className: "btn-sm btn-primary"
                                        }
                                    }
                                });
                            }
                        }
                    });

                    return changeStep;
                }

            })
            .on('finished', function (e) {
                window.location.href = '<?php echo $view['router']->generate('Module_Save_Finish'); ?>';
                return;
            });

        $('.delete-screenshot').on('click', function(event) {
            bootbox.confirm("Are you sure you want to delete this Screenshot?", function(result) {
                if (result) {
                    $.ajax({
                        dataType: 'json',
                        method: 'post',
                        url: '<?= $view['router']->generate('Module_Delete_Screenshot'); ?>',
                        data: {
                            'moduleId': $('#moduleId').val(),
                            'screenshotId': $(event.target).parent().prop('rel')
                        },
                        success: function (response) {
                            if (response.status != 'success') {
                                bootbox.dialog({
                                    closeButton: false,
                                    message: "Unable to delete screenshot",
                                    buttons: {
                                        "success": {
                                            label: "Try again!",
                                            className: "btn-sm btn-primary"
                                        }
                                    }
                                });
                            }

                            $('#current-screenshots').html(response.html);
                        }
                    });
                }
            });
        });
    });

</script>

<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_css'); ?>
<style type="text/css">
    #step3 {
        padding: 0; /* To make steps all the same height */
    }

    .icon-remove {
        cursor: pointer;
    }

    #description {
        width: 100%;
    }

    .dropzone {
        border: 1px dashed #5293C4;
    }

    #current-screenshots {
        margin-top: 10px;
    }
</style>
<?php $view['slots']->stop(); ?>
