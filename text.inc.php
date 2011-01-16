<?php
/**
* Hold functions that generate text output.
*
* @author Douglas Muth <http://www.dmuth.org/>
*/


/**
* Convert the list of dealer tables into tab-delimited text.
*
* @param array $rows An array of rows of dealer tables.
*
* @return string tab-delimited text, with a header.
*/
function anthrocon_dealers_get_tables_sold_text($rows) {

	$retval = "";

	//
	// Our column delimiter
	//
	$delimiter = "\t";

	//
	// Our row delimiter.
	//
	$end = "\r\n";

	foreach ($rows as $key => $value) {

		$line = "";

		//
		// First time around?  Generate our header row.
		//
		if (empty($retval)) {
			$retval .= join($delimiter, array_keys($value)) . $end;
		}

		//
		// Now grab the values for this row.
		//
		$retval .= join($delimiter, array_values($value)) . $end;

	}

	return($retval);

} // End of anthrocon_dealers_get_tables_sold_text()



