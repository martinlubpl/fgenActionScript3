/**
 * imagetools.js
 *
 * @author Moxiecode
 * @copyright Copyright � 2005, Moxiecode Systems AB, All rights reserved.
 */

function keepSessionAlive() {
	var img = new Image();

	img.src = "session_keepalive.php?rnd=" + new Date().getTime();

	window.setTimeout('keepSessionAlive();', 1000 * 60);
}

keepSessionAlive();

function execFileCommand(command, value) {
	if (isDisabled(command))
		return;

	// If command disabled then do nothing
	if (!isCommandEnabled(command))
		return;

	switch (command) {
		case "createdir":
			openPop("createdir.php?path=" + escape(path), 350, 250);
			break;

		case "upload":
			openPop("upload.php?path=" + escape(path), 500, 430, "yes");
			break;

		case "refresh":
			if (typeof(value) != "undefined")
				document.location.href = "images.php?path="+ escape(value) +"&formname="+ formname +"&elementnames="+ elementnames +"&js="+ js +"&rnd="+ new Date().getTime();
			else
				document.location.reload();

			break;
		case "filemanager":
			document.location.href = filemanger_urlprefix + "/frameset.php?path="+ escape(full_path) +"&formname="+ formname +"&elementnames="+ elementnames +"&js="+ js +"";
		break;
	}
}

function isCommandEnabled(command) {
	var elm = document.getElementById(command);

	return elm && elm.commandEnabled;
}

function isDisabled(command) {
	for (var i=0; i<disabledTools.length; i++) {
		if (command == disabledTools[i])
			return true;
	}

	return false;
}

function setCommandEnabled(command, state) {
	if (isDisabled(command))
		return;

	var elm = document.getElementById(command);
	if (elm)
		elm.commandEnabled = state;

	if (state) {
		setClassLock(command, false);
		switchClass(command, 'mceButtonNormal');
	} else {
		switchClass(command, 'mceButtonDisabled');
		setClassLock(command, true);
	}
}

function addButtonHandlers(element_id) {
	var targetElm = document.getElementById(element_id);
	if (targetElm) {
		targetElm.onmouseover = buttonEventHandler;
		targetElm.onmouseout = buttonEventHandler;
		targetElm.onmouseup = buttonEventHandler;
		targetElm.onmousedown = buttonEventHandler;
	}
}

function buttonEventHandler(e) {
	var isMSIE = (navigator.appName == "Microsoft Internet Explorer");
	e = isMSIE ? window.event : e;
	var srcElm = isMSIE ? e.srcElement : e.target;

	if (typeof(isDisabled) == "undefined")
		return;

	if (isDisabled(srcElm.getAttribute('id')))
		return;

	switch (e.type) {
		case "mouseover":
			switchClass(srcElm.getAttribute('id'), 'mceButtonOver');
			break;

		case "mouseup":
		case "mouseout":
			switchClass(srcElm.getAttribute('id'), 'mceButtonNormal');
			break;

		case "mousedown":
			switchClass(srcElm.getAttribute('id'), 'mceButtonDown');
			break;
	}
}

function resizeColumn(name1, name2) {
	var elm1 = document.getElementById(name1);
	var elm2 = document.getElementById(name2);

	if (elm2.clientWidth > elm1.clientWidth)
		elm1.width = elm2.clientWidth + 2;
}

function init(error_msg) {
	var isGecko = navigator.userAgent.indexOf('Gecko') != -1;

	disabledTools = disabledTools.split(',');

	// Lock down all tools
	setCommandEnabled('filemanager', true);
	setCommandEnabled('createdir', hasWriteAccess);
	setCommandEnabled('refresh', true);
	setCommandEnabled('upload', hasWriteAccess);
	addButtonHandlers('filemanager');
	addButtonHandlers('createdir');
	addButtonHandlers('refresh');
	addButtonHandlers('upload');

	fixImagesBug();

	if (error_msg != "")
		alert(error_msg);
}

function updateToolbar() {
	// Show hide tools
	if (hasWriteAccess) {
		setCommandEnabled('delete', true);
		setCommandEnabled('upload', true);
	} else {
		setCommandEnabled('delete', false);
		setCommandEnabled('upload', false);
	}
}