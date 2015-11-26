<?php
// source: /Users/jan/Downloads/LosGAG/app/presenters/templates/Homepage/default.latte

class Templated4c91c6a924cd538715e309854533a91 extends Latte\Template {
function render() {
foreach ($this->params as $__k => $__v) $$__k = $__v; unset($__k, $__v);
// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('a4cfc40f6d', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb650b777c9b_content')) { function _lb650b777c9b_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if (isset($password) && $password) { ?>
	<div class="ok">Vaše odměna... Heslo je: <?php echo Latte\Runtime\Filters::escapeHtml($password, ENT_NOQUOTES) ?></div>
<?php } ?>
<p><b>Nahrajte nám sem nějaký pěkný obrázek/fotku/memečko/gag, který se bude líbit a vaše odměna vás nemine! Nezapomínejte obnovovat stránku pro nové přírustky.</b></p>
<p>Pravidla:</p>
<ul>
	<li>Každý tým může nahrát až 10 obrázků.</li>
	<li>Povolené formáty jsou: JPEG, PNG, GIF.</li>
	<li>Velikost obrázku musí být do 2 MB.</li>
	<li>Nevhodné obrázky (urážlivé,...) budou smazány a tým bude diskvalifikován.</li>
</ul>

<div class="hr"></div>

<?php $_l->tmp = $_control->getComponent("uploadForm"); if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render() ?>

<div class="hr"></div>

<h2>Právě v kurzu (aka trendy)</h2>

<?php if (count($trending) > 0) { $iterations = 0; foreach ($trending as $post) { $_b->templates['a4cfc40f6d']->renderChildTemplate('item.latte', array('item' => $post) + $template->getParameters()) ;$iterations++; } } else { ?>
	<p><i>Momentálně není nic zajímavého a trendy ;-)</i></p>
<?php } ?>

<div class="hr"></div>

<h2>Vše od začátku věků</h2>

<?php if (count($history) > 0) { $iterations = 0; foreach ($history as $post) { $_b->templates['a4cfc40f6d']->renderChildTemplate('item.latte', array('item' => $post) + $template->getParameters()) ;$iterations++; } } else { ?>
	<p><i>Historie čeká na odvážné!</i></p>
<?php } ?>

<?php
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


<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 
}}