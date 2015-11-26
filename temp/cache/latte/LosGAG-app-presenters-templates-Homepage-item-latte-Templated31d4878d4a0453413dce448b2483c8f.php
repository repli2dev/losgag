<?php
// source: /Users/jan/Downloads/LosGAG/app/presenters/templates/Homepage/item.latte

class Templated31d4878d4a0453413dce448b2483c8f extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('a183ef92e7', 'html')
;
// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIRuntime::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>
<div class="gag" id="post-<?php echo Latte\Runtime\Filters::escapeHtml($item->id_post, ENT_COMPAT) ?>">
	<img class="main2" src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/images/<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($item->id_post), ENT_COMPAT) ?>" alt="Gag, gag!">
	<span class="info">
		<img src="<?php echo Latte\Runtime\Filters::escapeHtml(Latte\Runtime\Filters::safeUrl($basePath), ENT_COMPAT) ?>
/css/tracks.png" width="20px" class="likes"><?php echo Latte\Runtime\Filters::escapeHtml($item->likes, ENT_NOQUOTES) ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("like!", array($item->id_post)), ENT_COMPAT) ?>">Olosovat!</a>
		<span class="date"><?php echo Latte\Runtime\Filters::escapeHtml($template->date($item->inserted, "j. n. Y H:i:s"), ENT_NOQUOTES) ?></span>
	</span>
</div><?php
}}