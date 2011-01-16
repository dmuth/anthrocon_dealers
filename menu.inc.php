<?php
/**
* Functions relating to our menu and permissions.
*
* @author Douglas Muth <http://www.dmuth.org/>
*/

/**
* Return an array of permissions for this module.
*/
function anthrocon_dealers_perm() {
	$retval = array("view dealer table sales");
	return($retval);
}


/**
* Return an array of menu options.
*/
function anthrocon_dealers_menu() {

	$retval = array();

	$retval["admin/dealer"] = array(
		"title" => "View Dealer Tables",
		"page callback" => "anthrocon_dealers_main",
		"access arguments" => array("view dealer table sales"),
		);

	return($retval);

} // End of anthrocon_dealers_menu()



