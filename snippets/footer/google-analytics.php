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

?>
<script>
	var necessaryCookies = ['_ga', '_gid', '_gat', '__utma', '__utmt', '__utmb', '__utmc', '__utmz', '__utmv'];
	var config = {
		apiKey: '18bebc71136a7eadcbf114a44278ef812c277351',
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
