<?php
/**
 * Template snippet for Google Analytics' tracking code
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

$ga_tracking_code = get_option( 'viderum_settings' )['ga_tracking_id'];

if ( $ga_tracking_code ) :

	?>
	<script>
		(function (i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function () {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
					m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		ga('create', '<?php echo esc_js( $ga_tracking_code ); ?>', 'auto');
		ga('send', 'pageview');

	</script>
	<?php

endif;
