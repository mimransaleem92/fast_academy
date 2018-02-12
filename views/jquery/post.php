<?php $this->load->view('inc/header')?>
	
	<h1>Post Jquery Example</h1>
	
	<br />
	<br />
	<div id="errors" style="display:none">Form Errors</div>
	
		
	<form method="post" action="/jquery/processform/" id="myform">
				
	<label>First Name:</label>
	<input type="text" name="first_name" id="first_name" value="">
	
	<br class="cl" />

	<label>Last Name:</label>
	<input type="text" name="last_name" id="last_name" value="">
	
	<br class="cl" />
	
	<input type="submit" value="Submit Form">
		
	</form>

	

<?php $this->load->view('inc/footer')?>