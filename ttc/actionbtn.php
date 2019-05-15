<!--action button-->
	<div class = "fixed-action-btn">
		<a class = "btn-floating btn-large red waves-effect waves-light">
			<i class = "large material-icons">navigation</i>
		</a>
		<ul>
			<li><a class = "btn-floating amber waves-effect waves-light modal-trigger" href = "#help">
				<i class = "large material-icons">help</i></a>
			</li>
			<li><a class = "btn-floating green waves-effect waves-light modal-trigger" href = "#recommend">
				<i class = "large material-icons">create</i></a>
			</li>
			<li><a class = "btn-floating blue waves-effect waves-light modal-trigger" href = "#event">
				<i class = "large material-icons">event</i></a>
			</li>
			<li><a class = "btn-floating lime waves-effect waves-light modal-trigger" href = "#feedback">
				<i class = "large material-icons">mail</i></a>
			</li>
	</div>
<!--modal-->
	<div class = "modal" id = "help">
		<div class = "modal-content">
			<h4>Help</h4><br>
			<p>
			<a class = "btn-floating green">
				<i class = "large material-icons">create</i>
			</a>
			Where do you want to go next?
			</p>
			<p>
			<a class = "btn-floating blue">
				<i class = "large material-icons">event</i>
			</a>
			next trip info
			</p>
			<p>
			<a class = "btn-floating lime">
				<i class = "large material-icons">mail</i>
			</a>
			feedback
			</p>
		</div>
		<div class = "modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">
				Okay
			</a>
		</div>
	</div>
<!--modal recommendation-->
	<div class = "modal" id = "recommend">
		<div class = "modal-content">
			<h4 class = "center-align">Recommend where to go!</h4><br>
			<form method = "post" onsubmit = "thanksmsg()">
				<div class = "input-field">
					<i class="material-icons prefix">account_circle</i>
					<input type = "text" id = "recname"  name = "recname" class = "validate" required>
					<label for = "recname" data-success = "Hello">Name</label>
				</div><br>
				<div class = "input-field">
					<i class="material-icons prefix">landscape</i>
					<input type = "text" id = "recplace" name = "recplace" class = "validate" length = "20" required>
					<label for = "recplace" data-error = "Too long" data-success = "Awesome">Place</label>
				</div><br>
				<div class = "input-field">
					<i class="material-icons prefix">contact_phone</i>
					<input type = "text" id = "reccontact" name = "reccontact" class = "validate" required>
					<label for = "reccontact" data-success = "Thanks">Contact</label>
				</div><br>
				<div class = "input-field">
					<select id = "recseason" name = "recseason" required>
						<option>Any time</option>
						<option>Spring</option>
						<option>Summer</option>
						<option>Fall</option>
						<option>Winter</option>
					</select>
					<label for = "recseason">Season option</label>
				</div><br>
				<div class="chip">
				    ** Name and Contact information will not be displayed
				 </div>
				<br><br><br>

				<button type = "submit" name = "recsubmit" id = "recsubmit" class = "btn waves-effect waves-light green">
					Submit<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
		<div class = "modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">
				No recommendation
			</a>
		</div>
	</div>

	<?php
		if (isset($_POST['recsubmit'])) {
			include 'connection.php';
			
			$rec_name = $_POST['recname'];
			$rec_place = $_POST['recplace'];
			$rec_season = $_POST['recseason'];
			$rec_contact = $_POST['reccontact'];

			$rec_name = mysql_real_escape_string($rec_name);
			$rec_place = mysql_real_escape_string($rec_place);
			$rec_season = mysql_real_escape_string($rec_season);
			$rec_contact = mysql_real_escape_string($rec_contact);
			
			$recprocessing = "INSERT INTO recommend  
					VALUES (null, '$rec_name', '$rec_place', '$rec_contact', now(), '$rec_season');";
			mysql_query($recprocessing);
			mysql_close($con);		
		}
	?>
<!--modal next event-->
	<div class = "modal" id = "event">
		<div class = "modal-content">
			<h4>Next trip</h4><br>
			<p>
			To be posted!
			</p>
			<i class="large material-icons left">tag_faces</i>
		</div><br><br><br>
		<div class = "modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">
				Okay
			</a>
		</div>
	</div>
<!--modal feedback-->
	<div class = "modal" id = "feedback">
		<div class = "modal-content">
			<h4>Any feedback?</h4><br>
				<form method = "post" onsubmit = "thanksmsgfeedback()">
					<div class = "input-field">
						<i class="material-icons prefix">account_circle</i>
						<input type = "text" id = "feedbackname"  name = "feedbackname" class = "validate" required>
						<label for = "feedbackname" data-success = "Hello">Name</label>
					</div><br>
					<div class = "input-field">
						<i class="material-icons prefix">contact_phone</i>
						<input type = "text" id = "feedbackcontact" name = "feedbackcontact" class = "validate" required>
						<label for = "feedbackcontact" data-success = "Thanks">Contact</label>
					</div><br>
					<div class = "input-field">
						<i class="material-icons prefix">chat_bubble_outline</i>
						<textarea id = "feedbacktxt" name = "feedbacktxt" class = "materialize-textarea" required></textarea>
						<label for = "feedbacktxt">Textarea</label>
					</div>

					<button type = "submit" name = "feedbacksubmit" id = "feedbacksubmit" class = "btn waves-effect waves-light lime">
					Submit<i class="material-icons right">send</i>
					</button>
				</form>
		</div><br>
		<div class = "modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">
				Close
			</a>
		</div>
	</div>
	<?php
		if (isset($_POST['feedbacksubmit'])) {
			include 'connection.php';
			
			$feedback_name = $_POST['feedbackname'];
			$feedback_contact = $_POST['feedbackcontact'];
			$feedback_txt = $_POST['feedbacktxt'];

			$feedback_name = mysql_real_escape_string($feedback_name);
			$feedback_contact = mysql_real_escape_string($feedback_contact);
			$feedback_txt = mysql_real_escape_string($feedback_txt);
			
			$feedbackprocessing = "INSERT INTO feedback 
					VALUES (null, '$feedback_name', '$feedback_contact', '$feedback_txt');";
			mysql_query($feedbackprocessing);
			mysql_close($con);		
		}
	?>