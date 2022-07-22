<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="modal-header">    
    <button type="button" class="btn btn-dark pull-left" data-bs-dismiss="modal"><?php echo __('profileview_cancel','Cancel');?></button>
    <h4 class="modal-title"><?php echo __('proposal_capture_thumb','Capture thumb');?></h4> 

    <button type="button" class="btn btn-site pull-right" onclick="SaveCapture(this)"><?php echo __('profileview_save','Save');?></button>
</div>
<div class="modal-body">
<p class="text-danger">Note: Play the video to create the thumb 
<button type="button" class="btn btn-site pull-right" id="captureBTN" onclick="capture()" style="display:none">Captures</button>
</p>
	<div class="row">
        <div class="col-sm-6">
        <video id="videoId" controls preload="none" style="width:100%" >
        <source id='mp4' src="<?php echo $path;?>" type='video/mp4' />
        <source id='webm' src="<?php echo $path;?>" type='video/webm'/>
        <source id='ogv' src="<?php echo $path;?>" type='video/ogg' />
    </video>

        </div>
        <div class="col-sm-6">
        <canvas id="canvasId" style="display:none;" ></canvas>
    <img id="imgId" src="" crossorigin="anonymous"/>
    

        </div>
    

    </div>
</div>
<script type='text/javascript'>

         
            var video = document.getElementById('videoId');
            var canvas = document.getElementById('canvasId');
            var img = document.getElementById('imgId');
            var btn = document.getElementById('captureBTN');

            video.addEventListener('play', function () {
                
               // canvas.style.display = 'none';
                //img.style.display = 'none';
                var w=800/canvas.width;
                canvas.setAttribute('width', canvas.width*w);
                canvas.setAttribute('height', canvas.height*w);
                btn.style.display = 'block';
            }, false);

            video.addEventListener('pause', function () {
                //canvas.style.display = 'block';
                img.style.display = 'block';

                //draw(video, canvas, img);
            }, false); 
        
function capture(){
	draw(video, canvas, img);
}
        function draw(video, canvas, img) {
            var context = canvas.getContext('2d');
            
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            var dataURL = canvas.toDataURL('image/png');
            img.crossOrigin = "anonymous";
            img.setAttribute('src', dataURL);
        }
        $("#myModal").on('hide.bs.modal', function () {
            $( "#myModal .mycustom-modal").empty();
        })
function SaveCapture(ev){
    var buttonsection=$(ev);
		var buttonval = buttonsection.html();
		buttonsection.html(SPINNER).attr('disabled','disabled');
        var imagesource=$('#imgId').attr('src');
        if(imagesource){
            $.ajax({
                type: "POST",
                url: "<?php D(get_link('savecaptureAJAXURL'))?>",
                data:{'videothumb':imagesource},
                dataType: "json",
                cache: false,
                success: function(msg) {
                    buttonsection.html(buttonval).removeAttr('disabled');
                    if (msg['status'] == 'OK') {
                        var image_thumb=msg.upload_response.thumb;
                        $('.thumbnail_sec_video_capture .addthumb').hide();
                        $('.thumbnail_sec_video_capture .removethumb').show();
                        $('.thumbnail_sec_video_capture #videothumb').val(JSON.stringify(msg.upload_response));
                        $("#myModal").modal('hide');
                        $('.thumbnail_sec_video_capture').css('background-image', 'url(' + image_thumb + ')');
                    }
                }
            });




       
    }else{
        buttonsection.html(buttonval).removeAttr('disabled');
    }

		
}
</script>