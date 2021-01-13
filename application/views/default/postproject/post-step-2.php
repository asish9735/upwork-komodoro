<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//dd($memberInfo,TRUE);
?>
<div id="dataStep-2" style="display: none">	
<div class="dashboard-box margin-top-0">
    <!-- Headline -->
    <div class="headline">
        <h3> Description </h3>
    </div>
    <div class="content with-padding">    
            <div class="submit-field">
                <label>Description about project</label>
                <textarea  class="form-control" name="description" id="description"></textarea>
                <span id="descriptionError" class="rerror"></span>

            </div>
        
            <div class="submit-field">
                <label>Project attachment</label>                
                <input type="file" name="fileinput" id="fileinput" multiple="true">
                <div class="upload-area" id="uploadfile">
                    <p>Drag &amp; drop file here<br /> or<br /> <span class="text-site">click</span> to select file</p>
                </div>
                <div id="uploadfile_container"></div>
            </div>        
    </div>
    <div class="dashboard-box-footer">
        <button class="btn btn-secondary backbtnproject" data-step="2">Back</button>
        <button class="btn btn-site nextbtnproject" data-step="2">Next</button>
    </div>
</div>
</div>
