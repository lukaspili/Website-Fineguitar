<?php
require_once('access.php');
require_once('header.php');

function accountCheck($key,$id=""){ //try to prevent duplicated accounts
	$ocdb=phpMyDB::GetInstance();    
    if (is_numeric($id)) $query="SELECT email FROM ".TABLE_PREFIX."accounts where (email='$key') and (idAccount <> $id) limit 1";
    else $query="SELECT email FROM ".TABLE_PREFIX."accounts where (email='$key') limit 1";
    $res=$ocdb->getValue($query,"none");
    
    return $res;	
}
?>
<script type="text/javascript">
	function newAccount(){
		d = document.Account;
		d.account.value = "";
		d.name.value = "";
		d.email.value = "";
		d.action.value ="new";
		d.submitAccount.value ="<?php _e("New Account");?>";
		document.getElementById("form-tab").innerHTML ="<?php _e("New Account");?>";
		show("formAccount");
		location.href = "#formAccount";
	}	
	function editAccount(account, name, email){
		d = document.Account;
		d.account.value = account;
		d.name.value = name;
		d.email.value = email;
		d.action.value ="edit";
		d.submitAccount.value ="<?php _e("Update Account");?>";
		document.getElementById("form-tab").innerHTML ="<?php _e("Update Account");?>";
		show("formAccount");
		location.href = "#formAccount";
	}	
</script>
<?php if (!LOGON_TO_POST) echo T_('Accounts (Logon to Post) are disabled, please go to the settings to enable this feature.').'<br />';?>
<h2><?php _e("Accounts list");?></h2>
<div id='formAccount' style="display:none;">
	<div id="form-tab" class="form-tab"></div>
	<div class="clear"></div>
	<form name="Account" action="" method="post" onsubmit="return checkForm(this);">
		<fieldset>
			<p>
				<label><?php _e("Name");?></label>
				<input name="name" type="text" class="text-long" lang="false" onblur="validateText(this);" xml:lang="false" />
			</p>
			<p>
				<label><?php _e("Email");?></label>
				<input name="email" type="text" class="text-long" lang="false" onblur="validateText(this);" xml:lang="false" />
			</p>        
			<input id="submitAccount" type="submit" value="<?php _e("Submit");?>" class="button-submit" />
			<input type="submit" value="<?php _e("Cancel");?>" class="button-cancel" onclick="hide('formAccount');return false;" />
			<input type="hidden" name="account" value="" />
			<input type="hidden" name="action" value="" />
		</fieldset>
	</form>
