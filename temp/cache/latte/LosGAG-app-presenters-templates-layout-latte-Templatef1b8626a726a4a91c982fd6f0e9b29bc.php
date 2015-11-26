<?php
// source: /Users/jan/Downloads/LosGAG/app/presenters/templates/@layout.latte

class Templatef1b8626a726a4a91c982fd6f0e9b29bc extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('c1850c8a31', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block head
//
if (!function_exists($_b->blocks['head'][] = '_lbccdb99aa9d_head')) { function _lbccdb99aa9d_head($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;
}}

//
// block scripts
//
if (!function_exists($_b->blocks['scripts'][] = '_lb89eedef55e_scripts')) { function _lb89eedef55e_scripts($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>					<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
					<script src="//nette.github.io/resources/js/netteForms.min.js"></script>
					<script src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/js/main.js"></script>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="footer-line">&nbsp;</div>
		</div>
	</div>
</body>
</html><?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="content-language" content="cz">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
	<meta name="description" content="InterLoS - Internetova Logicka Soutez">
	<link href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/css/stylesheet.css" media="screen" rel="stylesheet" type="text/css">
	<link rel="icon" href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/design/favicon.ico" type="image/x-icon">
	<title><?php if (isset($_b->blocks["title"])) { ob_start(); Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'title', $template->getParameters()); echo $template->striptags(ob_get_clean()) ?>
 | <?php } ?>L9 LosGAG</title>
	<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['head']), $_b, get_defined_vars())  ?>

</head>
<body>
	<div class="root">
		<div class="header">
			<div class="header-line">&nbsp;</div>
			<div class="contents">
				<a href="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>/">
					<span class="block header-logo" title="InterLoS - INTERnetová LOgická Soutěž">&nbsp;</span>
					<span class="block header-name" title="InterLoS - INTERnetová LOgická Soutěž">&nbsp;</span>
					<span class="vandalism">GAG</span>
				</a>
				<div class="header-year"><h1>ročník 2015</h1></div>
				<div class="cleaner-both">&nbsp;</div>
			</div>
		</div>

		<div class="main">
			<div class="contents">
				<div class="main-block">
<?php $iterations = 0; foreach ($flashes as $flash) { ?>					<div<?php if ($_l->tmp = array_filter(array('flash', $flash->type))) echo ' class="', Latte\Runtime\Filters::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT), '"' ?>
><?php echo Latte\Runtime\Filters::escapeHtml($flash->message, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>

<?php Latte\Macros\BlockMacrosRuntime::callBlock($_b, 'content', $template->getParameters()) ?>

<?php call_user_func(reset($_b->blocks['scripts']), $_b, get_defined_vars()) ; 
}}