<?php
	require_once("includes/general.php");
	require_once("classes/FileSystems/FileFactory.php");
	require_once("classes/FileSystems/LocalFileImpl.php");


	$data = array();
	verifyAccess($mcImageManagerConfig);
	$path = getRequestParam("path", toUnixPath($mcImageManagerConfig['filesystem.path']));
	$rootpath = getRequestParam("rootpath", toUnixPath($mcImageManagerConfig['filesystem.rootpath']));
	$action = getRequestParam("action", "");
	$dirname = getRequestParam("dirname", false);
	$template = getRequestParam("template", "");
	$fileFactory =& new FileFactory($mcImageManagerConfig, $rootpath);
	$targetFile =& $fileFactory->getFile($path);
	$config = $targetFile->getConfig();

	addFileEventListeners($fileFactory);

	$data['path'] = $path;
	$data['demo'] = checkBool($config['general.demo']) ? "true" : "false";
	$data['demo_msg'] = $config['general.demo_msg'];
	$data['short_path'] = getUserFriendlyPath($path, 30);
	$data['full_path'] = getUserFriendlyPath($path);
	$data['dirname'] = $dirname;
	$data['template'] = $template;
	$data['errorMsg'] = "";
	$data['dir_path'] = "";

	$templates = explode(',', $config['filesystem.directory_templates']);
	$data['templates'] = array();
	foreach ($templates as $templateName) {
		if ($templateName != "")
			$data['templates'][basename($templateName)] = $templateName;
	}

	// Do action
	if ($action == "submit") {
		// No access, tool disabled
		if (in_array("createdir", explode(',', $config['general.disabled_tools'])))
			die("You don't have access to perform the requested action.");

		// Do nothing in demo mode
		if (checkBool($config['general.demo']))
			die("This application is running in demostration mode, this action is restricted.");

		// No dirname specified
		if (!$dirname) {
			$data['errorMsg'] = "Error: You must specify a directory name.";
			renderPage("createdir.tpl.php", $data);
		}

		// No template selected
		if ((!$template && count(array_keys($templates)) > 1) && checkBool($config['filesystem.force_directory_template'])) {
			$data['errorMsg'] = "Error: You must select a directory template.";
			renderPage("createdir.tpl.php", $data);
		}

		if ($template != "") {
			$templateFile =& $fileFactory->getFile($template);
			if (!$templateFile->exists() || $template == "" || $template === false) {
				$data['errorMsg'] = "Error: Template file could not be found.";
				renderPage("createdir.tpl.php", $data);
			}
		}

		$file =& $fileFactory->getFile($path, $dirname, MC_IS_DIRECTORY);

		// Setup first filter
		$fileFilterA =& new BasicFileFilter();
		$fileFilterA->setIncludeDirectoryPattern($config['filesystem.include_directory_pattern']);
		$fileFilterA->setExcludeDirectoryPattern($config['filesystem.exclude_directory_pattern']);
		if (!$fileFilterA->accept($file)) {
			$data['errorMsg'] = "Error: The name of the directory you are trying to create is invalid.";
			renderPage("createdir.tpl.php", $data);
		}

		// Setup second filter
		$fileFilterB =& new BasicFileFilter();
		$fileFilterB->setIncludeDirectoryPattern($config['createdir.include_directory_pattern']);
		$fileFilterB->setExcludeDirectoryPattern($config['createdir.exclude_directory_pattern']);
		if (!$fileFilterB->accept($file)) {
			$data['errorMsg'] = "Error: The name of the directory you are trying to create is invalid.";
			renderPage("createdir.tpl.php", $data);
		}

		if ($file->exists()) {
			$data['errorMsg'] = 'Error: Directory "' . $file->getName() . '" exists.';
			renderPage("createdir.tpl.php", $data);
		}

		if ($template != "" && $templateFile->exists())
			$templateFile->copyTo($file);
		else
			$file->mkdir();

		$data['dir_path'] = $file->getAbsolutePath();
	}
	
	// Render output
	renderPage("createdir.tpl.php", $data);
?>
