<?php
require '../vendor/autoload.php';

use Aws\Ec2\Ec2Client;

$profiles = [
	'profile-1',
	'profile-2'
];

forEach($profiles as $profile){
	//Login
	$ec2Client = new Ec2Client([
		'region' => 'us-east-2',
		'version' => '2016-11-15',
		'profile' => $profile
	]);


	// LIST Instances
	$result = $ec2Client->describeInstances();

	forEach($result["Reservations"] as $EC2){
		echo sprintf("Instance id: %s, Private IP: %s\n", 
			$EC2["Instances"][0]["InstanceId"], 
			$EC2["Instances"][0]["PrivateIpAddress"]); 
	}
}

exit();
