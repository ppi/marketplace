<?php $view->extend('::base.html.php'); ?>

<div class="page-header">
    <h1>Welcome User</h1>
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
				<a href="#profile" data-toggle="tab">
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
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod eget nulla et hendrerit. Donec adipiscing quam ac augue aliquam volutpat. Sed ut adipiscing lectus. Ut id odio et dolor ornare fermentum. Sed lacus quam, pulvinar ut felis id, iaculis ultrices tortor. Sed risus sem, sollicitudin nec augue et, hendrerit gravida augue. Duis ante nunc, viverra consectetur enim ullamcorper, vehicula consectetur nunc. Morbi porttitor at tortor quis pharetra. Nulla rutrum ultrices placerat. Ut adipiscing lorem in elit faucibus, a egestas purus venenatis. Sed ut risus consequat, laoreet leo eu, mollis justo. Praesent tristique quam dapibus fermentum rutrum. Fusce eu neque sem. Donec quis velit eu massa semper blandit. Nunc vel magna cursus, tincidunt risus id, commodo massa.</p>

				<p>Fusce nec dui eget risus rutrum rhoncus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec orci velit, vulputate eu lacus in, vulputate vehicula ipsum. Quisque a varius mi. Mauris pulvinar eget massa nec mollis. Quisque ut rhoncus lectus. Aenean vitae viverra nisi. Ut lorem nulla, aliquet sit amet sem semper, interdum sodales neque. Vivamus tristique auctor blandit. Sed sem sapien, feugiat sit amet lorem ut, tristique adipiscing nisl. Phasellus volutpat risus faucibus massa dapibus, nec consectetur turpis fringilla. Donec bibendum magna vitae lacinia imperdiet. Curabitur ut consectetur augue, a tempus neque. </p>
			</div>

			<div class="tab-pane" id="profile">
				<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
			</div>
			
			<div class="tab-pane" id="support">
				<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
			</div>
			
			<div class="tab-pane" id="comments">
				<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
			</div>
			
			<div class="tab-pane" id="source">
				<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
			</div>									


		</div>
	</div>
</div>

<?php $view['slots']->start('include_js_body'); ?>
    <script type="text/javascript" src="<?=$view['assets']->getUrl('js/home.js');?>"></script>
<?php $view['slots']->stop(); ?>