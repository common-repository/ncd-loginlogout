<?php
/*
 * Plugin Name: NCD Login/Logout
 * Plugin URI: http://plugins.noritaka.eu/ncd_login_logout/
 * Description: <strong>NCD Login/Logout</strong> est une extension qui affiche widget, permettant de s'authentifier en tant qu'utilisateur du site, et d'afficher une série de lien.
 * Author: Norit@k@ Corps Development
 * Text Domain: ncd_login_logout
 * Version: 1.0.7
 * Author URI: http://plugins.noritaka.eu/
 * License: http://www.gnu.org/licenses/gpl.html
*/
/*
Credit: 
Thanks to Roger Howorth http://www.thehypervisor.com for model code. 
Thanks to BestWebSoft http://bestwebsoft.com/ for model code. 


Copyright (c) 2013-2014 Norit@k@ Corps Development

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/
global $ncd_ll_db_version ;
global $ncd_ll_plugin_name;
$ncd_ll_db_version = "1.0";
$ncd_ll_plugin_name = 'ncd_login_logout';


if( ! function_exists( 'ncd_add_menu_render' ) ) {
	function ncd_add_menu_render() {
		global $title;
		$active_plugins = get_option('active_plugins');
		$all_plugins		= get_plugins();

		$array_activate = array();
		$array_install	= array();
		$array_recomend = array();
		$count_activate = $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array( dirname( plugin_basename( __FILE__ ) ) .'\/ncd_login_logout.php', 'NCD Login/Logout', 'http://wordpress.org/plugins/ncd-loginlogout/', 'http://plugins.noritaka.eu/ncd_login_logout/', '', 'admin.php?page=ncd_login_logout.php' ), 
			array( dirname( plugin_basename( __FILE__ ) ) .'\/ncd_paintball_league.php', 'NCD Paintball League', 'http://wordpress.org/plugins/ncd-paintball-league/', 'http://plugins.noritaka.eu/ncd-paintball-league/', '', 'admin.php?page=ncd_paintball_league.php' ), 
//			array( 'ncd_member_newsletter\/ncd_member_newsletter.php', 'NCD Member Newsletter', 'http://wordpress.org/plugins/ncd_member_newsletter/', 'http://plugins.noritaka.eu/plugins/ncd_member_newsletter.zip', '', 'admin.php?page=ncd_member_newsletter.php' ), 
			array( dirname( plugin_basename( __FILE__ ) ) .'\/ncd_ticket_reservation.php', 'NCD Ticket Reservation', 'http://wordpress.org/plugins/ncd-ticket-reservation/', 'http://plugins.noritaka.eu/plugins/ncd_ticket_reservation.zip', '', 'admin.php?page=ncd_ticket_reservation.php' ), 
		);
		foreach($array_plugins as $plugins) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate[$count_activate]['title'] = $plugins[1];
				$array_activate[$count_activate]['link']	= $plugins[2];
				$array_activate[$count_activate]['href']	= $plugins[3];
				$array_activate[$count_activate]['url']	= $plugins[5];
				$count_activate++;
			}
			else if( array_key_exists(str_replace("\\", "", $plugins[0]), $all_plugins) ) {
				$array_install[$count_install]['title'] = $plugins[1];
				$array_install[$count_install]['link']	= $plugins[2];
				$array_install[$count_install]['href']	= $plugins[3];
				$count_install++;
			}
			else {
				$array_recomend[$count_recomend]['title'] = $plugins[1];
				$array_recomend[$count_recomend]['link']	= $plugins[2];
				$array_recomend[$count_recomend]['href']	= $plugins[3];
				$array_recomend[$count_recomend]['slug']	= $plugins[4];
				$count_recomend++;
			}
		}
		?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
		  <h2><?php echo $title;?></h2>
			<?php if( 0 < $count_activate ) { ?>
			<div>
			  <h3><?php _e( 'Plugins activés', 'ncd_login_logout' ); ?></h3>
				<?php foreach( $array_activate as $activate_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $activate_plugin['title']; ?></div> <p><a href="<?php echo $activate_plugin['link']; ?>" target="_blank"><?php _e( 'En savoir plus...', 'ncd_login_logout'); ?></a> <a href="<?php echo $activate_plugin['url']; ?>"><?php _e( 'Paramètres', 'ncd_login_logout'); ?></a></p>
				<?php } ?>
		  </div>
			<?php } ?>
			<?php if( 0 < $count_install ) { ?>
			<div>
				<h3><?php _e( 'Plugins installés', 'ncd_login_logout' ); ?></h3>
				<?php foreach($array_install as $install_plugin) { ?>
				<div style="float:left; width:200px;"><?php echo $install_plugin['title']; ?></div> <p><a href="<?php echo $install_plugin['link']; ?>" target="_blank"><?php _e( 'En savoir plus...', 'ncd_login_logout'); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_recomend ) { ?>
			<div>
				<h3><?php _e( 'Plugins Recommendés', 'ncd_login_logout' ); ?></h3>
				<?php foreach( $array_recomend as $recomend_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $recomend_plugin['title']; ?></div> <p><a href="<?php echo $recomend_plugin['link']; ?>" target="_blank"><?php _e( 'En savoir plus...', 'ncd_login_logout'); ?></a> <a href="<?php echo $recomend_plugin['href']; ?>" target="_blank"><?php _e( 'Télécharger', 'ncd_login_logout'); ?></a> <a class="install-now" href="<?php echo get_bloginfo( "url" ) . $recomend_plugin['slug']; ?>" title="<?php esc_attr( sprintf( _e( 'Installer %s' ), $recomend_plugin['title'] ) ) ?>" target="_blank"><?php _e( 'Installer', 'ncd_login_logout' ) ?></a></p>
				<?php } ?>
				<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php _e( 'Pour toutes questions, merci de nous contacter sur plugins@noritaka.eu', 'ncd_login_logout' ); ?> <a href="http://plugins.noritaka.eu/contact/">http://plugins.noritaka.eu/contact/</a></span>
			</div>
			<?php } ?>
		</div>
		<?php
	}
}

// Function for display captcha settings page in the admin area
function ncd_ll_settings_page() {
	global $ncd_ll_options;

	$error = "";
	
	// Display form on the setting page
?>
<div class="wrap nosubsub">
	<style>
	.wrap #icon-options-general.icon32-ncd
	{
		 background: url("<?php _e(dirname( plugin_basename( __FILE__ ))); ?>/images/icon_36.png") no-repeat scroll left top transparent;
	}
	</style>
	<h2><?php _e('NCD Login/Logout Options', 'ncd_login_logout' ); ?></h2>
<?
	if ( isset ($_POST['update_loginout']) )  { 
		if ( !wp_verify_nonce ( $_POST['ncd_login_logout-verify-key'], 'ncd_login_logout') ) die( __('Controle de sécurité echoué. Rechargez la page et réessayez.','ncd_login_logout'));
	if ( $_POST['ncdhd_submit'] ) {
        if ( $_POST['insert_php'] == 'php' ) {
			update_option ( 'ncd_insert_php', '1' );
		}
		else {
			update_option ( 'ncd_insert_php', '0' );
		}
		$options['edisplay_email'] = $_POST['edisplay_email'];
		$options['ehide_register'] = $_POST['ehide_register'];
		$options['ehide_option_label'] = $_POST['ehide_option_label'];
		$options['sidebar_width'] = $_POST['sidebar_width'];
		$options['ecenter_widget'] = $_POST['ecenter_widget'];
		$options['ncdhd_title'] = $_POST['ncdhd_title'];
	    update_option('ncd_ll_options', $options );
?>
    <div id="message" class="updated"><p><strong><?php _e('Options mise à jour.','ncd_login_logout'); ?></strong></p></div>

<?php
	}
	?>
	<?php
	} // end if isset
	?>
	<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="ncdhd_submit" id="ncdhd_submit" value="1" />
	<div class="wrap nosubsub">
	<?php
	echo '<input type="hidden" name="ncd_login_logout-verify-key" id="ncd_login_logout-verify-key" value="' . wp_create_nonce('ncd_login_logout') . '" />';
	$options = get_option('ncd_ll_options');

	echo "<h3>". _e('Comment afficher le plugin NCD Login Logout ?','ncd_login_logout'). "</h3>";
	echo "<p>". _e('Afficher le plugin en l insérant le Widget dans la Sidebar de votre template.','ncd_login_logout'). "</p>";
        ?>
        <table>
	<tr><td><label for="edisplay_email"><?php _e('Afficher l adresse email: ','ncd_login_logout'); ?></td><td><input type="checkbox" <?php if ( $options["edisplay_email"] == '1' ) echo 'checked="yes" '?> name="edisplay_email" id="edisplay_email" value="1" /></label></td></tr>
	<tr><td><label for="ehide_option_label"><?php _e('Cache l étiquette de l option: ','ncd_login_logout'); ?></td><td><input type="checkbox" <?php if ( $options["ehide_option_label"] == '1' ) echo 'checked ' ?> name="ehide_option_label" id="ehide_option_label" value="1" /></label></td></tr>
	<tr><td><label for="ehide_register"><?php _e('Cacher le lien d inscription: ','ncd_login_logout'); ?></td><td><input type="checkbox" <?php if ( $options["ehide_register"] == '1' ) echo 'checked ' ?> name="ehide_register" id="ehide_register" value="1" /></label>
	<tr><td><label for="ecenter_widget"><?php _e('Centrer le Widget: ','ncd_login_logout'); ?></td><td><input type="checkbox" <?php if ( $options["ecenter_widget"] == '1' ) echo 'checked ' ?> name="ecenter_widget" id="ecenter_widget" value="1" /></label></td></tr>
	<tr><td><label for="ncdhd_title"><?php _e('Titre:','ncd_login_logout'); ?> <input type="text" id="ncdhd_title" name="ncdhd_title" value="<?php echo wp_specialchars($options['ncdhd_title']); ?>" /></label></td></tr>
	<tr><td><label for="sidebar_width"><?php _e('Taille du Widget:','ncd_login_logout'); ?> <input type="text" size="5" maxlength="5" id="sidebar_width" name="sidebar_width" value="<?php echo wp_specialchars($options['sidebar_width']); ?>" /></label></td></tr>
	</table>
		<input type="hidden" name="ncd_tr_form_submit" value="submit" />
	<p class="submit">
		<input type="submit" name="update_loginout" class="button-primary" value="<?php _e('Modifications sauvegardées') ?>" width="150" />
	</p>
		<?php wp_nonce_field( plugin_basename(__FILE__), 'ncd_ll_nonce_name' ); ?>
	</div>
	</form>
</div>
<?php
}


function ncd_login_logout_widget($args) {
        extract($args);
        $code = array();
        global $user_identity , $user_email;
        $options = get_option('ncd_ll_options');
	echo $before_widget;
	echo $before_title;
	_e(stripslashes($options['ncdhd_title']),'ncd_login_logout');
	echo $after_title;
	if ( !wp_specialchars($options['sidebar_width']) ) $options['sidebar_width'] = "200";
	if ( $options['ecenter_widget'] ) echo '<div style="width:'. wp_specialchars($options['sidebar_width']) . 'px; margin:0 auto;">';
	$all_links = get_option ( 'ncd_hidedash_links_options' );
	if ( !empty($all_links)) {
		foreach ( $all_links as $link ) {
		$extra_links = $extra_links . '<a href="'. current($link) .'">'. key($link).'</a> ';
		}
	}
	if (is_user_logged_in()) {
		// User Already Logged In
		get_currentuserinfo();  // Usually someone already did this, right?
		if ( $options['edisplay_email'] == '1' && !$options['ehide_option_label'] ) $code[] = sprintf(__('Bienvenue, <u><b>%s</b></u> (%s)<br />Options: &nbsp;','ncd_login_logout'),$user_identity,$user_email);
		else
		if ( $options['edisplay_email'] == '1' && $options['ehide_option_label'] ) $code[] = sprintf(__('Bienvenue, <u><b>%s</b></u> (%s)<br />','ncd_login_logout'),$user_identity,$user_email);
		else
		if ( $options['ehide_option_label'] ) $code[] = sprintf(__('Bienvenue, <u><b>%s</b></u><br />','ncd_login_logout'),$user_identity);
		else $code[] = sprintf(__('Bienvenue, <u><b>%s</b></u><br />Options: &nbsp;','ncd_login_logout'),$user_identity);
		// Default Strings
		$link_string_site = "<a href=\"".get_bloginfo('wpurl')."/wp-admin/index.php\" title=\"".__('Administrateur','ncd_login_logout')."\">".__('Administrateur','ncd_login_logout')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
		$link_string_logout = '<a href="'. wp_logout_url($_SERVER['REQUEST_URI']) .'" title="'.__('Se Déconnecter','ncd_login_logout').'">'.__('Se Déconnecter','ncd_login_logout').'</a>';
		$link_string_edit = "<a href=\"".get_bloginfo('wpurl')."/wp-admin/edit.php\" title=\"".__('Modifier un post','ncd_login_logout')."\">".__('Modifier un post','ncd_login_logout')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
		$link_string_profile = "<a href=\"".get_bloginfo('wpurl')."/wp-admin/profile.php\" title=\"".__('Mon Compte','ncd_login_logout')."\">".__('Mon Compte','ncd_login_logout')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";

		// Administrator?
		if (current_user_can('level_10')) {
			$code[] = $link_string_site;
                        $code[] = $link_string_logout;
			if ( $extra_links ) $code[] = '<br />Links: '.$extra_links;
			if ( $options['ecenter_widget'] ) $code[] = '</div>';
			$code[] = $after_widget;
		} else
		// level_2?
		if (current_user_can('level_2')) {
			if ($options['allow_authed']) {
				// Allow level_2 user to see Dashboard - treat like Administrator
				$code[] = $link_string_site;
				$code[] = $link_string_logout;
        			if ( $extra_links ) $code[] = '<br />Links: '.$extra_links;
				if ( $options['ecenter_widget'] ) $code[] = '</div>';
				$code[] = $after_widget;
			}
			// Hide Dashboard for level_2 user
			$code[] = $link_string_edit;
			$code[] = $link_string_logout;
			if ( $extra_links ) $code[] = '<br />Links: '.$extra_links;
			if ( $options['ecenter_widget'] ) $code[] = '</div>';
			$code[] = $after_widget;
		} else 
		// Less than level_2 user - Hide Dashboard from this User
		{
                $code[] = $link_string_profile;
		$code[] = $link_string_logout;
		if ( $extra_links ) $code[] = '<br />Links: '.$extra_links;
		if ( $options['ecenter_widget'] ) $code[] = '</div>';
		$code[] = $after_widget;
                }
	}
else {
	// User _NOT_ Logged In
	if ( $options['ehide_register'] != 1 ) $code[] = "<a href=\"".get_bloginfo('wpurl')."/wp-login.php?action=register&amp;redirect_to=".$_SERVER['REQUEST_URI']."\" title=\"".__('S inscrire','ncd_login_logout')."\">".__('S inscrire','ncd_login_logout')."</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
	$code[] = "<a href=\"".get_bloginfo('wpurl')."/wp-login.php?action=login&amp;redirect_to=".$_SERVER['REQUEST_URI']."\" title=\"".__('Connexion','ncd_login_logout')."\">".__('Connexion','ncd_login_logout')."</a>";
	$code[] = $after_widget;
}
   foreach ( $code as $snip ) {
      _e($snip);
   }
   return $code;
}

function ncd_ll_plugin_add_settings_link( $links ) {
	global $ncd_ll_plugin_name;
$settings_link = '<a href="admin.php?page='.$ncd_ll_plugin_name.'.php">'._e("Settings", $ncd_tr_plugin_name ).'</a>';
  	array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'ncd_ll_plugin_add_settings_link' );

// action function for above hook
function ncd_login_logout_menu() {
  if ( has_nav_menu( 'ncd_plugins' ) ) {
	add_submenu_page('ncd_plugins', __( 'NCD Login/Logout Options', 'ncd_login_logout' ), __( 'Login/Logout', 'ncd_login_logout' ), 'manage_options', "ncd_login_logout.php", 'ncd_ll_settings_page');
  }
  else {
	add_menu_page( '', 'NCD Plugins', 'manage_options', 'ncd_plugins', 'ncd_add_menu_render',  dirname( plugin_basename( __FILE__ ) ) . "/images/px.png", '1001.15'); 
	add_submenu_page('ncd_plugins', __( 'NCD Login/Logout Options', 'ncd_login_logout' ), __( 'Login/Logout', 'ncd_login_logout' ), 'manage_options', "ncd_login_logout.php", 'ncd_ll_settings_page');
  }
}

// uninstall process
function ncd_login_logout_uninstall(){
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

	// For Single site
	if ( !is_multisite() ) 
	{
		delete_option('ncd_ll_options');
		delete_option('ncd_hidedash_links_options');
		delete_option('ncd_insert_php');
		
	} 
	// For Multisite
	else 
	{
		// For regular options.
		global $wpdb;
		$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
		$original_blog_id = get_current_blog_id();
		foreach ( $blog_ids as $blog_id ) 
		{
			switch_to_blog( $blog_id );
			delete_option('ncd_ll_options');
			delete_option('ncd_hidedash_links_options');
			delete_option('ncd_insert_php');
		}
		switch_to_blog( $original_blog_id );
	
		// For site options.
		delete_site_option('ncd_ll_options');  
		delete_site_option('ncd_hidedash_links_options');  
		delete_site_option('ncd_insert_php');  
	}
}

// Hook for adding admin menus
add_action('admin_menu', 'ncd_login_logout_menu');
add_action("plugins_loaded", "ncd_ll_plugin_init");
register_uninstall_hook(__FILE__,'ncd_login_logout_uninstall');


if ( ! function_exists ( 'ncd_ll_plugin_init' ) ) {
	function ncd_ll_plugin_init() {
	// Internationalization, first(!)
	load_plugin_textdomain( 'ncd_login_logout', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	register_sidebar_widget('NCD Login/Logout '. __('Widget','ncd_login_logout'), 'ncd_login_logout_widget');
	return;

	// Other init stuff, be sure to it after load_plugins_textdomain if it involves translated text(!)
	}
}


