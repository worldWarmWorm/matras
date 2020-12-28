<?php foreach($events as $event): ?>
	<article class="news-item">
		<a class="news-item__image-wrap" href="<?= Yii::app()->createUrl('site/event', array('id'=>$event->id)); ?>">
			<img class="news-item__image" src="<?=ResizeHelper::resize($event->previewImg, 440, 360); ?>" alt="<?php echo $event->title; ?>" title="<?php echo $event->title; ?>">
		</a>
		<div class="news-item__content">
			<date class="news-item__date"><?php echo $event->date; ?></date>
			<div class="news-item__title hnews">
				<?php echo CHtml::link($event->title, array('site/event', 'id'=>$event->id), array('class'=>'news-item__title-link')); ?>
			</div>
			<p class="news-item__text"><?php echo $event->intro; ?></p>
		</div>
	</article>
<?php endforeach; ?>