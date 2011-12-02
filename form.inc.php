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

	$products = anthrocon_dealers_get_products("Select a Product");

	$nid = variable_get("anthrocon_dealers_nid", "");
	$retval["tables"]["nid"] = array(
		"#type" => "select",
		"#title" => t("Product"),
		"#options" => $products,
		"#default_value" => $nid,
		);

	$retval["tables"]["update_product"] = array(
		"#type" => "submit",
		"#value" => t("Change Product"),
		);

	if ($nid) {
		$retval["tables"]["download"] = array(
			"#type" => "submit",
			"#value" => t("Download This List"),
			);

		$retval["tables"]["browser_dump"] = array(
			"#type" => "checkbox",
			"#title" => t("Dump to browser instead. (for testing/debugging purposes)"),
			);

	}

	return($retval);

} // End of anthrocon_dealers_form()


/**
* Our form submission handler.
*/
function anthrocon_dealers_form_submit($form, $form_state) {

	//print "<pre>"; print_r($form_state); print "</pre>"; // Debugging
	//print "<pre>"; print_r($form_state["values"]); print "</pre>"; // Debugging

	//
	// What button did we click?
	//
	$op = $form_state["values"]["op"];
	$nid = $form_state["values"]["nid"];
	$dump = $form_state["values"]["browser_dump"];

	variable_set("anthrocon_dealers_nid", $nid);

	//
	// If we clicked the "change product" button, stop here.
	//
	if ($op == t("Change Product")) {
		drupal_set_message("Product updated to NID $nid");
		return(null);
	}

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


