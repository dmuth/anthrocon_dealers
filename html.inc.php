<?php
/**
* Hold functions that generate our HTML output.
*
* @author Douglas Muth <http://www.dmuth.org/>
*/

/**
* Theme up our sold tables in HTML tables.
*
* @param array $data An array of rows
*
* @return string HTML code
*/
function anthrocon_dealers_get_tables_sold_html($data) {

	$retval = "";

	$header = array(t("Order ID"), t("Cost"), t("Name"), t("Dealership"), t("Table Size"));
	$rows = array();
	$attributes = array();

	foreach ($data as $key => $value) {
		$row = array();
		$row[] = array("align" => "right", "data" => $value["order_id"]);
		$row[] = array(
			"align" => "right",
			"data" => "$" . number_format($value["order_total"], 2)
			);
		$row[] = $value["billing_first_name"] 
			. " " . $value["billing_last_name"];
		$row[] = $value["attribute-Name of Dealership"];
		$row[] = $value["attribute-Table Size"];

		$rows[] = $row;

	}

	$retval = theme("table", $header, $rows, $attributes);

	return($retval);

} // End of anthrocon_dealers_get_tables_sold_html()


