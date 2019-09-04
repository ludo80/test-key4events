<?php if (!empty($infomessages)) : ?>
  <div class="alert alert-warning text-center">
      <?php foreach ($infomessages as $key => $msg) {echo $msg.'<br />';}; ?>
  </div>    
<?php endif; ?>