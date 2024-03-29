<?php
require_once('access.php');
require_once('header.php');
?>
<script type="text/javascript">
	function newLocation(){
    	d = document.Location;
    	d.lid.value = "";
    	d.cname.value = "";
    	d.cparent.value = "";
    	d.action.value ="new";
    	d.submitLocation.value ="<?php _e("New Location");?>";
    	document.getElementById("form-tab").innerHTML ="<?php _e("New Location");?>";
    	show("formLocation");
    	location.href = "#formLocation";
    }	
    function editLocation(lid,cparent){
    	d = document.Location;
    	d.lid.value = lid;
    	d.cname.value = document.getElementById('name-'+lid).innerHTML;
    	d.cparent.value = cparent;
    	d.action.value ="edit";
    	d.submitLocation.value ="<?php _e("Edit Location");?>";
    	document.getElementById("form-tab").innerHTML ="<?php _e("Edit Location");?>";
    	show("formLocation");
    	location.href = "#formLocation";
    }	
    function deleteLocation(Location){
    	if (confirm('<?php _e("Delete Location");?> "' + document.getElementById('name-'+Location).innerHTML + '"?'))
    	window.location = "locations.php?action=delete&lid=" + Location;
    }
</script>
<?php if (!LOCATION) echo T_('Locations are disabled, please go to the settings to enable this feature.').'<br />';?>

<h2><?php _e("Locations");?></h2>

<?php
function catSlug($name,$id=""){ //try to prevent duplicated Locations
    $ocdb=phpMyDB::GetInstance();
    $name=friendly_url($name);
    
    if (is_numeric($id)) $query="SELECT friendlyName FROM ".TABLE_PREFIX."locations where (friendlyName='$name') and (idLocation <> $id) limit 1";
    else $query="SELECT friendlyName FROM ".TABLE_PREFIX."locations where (friendlyName='$name') limit 1";
    $res=$ocdb->getValue($query,"none");
    
    if ($res!=false){//exists try adding with parent id
        $name.='-'.cP("cparent");  
        $res=$ocdb->getValue("SELECT friendlyName FROM ".TABLE_PREFIX."locations where friendlyName='$name' limit 1","none");//now with the new location name
    }
    
    if ($res==false) return $name;
    else return false;	
}
//actions
if (cP("action")!=""||cG("action")!=""){
    $action=cG("action");
    if ($action=="")$action=cP("action");
    if (!is_numeric($_POST['cparent']))  $_POST['cparent']=0;
    
    if ($action=="new"){
        $nameSlug=catSlug(cP("cname"));
        if ($nameSlug!=false){  //no exists insert
            $ocdb->insert(TABLE_PREFIX."locations (name,friendlyName,idLocationParent)",
                        "'".cP("cname")."','$nameSlug',".cP("cparent"));
        }
        else _e("Location already exists");
    }
    elseif ($action=="delete"){
    	
    	if ( is_numeric(cG('plid')) && is_numeric(cG('lid')) ){//move posts
			$ocdb->update(TABLE_PREFIX.'posts',array('idLocation'=>cG('plid')),'idLocation='.cG('lid'));
			$countposts=0;
		}
		else{//counting how many posts
			$query = "select count(*) from ".TABLE_PREFIX."posts where idLocation=".cG("lid");
			$countposts=$ocdb->getValue($query);
		}
		
		if ( is_numeric(cG('mlid')) && is_numeric(cG('lid')) ){//move location parent
			$ocdb->update(TABLE_PREFIX.'locations',array('idLocationParent'=>cG('mlid')),'idLocationParent='.cG('lid'));
			$siblings=0;
		}
		else{
			$query = "select count(*) from ".TABLE_PREFIX."locations where idLocationParent=".cG("lid");
			$siblings=$ocdb->getValue($query);
		}

		if ($siblings>0){
			echo '<b>'.T_('There´s locations that belong to the selected location').'</b><br />';
			echo '<form  action="locations.php" method="get" >'.$siblings.' '.T_('Move them to').':';
				$query="SELECT idLocation,name FROM ".TABLE_PREFIX."locations  where idLocationParent=0 and idLocation!=".cG('lid')." order by idLocationParent, idLocation";
				sqlOptionGroup($query,"mlid","0",T_("None"));
			echo '<input type="hidden" name="lid" value="'.cG("lid").'" />
				<input type="hidden" name="action" value="delete" />
				<input type="submit" class="button-submit" /></form><hr><br /><br />';	
		}
		elseif ($countposts>0){
			echo '<b>'.T_('There´s posts that belong to the selected location').'</b><br />';
			echo '<form  action="locations.php" method="get" >'.$countposts.' '.T_('Move them to').':';
				$query="SELECT idLocation,name,(select name from ".TABLE_PREFIX."locations where idLocation=C.idLocationParent) FROM ".TABLE_PREFIX."locations C where idLocation!=".cG('lid')." order by idLocationParent, idLocation";
				sqlOptionGroup($query,"plid","0",T_("None"));
			echo '<input type="hidden" name="lid" value="'.cG("lid").'" />
				<input type="hidden" name="action" value="delete" />
				<input type="submit" class="button-submit" /></form><hr><br /><br />';
			
		}
		else  $ocdb->delete(TABLE_PREFIX."locations","idLocation=".cG("lid"));
       // echo "Deleted";
    }
    elseif ($action=="edit"){
        $nameSlug=catSlug(cP("cname"),cP("lid"));
        if ($nameSlug!=false){  //no exists update
            $query="update ".TABLE_PREFIX."locations set name='".cP("cname")."',friendlyName='$nameSlug',idLocationParent=".cP("cparent")." where idLocation=".cP("lid");
            $ocdb->query($query);
        }
        else _e("Location already exists");
        //echo "Edit: $query";
    }
	elseif ($action=="filter" && is_numeric(cG("lid"))){
		$filter = ' and idLocationParent='.cG("lid");
	}
    if (CACHE_DEL_ON_CAT) deleteCache();//delete cache on category if is activated
}
?>
<p class="desc"><?php _e("Manage your website locations");?>
<?php 
		echo '<form  action="locations.php" method="get" >';
    $query="SELECT idLocation,name FROM ".TABLE_PREFIX."locations  where idLocationParent=0 order by idLocationParent, idLocation";
    sqlOption($query,"lid",cG("lid"),T_("None"));
		echo'<input type="hidden" name="action" value="filter" />
			<input type="submit" class="button-submit" value="'.T_('Filter').'" /></form>';	
	?></p>
