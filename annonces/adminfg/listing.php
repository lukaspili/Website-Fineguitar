<?php
require_once('access.php');
require_once('header.php');

//save query string in session to return with proper parameters
$_SESSION['ADMIN_QUERY_STRING'] = remove_querystring_var('rd');

?>
<h2><?php _e("Classified Ads");?></h2>
<?php
//show return action message
$rd=cG("rd");

switch($rd) {
    case 'edit':
        echo "<div id='sysmessage'>".T_("Your Ad was successfully updated")."</div>";
        break;
    case 'activate':
        echo "<div id='sysmessage'>".T_("Your Ad was successfully activated")."</div>";
        break;
    case 'deactivate':
        echo "<div id='sysmessage'>".T_("Your Ad was successfully deactivated")."</div>";
        break;
    case 'spam':
        echo "<div id='sysmessage'>".T_("Spam reported")."</div>";
        break;
    case 'delete':
        echo "<div id='sysmessage'>".T_("Your Ad was successfully deleted")."</div>";
        break;
    default:
        break;
}
?>

<a href="export.php">Exporter les emails</a>


<table>
	<tr class="thead">
		<td><?php _e("Name");?></td>
		<td><?php _e("Email");?></td>
		<td><?php _e("Category");?></td>
        <?php if (COUNT_POSTS){?>
		<td><?php _e("Hits");?></td>
        <?php }?>
		<td><?php _e("Date");?></td>
		<td>&nbsp;</td>
	</tr>
	<?php 
        if ($resultSearch){
			foreach ( $resultSearch as $row ){
				$idPost=$row['idPost'];
				$postType=$row['type'];
				$postTypeName=$row['email'];
				$postTitle=$row['title'];
				$category=$row['category'];//real category name
				$fcategory=$row['fcategory'];//frienfly name category
				$idCategoryParent=$row['idCategoryParent'];
				$fCategoryParent=$row['parent'];
				$postPassword=$row['password'];
				$insertDate=setDate($row['insertDate']);
				$postUrl=itemURL($idPost,$fcategory,$postTypeName,$postTitle,$fCategoryParent);
		
				if (COUNT_POSTS) {
					$itemViews=$ocdb->getValue("SELECT count(idPost) FROM ".TABLE_PREFIX."postshits where idPost=$idPost","none");
				}
    ?>
	<tr>
		<td><a title="<?php echo $postTitle." ".$postTypeName." ".$category;?>" href="<?php echo SITE_URL.$postUrl;?>" ><?php echo $postTitle;?></a></td>
        <td><?php echo '<a href="listing.php?category='.$postType.'" >'.$postTypeName.'</a>';?></td>
        <td><?php echo '<a href="listing.php?category='.$fcategory.'" title="'.$category.' '.$fCategoryParent.'">'.$category.'</a>';?></td>
        <?php if (COUNT_POSTS){?>
        <td><?php echo $itemViews;?></td>
        <?php }?>
        <td><?php echo $insertDate;?></td>
        <td class="action">
        	<a href="<?php echo itemManageURL();?>?post=<?php echo $idPost;?>&amp;pwd=<?php echo $postPassword;?>&amp;action=edit"><?php _e("Edit");?></a> | 
            <a onclick="return confirm('<?php _e("Deactivate");?>?');" href="<?php echo itemManageURL();?>?post=<?php echo $idPost;?>&amp;pwd=<?php echo $postPassword;?>&amp;action=deactivate"><?php _e("Deactivate");?></a> | 
            <a onclick="return confirm('<?php _e("Spam");?>?');" href="<?php echo itemManageURL();?>?post=<?php echo $idPost;?>&amp;pwd=<?php echo $postPassword;?>&amp;action=spam"><?php _e("Spam");?></a> | 
            <a onclick="return confirm('<?php _e("Delete");?>?');" href="<?php echo itemManageURL();?>?post=<?php echo $idPost;?>&amp;pwd=<?php echo $postPassword;?>&amp;action=delete"><?php _e("Delete");?></a>
        </td>
	</tr>
	<?php 
			}
		}//end if check there's results
		else echo "<p>".T_("Nothing found")."</p>";
    ?>
</table>
<div class="pagination">&nbsp;<br />
<?php //page numbers
    if ($total_pages>1){
        //if is a search
        if (strlen(cG("s"))>=MIN_SEARCH_CHAR) $search="&s=".cG("s");
        
        $pag_title=$html_title." ".T_("Page")." ";
        
        $pag_url="/adminfg/listing.php";

        //getting the url
        if(strlen(cG("s"))>=MIN_SEARCH_CHAR){//home with search
            $pag_url.='?s='.cG("s").'&category='.$currentCategory.'&page=';
        }
        elseif ($advs){//advanced search
            $pag_url.="?category=$currentCategory&type=".cG("type")."&title=".cG("title")."&desc=".cG("desc")."&price=".cG("price")."&place=".cG("place")."&sort=".cG("sort")."&page=";
        }
        elseif (isset($type)){ //only set type in the home
            $pag_url.='?type='.$type.'&page=';
        }
        elseif (isset($currentCategory)){//category
            $pag_url.='?category='.$currentCategory.'&page=';
        }
        else {
           $pag_url.='?page=';
        }
        //////////////////////////////////
    
        if ($page>1){
            echo "<a title='$pag_title' href='".SITE_URL.$pag_url."1'>&laquo;&laquo;</a>".SEPARATOR;//First
            echo "<a title='".T_("Previous")." $pag_title".($page-1)."' href='".SITE_URL.$pag_url.($page-1)."'>".T_("Previous")."</a>";//previous
        }
        //pages loop
        for ($i = $page; $i <= $total_pages && $i<=($page+DISPLAY_PAGES); $i++) {//for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) echo SEPARATOR."<b>$i</b>";//not printing link current page
            else echo SEPARATOR."<a title='$pag_title$i' href='".SITE_URL."$pag_url$i'>$i</a>";//print the link
        }
        
        if ($page<$total_pages){
            echo SEPARATOR."<a href='".SITE_URL.$pag_url.($page+1)."' title='".T_("Next")." $pag_title".($page+1)."' >".T_("Next")."</a>";//next
            echo  SEPARATOR."<a title='$pag_title$total_pages' href='".SITE_URL."$pag_url$total_pages'>&raquo;&raquo;</a>";//End
        }
    }	
?>
</div>
<div class="form-tab"><?php _e("Search");?></div>
<div class="clear"></div>
<?php advancedSearchForm(1); ?>
<?php
require_once('footer.php');
?>
