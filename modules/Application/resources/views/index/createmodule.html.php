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
                <form action="<?php echo $view['router']->generate('Save_Module'); ?>" method="post" class="dropzone">
	                <div id="step1" class="step-pane active">
	                
						<div class="form-group">
							<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Name</label>
					
							<div class="col-xs-12 col-sm-5">
								<span class="block input-icon input-icon-right">
									<input type="text" id="inputInfo" name="title" class="width-100" />
									<i class="icon-info-sign"></i>
								</span>
							</div>
							<div class="help-block col-xs-12 col-sm-reset inline"> Enter title of module! </div>
						</div>	                    
					
						<div class="form-group">
							<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Packagist URL</label>
					
							<div class="col-xs-12 col-sm-5">
								<span class="block input-icon input-icon-right">
									<input type="text" id="inputInfo" name="packagist_url" class="width-100" />
									<i class="icon-info-sign"></i>
								</span>
							</div>
							<div class="help-block col-xs-12 col-sm-reset inline"> Enter Packagist URL! </div>
						</div>
						
						<div class="form-group">
							<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Github URL</label>
					
							<div class="col-xs-12 col-sm-5">
								<span class="block input-icon input-icon-right">
									<input type="text" id="inputInfo" name="github_url" class="width-100" />
									<i class="icon-info-sign"></i>
								</span>
							</div>
							<div class="help-block col-xs-12 col-sm-reset inline"> Enter Github URL! </div>
						</div>		

	                </div>
	
	                <div id="step2" class="step-pane">
	                    <textarea id="description"></textarea>
	                </div>
	
	                <div id="step3" class="step-pane">
	                	<div id="dropzone" class="row">
	                        
	                	</div>
	                </div>
	
	                <div id="step4" class="step-pane">
	                    <div class="center">
	                        <h3 class="green">Congrats!</h3>
	                        Your product is ready to ship! Click finish to continue!
	                    </div>
	                </div>
                </form>
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
        	$("div#dropzone").dropzone({ url: "<?php echo $view['router']->generate('Save_Module'); ?>" });

        	
            $('#fuelux-wizard').ace_wizard()
                .on('change', function () {

                })
                .on('finished', function(e) {
                    bootbox.dialog({
                        closeButton: false,
                        message: "Thank you! Your module is now ready",
                        buttons: {
                            "success" : {
                                label: "Let's Go!",
                                className: "btn-sm btn-primary",
                                callback: function() {
                                    window.location.href = 'http://www.google.com';
                                }
                            }
                        }
                    });
                });
        });
		
    </script>
    
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script>
		        tinymce.init({selector:'textarea'});
		</script>
    
    
    <?php $view['slots']->stop(); ?>

    <?php $view['slots']->start('include_css'); ?>

    <?php $view['slots']->stop(); ?>