<div id='formLocation' style="display:none;">
	<div id="form-tab" class="form-tab"></div>
	<div class="clear"></div>
    <form name="Location" action="locations.php" method="post" onsubmit="return checkForm(this);">
		<fieldset>
			<p>
				<label><?php _e("Name");?></label>
				<input name="cname" type="text" class="text-long" lang="false" onblur="validateText(this);" />
			</p>                          
			<p>
				<label><?php _e("Parent");?></label>
        <?php 
        $query="SELECT idLocation,name,(select name from ".TABLE_PREFIX."locations where idLocation=C.idLocationParent) FROM ".TABLE_PREFIX."locations C order by idLocationParent, idLocation";
        sqlOptionGroup($query,"cparent","0",T_("None"));
        ?>
			</p>
			<input id="submitLocation" type="submit" value="" class="button-submit" />
			<input type="submit" value="<?php _e("Cancel");?>" class="button-cancel" onclick="hide('formLocation');return false;" />
			<input type="hidden" name="lid" value="" />
			<input type="hidden" name="action" value="" />
		</fieldset>
    </form>            
</div>
<div class="add_link"><a href="" onclick="newLocation();return false;"><?php _e("New Location");?></a></div>
<table>
	<tr class="thead">
		<td><?php _e("Name");?></td>
		<td><?php _e("Parent");?></td>
		<td>&nbsp;</td>
	</tr>
	<?php 
        $result = $ocdb->query("SELECT *,(select name from ".TABLE_PREFIX."locations  where idLocation=C.idLocationParent) ParentName 
                            FROM ".TABLE_PREFIX."locations C where 6=6 ".$filter." order by  idLocationParent");
		$row_count = 0;
        while ($row = mysql_fetch_array($result)){
        	$name = $row["name"] ;
        	$idLocation=$row["idLocation"];
        	$parent=$row["idLocationParent"];
        	$parentName=$row["ParentName"];
        	if ($parentName=="") $parentName="None";

        	$row_count++;
        	if ($row_count%2 == 0) $row_class = 'class="odd"';
        	else $row_class = 'class="even"';
    ?>
	<tr <?php echo $row_class;?>>      
		<td><?php echo $name;?></td>
		<td><?php echo $parentName;?></td>
		<td class="action">
        	<a href="" onclick="editLocation('<?php echo $idLocation; ?>','<?php echo $parent;?>');return false;" class="edit"><?php _e("Edit");?></a> 
        	| <a href="" onclick="deleteLocation('<?php echo $idLocation;?>');return false;" class="delete"><?php _e("Delete");?></a>
        </td>
	</tr>
	<div style="display:none;" id="name-<?php echo $idLocation; ?>"><?php echo $name;?></div>
	
	<?php } ?>
</table>
<?php
require_once('footer.php');
?>