<?= '<?xml version="1.0" encoding="iso-8859-1"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sv" xml:lang="sv">
<head>
<title> Create directory </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="themes/default/css/dialog.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="themes/default/jscripts/general.js"></script>
<script language="javascript" type="text/javascript">
var demo = <?= $this->data['demo'] ?>;
var demoMsg = "<?= $this->data['demo_msg'] ?>";
var dirPath = "<?= $this->data['dir_path'] ?>";

<? if ($this->data['dirname'] && !$this->data['errorMsg']) { ?>
	if (window.opener)
		window.opener.execFileCommand("refresh", dirPath);

	top.close();
<? } ?>

function init() {
<? if ($this->data['errorMsg']) { ?>
	alert('<?=$this->data['errorMsg']?>');
<? } ?>
}

function verifyForm() {
	if (demo) {
		alert(demoMsg);
		return false;
	}

	return true;
}
</script>
</head>
<body onload="init();">
<form name="createdir" method="post" action="createdir.php" onsubmit="return verifyForm();">
<div class="mcBorderBottomWhite">
	<div class="mcHeader mcBorderBottomBlack">
		<div class="mcWrapper">
			<div class="mcHeaderLeft">
				<div class="mcHeaderTitle">Create directory</div>
				<div class="mcHeaderTitleText">Insert the name of the directory you wish to create.</div>
			</div>
			<div class="mcHeaderRight">&nbsp;</div>
			<br style="clear: both" />
		</div>
	</div>
</div>
<div class="mcContent">
	<table border="0" cellspacing="0" cellpadding="4" width="100">
<? if (count($this->data['templates']) > 1) { ?>
	  <tr>
		<td nowrap="nowrap">Template: </td>
		<td>
		<select name="template" style="width: 200px" <?=(count($this->data['templates']) > 0 ? '' : 'disabled="disabled"')?>>
		  <option value="" selected>-- Select template --</option>
<? foreach ($this->data['templates'] as $title => $path) { ?>
		  <option value="<?=$path?>" <?=($path == $this->data['template'] ? "SELECTED" : "")?>><?=$title?></option>
<? } ?>
		</select></td>
	  </tr>
<? } ?>
	  <tr>
		<td nowrap="nowrap">Directory name:</td>
		<td><input id="dirname" name="dirname" type="text" class="inputText" size="35" maxlength="100" style="width: 200px" value="<?=$this->data['dirname']?>" /></td>
	  </tr>
	  <tr>
		<td nowrap="nowrap">Create in:</td>
		<td><span title="<?=$this->data['full_path']?>"><?=$this->data['short_path']?></span></td>
	  </tr>
	</table>
	<input type="hidden" name="path" value="<?=$this->data['path']?>" />
	<input type="hidden" name="action" value="submit" />
</div>
<div class="mcFooter mcBorderTopBlack">
	<div class="mcBorderTopWhite">
		<div class="mcWrapper">
			<div class="mcFooterLeft"><input type="submit" name="Submit" value="Create" class="button" /></div>
			<div class="mcFooterRight"><input type="button" name="Cancel" value="Cancel" class="button" onclick="top.close();" /></div>
			<br style="clear: both" />
		</div>
	</div>
</div>
</form>
</body>
</html>
