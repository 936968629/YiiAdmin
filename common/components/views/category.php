<?php use app\common\service\UrlService; ?>
<?php foreach ($model as $item): ?>
<div class="subNav sublist-down">
    <span class="title-icon glyphicon glyphicon-chevron-right"></span>
    <span class="sublist-title"><?= $item['name'] ?></span>
</div>
<?php if(!empty($item['child'])):?>
<ul class="navContent" style="display:none">
    <?php foreach ($item['child'] as $itemchild): ?>
    <li class="nav-li">
        <div class="showtitle" style="width:100px;">
            <img src="__ADMIN_IMAGES__/leftimg.png" />
        </div>
        <a href="<?= UrlService::buildWwwUrl($itemchild['url']); ?>" target="right_content">
            <span class="sublist-icon glyphicon glyphicon-record"></span>
            <span class="sub-title"><?= $itemchild['name'] ?></span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
<?php endforeach; ?>