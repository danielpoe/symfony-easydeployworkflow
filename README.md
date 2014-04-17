Kickstart for a Symfony Deploymentscript based on EasyDeployWorkflows
----------------------------

1) Usage to kickstart your deploymentscript
----------------------------

* Clone this repository
* Run "composer install"
* Rename "YOURPROJECTNAME" to the real name of your project

    * Rename Folder in "Configuration" Folder
    * Rename $project variable in deploy.php
    * Configure correct Source in Configuration/YOURPROJECTNAME/local.php

* Delete "vendor" from .gitignore folder
* Add everything to git repository and commit it to your new remote Deployment Repository

2) Test and tune your deployment script
----------------------------
### Prepare your infrastructure:
* Create a release folder (This is where new releaseversions are installed to)
* Create a vHost and be sure the webroot symlinks to the /releases/current symlink
* If your application needs more from the infrastructure, then prepare this (e.g. Databases and Access...)

-----------------------

Create a script "set_YOURPROJECTNAME_dependencies.sh" (or something comparable) that exposes the relevant environmentvariables, that the deployment and the installation needs to know:


	#!/bin/bash
	export RELEASEBASEFOLDER=/delivery
	export DELIVERYFOLDER=/releases
	export DBHOST=localhost
	export DBUSER=***
	export DBPASSWORD=***
	export DBNAME=***


### Run your deployment:


	git clone YOURREMOTEDEPLOYMENTREPOSITORY
	set_YOURPROJECTNAME_dependencies.sh
	php deploy.php --version=1 --environment=local

