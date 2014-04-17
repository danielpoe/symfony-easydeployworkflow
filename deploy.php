<?php
/**
 * Binary for deploying a searchperience-backend instance
 * On devbox:
 *  deploy.php --version=12 --environment=local
 */
require_once dirname(__FILE__) . '/vendor/autoload.php';

$source = new EasyDeployWorkflows\Source\File\JenkinsArtifactSource();

$project = 'YOURPROJECTNAME';

$environment = \EasyDeploy_Utils::getParameterOrUserSelectionInput('environment','Which environment do you want to install?',array('local'));
$releaseVersion = \EasyDeploy_Utils::getParameterOrInput('version','Which version?');

$workflowFactory = new EasyDeployWorkflows\Workflows\WorkflowFactory();

try {
    $deploymentWorkflow = $workflowFactory->createByConfigurationVariable($project,$environment,$releaseVersion, 'projectConfiguration');
    $deploymentWorkflow->deploy();
}
catch (\EasyDeployWorkflows\Exception\HaltAndRollback $e) {
    exit(1);
}