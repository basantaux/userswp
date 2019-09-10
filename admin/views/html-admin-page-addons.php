<?php
/**
 * Admin View: Page - Addons
 *
 * @var string $view
 * @var object $addons
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_ThickBox();
?>
<div class="wrap uwp_addons_wrap">
	<h1><?php echo get_admin_page_title(); ?></h1>

	<?php if ( $tabs ){ ?>
		<nav class="nav-tab-wrapper uwp-nav-tab-wrapper">
			<?php
			foreach ( $tabs as $name => $label ) {
				echo '<a href="' . admin_url( 'admin.php?page=uwp-addons&tab=' . $name ) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
			}
			do_action( 'uwp_addons_tabs' );
			?>
		</nav>

		<?php

		if($current_tab == 'membership'){

			?>

			<div class="uwp-membership-tab-conatiner">
				<div class="uwp-membership-content">

			<!--	<h2>With our UsersWP Membership you get access to all our products!</h2>
				<p><a class="button button-primary" href="https://userswp.io/downloads/membership/">View Memberships</a></p>-->
				<?php if(defined('WP_EASY_UPDATES_ACTIVE')){?>

					<h2>Have a membership key?</h2>

					<p>
						<?php
						$wpeu_admin = new External_Updates_Admin('userswp.io','1');
						echo $wpeu_admin->render_licence_actions('userswp.io', 'membership',array(238,239,240));
						?>
					</p>
				<?php }?>

				<div class="uwp-membership-cta-contet">
					<div class="main-cta">
							<h2>Membership benefit Includes:</h2>
							<div class="feature-list">
								<ul>
										<li><span class="dashicons dashicons-yes-alt"></span> Moderation</li>
										<li><span class="dashicons dashicons-yes-alt"></span> MailChimp</li>
										<li><span class="dashicons dashicons-yes-alt"></span> WooCommerce</li>
										<li><span class="dashicons dashicons-yes-alt"></span> bbPress</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Restrict User Signups</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Profile Progress</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Claim myCRED</li>
										<li><span class="dashicons dashicons-yes-alt"></span> WP Job Manager</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Followers</li>
										<li><span class="dashicons dashicons-yes-alt"></span> GD Multisite Creator</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Frontend Post</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Activity</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Verified Users</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Ajax Friends</li>
										<li><span class="dashicons dashicons-yes-alt"></span> List Online Users</li>
										<li><span class="dashicons dashicons-yes-alt"></span> WP Easy Digital Downloads</li>
										<li><span class="dashicons dashicons-yes-alt"></span> Social Login</li>
										<li><span class="dashicons dashicons-yes-alt"></span> ReCaptcha</li>
										
								</ul>
							</div>
							<div class="feature-cta">
								<h3>Membership <br>Starts from</h3>
								<h4>$99</h4>
								<a href="https://wpgeodirectory.com/downloads/membership/" target="_blank">Buy Membership</a>
							</div>

					</div>
					<div class="member-testimonials">
						<h3>Testimonials</h3>
						<div class="testimonial-content">
							<div class="t-image">
								<?php
									echo '<img src="' . plugins_url( 'images/t-image2.jpeg', dirname(__FILE__) ) . '" > ';
								?>
							</div>
							<div class="t-content">
								<p>
									I need a user solution that worked and this fit the bill. Using the shortcodes you can customize it into any theme. A bit of a learning curve, but the guys help.
I love their wpgeodirectory, and this is proving to be a great tool for custom user profiles etc.
								</p>
								<p><strong>mssingley </strong> (@mssingley)</p>
							</div>
						</div>

						<div class="testimonial-content">
							<div class="t-image">
								<?php
									echo '<img src="' . plugins_url( 'images/t-image1.jpeg', dirname(__FILE__) ) . '" > ';
								?>
							</div>
							<div class="t-content">
								<p>
									Love it, easy to use and had it up & running in minutes.
The shortcode option is handy for widgets and other bespoke pages.<br><br>

But the list of extra “Pro” features is amazing (some still free like RECAPTCHA)<br><br>

Would not hesitate to use this again on my next project.<br><br>
								</p>
								<p><strong>Exo </strong> (@richardshea)</p>
							</div>
						</div>
					</div>
					<div class="member-footer">
						<a class="footer-btn" href="https://wpgeodirectory.com/downloads/membership/" target="_blank">Buy Membership</a>
						<a class="footer-link" href="post-new.php?post_type=gd_place">Create your First Listing</a>
					</div>
				</div>

			</div>
			</div>

			<?php
		}else{
			$installed_plugins = get_plugins();
            $addon_obj = new UsersWP_Admin_Addons();
			if ($addons = $addon_obj->get_section_data( $current_tab ) ) :
				?>
				<ul class="uwp-products"><?php foreach ( $addons as $addon ) :
						?><li class="uwp-product">
								<div class="uwp-product-title">
									<h3><?php
										if ( ! empty( $addon->info->excerpt) ){
											echo uwp_help_tip( $addon->info->excerpt );
										}
										echo esc_html( $addon->info->title ); ?></h3>
								</div>

								<span class="uwp-product-image">
									<?php if ( ! empty( $addon->info->thumbnail) ) : ?>
										<img src="<?php echo esc_attr( $addon->info->thumbnail ); ?>"/>
									<?php endif;

									if(isset($addon->info->link) && substr( $addon->info->link, 0, 21 ) === "https://wordpress.org"){
										echo '<a href="'.admin_url('/plugin-install.php?tab=plugin-information&plugin='.$addon->info->slug).'&TB_iframe=true&width=770&height=660" class="thickbox" >';
										echo '<span class="uwp-product-info">'.__('More info','userswp').'</span>';
										echo '</a>';
									}elseif(isset($addon->info->link) && substr( $addon->info->link, 0, 18 ) === "https://userswp.io"){
										if(defined('WP_EASY_UPDATES_ACTIVE')){
											$url = admin_url('/plugin-install.php?tab=plugin-information&plugin='.$addon->info->slug.'&TB_iframe=true&width=770&height=660&item_id='.$addon->info->id.'&update_url=https://userswp.io');
										}else{
											// if installed show activation link
											if(isset($installed_plugins['wp-easy-updates/external-updates.php'])){
												$url = '#TB_inline?width=600&height=50&inlineId=uwp-wpeu-required-activation';
											}else{
												$url = '#TB_inline?width=600&height=50&inlineId=uwp-wpeu-required-for-external';
											}
										}
										echo '<a href="'.$url.'" class="thickbox">';
										echo '<span class="uwp-product-info">'.__('More info','userswp').'</span>';
										echo '</a>';
									}

									?>

								</span>


								<span class="uwp-product-button">
									<?php
                                    $addon_obj->output_button( $addon );
									?>
								</span>

								<span class="uwp-price"><?php //print_r($addon); //echo wp_kses_post( $addon->price ); ?></span></li><?php endforeach; ?></ul>
			<?php endif;
		}

	}
	?>


	<div class="clearfix" ></div>

	<?php if($current_tab =='addons'){?>
	<p><?php printf( __( 'All of our UsersWP Addons can be found on UsersWP.io here: <a href="%s">UsersWP Addons</a>', 'userswp' ), 'https://userswp.io/downloads/category/addons/' ); ?></p>
	<?php } ?>

	<div id="uwp-wpeu-required-activation" style="display:none;"><span class="uwp-notification "><?php printf( __("The plugin <a href='https://wpeasyupdates.com/' target='_blank'>WP Easy Updates</a> is required to check for and update some installed plugins/themes, please <a href='%s'>activate</a> it now.",'userswp'),wp_nonce_url(admin_url('plugins.php?action=activate&plugin=wp-easy-updates/external-updates.php'), 'activate-plugin_wp-easy-updates/external-updates.php'));?></span></div>
	<div id="uwp-wpeu-required-for-external" style="display:none;"><span class="uwp-notification "><?php printf(  __("The plugin <a href='https://wpeasyupdates.com/' target='_blank'>WP Easy Updates</a> is required to check for and update some installed plugins/themes, please <a href='%s' onclick='window.open(\"https://wpeasyupdates.com/wp-easy-updates.zip\", \"_blank\");' >download</a> and install it now.",'userswp'),admin_url("plugin-install.php?tab=upload&wpeu-install=true"));?></span></div>
	<div id="wpeu-licence-popup" style="display:none;">
		<span class="uwp-notification noti-white">
			<h3 class="wpeu-licence-title"><?php _e("Licence key",'userswp');?></h3>
			<input class="wpeu-licence-key" type="text" placeholder="<?php _e("Enter your licence key",'userswp');?>"> <button class="button-primary wpeu-licence-popup-button" ><?php _e("Install",'userswp');?></button>
			<br>
			<?php
			echo sprintf( __('%sFind your licence key here%s OR %sBuy one here%s', 'userswp'), '<a href="https://userswp.io/your-account/" target="_blank">','</a>','<a class="wpeu-licence-link" href="https://userswp.io/downloads/category/addons/" target="_blank">','</a>' );
			?>
		</span>
	</div>

</div>
