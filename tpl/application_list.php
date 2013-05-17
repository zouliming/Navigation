<div class='application_list'>
    <ul>
        <?php
        foreach ($vhostConfig as $application){
        ?>
        <li>
            <div class='server'>
                <h1><?=$application['server']?></h1>
                <?
                if(isset($appHostConfig[$application['server']])){
                    echo '<div class="greenTag"></div>';
                }else{
                    echo '<div class="redTag"></div>';
                }
                ?>
                <span>
                    <a target="_blank" href="http://<?=$application['server']?>" >进入应用</a>
                </span>
            </div>
            <div class='path'>
                路径：<?=$application['path']?>
            </div>
        </li>
        <?php
        }
        ?>
    </ul>
</div>
