<?php if (!defined('PmWiki')) exit();
/* PmWiki Equilibrium skin
 *
 * Examples at: http://pmwiki.com/Cookbook/Equilibrium and http://solidgone.com/Skins/
 * Copyright (c) 2009 David Gilbert
 * This work is licensed under a Creative Commons Attribution-Share Alike 3.0 United States License.
 * Please retain the links in the footer.
 * http://creativecommons.org/licenses/by-sa/3.0/us/
 */
global $FmtPV,$HTMLStylesFmt,$MarkupExpr;
$FmtPV['$SkinName'] = '"equilibrium"';
$FmtPV['$SkinVersion'] = '"1.0.1"';
$FmtPV['$SkinDate'] = '"20090712"';

$MarkupExpr['mod'] = '($args[0] % $args[1])';

# Default color scheme
global $SkinColor, $ValidSkinColors;
$UserSkinColors = (is_array($ValidSkinColors) ?$ValidSkinColors :array());
$ValidSkinColors['black'] = array('block-highlight-back'=>'#000','entry-title-text'=>'#0B96D0','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['red'] = array('block-highlight-back'=>'#CC0000','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['orange'] = array('block-highlight-back'=>'#FF7400','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['dark-orange'] = array('block-highlight-back'=>'#D64B00','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['light-blue'] = array('block-highlight-back'=>'#4096EE','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['pink'] = array('block-highlight-back'=>'#FF0084','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['purple'] = array('block-highlight-back'=>'#80185B','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['gold'] = array('block-highlight-back'=>'#C79810','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['green'] = array('block-highlight-back'=>'#008C00','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['blue'] = array('block-highlight-back'=>'#356AA0','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['mint'] = array('block-highlight-back'=>'#CDEB8B','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors['dark-blue'] = array('block-highlight-back'=>'#3F4C6B','entry-title-text'=>'#000','text-highlight'=>'#0B96D0','block-highlight-text'=>'#fff','title-text'=>'#000');
$ValidSkinColors = array_merge($ValidSkinColors, $UserSkinColors);

if ( isset($_GET['color']) && isset($ValidSkinColors[$_GET['color']]) ) {
	$SkinColor = $_GET['color'];
} elseif ( !isset($ValidSkinColors[$SkinColor]) ) {
	$SkinColor = 'black';
}

$UserStyle = $HTMLStylesFmt['equilibrium'];
$HTMLStylesFmt['equilibrium'] =
	'.featured .title,.latest .title,.featured .title h2 a,.latest .title h2 a'.
		'{color:'. $ValidSkinColors[$SkinColor]['entry-title-text']. '}'.
	'.featured-title h2 a:hover,.featured .title h2 a:hover{color:'. $ValidSkinColors[$SkinColor]['block-highlight-text'].'}'.
	'.featured .title,.latest .title{background:'. $ValidSkinColors[$SkinColor]['block-highlight-back'].'}'.
	'p a,p a:visited,.postMeta-post a,.postMeta-post a:visited,.featured .post-content h2 a,'.
	'.latest .post-content h2,#footer div a:hover,'.
	'#comments .commentmetadata li a'.
		'{color:'. $ValidSkinColors[$SkinColor]['text-highlight']. '}'.
	'#sidebar a:hover,#nav a:hover,#siteheader ul a:hover,ul#nav li.current_page_item a:link,'.
	'ul#nav li.current_page_item a:visited,ul#nav li.current_page_item a:hover,ul#nav li.current_page_item a:active,'.
	'#siteheader ul li.current_page_item a:link,#siteheader ul li.current_page_item a:visited,#siteheader ul li.current_page_item a:hover,'.
	'#siteheader ul li.current_page_item a:active'.
		'{color:'. $ValidSkinColors[$SkinColor]['block-highlight-text'].
		';background:'. $ValidSkinColors[$SkinColor]['block-highlight-back'].'}'.
	'#siteheader .sitetitle.logo a, #siteheader .sitetitle a'.
		'{color:'. $ValidSkinColors[$SkinColor]['title-text']. '} ';

global $PageLogoUrl, $PageLogoUrlHeight, $PageLogoUrlWidth;
if (!empty($PageLogoUrl)) {
	if (!isset($PageLogoUrlWidth) || !isset($PageLogoUrlHeight)) {
		$size = @getimagesize(urlencode($PageLogoUrl));
		SDV($PageLogoUrlWidth, ($size ?$size[0]+15 :0) .'px');
		SDV($PageLogoUrlHeight, ($size ?$size[1] :0) .'px');
	}
	$HTMLStylesFmt['equilibrium'] .=
		'#siteheader .sitetitle a{'. (isset($PageLogoUrlHeight) ?'height:' .$PageLogoUrlHeight .';' :''). ' background: url(' .$PageLogoUrl .') left top no-repeat} '.
		(isset($PageLogoUrlWidth) ?'#siteheader .sitetitle a, #siteheader .sitetag{padding-left: ' .$PageLogoUrlWidth .'} ' :'').
		(isset($PageLogoUrlHeight) ?'#siteheader .sitetag{margin-top: ' .(45-substr($PageLogoUrlHeight,0,-2)) .'px}' :'');
}

$HTMLStylesFmt['equilibrium'] .= $UserStyle;

global $WikiStyleApply;
$WikiStyleApply['a'] = 'a';

# Move any (:noleft:) or SetTmplDisplay('PageLeftFmt', 0); directives to variables for access in jScript.
$FmtPV['$RightColumn'] = "\$GLOBALS['TmplDisplay']['PageRightFmt']";
Markup('noright', 'directives',  '/\\(:noright:\\)/ei', "SetTmplDisplay('PageRightFmt',0)");
$FmtPV['$ActionBar'] = "\$GLOBALS['TmplDisplay']['PageActionFmt']";
Markup('noaction', 'directives',  '/\\(:noaction:\\)/ei', "SetTmplDisplay('PageActionFmt',0)");
$FmtPV['$TabsBar'] = "\$GLOBALS['TmplDisplay']['PageTabsFmt']";
Markup('notabs', 'directives',  '/\\(:notabs:\\)/ei', "SetTmplDisplay('PageTabsFmt',0)");

# ----------------------------------------
# - Standard Skin Setup
# ----------------------------------------
$FmtPV['$WikiTitle'] = '$GLOBALS["WikiTitle"]';
$FmtPV['$WikiTag'] = '$GLOBALS["WikiTag"]';
Markup('fieldset', 'inline', '/\\(:fieldset:\\)/i', "<fieldset>");
Markup('fieldsetend', 'inline', '/\\(:fieldsetend:\\)/i', "</fieldset>");

# Define a link stye for new page links
global $LinkPageCreateFmt;
SDV($LinkPageCreateFmt, "<a class='createlinktext' href='\$PageUrl?action=edit'>\$LinkText</a>");

# Override pmwiki styles otherwise they will override styles declared in css
global $HTMLStylesFmt;
$HTMLStylesFmt['pmwiki'] = '';

# Add a custom page storage location
global $WikiLibDirs;
$PageStorePath = dirname(__FILE__)."/wikilib.d/{\$FullName}";
$where = count($WikiLibDirs);
if ($where>1) $where--;
array_splice($WikiLibDirs, $where, 0, array(new PageStore($PageStorePath)));
