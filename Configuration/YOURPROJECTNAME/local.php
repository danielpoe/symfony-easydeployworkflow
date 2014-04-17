<?php

/**
 * Specify the Source of the artifact that should be installed.
 * Check https://github.com/AOEpeople/EasyDeployWorkflows/tree/refactorworkflows for a list of available sources.
 * (The source should take the "releaseversion" into account - to point to the correct version of course)
 */
$source = new \EasyDeployWorkflows\Source\File\JenkinsArtifactSource();
$source
    ->setJenkinsBaseUrl('http://YOUR-JENKINSURL')
    ->setJobName('YOURPROJECTNAME_build')
    ->setBuildNr('###releaseversion###')
    ->setArtifactFileName('YOURPROJECTNAME.tar.gz')
    ->setUser('YOURJENKINSUSER_WITH_CORRECT_PERMISSIONS')
    ->setPassword('YOURJENKINSUSER_PASSWORD');

$projectConfiguration = new EasyDeployWorkflows\Workflows\Application\ReleaseFolderApplicationConfiguration();
$projectConfiguration
        ->addInstallServer('localhost')
        ->setReleaseBaseFolder('###ENV:RELEASEBASEFOLDER###')
		->setSource($source)
		->setDeliveryFolder('###ENV:DELIVERYFOLDER###')
		->setSetupCommand('setup/setup.sh');

$checkPhp = new EasyDeployWorkflows\Tasks\Common\RunCommand();
$checkPhp->setCommand('php app/check.php');

$projectConfiguration->addSmokeTestTask('Symfony2 Check.php script',$checkPhp);

//$experiencemanagerConfiguration->addPostSetupTask();
