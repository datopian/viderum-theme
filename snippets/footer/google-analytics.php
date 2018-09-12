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
$cc_api_key = '18bebc71136a7eadcbf114a44278ef812c277351';

if ( function_exists( 'pll_current_language' ) && 'de' === pll_current_language() ) :
	// Cookie Control API key for viderum.de
	$cc_api_key = '353d17fd21dc5abb8cc089927b2938416fe47fc7';

	// Google Analytics tracking id for viderum.de
	$ga_tracking_code = 'UA-71073754-3';
endif;

?>
<script>
	var necessaryCookies = ['_ga', '_gid', '_gat', '__utma', '__utmt', '__utmb', '__utmc', '__utmz', '__utmv'];
	var config = {
		apiKey: '<?php echo esc_html( $cc_api_key ); ?>',
		product: 'COMMUNITY',
		initialState: "OPEN",
		necessaryCookies: necessaryCookies,
		optionalCookies: [{
			name: 'analytics',
			label: 'Analytics',
			description: 'Analytics cookies help us to improve website and services by collecting and reporting information on its usage.',
			cookies: necessaryCookies,
			initialConsentState: "on",
			onAccept: function() {
				<?php if ( $ga_tracking_code ) : ?>
				(function(i, s, o, g, r, a, m) {
					i['GoogleAnalyticsObject'] = r;
					i[r] = i[r] || function() {
						(i[r].q = i[r].q || []).push(arguments);
					}, i[r].l = 1 * new Date();
					a = s.createElement(o),
						m = s.getElementsByTagName(o)[0];
					a.async = 1;
					a.src = g;
					m.parentNode.insertBefore(a, m);
				})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

				ga('create', '<?php echo esc_js( $ga_tracking_code ); ?>', 'auto');
				ga('set', 'anonymizeIp', true);
				ga('send', 'pageview');
				<?php endif; ?>
			},
			onRevoke: function() {
				// Disable GA
				window['ga-disable-<?php esc_html( $ga_tracking_code ); ?>'] = true;
				// End GA
			}
		}],
		position: 'RIGHT',
		theme: 'DARK'
	};
	CookieControl.load(config);
</script>
