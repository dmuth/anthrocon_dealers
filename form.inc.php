<?php
/**
* Hold code that relates to forms.
*
* @author Douglas Muth <http://www.dmuth.org/>
*/


/**
* Generate our form for viewing/downloading dealer tables.
*/
function anthrocon_dealers_form() {

	$retval = array();

	$retval["tables"] = array(
		"#type" => "fieldset",
		"#title" => t("Dealer Tables"),
		);

	$retval["tables"]["download"] = array(
		"#type" => "submit",
		"#value" => t("Download This List"),
		);

	$retval["tables"]["browser_dump"] = array(
		"#type" => "checkbox",
		"#title" => t("Dump to browser instead. (for testing/debugging purposes)"),
		);

	return($retval);

} // End of anthrocon_dealers_form()


/**
* Our form submission handler.
*/
function anthrocon_dealers_form_submit($form, $form_state) {

	//print "<pre>"; print_r($form_state); print "</pre>"; // Debugging

	//
	// What button did we click?
	// We'll need this if we add more buttons later.
	//
	$op = $form_state["values"]["op"];
	$dump = $form_state["values"]["browser_dump"];

	//
	// Retrieve our current tables sold.
	//
	$rows = anthrocon_dealers_get_tables_sold();

	//
	// Get tab-delimited text
	//
	$text = anthrocon_dealers_get_tables_sold_text($rows);


	if (!$dump) {
		//
		// Start a download in the user's browser
		//
		$header = "Content-Type: octet/stream";
		drupal_set_header($header);

		$filename = "dealer_orders.txt";
		$header = "Content-Disposition: attachment; filename=\"$filename\"";
		drupal_set_header($header);

	} else {
		//
		// We're dumping to the browser. Formatting time!
		//
		print "<pre>";

	}

	//
	// And print up our text!
	//
	print $text;

	//
	// Not sure if I have to put an exit() call here or not.
	// For now, this seems to be working without any issues in Google Chrome.
	//

} // End of anthrocon_dealers_submit()


