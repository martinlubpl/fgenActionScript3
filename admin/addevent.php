<?php
include("head.php");
bar("ADD NEW EVENT");
?>


<form action="events.php" enctype="multipart/form-data" id="addEvForm"
	method="POST"><input type="hidden" name="action" value="addevent">
<table align="center">
	<tr>
		<td>
		<table>
			<tr>
				<td><b>TITLE:</b></td>
				<td><input name="title" type="text"
					style="font-family: Verdana; font-size: 10px; color: #333333" /></td>
				<td><b> &nbsp;&nbsp;&nbsp;&nbsp;DATE:</b></td>
				<td><input id="event_date" name="event_date" size="20"
					maxlength="20" type="text" style="color: #333333" /> <img
					src="datechooser/calendar.gif"
					onclick="showChooser(this, 'event_date', 'chooserSpan', 2000, 2015, Date.patterns.ISO8601LongPattern, true);" />
				<div id="chooserSpan" class="dateChooser select-free"
					style="display: none; visibility: hidden; width: 160px;"></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><b>EVENT BODY:</b></td>
	</tr>
	<tr>
		<td><textarea style="color: #333333; width: 500px" name=content
			rows=15>sasdasd</textarea></td>
	</tr>
	<tr>
		<td><b>UPLOAD IMAGE:</b> <br>
		Image should be jpeg 166 * 235 px. Otherwise image will be cropped or
		scaled.</td>
	</tr>
	<tr>
		<td><input type="file" id="event_file" name="event_file"
			style="font-family: verdana; font-size: 10px; color: #333333" /></td>
	</tr>
	<tr>
		<td>
		<table>
			<tr>
				<td><input type="checkbox" name="archive" id="archive" value="1"></td>
				<td><label for="archive">archive item ???</label></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><br>
		<br>
		<input style="color: #333333" type="submit" value="Add Event"></td>
	</tr>
</table>
</form>

<?	
print '<br><br>';
//bar ("ALL EVENTS");





?>





<?
include("foot.php");
?>