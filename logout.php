<?php

require 'includes/init.php';

Auth::logout();

Url::redirect('/cms_from_scratch_php/index.php');
