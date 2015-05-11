<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

@session_start() ;

$returnInt=NULL ;

//Only include module include if it is not already included (which it may be been on the index page)
$included=FALSE ;
$includes=get_included_files() ;
foreach ($includes AS $include) {
	if ($include==$_SESSION[$guid]["absolutePath"] . "/modules/Free Learning/moduleFunctions.php") {
		$included=TRUE ;
	}
}
if ($included==FALSE) {
	include "./modules/Free Learning/moduleFunctions.php" ;
}

if (isActionAccessible($guid, $connection2, "/modules/Free Learning/report_unitHistory_byStudent.php")==FALSE) {
	//Acess denied
	$returnInt.="<div class='error'>" ;
		$returnInt.="You do not have access to this action." ;
	$returnInt.="</div>" ;
}
else {
	$returnInt.="<p>" ;
		$returnInt.=_('The table below shows recent results for Free Learning units studied by your child:') ;
	$returnInt.="</p>" ;
	$returnInt.=getStudentHistory($connection2, $guid, $gibbonPersonID, TRUE) ;	
}

return $returnInt ;
?>