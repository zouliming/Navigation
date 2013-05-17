<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>兵器谱</title>
        <link rel="stylesheet" type="text/css" href="css/36.css"></style>
    </head>
    <body>
        <div class="container">
            <div class="clear"></div>
            <div id="content" class="content">
                <section>
                <?php
                    if(isset($view)){
                        require 'tpl/'.$view;
                    }
                ?>
                </section>
            </div>
            <div class="row-fluid">
                <nav style="margin-top: -25px;" class="sideBar hidden-phone pull-left">
                    <ul class="side_nav affix">
                        <li>
                            <figure>
                                <h1>
                                    <a href="#">
                                        <img width="90" height="90" src="img/a.jpg" alt="兵器谱" title="邹立明的兵器谱"></a>
                                </h1>
                            </figure>
                        </li>
                        <?php
                        foreach($menu as $v){
                            $activeStr = str_replace('/', '', $_SERVER['SCRIPT_NAME'])==$v['url']?" class='active'":"";
                        ?>
                        <li<?=$activeStr?>>
                            <figure>
                                <div class="menuText">
                                    <a href="<?=$v['url']?>" <?php if(isset($v['attr'])){ foreach($v['attr'] as $a=>$av){ echo $a.'="'.$av.'"'; } }?>><?=$v['title']?></a>
                                </div>
                            </figure>
                        </li>
                        <?php
                        }
                        ?>
                </nav>
            </div>
        </div>
    </body>
</html>