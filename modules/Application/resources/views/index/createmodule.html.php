<?php $view->extend('::base.html.php'); ?>

<div class="page-header">
    <h1>Create New Module</h1>
</div>

<div class="widget-box">
    <div class="widget-header widget-header-blue widget-header-flat">
        <h4 class="lighter">New Item Wizard</h4>
    </div>

    <div class="widget-body">
        <div class="widget-main">
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

            <hr>
            <div id="step-container" class="step-content row-fluid position-relative">
                <div id="step1" class="step-pane active">
                    <p>I am step 1</p>
                </div>

                <div id="step2" class="step-pane">
                    <p>I am step 2</p>
                </div>

                <div id="step3" class="step-pane">
                    <div class="center">
                        <h3 class="blue lighter">This is step 3</h3>
                    </div>
                </div>

                <div id="step4" class="step-pane">
                    <div class="center">
                        <h3 class="green">Congrats!</h3>
                        Your product is ready to ship! Click finish to continue!
                    </div>
                </div>
            </div>

            <hr>
            <div class="row-fluid wizard-actions">
                <button class="btn btn-prev" disabled="disabled">
                    <i class="icon-arrow-left"></i>
                    Prev
                </button>

                <button data-last="Finish " class="btn btn-success btn-next">
                    Next

                    <i class="icon-arrow-right icon-on-right"></i></button>
            </div>
        </div>
        <!-- /widget-main -->
    </div>
    <!-- /widget-body -->



    <?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="<?= $view['assets']->getUrl('js/home.js'); ?>"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#fuelux-wizard').ace_wizard().on('change', function () {
                alert('working');
            });
        });
    </script>
    <?php $view['slots']->stop(); ?>

    <?php $view['slots']->start('include_css'); ?>

    <?php $view['slots']->stop(); ?>
