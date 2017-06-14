<?php
yii::setAlias('@upld', 'localhost/upload');
yii::setAlias('@upload', '../upload');
yii::setAlias('@temp', '../temp');

return [
    'adminEmail' => 'admin@example.com',
    'email-notifications' => "xyyy0107@gmail.com",
    // /*mailtrap.io*/
	// 'email-host' => 'smtp.mailtrap.io',
	// 'email-username' => '35df5d719029f0',
	// 'email-password' => '4778d5f21e78d0',
	// 'email-port' => '2525',
	// 'email-encryption' => 'tls',
	// 'email-subject' => "Your selfie!!",

	// /*gmail*/
	'email-host' => 'smtp.gmail.com',
	'email-username' => 'xyyy0107@gmail.com',
	'email-password' => 'Devdeliver123',
	'email-port' => '587',
	'email-encryption' => 'tls',
	'email-subject' => "Your selfie!!"

];
