<?php $this->beginContent('//layouts/main'); ?>
<div class="breadcrumbs-block pages__breadcrumbs-block">
	<div class="breadcrumbs-block__container container">
		<?$this->widget('\ext\D\breadcrumbs\widgets\Breadcrumbs', array('breadcrumbs'=>$this->breadcrumbs->get()))?>
	</div>
</div>
<div class="pages__body">
	<div class="pages__body-container container">
		<div class="pages__body-row">
			<aside class="sidebar pages__sidebar">
			<section class="widget sidebar__widget">
				<h2 class="widget__title">Каталог</h2>
				<?$this->widget('widget.ShopCategories.ShopCategories', ['listClass' => 'catalog-list sidebar__catalog-list'])?>
			</section>
			<section class="widget sidebar__widget">
				<h2 class="widget__title">Новости</h2>
				<?$this->widget('widget.Events.Events')?>
			</section>
			</aside>
			<main class="main pages__main">
			<?= $content ?>
			</main>
		</div>
	</div>
</div>

<?php $this->endContent(); ?>
