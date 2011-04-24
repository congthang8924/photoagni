<?PHP
// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

check_admin_referer('edit-job');
global $wpdb;	
$jobid = (int) $_REQUEST['jobid'];
$jobs=get_option('backwpup_jobs');
if (empty($jobid)) { //generate a new id for new job
	if (is_array($jobs)) {
		foreach ($jobs as $jobkey => $jobvalue) {
			if ($jobkey>$heighestid) $heighestid=$jobkey;
		}
		$jobid=$heighestid+1;
	} else {
		$jobid=1;
	}
}
$jobvalue=backwpup_check_job_vars($jobs[$jobid],$jobid);
$todo=explode('+',$jobvalue['type']);
$dests=explode(',',strtoupper(BACKWPUP_DESTS));
?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br /></div>
<h2><?php _e('BackWPup Job Settings', 'backwpup'); ?></h2>

<?PHP backwpup_option_submenues(); ?>
<div class="clear"></div>


<form method="post" action="<?PHP echo get_admin_url().'admin.php?page=BackWPup&subpage=edit';?>">
<input type="hidden" name="subpage" value="edit" />
<input type="hidden" name="jobid" value="<?PHP echo $jobid;?>" />
<?php wp_nonce_field('edit-job'); ?>
<div id="poststuff" class="metabox-holder has-right-sidebar">
	<div class="inner-sidebar">
		<div id="side-sortables" class="meta-box-sortables">

			<div id="jobtype" class="postbox">
				<h3 class="hndle"><span><?PHP _e('Job Type','backwpup'); ?></span></h3>
				<div class="inside">
					<?php
					foreach (backwpup_backup_types() as $type) {
						echo "<input class=\"jobtype-select checkbox\" id=\"jobtype-select-".$type."\" type=\"checkbox\"".checked(true,in_array($type,$todo),false)." name=\"type[]\" value=\"".$type."\"/> ".backwpup_backup_types($type);
					}
					?>


				</div>
				<div id="major-publishing-actions">
					<div id="delete-action">
					<a class="submitdelete deletion" style="color:red" href="<?PHP echo wp_nonce_url('admin.php?page=BackWPup&action=delete&jobid='.$jobid, 'delete-job_'.$jobid); ?>" onclick="if ( confirm('<?PHP echo esc_js(__("You are about to delete this Job. \n  'Cancel' to stop, 'OK' to delete.","backwpup")); ?>') ) { return true;}return false;"><?php _e('Delete', 'backwpup'); ?></a>
					</div>
					<div id="publishing-action">
						<input type="submit" name="submit" class="button-primary right" accesskey="s" value="<?php _e('Save Changes', 'backwpup'); ?>" />
					</div>
					<div class="clear"></div>
				</div>
			</div>

			<div id="jobschedule" class="postbox">
				<h3 class="hndle"><span><?PHP _e('Job Schedule','backwpup'); ?></span></h3>
				<div class="inside">
					<input class="checkbox" value="1" type="checkbox" <?php checked($jobvalue['activated'],true); ?> name="activated" /> <?PHP _e('Activate scheduling', 'backwpup'); ?><br />
					<?PHP list($cronstr['minutes'],$cronstr['hours'],$cronstr['mday'],$cronstr['mon'],$cronstr['wday'])=explode(' ',$jobvalue['cron'],5);    ?>
					<div style="width:85px; float: left;">
						<b><?PHP _e('Minutes: ','backwpup'); ?></b><br />
						<?PHP 
						if (strstr($cronstr['minutes'],'*/'))
							$minutes=explode('/',$cronstr['minutes']);
						else
							$minutes=explode(',',$cronstr['minutes']);
						?>
						<select name="cronminutes[]" id="cronminutes" style="height:65px;" multiple="multiple">
						<option value="*"<?PHP selected(in_array('*',$minutes,true),true,true); ?>><?PHP _e('Any (*)','backwpup'); ?></option>
						<?PHP
						for ($i=0;$i<60;$i=$i+5) {
							echo "<option value=\"".$i."\"".selected(in_array("$i",$minutes,true),true,false).">".$i."</option>";
						}
						?>
						</select>
					</div>
					<div style="width:85px; float: left;">
						<b><?PHP _e('Hours:','backwpup'); ?></b><br />
						<?PHP 
						if (strstr($cronstr['hours'],'*/'))
							$hours=explode('/',$cronstr['hours']);
						else
							$hours=explode(',',$cronstr['hours']);
						?>
						<select name="cronhours[]" id="cronhours" style="height:65px;" multiple="multiple">
						<option value="*"<?PHP selected(in_array('*',$hours,true),true,true); ?>><?PHP _e('Any (*)','backwpup'); ?></option>
						<?PHP
						for ($i=0;$i<24;$i++) {
							echo "<option value=\"".$i."\"".selected(in_array("$i",$hours,true),true,false).">".$i."</option>";
						}
						?>
						</select>
					</div>
					<div style="width:85px; float: right;">
						<b><?PHP _e('Days:','backwpup'); ?></b><br />
						<?PHP 
						if (strstr($cronstr['mday'],'*/'))
							$mday=explode('/',$cronstr['mday']);
						else
							$mday=explode(',',$cronstr['mday']);
						?>
						<select name="cronmday[]" id="cronmday" style="height:65px;" multiple="multiple">
						<option value="*"<?PHP selected(in_array('*',$mday,true),true,true); ?>><?PHP _e('Any (*)','backwpup'); ?></option>
						<?PHP
						for ($i=1;$i<=31;$i++) {
							echo "<option value=\"".$i."\"".selected(in_array("$i",$mday,true),true,false).">".$i."</option>";
						}
						?>
						</select>
					</div>
					<br class="clear" />
					<div style="width:130px; float: left;">
						<b><?PHP _e('Day of Month:','backwpup'); ?></b><br />
						<?PHP 
						if (strstr($cronstr['mon'],'*/'))
							$mon=explode('/',$cronstr['mon']);
						else
							$mon=explode(',',$cronstr['mon']);
						?>
						<select name="cronmon[]" id="cronmon" style="height:65px;" multiple="multiple">
						<option value="*"<?PHP selected(in_array('*',$mon,true),true,true); ?>><?PHP _e('Any (*)','backwpup'); ?></option>
						<option value="1"<?PHP selected(in_array('1',$mon,true),true,true); ?>><?PHP _e('January'); ?></option>
						<option value="2"<?PHP selected(in_array('2',$mon,true),true,true); ?>><?PHP _e('February'); ?></option>
						<option value="3"<?PHP selected(in_array('3',$mon,true),true,true); ?>><?PHP _e('March'); ?></option>
						<option value="4"<?PHP selected(in_array('4',$mon,true),true,true); ?>><?PHP _e('April'); ?></option>
						<option value="5"<?PHP selected(in_array('5',$mon,true),true,true); ?>><?PHP _e('May'); ?></option>
						<option value="6"<?PHP selected(in_array('6',$mon,true),true,true); ?>><?PHP _e('June'); ?></option>
						<option value="7"<?PHP selected(in_array('7',$mon,true),true,true); ?>><?PHP _e('July'); ?></option>
						<option value="8"<?PHP selected(in_array('8',$mon,true),true,true); ?>><?PHP _e('Augest'); ?></option>
						<option value="9"<?PHP selected(in_array('9',$mon,true),true,true); ?>><?PHP _e('September'); ?></option>
						<option value="10"<?PHP selected(in_array('10',$mon,true),true,true); ?>><?PHP _e('October'); ?></option>
						<option value="11"<?PHP selected(in_array('11',$mon,true),true,true); ?>><?PHP _e('November'); ?></option>
						<option value="12"<?PHP selected(in_array('12',$mon,true),true,true); ?>><?PHP _e('December'); ?></option>
						</select>
					</div>
					<div style="width:130px; float: right;">
						<b><?PHP _e('Day of Week:','backwpup'); ?></b><br />
						<select name="cronwday[]" id="cronwday" style="height:65px;" multiple="multiple">
						<?PHP 
						if (strstr($cronstr['wday'],'*/'))
							$wday=explode('/',$cronstr['wday']);
						else
							$wday=explode(',',$cronstr['wday']);
						?>
						<option value="*"<?PHP selected(in_array('*',$wday,true),true,true); ?>><?PHP _e('Any (*)','backwpup'); ?></option>
						<option value="0"<?PHP selected(in_array('0',$wday,true),true,true); ?>><?PHP _e('Sunday'); ?></option>
						<option value="1"<?PHP selected(in_array('1',$wday,true),true,true); ?>><?PHP _e('Monday'); ?></option>
						<option value="2"<?PHP selected(in_array('2',$wday,true),true,true); ?>><?PHP _e('Tuesday'); ?></option>
						<option value="3"<?PHP selected(in_array('3',$wday,true),true,true); ?>><?PHP _e('Wednesday'); ?></option>
						<option value="4"<?PHP selected(in_array('4',$wday,true),true,true); ?>><?PHP _e('Thursday'); ?></option>
						<option value="5"<?PHP selected(in_array('5',$wday,true),true,true); ?>><?PHP _e('Friday'); ?></option>
						<option value="6"<?PHP selected(in_array('6',$wday,true),true,true); ?>><?PHP _e('Saturday'); ?></option>
						</select>
					</div>
					<br class="clear" />
					<?PHP 
					_e('Working as <a href="http://wikipedia.org/wiki/Cron" target="_blank">Cron</a> job schedule:','backwpup'); echo ' <i>'.$jobvalue['cron'].'</i><br />'; 
					_e('Next runtime:'); echo ' '.date('D, j M Y H:i',backwpup_cron_next($jobvalue['cron']));
					?>
				</div>
			</div>

			<div id="fileformart" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup File','backwpup'); ?></span></h3>
				<div class="inside">
				<b><?PHP _e('File Prefix:','backwpup'); ?></b><br />
				<input name="fileprefix" type="text" value="<?PHP echo $jobvalue['fileprefix'];?>" class="large-text" /><br />
				<b><?PHP _e('File Formart:','backwpup'); ?></b><br />
				<?PHP
				if (function_exists('gzopen') or class_exists('ZipArchive'))
					echo '<input class="radio" type="radio"'.checked('.zip',$jobvalue['fileformart'],false).' name="fileformart" value=".zip" />'.__('Zip','backwpup').'<br />';
				else
					echo '<input class="radio" type="radio"'.checked('.zip',$jobvalue['fileformart'],false).' name="fileformart" value=".zip" disabled="disabled" />'.__('Zip','backwpup').'<br />';
				echo '<input class="radio" type="radio"'.checked('.tar',$jobvalue['fileformart'],false).' name="fileformart" value=".tar" />'.__('Tar','backwpup').'<br />';
				if (function_exists('gzopen'))
					echo '<input class="radio" type="radio"'.checked('.tar.gz',$jobvalue['fileformart'],false).' name="fileformart" value=".tar.gz" />'.__('Tar GZip','backwpup').'<br />';
				else
					echo '<input class="radio" type="radio"'.checked('.tar.gz',$jobvalue['fileformart'],false).' name="fileformart" value=".tar.gz" disabled="disabled" />'.__('Tar GZip','backwpup').'<br />';
				if (function_exists('bzopen'))
					echo '<input class="radio" type="radio"'.checked('.tar.bz2',$jobvalue['fileformart'],false).' name="fileformart" value=".tar.bz2" />'.__('Tar BZip2','backwpup').'<br />';
				else
					echo '<input class="radio" type="radio"'.checked('.tar.bz2',$jobvalue['fileformart'],false).' name="fileformart" value=".tar.bz2" disabled="disabled" />'.__('Tar BZip2','backwpup').'<br />';	
				_e('Example:','backwpup'); 
				echo '<br /><i>'.$jobvalue['fileprefix'].date_i18n('Y-m-d_H-i-s').$jobvalue['fileformart'].'</i>';
				?>
				</div>
			</div>

			<div id="logmail" class="postbox">
				<h3 class="hndle"><span><?PHP _e('Send log','backwpup'); ?></span></h3>
				<div class="inside">
					<?PHP _e('E-Mail-Adress:','backwpup'); ?>
					<input name="mailaddresslog" id="mailaddresslog" type="text" value="<?PHP echo $jobvalue['mailaddresslog'];?>" class="large-text" /><br />
					<input class="checkbox" value="1" type="checkbox" <?php checked($jobvalue['mailerroronly'],true); ?> name="mailerroronly" /> <?PHP _e('Only send an e-mail if there are errors.','backwpup'); ?>
				</div>
			</div>


		</div>
	</div>
	<div class="has-sidebar" >
		<div id="post-body-content" class="has-sidebar-content">

			<div id="titlediv">
				<div id="titlewrap">
					<label class="hide-if-no-js" style="visibility:hidden" id="title-prompt-text" for="title"><?PHP _e('Enter Job name here','backwpup'); ?></label>
					<input type="text" name="name" size="30" tabindex="1" value="<?PHP echo $jobvalue['name'];?>" id="title" autocomplete="off" />
				</div>
			</div>

			<div id="databasejobs" class="postbox" <?PHP if (!in_array("CHECK",$todo) and !in_array("DB",$todo) and !in_array("OPTIMIZE",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Database Jobs','backwpup'); ?></span></h3>
				<div class="inside">

					<b><?PHP _e('Database tables to <span style="color:red;">ex</span>clude:','backwpup'); ?></b>
					<div id="dbexclude-pop" style="border-color:#CEE1EF; border-style:solid; border-width:2px; height:10em; width:50%; margin:5px 0px 5px 40px; overflow:auto; padding:0.5em 0.5em;">
					<?php
					$tables=$wpdb->get_col('SHOW TABLES FROM `'.DB_NAME.'`');
					foreach ($tables as $table) {
						if ($wpdb->backwpup_logs<>$table) {
							echo '	<input class="checkbox" type="checkbox"'.checked(in_array($table,(array)$jobvalue['dbexclude']),true,false).' name="dbexclude[]" value="'.$table.'"/> '.$table.'<br />';
						}
					}
					?>
					</div><br />
					<span id="dbshortinsert" <?PHP if (!in_array("DB",$todo)) echo 'style="display:none;"';?>><input class="checkbox" type="checkbox"<?php checked($jobvalue['dbshortinsert'],true,true);?> name="dbshortinsert" value="1"/> <?php _e('Use short INSERTs instead of full (with keys)','backwpup');?><br /></span>
					<input class="checkbox" type="checkbox"<?php checked($jobvalue['maintenance'],true,true);?> name="maintenance" value="1"/> <?php _e('Set Blog Maintenance Mode on Database Operations','backwpup');?><br />
				</div>
			</div>

			<div id="filebackup" class="postbox" <?PHP if (!in_array("FILE",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('File Backup','backwpup'); ?></span></h3>
				<div class="inside">
					<b><?PHP _e('Blog Folders to Backup:','backwpup'); ?></b><br />&nbsp;<br />
					<div>
						<div style="width:20%; float: left;">
							&nbsp;<b><input class="checkbox" type="checkbox"<?php checked($jobvalue['backuproot'],true,true);?> name="backuproot" value="1"/> <?php _e('root','backwpup');?></b><br />
							<div style="border-color:#CEE1EF; border-style:solid; border-width:2px; height:10em; width:90%; margin:2px; overflow:auto;">
							<?PHP
							echo '<i>'.__('Exclude:','backwpup').'</i><br />';
							$folder=untrailingslashit(str_replace('\\','/',ABSPATH));
							if ( $dir = @opendir( $folder ) ) {
								while (($file = readdir( $dir ) ) !== false ) {
									if ( !in_array($file, array('.', '..','.svn')) and is_dir($folder.'/'.$file) and !in_array($folder.'/'.$file.'/',backwpup_get_exclude_wp_dirs($folder)))
										echo '<nobr><input class="checkbox" type="checkbox"'.checked(in_array($folder.'/'.$file.'/',$jobvalue['backuprootexcludedirs']),true,false).' name="backuprootexcludedirs[]" value="'.$folder.'/'.$file.'/"/> '.$file.'</nobr><br />';
								}
								@closedir( $dir );
							}
							?>
							</div>
						</div>
						<div style="width:20%;float: left;">
							&nbsp;<b><input class="checkbox" type="checkbox"<?php checked($jobvalue['backupcontent'],true,true);?> name="backupcontent" value="1"/> <?php _e('Content','backwpup');?></b><br />
							<div style="border-color:#CEE1EF; border-style:solid; border-width:2px; height:10em; width:90%; margin:2px; overflow:auto;">
							<?PHP
							echo '<i>'.__('Exclude:','backwpup').'</i><br />';
							$folder=untrailingslashit(str_replace('\\','/',WP_CONTENT_DIR));
							if ( $dir = @opendir( $folder ) ) {
								while (($file = readdir( $dir ) ) !== false ) {
									if ( !in_array($file, array('.', '..','.svn')) and is_dir($folder.'/'.$file) and !in_array($folder.'/'.$file.'/',backwpup_get_exclude_wp_dirs($folder)))
										echo '<nobr><input class="checkbox" type="checkbox"'.checked(in_array($folder.'/'.$file.'/',$jobvalue['backupcontentexcludedirs']),true,false).' name="backupcontentexcludedirs[]" value="'.$folder.'/'.$file.'/"/> '.$file.'</nobr><br />';
								}
								@closedir( $dir );
							}
							?>
							</div>
						</div>
						<div style="width:20%; float: left;">
							&nbsp;<b><input class="checkbox" type="checkbox"<?php checked($jobvalue['backupplugins'],true,true);?> name="backupplugins" value="1"/> <?php _e('Plugins','backwpup');?></b><br />
							<div style="border-color:#CEE1EF; border-style:solid; border-width:2px; height:10em; width:90%; margin:2px; overflow:auto;">
							<?PHP
							echo '<i>'.__('Exclude:','backwpup').'</i><br />';
							$folder=untrailingslashit(str_replace('\\','/',WP_PLUGIN_DIR));
							if ( $dir = @opendir( $folder ) ) {
								while (($file = readdir( $dir ) ) !== false ) {
									if ( !in_array($file, array('.', '..','.svn')) and is_dir($folder.'/'.$file) and !in_array($folder.'/'.$file.'/',backwpup_get_exclude_wp_dirs($folder)))
										echo '<nobr><input class="checkbox" type="checkbox"'.checked(in_array($folder.'/'.$file.'/',$jobvalue['backuppluginsexcludedirs']),true,false).' name="backuppluginsexcludedirs[]" value="'.$folder.'/'.$file.'/"/> '.$file.'</nobr><br />';
								}
								@closedir( $dir );
							}
							?>
							</div>
						</div>
						<div style="width:20%; float: left;">
							&nbsp;<b><input class="checkbox" type="checkbox"<?php checked($jobvalue['backupthemes'],true,true);?> name="backupthemes" value="1"/> <?php _e('Themes','backwpup');?></b><br />
							<div style="border-color:#CEE1EF; border-style:solid; border-width:2px; height:10em; width:90%; margin:2px; overflow:auto;">
							<?PHP
							echo '<i>'.__('Exclude:','backwpup').'</i><br />';
							$folder=untrailingslashit(str_replace('\\','/',trailingslashit(WP_CONTENT_DIR).'themes'));
							if ( $dir = @opendir( $folder ) ) {
								while (($file = readdir( $dir ) ) !== false ) {
									if ( !in_array($file, array('.', '..','.svn')) and is_dir($folder.'/'.$file) and !in_array($folder.'/'.$file.'/',backwpup_get_exclude_wp_dirs($folder)))
										echo '<nobr><input class="checkbox" type="checkbox"'.checked(in_array($folder.'/'.$file.'/',$jobvalue['backupthemesexcludedirs']),true,false).' name="backupthemesexcludedirs[]" value="'.$folder.'/'.$file.'/"/> '.$file.'</nobr><br />';
								}
								@closedir( $dir );
							}
							?>
							</div>
						</div>
						<div style="width:20%; float: left;">
							&nbsp;<b><input class="checkbox" type="checkbox"<?php checked($jobvalue['backupuploads'],true,true);?> name="backupuploads" value="1"/> <?php _e('Blog Uploads','backwpup');?></b><br />
							<div style="border-color:#CEE1EF; border-style:solid; border-width:2px; height:10em; width:90%; margin:2px; overflow:auto;">
							<?PHP
							echo '<i>'.__('Exclude:','backwpup').'</i><br />';
							$folder=untrailingslashit(backwpup_get_upload_dir());
							if ( $dir = @opendir( $folder ) ) {
								while (($file = readdir( $dir ) ) !== false ) {
									if ( !in_array($file, array('.', '..','.svn')) and is_dir($folder.'/'.$file) and !in_array($folder.'/'.$file,backwpup_get_exclude_wp_dirs($folder)))
										echo '<nobr><input class="checkbox" type="checkbox"'.checked(in_array($folder.'/'.$file.'/',$jobvalue['backupuploadsexcludedirs']),true,false).' name="backupuploadsexcludedirs[]" value="'.$folder.'/'.$file.'/"/> '.$file.'</nobr><br />';
								}
								@closedir( $dir );
							}
							?>
							</div>
						</div>
					</div>
					<br />&nbsp;<br />
					<b><?PHP _e('Include Folders to Backup:','backwpup'); ?></b><br />
					<?PHP _e('Example:','backwpup'); ?> <?PHP echo str_replace('\\','/',ABSPATH); ?>,...<br />
					<input name="dirinclude" id="dirinclude" type="text" value="<?PHP echo $jobvalue['dirinclude'];?>" class="large-text" /><br />
					<br />
					<b><?PHP _e('Exclude Files/Folders from Backup:','backwpup'); ?></b><br />
					<?PHP _e('Example:','backwpup'); ?> /logs/,.log,.tmp,/temp/,....<br />
					<input name="fileexclude" id="fileexclude" type="text" value="<?PHP echo $jobvalue['fileexclude'];?>" class="large-text" /><br />
				</div>
			</div>

			<div id="todir" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to Directory','backwpup'); ?></span></h3>
				<div class="inside">
					<b><?PHP _e('Full Path to Folder for Backup Files:','backwpup'); ?></b><br />
					<input name="backupdir" id="backupdir" type="text" value="<?PHP echo $jobvalue['backupdir'];?>" class="large-text" /><br />
					<span class="description"><?PHP _e('(Leave it empty to store Backups not local!)','backwpup');?></span><br />
					<?PHP _e('Max. Backup Files in Folder:','backwpup'); ?> <input name="maxbackups" id="maxbackups" type="text" size="3" value="<?PHP echo $jobvalue['maxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will deleted first.)','backwpup');?></span>
				</div>
			</div>
			
			<?PHP if (in_array('FTP',$dests)) { ?>
			<div id="toftp" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to FTP Server','backwpup'); ?></span></h3>
				<div class="inside">
					<b><?PHP _e('Hostname:','backwpup'); ?></b><br />
					<input name="ftphost" type="text" value="<?PHP echo $jobvalue['ftphost'];?>" class="large-text" /><br />
					<b><?PHP _e('Username:','backwpup'); ?></b><br />
					<input name="ftpuser" type="text" value="<?PHP echo $jobvalue['ftpuser'];?>" class="user large-text" /><br />
					<b><?PHP _e('Password:','backwpup'); ?></b><br />
					<input name="ftppass" type="password" value="<?PHP echo base64_decode($jobvalue['ftppass']);?>" class="password large-text" /><br />
					<b><?PHP _e('Directory on Server:','backwpup'); ?></b><br />
					<input name="ftpdir" type="text" value="<?PHP echo $jobvalue['ftpdir'];?>" class="large-text" /><br />
					<?PHP if (!is_numeric($jobvalue['ftpmaxbackups'])) $jobvalue['ftpmaxbackups']=0; ?>
					<?PHP _e('Max. Backup Files in FTP Folder:','backwpup'); ?> <input name="ftpmaxbackups" type="text" size="3" value="<?PHP echo $jobvalue['ftpmaxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will be deleted first.)','backwpup');?></span><br />
					<input class="checkbox" value="1" type="checkbox" <?php checked($jobvalue['ftpssl'],true); ?> name="ftpssl" /> <?PHP _e('Use SSL-FTP Connection.','backwpup'); ?><br />
					<input class="checkbox" value="1" type="checkbox" <?php checked($jobvalue['ftppasv'],true); ?> name="ftppasv" /> <?PHP _e('Use FTP Passiv mode.','backwpup'); ?><br />			
				</div>
			</div>
			<?PHP } ?>

			<?PHP if (in_array('S3',$dests) and function_exists('curl_exec')) { ?>
			<div id="toamazon" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to Amazon S3','backwpup'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.amazon.de/gp/redirect.html?ie=UTF8&location=http%3A%2F%2Fwww.amazon.com%2Fgp%2Faws%2Fregistration%2Fregistration-form.html&site-redirect=de&tag=hueskennet-21&linkCode=ur2&camp=1638&creative=6742" target="_blank"><?PHP _e('Create Account','backwpup'); ?></a><img src="http://www.assoc-amazon.de/e/ir?t=hueskennet-21&l=ur2&o=3" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" /></h3>
				<div class="inside">
					<b><?PHP _e('Access Key ID:','backwpup'); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://aws-portal.amazon.com/gp/aws/developer/account/index.html?action=access-key" target="_blank"><?PHP _e('Find it','backwpup'); ?></a><br />
					<input id="awsAccessKey" name="awsAccessKey" type="text" value="<?PHP echo $jobvalue['awsAccessKey'];?>" class="large-text" /><br />
					<b><?PHP _e('Secret Access Key:','backwpup'); ?></b><br />
					<input id="awsSecretKey" name="awsSecretKey" type="password" value="<?PHP echo $jobvalue['awsSecretKey'];?>" class="large-text" /><br />
					<b><?PHP _e('Bucket:','backwpup'); ?></b><br />
					<input id="awsBucketselected" name="awsBucketselected" type="hidden" value="<?PHP echo $jobvalue['awsBucket'];?>" />
					<?PHP if (!empty($jobvalue['awsAccessKey']) and !empty($jobvalue['awsSecretKey'])) backwpup_get_aws_buckets(array('awsAccessKey'=>$jobvalue['awsAccessKey'],'awsSecretKey'=>$jobvalue['awsSecretKey'],'awsselected'=>$jobvalue['awsBucket'])); ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP _e('Create Bucket:','backwpup'); ?><input name="newawsBucket" type="text" value="" class="text" /> <select name="awsRegion" title="<?php _e('Bucket Region', 'backwpup'); ?>"><option value=""><?php _e('US-East (Northern Virginia)', 'backwpup'); ?></option><option value="us-west-1"><?php _e('US-West (Northern California)', 'backwpup'); ?></option><option value="EU"><?php _e('EU (Ireland)', 'backwpup'); ?></option><option value="ap-southeast-1"><?php _e('Asia Pacific (Singapore)', 'backwpup'); ?></option><option value="ap-northeast-1"><?php _e('Asia Pacific (Japan)', 'backwpup'); ?></option></select><br />
					<b><?PHP _e('Directory in Bucket:','backwpup'); ?></b><br />
					<input name="awsdir" type="text" value="<?PHP echo $jobvalue['awsdir'];?>" class="large-text" /><br />
					<?PHP _e('Max. Backup Files in Bucket Folder:','backwpup'); ?><input name="awsmaxbackups" type="text" size="3" value="<?PHP echo $jobvalue['awsmaxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will be deleted first.)','backwpup');?></span><br />
					<input class="checkbox" value="1" type="checkbox" <?php checked($jobvalue['awsrrs'],true); ?> name="awsrrs" /> <?PHP _e('Save Backups with reduced redundancy!','backwpup'); ?><br />
				</div>
			</div>
			<?PHP } ?>

			<?PHP if (in_array('MSAZURE',$dests) and function_exists('curl_exec')) { ?>
			<div id="tomsazure" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to Micosoft Azure (Blob)','backwpup'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.microsoft.com/windowsazure/offers/" target="_blank"><?PHP _e('Create Account','backwpup'); ?></a></h3>
				<div class="inside">
					<b><?PHP _e('Host:','backwpup'); ?></b><br />
					<input id="msazureHost" name="msazureHost" type="text" value="<?PHP echo $jobvalue['msazureHost'];?>" class="large-text" /><span class="description"><?PHP _e('Normely: blob.core.windows.net','backwpup');?></span><br />
					<b><?PHP _e('Account Name:','backwpup'); ?></b><br />
					<input id="msazureAccName" name="msazureAccName" type="text" value="<?PHP echo $jobvalue['msazureAccName'];?>" class="large-text" /><br />
					<b><?PHP _e('Access Key:','backwpup'); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://windows.azure.com/" target="_blank"><?PHP _e('Find it','backwpup'); ?></a><br />
					<input id="msazureKey" name="msazureKey" type="password" value="<?PHP echo $jobvalue['msazureKey'];?>" class="large-text" /><br />
					<b><?PHP _e('Container:','backwpup'); ?></b><br />
					<input id="msazureContainerselected" name="msazureContainerselected" type="hidden" value="<?PHP echo $jobvalue['msazureContainer'];?>" />
					<?PHP if (!empty($jobvalue['msazureAccName']) and !empty($jobvalue['msazureKey'])) backwpup_get_msazure_container(array('msazureHost'=>$jobvalue['msazureHost'],'msazureAccName'=>$jobvalue['msazureAccName'],'msazureKey'=>$jobvalue['msazureKey'],'msazureselected'=>$jobvalue['msazureContainer'])); ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP _e('Create Container:','backwpup'); ?><input name="newmsazureContainer" type="text" value="" class="text" /> <br />
					<b><?PHP _e('Directory in Container:','backwpup'); ?></b><br />
					<input name="msazuredir" type="text" value="<?PHP echo $jobvalue['msazuredir'];?>" class="large-text" /><br />
					<?PHP _e('Max. Backup Files in Container Folder:','backwpup'); ?><input name="msazuremaxbackups" type="text" size="3" value="<?PHP echo $jobvalue['msazuremaxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will be deleted first.)','backwpup');?></span><br />
				</div>
			</div>
			<?PHP } ?>
			
			<?PHP if (in_array('RSC',$dests) and function_exists('curl_exec')) { ?>
			<div id="torsc" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to Rackspace Cloud','backwpup'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.rackspacecloud.com/2073.html" target="_blank"><?PHP _e('Create Account','backwpup'); ?></a></h3>
				<div class="inside">
					<b><?PHP _e('Username:','backwpup'); ?></b><br />
					<input id="rscUsername" name="rscUsername" type="text" value="<?PHP echo $jobvalue['rscUsername'];?>" class="large-text" /><br />
					<b><?PHP _e('API Key:','backwpup'); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://manage.rackspacecloud.com/APIAccess.do" target="_blank"><?PHP _e('Find it','backwpup'); ?></a><br />
					<input id="rscAPIKey" name="rscAPIKey" type="text" value="<?PHP echo $jobvalue['rscAPIKey'];?>" class="large-text" /><br />
					<b><?PHP _e('Container:','backwpup'); ?></b><br />
					<input id="rscContainerselected" name="rscContainerselected" type="hidden" value="<?PHP echo $jobvalue['rscContainer'];?>" />
					<?PHP if (!empty($jobvalue['rscUsername']) and !empty($jobvalue['rscAPIKey'])) backwpup_get_rsc_container(array('rscUsername'=>$jobvalue['rscUsername'],'rscAPIKey'=>$jobvalue['rscAPIKey'],'rscselected'=>$jobvalue['rscContainer'])); ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP _e('Create Container:','backwpup'); ?><input name="newrscContainer" type="text" value="" class="text" /> <br />
					<b><?PHP _e('Directory in Container:','backwpup'); ?></b><br />
					<input name="rscdir" type="text" value="<?PHP echo $jobvalue['rscdir'];?>" class="large-text" /><br />
					<?PHP _e('Max. Backup Files in Container Folder:','backwpup'); ?><input name="rscmaxbackups" type="text" size="3" value="<?PHP echo $jobvalue['rscmaxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will be deleted first.)','backwpup');?></span><br />
				</div>
			</div>
			<?PHP } ?>
			
			<?PHP if (in_array('DROPBOX',$dests) and function_exists('curl_exec') and function_exists('json_decode')) { ?>
			<div id="todropbox" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to Dropbox','backwpup'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a name="dropbox" href="http://db.tt/MfxHKBd" target="_blank"><?PHP _e('Create Account','backwpup'); ?></a></h3>
				<div class="inside">
					<b><?PHP _e('Login:','backwpup'); ?></b>&nbsp;
					<?PHP if (empty($jobvalue['dropetoken']) and empty($jobvalue['dropesecret'])) { ?>
						<span style="color:red;"><?php _e('Not authenticated!', 'backwpup'); ?></span> <input type="submit" name="dropboxauth" class="button-primary" accesskey="d" value="<?php _e('Authenticate!', 'backwpup'); ?>" /><br />
					<?PHP } else  { ?>
						<span style="color:green;"><?php _e('Authenticated!', 'backwpup'); ?></span> <input type="submit" name="dropboxauth" class="button-primary" accesskey="d" value="<?php _e('Delete!', 'backwpup'); ?>" /><br />
					<?PHP } ?><br />
					<b><?PHP _e('Directory:','backwpup'); ?></b><br />
					<input name="dropedir" type="text" value="<?PHP echo $jobvalue['dropedir'];?>" class="user large-text" /><br />			
					<?PHP _e('Max. Backup Files in Dopbox Folder:','backwpup'); ?><input name="dropemaxbackups" type="text" size="3" value="<?PHP echo $jobvalue['dropemaxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will be deleted first.)','backwpup');?></span><br />
				</div>
			</div>
			<?PHP } ?>
			
			<?PHP if (in_array('SUGARSYNC',$dests) and function_exists('curl_exec')) { ?>
			<div id="tosugarsync" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to SugarSync','backwpup'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://www.sugarsync.com/referral?rf=cajw0b09tbw6k" target="_blank"><?PHP _e('Create Account','backwpup'); ?></a></h3>
				<div class="inside">
					<b><?PHP _e('E-mail address:','backwpup'); ?></b><br />
					<input id="sugaruser" name="sugaruser" type="text" value="<?PHP echo $jobvalue['sugaruser'];?>" class="large-text" /><br />
					<b><?PHP _e('Password:','backwpup'); ?></b><br />
					<input id="sugarpass" name="sugarpass" type="password" value="<?PHP echo base64_decode($jobvalue['sugarpass']);?>" class="large-text" /><br />
					<b><?PHP _e('Root:','backwpup'); ?></b><br />
					<input id="sugarrootselected" name="sugarrootselected" type="hidden" value="<?PHP echo $jobvalue['sugarroot'];?>" />
					<?PHP if (!empty($jobvalue['sugaruser']) and !empty($jobvalue['sugarpass'])) backwpup_get_sugarsync_root(array('sugaruser'=>$jobvalue['sugaruser'],'sugarpass'=>base64_decode($jobvalue['sugarpass']),'sugarrootselected'=>$jobvalue['sugarroot'])); ?><br />
					<b><?PHP _e('Directory:','backwpup'); ?></b><br />
					<input name="sugardir" type="text" value="<?PHP echo $jobvalue['sugardir'];?>" class="large-text" /><br />
					<?PHP _e('Max. Backup Files in Folder:','backwpup'); ?><input name="sugarmaxbackups" type="text" size="3" value="<?PHP echo $jobvalue['sugarmaxbackups'];?>" class="small-text" /><span class="description"><?PHP _e('(Oldest files will be deleted first.)','backwpup');?></span><br />
				</div>
			</div>
			<?PHP } ?>
			
			<div id="tomail" class="postbox" <?PHP if (!in_array("FILE",$todo) and !in_array("DB",$todo) and !in_array("WPEXP",$todo)) echo 'style="display:none;"';?>>
				<h3 class="hndle"><span><?PHP _e('Backup to E-Mail','backwpup'); ?></span></h3>
				<div class="inside">
					<b><?PHP _e('E-mail address:','backwpup'); ?></b><br />
					<input name="mailaddress" id="mailaddress" type="text" value="<?PHP echo $jobvalue['mailaddress'];?>" class="large-text" /><br />
					<?PHP if (!is_numeric($jobvalue['mailefilesize'])) $jobvalue['mailefilesize']=0; ?>
					<?PHP echo __('Max. File Size for sending Backups with mail:','backwpup').'<input name="mailefilesize" type="text" value="'.$jobvalue['mailefilesize'].'" class="small-text" />MB<br />';?>
				</div>
			</div>
		</div>
	</div>
</div>

</form>
</div>