<?php $v->layout("base"); ?>
<div class="error_code">
    <div class="error_image">
        <i class="fas fa-exclamation-triangle"></i>        
    </div>
    <div class="error_code">
        <span>-. <?= $error->code; ?> .-</span>
    </div>
</div>