</div>
<div class="add_link"><a href="" onclick="newAccount();return false;"><?php _e("New Account");?></a></div>
<table>
	<tr class="thead">
		<td><?php _e("Name");?></td>
		<td><?php _e("Email");?></td>
		<td><?php _e("Active");?></td>
		<td><?php _e("Date Created");?></td>
		<td>&nbsp;</td>
	</tr>
	<?php 
		if ($_POST){
            $action=trim(cP("action"));
            $account_id=trim(cP("account"));
            $name=trim(cP("name"));
            $email=trim(cP("email"));
            
            if ($action=="new"){
                $account = new Account($email);
                if ($account->exists){
                    echo "<div id='sysmessage'>".T_("Account already exists")."</div>";
                }
                else {
                    $password=generatePassword(8);
               
                    if ($account->Register($name,$email,$password)){
                        $token=$account->token();
    
                        if ($account->Activate($token)){
                            $message='<p>'.T_("Your new account information").'</p>
                            <p><label>'.T_("Email").': '.$account->email.'</label><br/>
                            <label>'.T_("Password").': '.$password.'</label></p>';
                            
                            $array_content[]=array("ACCOUNT", $account->name);
                            $array_content[]=array("MESSAGE", $message);
                            
                            $bodyHTML=buildEmailBodyHTML($array_content);
                            
                            sendEmail($email,T_("Your new account")." - ".SITE_NAME,$bodyHTML);//
         
                            echo "<div id='sysmessage'>".T_("Account succesfully created")."</div>";
                        } else echo "<div id='sysmessage'>".T_("An unexpected error has occurred trying to confirm the account")."</div>";
                    } else echo "<div id='sysmessage'>".T_("An unexpected error has occurred trying to register the account")."</div>";
                }
            }
            if (is_numeric($account_id)){
                if ($action=="edit"){                
                    if (!accountCheck($email,$account_id)){  //no exists update
                    $ocdb->update(TABLE_PREFIX."accounts","name='$name',email='$email'","idAccount=$account_id");
                    
                    $message='<p>'.T_("Your account has been updated").'</p>
                    <label>'.T_("Name").': '.$name.'</label></p><br/>                
                    <p><label>'.T_("Email").': '.$email.'</label>';
                    
                    $array_content[]=array("ACCOUNT", T_("User"));
                    $array_content[]=array("MESSAGE", $message);
                    
                    $bodyHTML=buildEmailBodyHTML($array_content);
                    
                    sendEmail($email,T_("Your account has been updated")." - ".SITE_NAME,$bodyHTML);//
                    
                    echo "<div id='sysmessage'>".T_("Account succesfully updated")."</div>";
                    }
                    else echo "<div id='sysmessage'>".T_("Account already exists")."</div>";
                }
            }
        } else {
            $action=trim(cG("action"));
            $account_id=trim(cG("account"));
            $email=trim(cG("amail"));
            
            if (is_numeric($account_id)){
                if ($action=="activate"){
                    $ocdb->update(TABLE_PREFIX."accounts","active=1","idAccount=$account_id");
                    
                    $action_notify=T_("Activated");
                    
                    echo "<div id='sysmessage'>".T_("Account successfully activated")."</div>";
                } elseif ($action=="deactivate"){ 
                    $ocdb->update(TABLE_PREFIX."accounts","active=0","idAccount=$account_id");
                    
                    //deactivate related posts
                    $ocdb->update(TABLE_PREFIX."posts","isAvailable=0","email='$email'");
                    if (CACHE_DEL_ON_POST) deleteCache();//delete cache
                    
                    $action_notify=T_("Deactivated");
                    
                    echo "<div id='sysmessage'>".T_("Account successfully deactivated")."</div>";
                } elseif ($action=="delete"){
                    $ocdb->delete(TABLE_PREFIX."accounts","idAccount=$account_id");
                    
                    //delete related posts
                    $query="SELECT idPost FROM ".TABLE_PREFIX."posts
                        where email='$email'";
                    $resultSearch=$ocdb->getRows($query);	
                    if ($resultSearch){
                        foreach ( $resultSearch as $row ){
                            $idPost=$row['idPost'];
                            deletePostImages($idPost);//delete images! and folder
                        }
                    }
                    $ocdb->delete(TABLE_PREFIX."posts","email='$email'");
                    if (CACHE_DEL_ON_POST) deleteCache();//delete cache
    
                    $action_notify=T_("Removed");
                    
                    echo "<div id='sysmessage'>".T_("Account successfully removed")."</div>";
                }
                
                if ($action_notify!="" && $email!=""){
                    $message='<p>'.T_("Your account has been updated").'</p><br/>
                    <label>'.T_("Actions performed").': '.$action_notify.'</label></p>';
                    
                    $array_content[]=array("ACCOUNT", T_("User"));
                    $array_content[]=array("MESSAGE", $message);
                    
                    $bodyHTML=buildEmailBodyHTML($array_content);
                    
                    sendEmail($email,T_("Your account has been updated")." - ".SITE_NAME,$bodyHTML);//
                }
            }
        }
        
        if (cG("name")!=""){
            $filter.= " and a.name like '%".cG("name")."%' ";
        }
        if (cG("email")!=""){
            $filter.= " and a.email like '%".cG("email")."%' ";
        }
        
        $order="a.createdDate Desc";
        
        //pagination
        $query="SELECT count(a.idAccount) total	FROM ".TABLE_PREFIX."accounts a
                WHERE 1 $filter";
        $total_records = $ocdb->getValue($query);//query to get total of records
        $records_per_page = ITEMS_PER_PAGE;//how many records per page displayed
        $total_pages = ceil($total_records / $records_per_page);//total pages to display
        if ($page < 1 || $page > $total_pages) $page = 1;//controlling that the page have a valid value
        $offset = ($page - 1) * $records_per_page;//position where we need to display
        $limit = " LIMIT $offset, $records_per_page";//sql to attach IMPORTANT
        //end pagination
    
        $query="SELECT a.idAccount,a.name,a.email,a.createdDate,a.active FROM ".TABLE_PREFIX."accounts a
                WHERE 1 $filter
                order by $order $limit";
        //echo $query;
        $resultSearch=$ocdb->getRows($query,"assoc","none");				
    
        if ($resultSearch){
			$row_count = 0;
			foreach ( $resultSearch as $row ){
				$idAccount=$row['idAccount'];
				$name=$row['name'];//
				$email=$row['email'];//
				$insertDate=setDate($row['createdDate']);
				$active=$row['active'];//
				
				$row_count++;
				if ($row_count%2 == 0) $row_class = 'class="odd"';
				else $row_class = 'class="even"';
?>
	<tr <?php echo $row_class;?>>      
		<td><?php echo $name;?></td>
		<td><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></td>
		<td><?php if($active) echo "yes"; else echo "no";?></td>
		<td><?php echo $insertDate;?></td>
		<td class="action">
        	<a href="" onclick="editAccount('<?php echo $idAccount; ?>', '<?php echo $name;?>', '<?php echo $email;?>');return false;" class="edit"><?php _e("Edit");?></a> | 
			<?php if ($active){?>
            <a onclick="return confirm('<?php _e("Deactivate");?>?');" href="?account=<?php echo $idAccount;?>&amp;amail=<?php echo $email;?>&amp;action=deactivate"><?php _e("Deactivate");?></a> | 
            <?php } else {?>
            <a onclick="return confirm('<?php _e("Activate");?>?');" href="?account=<?php echo $idAccount;?>&amp;amail=<?php echo $email;?>&amp;action=activate"><?php _e("Activate");?></a> | 
            <?php }?>
			<a onclick="return confirm('<?php _e("Delete");?>?');" href="?account=<?php echo $idAccount;?>&amp;amail=<?php echo $email;?>&amp;action=delete" class="delete"><?php _e("Delete");?></a>
		</td>
	</tr>
	<?php 
			}
        }//end if check there's results
		else echo "<p>".T_("Nothing found")."</p>";
    ?>
</table>
<div class="pagination">&nbsp;
<?php //page numbers
    if ($total_pages>1){
		$pag_title=$html_title." ".T_PAGE." ";
		
		$pag_url="/adminfg/accounts.php";

		//getting the url
		if(strlen(cG("name"))>=1 || strlen(cG("email"))>=1){
			$pag_url.='?name='.cG("name").'&email='.cG("email").'&page=';
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
<form name="ocForm" id="ocForm" action="" method="get">
	<fieldset>
        <p>
        	<label><?php _e("Name");?></label>
            <input name="name" type="text" class="text-long" value="<?php echo cG("name");?>" />
		</p>
		<p>
        	<label><?php _e("Email");?></label>
            <input name="email" type="text" class="text-long" value="<?php echo cG("email");?>" />
		</p>
		<input type="submit" value="<?php _e("Search");?>" class="button-submit" />
	</fieldset>
</form>
<?php
require_once('footer.php');
?>
