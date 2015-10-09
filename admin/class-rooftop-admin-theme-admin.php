<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://errorstudio.co.uk
 * @since      1.0.0
 *
 * @package    Rooftop_Admin_Theme
 * @subpackage Rooftop_Admin_Theme/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rooftop_Admin_Theme
 * @subpackage Rooftop_Admin_Theme/admin
 * @author     Error <info@errorstudio.co.uk>
 */
class Rooftop_Admin_Theme_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rooftop_Admin_Theme_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rooftop_Admin_Theme_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rooftop-admin-theme-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rooftop_Admin_Theme_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rooftop_Admin_Theme_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rooftop-admin-theme-admin.js', array( 'jquery' ), $this->version, false );

	}


    /**
     * limit the available roles
     *
     * called in admin_init
     */
    public function remove_user_roles() {
        remove_role("subscriber");
        remove_role("author");
    }

    /**
     * Remove menu items from the Wordpress admin sidebar
     *
     * called in admin_menu
     */
    public function remove_admin_menus() {
        $remove_menus = array("edit-comments.php", "tools.php");
        foreach($remove_menus as $menu_to_remove){
            remove_menu_page($menu_to_remove);
        }

        $remove_submenus_parents = array(
            "options-general.php" => array("options-reading.php", "options-discussion.php"),
        );

        foreach($remove_submenus_parents as $submenu_parent => $submenus) {
            foreach($submenus as $submenu_to_remove) {
                remove_submenu_page($submenu_parent, $submenu_to_remove);
            }
        }

        // remove all but the 'menus' appearence submenu
        global $submenu;
        if(array_key_exists('themes.php', $submenu)){
            $appearance_submenu_items = $submenu['themes.php'];

            foreach($appearance_submenu_items as $sm){
                if(in_array($sm[0], array("Customize"))) {
                   remove_submenu_page("themes.php", $sm[2]);
                }
            }
        }
    }

    /**
     * Re-order the menu - move 'Media' below the other content types
     *
     * called in admin_menu
     */
    public function reorder_admin_menu() {
        global $menu;

        if($menu[10] && $menu[10][0]=="Media" && !array_key_exists(50, $menu)){
            $m = $menu[10];
            unset($menu[10]);
            $menu[50] = $m;
        }
    }

    public function remove_admin_navigation_menus(){
        global $wp_admin_bar;

        global $current_user;
        $current_user_blogs = get_blogs_of_user($current_user->ID);
        $current_user_is_superadmin = is_super_admin($current_user->ID);

        if(!$current_user_is_superadmin && count($current_user_blogs)<=1){
            $wp_admin_bar->remove_menu('my-sites');
        }

        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('site-name');
    }

    /**
     * When rendering the user-edit form, remove the API specific user roles from the roles that are available in the dropdown.
     */
    public function remove_api_roles_if_rest_request($roles){
        unset($roles['api-read-only']);
        unset($roles['api-read-write']);

        return $roles;
    }
}
