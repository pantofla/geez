<?php
// header
	$lang['installer'] = 'Installer';
	$lang['Welcome'] = 'Welcome';
	$lang['Install'] = 'Install';
	$lang['Upgrade'] = 'Upgrade';
	$lang['Troubleshooter'] = 'Troubleshooter';
	$lang['Admin'] = 'Admin';
	$lang['Step'] = 'Step';

// intro / step 1
	$lang['WelcomeToInstaller'] = '<h2>Welcome to the Pligg Installer!</h2>';
	$lang['Introduction'] = 'Introduction';
	$lang['WelcomeToThe'] = '<p>Welcome to the <a href="http://www.pligg.com" target="_blank">Pligg CMS</a>. Before installing Pligg please make sure that you have the latest version of Pligg by checking the <a href="http://forums.pligg.com/current-version/" target="_blank">Current Version forum</a>.</p>';
	$lang['Bugs'] = '<p>While you are visiting <a href="http://www.pligg.com/">pligg.com</a>, please register on our forum to gain access to free templates and modules. By creating an account and marking modules and templates as installed you will be notified of important Pligg updates as they become available. We also appreciate it when you take time to <a href="http://forums.pligg.com/projects.html">report bugs</a> so that we can make Pligg a more stable product.</p>';
	$lang['Installation'] = '<h3>Installation</h3>';
	$lang['OnceFamiliar'] = '<p>Once you have familiarized yourself with the installation process for Pligg by reading the included <a href="../readme.html">Readme</a> file, proceed to the next step to begin installing Pligg.</p>';

// step 2
	$lang['EnterMySQL'] = '<strong>Enter your MySQL database settings below:</strong>';
	$lang['DatabaseName'] = 'Database Name';
	$lang['DatabaseUsername'] = 'Database Username';
	$lang['DatabasePassword'] = 'Database Password';
	$lang['DatabaseServer'] = 'Database Server';
	$lang['TablePrefix'] = 'Table Prefix';
	$lang['PrefixExample'] = '(ie: "pligg_" makes the tables for users become pligg_users)';
	$lang['CheckSettings'] = 'Check Settings';
	$lang['Errors'] = 'Please fix the above error(s), install halted!';

// step 3
	$lang['ConnectionEstab'] = '<p>Database connection established...</p>';
	$lang['FoundDb'] = '<p>Found database...</p>';
	$lang['dbconnect'] = '<p>\'/libs/dbconnect.php\' was updated successfully.</p>';
	$lang['NoErrors'] = '<p>There were no errors, continue onto the next step...</p>';
	$lang['Next'] = 'Next';
	$lang['GoBack'] = 'Go Back';
	$lang['Error2-1'] = '<p>Could not write to \'libs/dbconnect.php\' file.</p>';
	$lang['Error2-2'] = '<p>Could not open \'/libs/dbconnect.php\' file for writing.</p>';
	$lang['Error2-3'] = '<p>Connected to the database, but the database name is incorrect.</p>';
	$lang['Error2-4'] = '<p>Cannot connect to the database <b>server</b> using the information provided.</p>';

// step 4
	$lang['CreatingTables'] = '<p><strong>Creating database tables...</strong></p>';
	$lang['TablesGood'] = '<p><strong>Tables were created successfully!</strong></p><hr />';
	$lang['Error3-1'] = '<p>There was a problem creating the tables.</p>';
	$lang['Error3-2'] = '<p>Could not connect to database.</p>';
	$lang['EnterGod'] = '<p><strong>Enter your admin account details below:</strong><br />Please write down this account information because it will be needed to log in and configure your site.</p>';
	$lang['GodLogin'] = 'Admin Login';
	$lang['GodPassword'] = 'Admin Password';
	$lang['ConfirmPassword'] = 'Confirm Password';
	$lang['GodEmail'] = 'Admin E-mail';
	$lang['CreateAdmin'] = 'Create Admin Account';

// Step 5
	$lang['Error5-1'] = 'Please fill all fields for admin account.';
	$lang['Error5-2'] = 'Password copies do not match.';

// footer
	$lang['ThankYou'] = 'Thank you for downloading the Pligg Content Management System. Please review this page before proceeding to the installation page. If you have any questions or comments, please leave us a message on the <a href="http://www.pligg.com/forum/" target="_blank">Pligg Forum</a>.';
	$lang['UsefulLinks'] = 'Here are some useful links related to Pligg:';


// Upgrade
	$lang['UpgradeTop'] = '<h2>Upgrade</h2>';
	$lang['UpgradeHome'] = 'This upgrade script will update the MySQL database of a previously installed version of Pligg.<br />Please make sure that you have made a backup of your database information before proceeding.<br /><br /><strong>Note:</strong> this is only a database upgrade, you will still need to upload the new files.<br />';
	$lang['UpgradeAreYouSure'] = 'Are you sure you wish to upgrade you database? It will make permanent changes to your database.';
	$lang['UpgradeYes'] = 'Proceed';

	$lang['UpgradingTables'] = '<h2>Upgrading Tables...</h2>';
	$lang['IfNoError'] = 'If there were no errors displayed, upgrade is complete!';
	$lang['PleaseFix'] = 'Please fix the above error(s), upgrade halted!';
?>

