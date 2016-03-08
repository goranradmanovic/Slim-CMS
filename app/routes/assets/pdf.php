<?php

$app->get('/assets/pdf', $authenticated(), function () use ($app) {
	
	//Novi pdf dokumenat
	$pdf = $app->pdf;

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Goran Radmanovic');
	$pdf->SetTitle('All Users Table');
	$pdf->SetSubject('All Users Table');
	$pdf->SetKeywords('Users, PDF, Data, Table');
	
	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	$pdf->setFooterData(array(0,64,0), array(0,64,128));

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set font
	$pdf->SetFont('helvetica', '', 9);

	// add a page
	$pdf->AddPage();

	$pdf->Write(0, 'All Users Table', '', 0, 'L', true, 0, false, false, 0);

	//Set content to display. Table head
	$thead= '<table border="1" cellpadding="2" cellspacing="2" nobr="true">
				<thead>
					<tr bgcolor="#eee" align="center" style="">
						<th><strong><em>Username</em></strong></th>
						<th><strong><em>Full Name</em></strong></th>
						<th><strong><em>Acitve</em></strong></th>
						<th><strong><em>Admin</em></strong></th>
						<th><strong><em>Moderator</em></strong></th>
						<th><strong><em>Can Post</em></strong></th>
					</tr>
				</thead>';

	//Table end (footer)
	$tend = '</table>';

	//Table body - content
	$tbody = '';

	//Querrying for all users from users table in the database
	$users = $app->user->query('SELECT users.id,username,first_name,last_name,active,users_permissions.user_id,users_permissions.is_admin,
								users_permissions.is_moderator,users_permissions.can_post_topic 
								FROM users LEFT JOIN users_permissions ON users.id = users_permissions.user_id')->get();

	//Pulling data for each user
	foreach($users as $user)
	{
		$tbody .= '<tbody>
						<tr style="" bgcolor="#eee8aa" align="center">
							<td>' . $user->username . '</td>
							<td>' . $user->getFullName() . '</td>
							<td>' . $user->active . '</td>
							<td>' . $user->isAdmin() . '</td>
							<td>' . $user->isModerator() . '</td>
							<td>' . $user->canPostTopic() . '</td>
						</tr>
					</tbody>';
	}

	//Writting HTML
	$pdf->writeHTML($thead . $tbody . $tend, true, false, false, false, '');

	// close and output PDF document
	$pdf->Output('All_Users_Table.pdf', 'D');

})->name('assets.pdf');

?>