<div class="container">
  <ul class="timeline">
    <?php 
      // print_r($post);
      foreach ($post as $post) {
    ?>
      <li>
        <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
        <div class="timeline-panel">
          <div class="timeline-body">
            <article class="post-wrap thumbnail">
              <div class="post-media">                    
                  <div class="post-meta clearfix">
                      <span class="pull-left"><span class="post-date"><i class="fa fa-clock-o"></i>
                        <?php echo $post['time']; ?>
                      </span>
                      </span>
                  </div>
              </div>
              <div class="post-header">
                  <h4 class="post-title"><?php echo $post['desc']; ?></h4>
              </div>
              <div class="post-body">
                  <div class="post-excerpt">
                    <ul class="thumbnails">
                    <?php
                    foreach ($post['media'] as $media) {
                      $allowed =  array('gif','jpg','png');
                      $ext = pathinfo(strtolower($media), PATHINFO_EXTENSION);
                      if(in_array($ext, $allowed)){
                        echo "
                          <img style='height:150px;' src='https://s3-us-west-2.amazonaws.com/krunalupload/".$media."' />
                        ";
                      } else {
                        echo "<iframe height='150' src='https://s3-us-west-2.amazonaws.com/krunalupload/".$media."'></iframe>";
                      }
                    } ?>
                    </ul>
                  </div>
              </div>
          </article>
          </div>
        </div>
      </li>
      <?php } ?>
  </ul>
</div>
<script>
$(function() {
  $('#imgvid').click(function(e) {
    $("#imgvid-form").delay(100).fadeIn(100);
    $("#images-form").fadeOut(100);
    $('#images').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#images').click(function(e) {
    $("#images-form").delay(100).fadeIn(100);
    $("#imgvid-form").fadeOut(100);
    $('#imgvid').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
});
$("#edit").click(function(e){
  $("#nedit").hide();
  $("#fedit").show();
});
$(function () {
    $('#datetimepicker1').datepicker({
      format: 'yyyy/mm/dd',
      });
});
</script>