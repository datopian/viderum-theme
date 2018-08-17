<?php
/**
 * Department taxonomy for Users
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

 /**
  * Register Department taxonomy, make it hierarchical (like categories)
  *
  * @return void
  */
function register_user_department() {
	$labels = array(
		'name'              => _x( 'Departments', 'taxonomy general name', 'viderum' ),
		'singular_name'     => _x( 'Department', 'taxonomy singular name', 'viderum' ),
		'search_items'      => __( 'Search Departments', 'viderum' ),
		'all_items'         => __( 'All Departments', 'viderum' ),
		'parent_item'       => __( 'Parent Department', 'viderum' ),
		'parent_item_colon' => __( 'Parent Department:', 'viderum' ),
		'edit_item'         => __( 'Edit Department', 'viderum' ),
		'update_item'       => __( 'Update Department', 'viderum' ),
		'add_new_item'      => __( 'Add New Department', 'viderum' ),
		'new_item_name'     => __( 'New Department Name', 'viderum' ),
		'menu_name'         => __( 'Departments', 'viderum' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'show_in_nav_menus'     => true,
		'show_tagcloud'         => true,
		'query_var'             => true,
		'rewrite'               => array(
			'slug'         => 'department',
			'hierarchical' => true,
		),
		'capabilities'          => array(
			'manage_terms' => 'manage_categories',
			'edit_terms'   => 'manage_categories',
			'delete_terms' => 'manage_categories',
			'assign_terms' => 'edit_posts',
		),
		'update_count_callback' => 'update_count_department_callback',
	);

	register_taxonomy( 'department', 'user', $args );

}

add_action( 'init', 'register_user_department' );

/**
 * Create Department administration page
 *
 * @return void
 */
function department_admin_page() {

	$tax = get_taxonomy( 'department' );

	add_users_page(
		esc_attr( $tax->labels->menu_name ), esc_attr( $tax->labels->menu_name ), $tax->cap->manage_terms, 'edit-tags.php?taxonomy=' . $tax->name
	);

}

add_action( 'admin_menu', 'department_admin_page' );

/**
 * Fix position of user taxonomy in admin menu to be under Users by filtering parent_file
 *
 * Should be used with 'parent_file' filter.
 *
 * This is a fix to make edit-tags.php work as an editor of user taxonomies, it solves a
 * problem where the "Posts" sidebar item is expanded rather than "Users".
 *
 * @see add_user_taxonomy_admin_page() which registers the user taxonomy page as edit-tags.php
 * @global string $pagenow Filename of current page (like edit-tags.php)
 * @param string $parent_file Filename of admin page being filtered.
 * @return string Filtered filename
 *
 * Source: https://wordpress.stackexchange.com/a/218624
 */
function filter_user_taxonomy_admin_page_parent_file( $parent_file = '' ) {
	global $pagenow;

	if ( ! empty( $_GET['taxonomy'] ) && ( 'department' == $_GET['taxonomy'] ) && ( 'edit-tags.php' == $pagenow || 'term.php' == $pagenow ) ) {
		$parent_file = 'users.php';
	}

	return $parent_file;

}

add_filter( 'parent_file', 'filter_user_taxonomy_admin_page_parent_file' );

/**
 * Manage user department on Your Profile page
 *
 * @param [type] $user
 * @return void
 */
function edit_user_department( $user ) {

	$tax_name = 'department';
	$tax      = get_taxonomy( $tax_name );

	/* Make sure the user can assign terms of the profession taxonomy before proceeding. */
	if ( ! current_user_can( $tax->cap->assign_terms ) ) :
		return;
	endif;

	/* Get the terms of the 'profession' taxonomy. */
	$terms      = get_terms( $tax_name, array( 'hide_empty' => false ) );
	$department = ( isset( get_user_meta( $user->ID )[ $tax_name ] ) ? get_user_meta( $user->ID )[ $tax_name ][0] : false );

	?>
	<h3><?php _e( 'Company Department' ); ?></h3>
	<table class="form-table">
		<tr>
			<th>
				<label for="department"><?php esc_html_e( 'Department' ); ?></label>
			</th>
			<td>
			<?php

				/* If there are any profession terms, loop through them and display checkboxes. */
			if ( ! empty( $terms ) ) :

				?>
				<select name="department" id="department">
				<?php foreach ( $terms as $term ) : ?>
							<option value="<?php echo esc_attr( $term->term_id ); ?>" <?php selected( $department, $term->term_id ); ?>><?php echo esc_html( $term->name ); ?></option>
						<?php endforeach; ?>
				</select>
				<?php

				/* If there are no departments added, display a message. */
				else :
					esc_html_e( 'There are no departments available.', 'viderum' );
				endif

				?>
			</td>
		</tr>
	</table>
	<?php

}

add_action( 'show_user_profile', 'edit_user_department' );
add_action( 'edit_user_profile', 'edit_user_department' );


/**
 * Save user department per user when set
 *
 * @param [type] $user_id
 * @return void
 */
function save_user_department( $user_id ) {

	$tax = get_taxonomy( 'department' );

	/*
     * Make sure the current user can edit the user and assign terms before proceeding.
     */
	if ( ! current_user_can( 'edit_user', $user_id ) && current_user_can( $tax->cap->assign_terms ) ) :
		return false;
	endif;

	$term = esc_attr( $_POST['department'] );

	/* Sets the terms (we're just using a single term) for the user. */
	update_user_meta( $user_id, 'department', $term );

}

add_action( 'personal_options_update', 'save_user_department' );
add_action( 'edit_user_profile_update', 'save_user_department' );

/**
 * Function for updating the 'profession' taxonomy count.  What this does is update the count of a specific term
 * by the number of users that have been given the term.  We're not doing any checks for users specifically here.
 * We're just updating the count with no specifics for simplicity.
 *
 * See the _update_post_term_count() function in WordPress for more info.
 *
 * @param array  $terms List of Term taxonomy IDs
 * @param object $taxonomy Current taxonomy object of terms
 */
function update_count_department_callback( $terms, $taxonomy ) {
	global $wpdb;

	foreach ( (array) $terms as $term ) {

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );

		do_action( 'edit_term_taxonomy', $term, $taxonomy );
		$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
		do_action( 'edited_term_taxonomy', $term, $taxonomy );
	}

}
