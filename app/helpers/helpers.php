<?php

########################## HELPER FUNCTION FOR FLASH MESSAGES ####
class FlashMessage {

	public static  function DisplayAlert($message, $type) {
		return "<h4 class='alert alert-".$type."' style='text-align: center'>$message</h4>";
	}
}