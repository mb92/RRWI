<?php
 yii::setAlias('@upld', 'localhost/upload');
 
return [
    'adminEmail' => 'admin@example.com',

	'email-host' => 'smtp.mailtrap.io',
	'email-username' => '638f257e3a8555',
	'email-password' => '8d470dafa0a2a5',
	'email-port' => '2525',
	'email-encryption' => 'tls',
	'email-subject' => "Your selfie!!"

    // 'components' => [
    // 	'mailer' => [
    //             'class' => 'yii\swiftmailer\Mailer',
    //             // 'viewPath' => '/layouts/email',
    //             'messageConfig' => [
    //                 'from' => 'xyyy0107@gmail.com',
    //             ],
    //             'useFileTransport' => false,
    //             // 'enableSwiftMailerLogging' => true,
    //             'transport' => [
    //                 'class' => 'Swift_SmtpTransport',
    //                 'host' => 'smtp.mailtrap.io',
    //                 'username' => '638f257e3a8555',
    //                 'password' => '8d470dafa0a2a5',
    //                 'port' => '2525',
    //                 'encryption' => 'tls',
    //                             ],
    //                 ],
    //             // 'transport' => [
    //             //     'class' => 'Swift_SmtpTransport',
    //             //     'host' => 'smtp.gmail.com',
    //             //     'username' => 'xyyy0107@gmail.com',
    //             //     'password' => 'Devdeliver123',
    //             //     'port' => '587',
    //             //     'encryption' => 'tls',
    //             //                 ],
    //             // ],
    // ]
];
