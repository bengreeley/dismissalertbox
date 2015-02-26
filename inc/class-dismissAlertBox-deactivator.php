<?php

// Functions/hooks for plugin deactivation process for cleaning up of any settings.
class dismissAlertBox_Deactivator {

	public static function deactivate() {
		unregister_setting( 'dismissalertbox-group', 'dismissalertbox_hideonclose' );
		unregister_setting( 'dismissalertbox-group', 'dismissalertbox_preventanimation' );
	}
}