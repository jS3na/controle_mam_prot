<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * The user name of the git hub user who owns the repo
 */
$config['github_user'] = 'js3na';

/**
 * The repo on GitHub we will be updating from
 */
$config['github_repo'] = 'controle_mam_prot';

/**
 * The branch to update from
 */
$config['github_branch'] = 'master';


$config['current_commit'] = '53d35385917658bab3e048622325429d993f00de';


$config['ignored_files'] = [];


$config['clean_update_files'] = true;
