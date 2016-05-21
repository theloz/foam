<?php
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
?>
<div class="col-sm-4"><?php echo $form->field($model, 'extime'.$exno, ['inputOptions'=>['type'=>'number','value'=>0]]); ?></div>
<div class="col-sm-8"><?php echo $form->field($model, 'exname'.$exno, [])->textarea(); ?></div>
<div class="col-sm-4"><?php echo $form->field($model, 'ruleprovoke'.$exno, [])->textarea(); ?></div>
<div class="col-sm-4"><?php echo $form->field($model, 'rulecontinue'.$exno, [])->textarea(); ?></div>
<div class="col-sm-4"><?php echo $form->field($model, 'rulecorection'.$exno, [])->textarea(); ?></div>
<div class="col-md-12">
        <?php
        Modal::begin([
                'header'	=> '<h3>Scegli il video</h3>',
                'options'	=> [],
                'toggleButton'	=> ['label' => 'Inserisci video', 'class'=>'btn btn-info', 'onclick'=>'$("#dropzonesel").val("'.$exno.'")'],
                'size'		=> 'modal-lg',
                'footer'	=> '<button class="btn btn-info" data-dismiss="modal">Chiudi</button>'
        ]);
        echo '<div class="menusliderstyle" id="videoslidemenu">';
        echo $this->render( '_videolist', ['param'=> 'oo'] );
        echo '</div>';
        Modal::end();
        ?>
        <?php
        Modal::begin([
                'header'	=> '<h3>Scegli lo schema</h3>',
                'options'	=> [],
                'toggleButton'	=> ['label' => 'Inserisci schema', 'class'=>'btn btn-info', 'onclick'=>'$("#dropzonesel").val("'.$exno.'")'],
                'size'		=> 'modal-lg',
                'footer'	=> '<button class="btn btn-info" data-dismiss="modal">Chiudi</button>'
        ]);
        echo '<div class="menusliderstyle" id="schemaslidemenu">';
        echo $this->render( '_schemalist', ['param'=> 'oo'] );
        echo '</div>';
        Modal::end();
        ?>
        <?php
        Modal::begin([
                'header'	=> '<h3>Scegli l\'immagine</h3>',
                'options'	=> [],
                'toggleButton'	=> ['label' => 'Inserisci immagine', 'class'=>'btn btn-info', 'onclick'=>'$("#dropzonesel").val("'.$exno.'")'],
                'size'		=> 'modal-lg',
                'footer'	=> '<button class="btn btn-info" data-dismiss="modal">Chiudi</button>'
        ]);

        echo '<div class="menusliderstyle" id="videoslidemenu">';
        //echo $this->render( '_videolist', ['param'=> 'oo'] );
        echo '</div>';
        Modal::end();
        ?>
        <!--button class="btn btn-info" id="videotoggle">Inserisci Video</button>
        <button class="btn btn-info" id="schematoggle">Inserisci schema</button>
        <button class="btn btn-info" id="imagetoggle">Inserisci Immagine</button-->
</div>
<div class="col-md-12 mediazone zone<?=$exno?>">
        <p class="firstmediazone<?=$exno?>">Nessun file allegato</p>
</div>
<div class="clearfix"></div>
