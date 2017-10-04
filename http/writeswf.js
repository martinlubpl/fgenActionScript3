function writeswf(swfname)
{
document.write('<!-- saved from url=(0013)about:internet -->\n');
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="933" height="686" id="fotogen2006" align="middle">\n');
document.write('<param name="allowScriptAccess" value="sameDomain" />\n');
document.write('<param name="movie" value="'+swfname+'" /><param name="menu" value="false" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />\n');
document.write('<embed src="'+swfname+'" menu="false" quality="high" bgcolor="#ffffff" width="933" height="686" name="fotogen2006" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\n');
document.write('</object>\n');
}

