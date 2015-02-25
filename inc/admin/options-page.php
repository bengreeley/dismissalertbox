<div class="wrap">
			
	<h2>Dismissable Alert Box Settings</h2>
		
	<form method="post" action="options.php">	    
		<table class="form-table">
			<tbody>
		<?php
			settings_fields( 'dismissalertbox-group' );
			do_settings_sections( 'dismissalertbox-group' );	
			
			echo '<tr>
					<th scope="row"><label for="dismissalertbox_hideonclose">Open Alert Box on Every Load:</label>
					
					</th>';
			
			echo '<td>
					<input type="checkbox"' .
					( get_option('dismissalertbox_hideonclose') == '1' ? 'checked': '') .
					' id="dismissalertbox_hideonclose" name="dismissalertbox_hideonclose" value="1" />
					<p class="howto">If you wish for the alert box to show when a user returns to a site (event after closing), make sure this option is checked.</p>
				</td>
			</tr>';
			
			echo '<tr>
					<th scope="row"><label for="dismissalertbox_preventanimation">Prevent Alex Box Animations:</label>
					
					</th>';
			
			echo '<td>
					<input type="checkbox"' .
					( get_option('dismissalertbox_preventanimation') == '1' ? 'checked': '') .
					' id="dismissalertbox_preventanimation" name="dismissalertbox_preventanimation" value="1" />
				</td>
			</tr>';
			
			echo '<tr>
				<td>';
			
			submit_button();
			echo '</td></tr>';
			 ?>
			</tbody>
		</table>
	</form>
	
</div>