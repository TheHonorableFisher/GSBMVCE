<div class="row">
    <div class="col-md-12 col-md-offset-2">

        <legend>Fiches de frais</legend>
        <?php
        foreach ($listeFiche as $key => $value) {
            echo '<div>';
            foreach ($value as $key2 => $value2) {    
                if(is_numeric($key2)){

                }else{
                    echo "<p> $key2 : $value2 </p>";    
                }
            }
            echo '-----------------<br><br>';
            echo '</div>';
        }
        ?>
    </div>
</div>