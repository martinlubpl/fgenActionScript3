<?php
	require_once("includes/general.php");
	require_once("includes/toolbar.php");
	require_once("classes/FileSystems/LocalFileImpl.php");

	$errorMsg = getRequestParam("errorMsg", "");
	// Get path and config
	verifyAccess($mcImageManagerConfig);

	$path = removeTrailingSlash(getRequestParam("path", ""));
	$url = getRequestParam("url", "");
	$rootpath = removeTrailingSlash(getRequestParam("rootpath", toUnixPath(getRealPath($mcImageManagerConfig, 'filesystem.rootpath'))));
	$fileFactory =& new FileFactory($mcImageManagerConfig, $rootPath);

	// Handle URL
	if ($url != "") {
		// Is absolute URL
		if (strpos($url, $mcImageManagerConfig['preview.urlprefix']) === 0) {
			// Trim away prefix
			$path = substr($url, strlen($mcImageManagerConfig['preview.urlprefix'])-1);

			// Add rest to wwwroot
			$path = toUnixPath(getWWWRoot($mcImageManagerConfig)) . $path;
		}

		// Try step 2
		if ($path == "") {
			$tmppath = toUnixPath(getWWWRoot($mcImageManagerConfig)) . $url;
			if ($fileFactory->verifyPath($tmppath)) {
				$file = $fileFactory->getFile($tmppath);

				if ($file->exists())
					$path = $file->getAbsolutePath();
			}
		}

		// Try step 2
		if ($path == "") {
			$tmppath = toUnixPath(getRealPath($mcImageManagerConfig, 'filesystem.rootpath')) . $url;
			if ($fileFactory->verifyPath($tmppath)) {
				$file = $fileFactory->getFile($tmppath);

				if ($file->exists())
					$path = $file->getAbsolutePath();
			}
		}
	}

	if ($path == "") {
		if (isset($_SESSION['mc_imagebrowser_lastpath']))
			$path = $_SESSION['mc_imagebrowser_lastpath'];
		else
			$path = toUnixPath(getRealPath($mcImageManagerConfig, 'filesystem.path'));
	}

	// Invalid path, use root path
	if (!$fileFactory->verifyPath($path))
		$path = $rootpath;

	$targetFile =& $fileFactory->getFile($path);

	// Check if it's exits use root instead
	if (!$targetFile->exists())
		$targetFile =& $fileFactory->getFile(getRealPath($mcImageManagerConfig, 'filesystem.path'));

	if ($targetFile->isFile()) {
		$anchor = basename($path);
		$path = $targetFile->getParent();
		$targetFile =& $targetFile->getParentFile();
	} else
		$anchor = "none";

	$rootFile =& $fileFactory->getFile($rootpath);

	$config = $targetFile->getConfig();
	addFileEventListeners($fileFactory);

	// Save away path
	$_SESSION['mc_imagebrowser_lastpath'] = $path;
	$selectedPath = getUserFriendlyPath($path);

	// Get rest of input
	$action = getRequestParam("action");
	$value = getRequestParam("value", "");
	$formname = getRequestParam("formname", "");
	$elementnames = getRequestParam("elementnames", "");
	$isGD = gdExists();

	$selectedFiles = array();
	foreach ($_REQUEST as $name => $value) {
		if (strpos($name, "file_") !== false || strpos($name, "dir_") !== false)
			$selectedFiles[] =& $fileFactory->getFile($value);
	}

	// Do action
	switch ($action) {
		case "delete":
		// No access, tool disabled
		if (!in_array("delete", explode(',', $config['thumbnail.image_tools'])))
			die("You don't have access to perform the requested action.");

		if (checkBool($config['general.demo']))
			break;

			$canread = false;
			$canwrite = false;
			foreach ($selectedFiles as $file) {
				$canread = $file->canRead() && checkBool($config["filesystem.readable"]) ? true : false;
				$canwrite = $file->canWrite() && checkBool($config["filesystem.writable"]) ? true : false;

				if ($canwrite) {
					// Check for Thumbnail
					if ($config['thumbnail.gd.delete'] == true) {
						$th_folder = "/". $config['thumbnail.gd.folder'];
						$th_folder = dirname($file->getAbsolutePath()) . $th_folder;
						$thFolder = $fileFactory->getFile($th_folder);
						if ($thFolder->exists()) {
							$th_path = $thFolder->getAbsolutePath() . "/" . $config['thumbnail.gd.prefix'] . basename($file->getAbsolutePath());
							$th = $fileFactory->getFile($th_path);

							if ($th->exists())
								$th->delete();
						}
					}
					$file->delete();
				}
				else
					$errorMsg = "No write access on this file/folder.";
			}
			header("Location: images.php?path=". $path ."&errorMsg=". $errorMsg);
			die();
			break;
	}

	$data = array();
	$data['rootpath'] = $rootpath;

	// Get filtered dirs, deep
	$fileFilter =& new BasicFileFilter();
	$fileFilter->setIncludeDirectoryPattern($config['filesystem.include_directory_pattern']);
	$fileFilter->setExcludeDirectoryPattern($config['filesystem.exclude_directory_pattern']);
	$fileFilter->setOnlyDirs(true);

	$treeHandler =& new ConfigFilteredFileTreeHandler();
	$treeHandler->setOnlyDirs(true);

	$rootFile->listTree($treeHandler);
	$dirsFiltered =& $treeHandler->getFileArray();
	// end

	if (!is_array($dirsFiltered))
		$dirsFiltered = array();

	$dirs = array();
	// End filter run

	$dirList = array();
	$evenDir = true;
	foreach($dirsFiltered as $dir) {
		$dirItem = array();
		
		$dirPath = $dir->getAbsolutePath();
		$dirItem['even'] = $evenDir;
		$dirItem['abs_path'] = $dirPath;
		$dirItem['path'] = getUserFriendlyPath($dirPath);

		$evenDir = !$evenDir;
		$dirList[] = $dirItem;
	}
	$dirsFiltered = array();

	// Get filtered files
	$fileFilter =& new BasicFileFilter();
	$fileFilter->setIncludeDirectoryPattern($config['filesystem.include_directory_pattern']);
	$fileFilter->setExcludeDirectoryPattern($config['filesystem.exclude_directory_pattern']);
	$fileFilter->setIncludeFilePattern($config['filesystem.include_file_pattern']);
	$fileFilter->setExcludeFilePattern($config['filesystem.exclude_file_pattern']);
	$fileFilter->setOnlyFiles(true);
	$files =& $targetFile->listFilesFiltered($fileFilter);

	$fileList = array();
	$even = true;


