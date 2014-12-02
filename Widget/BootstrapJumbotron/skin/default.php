<div class="jumbotron">
    <?php foreach ($blocks as $key => $block):?>
    <div class="content">
    <?php echo ipBlock($block)->exampleContent('')->render($revisionId); ?>
    </div>
    <?php endforeach;?>
</div>