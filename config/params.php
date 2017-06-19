<?php
yii::setAlias('@upld', 'localhost/upload');
yii::setAlias('@upload', '../upload');
yii::setAlias('@temp', '../temp');

return [
    'adminEmail' => 'admin@example.com',
    'email-notifications' => "sara@flipsidegroup.com",

	// /*gmail*/
	// 'email-host' => 'smtp.gmail.com',
	// 'email-username' => 'lorem.ipsum.dnd@gmail.com',
	// 'email-password' => 'zaq12wsxcde3',
	// 'email-port' => '587',
	// 'email-encryption' => 'tls',
	// 'email-subject' => "Your selfie!"

	
	'email-host' => 'smtp.gmail.com',
	'email-username' => 'lorem.ipsum.dnd@gmail.com',
	'email-password' => 'zaq12wsxcde3',
	'email-port' => '587',
	'email-encryption' => 'tls',
	'email-subject' => "Your selfie!"

];
