<?php

class AppController extends Controller {
	var $components = array('DebugKit.Toolbar','Session');
	var $helpers = array('Session','Html','Form');
}
?>