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
$product = 'COMMUNITY';
$cc_api_key = '18bebc71136a7eadcbf114a44278ef812c277351';
$locales = [];

if ( function_exists( 'pll_current_language' ) && 'de' === pll_current_language() ) :
	// Cookie Control account type for viderum.de
	$product = 'PRO';

	// Cookie Control API key for viderum.de
	$cc_api_key = 'cddf33e1315a5ea640440460d26f3cb7ca311818';

	// Google Analytics tracking id for viderum.de
	$ga_tracking_code = 'UA-71073754-3';

	$locales = "[
		{
			locale: 'de',
			text: {
				title: 'Viderum verwendet Cookies, um Daten auf Ihrem Computer zu spreichern und Ihnen diese Website in bestmöglicher Qualität anzubieten.',
				intro: 'Einige dieser Cookies sind für die störungsfreie Nutzung der Website notwendig, während andere uns dabei helfen, mehr darüber zu erfahren, wie diese Website verwendet wird.',
				necessaryTitle: 'Notwendige Cookies',
				necessaryDescription: 'Notwendige Cookies ermöglichen die Kernfunktionalität wie beispielsweise die Seitennavigation oder Zugang zu passwortgeschützten Bereichen. Diese Website funktioniert ohne diese Cookies nicht. Solche Cookies können nur durch Änderungen an Ihren Browser-Einstellungen deaktiviert werden.',
				on: 'An',
				off: 'Aus',
				notifyTitle: 'Cookie-Einstellungen für diese Website',
				notifyDescription: 'Viderum verwendet Cookies, um die Funktionalität dieser Website zu verbessern.',
				accept: 'Akzeptieren',
				settings: 'Cookie-Einstellungen',
				thirdPartyTitle: 'Einige Cookies benötigen Ihre Aufmerksamkeit',
				thirdPartyDescription: 'Für die folgenden Cookies konnte die Zustimmung nicht automatisch entzogen werden. Öffnen Sie bitte die folgenden Links, um Sie manuell zu deaktivieren.',
				optionalCookies: [{
					label: 'Auswertungen',
					description: 'Diese Cookies helfen uns dabei, die Website für Ihren Gebrauch zu optimieren, indem wir Informationen zur individuellen Nutzung anonym sammeln und auswerten.'
				}],
				acceptRecommended: 'Empfohlene Einstellungen akzeptieren'
			}
		}
	]";
endif;

?>
<script>
	var necessaryCookies = ['_ga', '_gid', '_gat', '__utma', '__utmt', '__utmb', '__utmc', '__utmz', '__utmv'];
	var config = {
		apiKey: '<?php echo esc_html( $cc_api_key ); ?>',
		product: '<?php echo esc_html( $product ); ?>',
	<?php if ( function_exists( 'pll_current_language' ) && 'de' === pll_current_language() ) : ?>
		locales: <?php echo $locales; ?>,
	<?php endif; ?>
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
