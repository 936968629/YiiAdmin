<?= foreach ($model as $item): ?>
<div class="subNav sublist-down">
    <span class="title-icon glyphicon glyphicon-chevron-right"></span>
    <span class="sublist-title">资源管理</span>
</div>
<ul class="navContent" style="display:none">
    <li class="nav-li">
        <div class="showtitle" style="width:100px;">
            <img src="__ADMIN_IMAGES__/leftimg.png" />
        </div>
        <a href="<?= UrlService::buildWwwUrl('source/index'); ?>" target="right_content">
            <span class="sublist-icon glyphicon glyphicon-record"></span>
            <span class="sub-title">资源列表</span>
        </a>
    </li>
</ul>
<?= endforeach; ?>