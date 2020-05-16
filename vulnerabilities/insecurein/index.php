<?php

function field($label, $name, $type)
{
	return "
		<div class='form-group'>
			<label>".$label."</label>
			<input type=".$type." class='form-control' name=".$name.">
		</div>
	";
}


define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Insecure Input' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'insecurein';
$page[ 'help_button' ]   = 'insecurein';
$page[ 'source_button' ] = 'insecurein';

dvwaDatabaseConnect();

$method            = 'POST';
$vulnerabilityFile = 'low.php';
$ticket_price = 15;
$total_amount = 0;
/*
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		$method = 'POST';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}
*/

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/insecurein/source/{$vulnerabilityFile}";


$page[ 'body' ] .= "
<div class=\"body_padded\" class='col-md-6'>
	<h1>Insecure DOR (Order Tickets)</h1> 

	<div class=\"vulnerable_code_area\">";

	$page[ 'body' ] .= "
		<form action=\"#\" method=\"{$method}\" >
			<p>";
	$page[ 'body' ] .= "
	
	<p>How many movie tickets would you like to order? ($ticket_price EUR per ticket)</p>
        
	<p>I would like to order <input type='text' name='ticket_quantity' value='1' size='2'> tickets.</p>
	
	<input type='hidden' name='ticket_price' value='$ticket_price'>
	
	";

	$page[ 'body' ] .= "\n				<input type=\"submit\" class='btn btn-primary' name=\"Submit\" value=\"Submit\">
			</p>\n";

	$page[ 'body' ] .= "
		</form>";

if (isset($user)){
	$page[ 'body' ] .= "$user";
}

	$page[ 'body' ] .= "
			{$html}
		</div>


	</div>\n";


$page[ 'body' ] .= 
"<div>
	<div class='info'>
		<p>You ordered <b>$ticket_quantity</b> movie tickets.</p>
		<p>Total amount charged from your account automatically: <b>$total_amount EUR</b>.</p>
		<p>Thank you for your order!</p>
		<p></p>
	</div>		
</div>";
$page[ 'body' ] .= 
"<div>
		<h2>More Information</h2>
		<ul>
			<li>" . dvwaExternalLinkUrlGet( 'https://owasp.org/www-project-top-ten/OWASP_Top_Ten_2017/Top_10-2017_A5-Broken_Access_Control' ) . "</li>
		</ul>
</div>";
dvwaHtmlEcho( $page );

?>
