<?php
/* Check for admin Options submission and update options*/
if ('process' == $_POST['stage']) 
{
    update_option('yaft_api_key', $_POST['yaft_api_key']);
	update_option('yaft_secret', $_POST['yaft_secret']);
	update_option('yaft_nsid', $_POST['yaft_nsid']);
	//update_option('yaft_use_lightbox', $_POST['yaft_use_lightbox']);
	update_option('yaft_use_lightbox', false);
}

?>

<div class="wrap">
  <h2>YAFT Options</h2>
  <form name="form1" method="post" action="<?php echo $yaft_options_page ?>&amp;updated=true">
	<input type="hidden" name="stage" value="process" />
    <table width="100%" cellspacing="0" cellpadding="0" class="form-table">
		<tr>    
		    <th scope="row">API Key</th> 
        	<td>
		        <?php $yaft_api_key = get_option('yaft_api_key');?>
				<input type="text" name="yaft_api_key" value="<?=$yaft_api_key?>" size="35" />
        	</td>
        </tr>
		<tr>
			<th scope="row">Secret</th> 
        	<td>
		        <?php $yaft_secret = get_option('yaft_secret');?>
				<input type="text" name="yaft_secret" value="<?=$yaft_secret?>" size="30" />
        	</td>
        </tr>
		<tr>
			<th scope="row">User Id (NSID)</th> 
        	<td>
		        <?php $yaft_nsid = get_option('yaft_nsid');?>
				<input type="text" name="yaft_nsid" value="<?=$yaft_nsid?>" size="30" />
        	</td>
        </tr>
		<!--<tr>
			<th scope="row">Use Lightbox</th> 
        	<td>
		        <?php 
					$yaft_use_lightbox = get_option('yaft_use_lightbox');
					$checked = $yaft_use_lightbox==true ? 'checked' : '';
				?>

				<input type="checkbox" name="yaft_use_lightbox" value="true" <?=$checked?>/>
        	</td>
        </tr>-->
     </table>

    <p class="submit">
      <input type="submit" name="Submit" value="Save Changes" />
    </p>
  </form>
</div>