// List files
	foreach ($files as $file) {
		if ($file->isDirectory())
			continue;

		$fileItem = array();
		$imageSize = array();
		$filepath = $file->getAbsolutePath();
		$fileItem['margin'] = 0;

		$imageSize = getimagesize($file->getAbsolutePath());
		$fileItem['real_width'] = $imageSize[0];
		$fileItem['real_height'] = $imageSize[1];

		// calculate percentage width and height
		if ($config['thumbnail.scale_mode'] == "percentage") {
			if ($config['thumbnail.height'] > $config['thumbnail.width'])
				$target = $config['thumbnail.width'];
			else
				$target = $config['thumbnail.height'];

			$imageSize = imageResize($imageSize[0], $imageSize[1], $target);

			$fileItem['width'] = $imageSize['width'];
			$fileItem['height'] = $imageSize['height'];
			$fileItem['scale'] = $imageSize['scale'];

			// Calculate margin
			if (($config['thumbnail.height'] - $imageSize['height']) > 0)
				$fileItem['margin'] = (($config['thumbnail.height'] - $imageSize['height']) / 2);
	
		} else {
			$fileItem['width'] = $config['thumbnail.width'];
			$fileItem['height'] = $config['thumbnail.height'];
			$fileItem['scale'] = 0;
		}

		$fileItem['name'] = basename($file->getAbsolutePath());
		$fileItem['path'] = $file->getAbsolutePath();
		$fileItem['size'] = getSizeStr($file->length());
		$fileItem['modificationdate'] = date($config['filesystem.datefmt'], $file->lastModified());
		$fileItem['even'] = $even;
		$fileItem['hasReadAccess'] = $file->canRead() && checkBool($config["filesystem.readable"]) ? "true" : "false";
		$fileItem['hasWriteAccess'] = $file->canWrite() && checkBool($config["filesystem.writable"]) ? "true" : "false";

		// File info
		$fileType = getFileType($file->getAbsolutePath());
		$fileItem['icon'] = $fileType['icon'];
		$fileItem['type'] = $fileType['type'];
		$fileItem['ext'] = $fileType['ext'];
		$fileItem['editable'] = $isGD && ($fileType['ext'] == "gif" || $fileType['ext'] == "jpg" || $fileType['ext'] == "jpeg" || $fileType['ext'] == "png");

		// Preview path
		$wwwroot = removeTrailingSlash(toUnixPath(getWWWRoot($config)));
		$urlprefix = removeTrailingSlash(toUnixPath($config['preview.urlprefix']));
		$urlsuffix = toUnixPath($config['preview.urlsuffix']);

		$fileItem['previewurl'] = "";
		$pos = strpos($filepath, $wwwroot);
		if ($pos !== false && $pos == 0)
			$fileItem['previewurl'] = $urlprefix . substr($filepath, strlen($wwwroot)) . $urlsuffix;
		else
			$fileItem['previewurl'] = "ERROR IN PATH";

		if (($fileItem['editable'] == true) AND (checkBool($config['thumbnail.gd.enabled']) == true))
			$fileItem['url'] = "thumbnail.php?path=". $fileItem['path'] ."&width=". $fileItem['width'] ."&height=". $fileItem['height'] ."&ext=". $fileItem['ext'];
		else
			$fileItem['url'] = $fileItem['previewurl'];

		$even = !$even;
		$fileList[] = $fileItem;
	}

	$data['files'] = $fileList;
	$data['path'] = $path;
	$data['hasReadAccess'] = $targetFile->canRead() ? "true" : "false";
	$data['hasWriteAccess'] = $targetFile->canWrite() ? "true" : "false";

	$toolbarCommands = explode(',', $config['general.toolbar']);
	$tools = array();
	foreach ($toolbarCommands as $command) {
		foreach ($toolbar as $tool) {
			if ($tool['command'] == $command)
				$tools[] = $tool;
		}
	}

	$imageTools = array();
	$imageTools = explode(',', $config['thumbnail.image_tools']);

	$information = array();
	$information = explode(',', $config['thumbnail.information']);

	$data['js'] = getRequestParam("js", "");
	$data['formname'] = getRequestParam("formname", "");
	$data['elementnames'] = getRequestParam("elementnames", "");
	$data['disabled_tools'] = $config['general.disabled_tools'];
	$data['image_tools'] = $imageTools;
	$data['toolbar'] = $tools;
	$data['full_path'] = $path;
	$data['errorMsg'] = $errorMsg;
	$data['selectedPath'] = $selectedPath;
	$data['dirlist'] = $dirList;
	$data['anchor'] = $anchor;
	$data['exif_support'] = exifExists();
	$data['gd_support'] = $isGD;
	$data['edit_enabled'] = checkBool($config["thumbnail.gd.enabled"]);
	$data['demo'] = checkBool($config["general.demo"]);
	$data['demo_msg'] = $config["general.demo_msg"];
	$data['information'] = $information;
	$data['extension_image'] = checkBool($config["thumbnail.extension_image"]);
	$data['insert'] = checkBool($config["thumbnail.insert"]);
	$data['filemanager_urlprefix'] = removeTrailingSlash($config["filemanager.urlprefix"]);
	$data['thumbnail_width'] = $config['thumbnail.width'];
	$data['thumbnail_height'] = $config['thumbnail.height'];
	$data['thumbnail_border_style'] = $config['thumbnail.border_style'];
	$data['thumbnail_margin_around'] = $config['thumbnail.margin_around'];

	renderPage("images.tpl.php", $data);
?>