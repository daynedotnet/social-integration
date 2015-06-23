           
           </div>            
        </div>

        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <div class="slides"></div>
            <h3 class="title"></h3>
            <!-- <a class="prev">‹</a>
            <a class="next">›</a> -->
            <a class="close">×</a>
            <!-- <a class="play-pause"></a>
            <ol class="indicator"></ol> -->
        </div>

        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-power-off"></span> Sign <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if you want to continue work. Press Yes to signout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?php echo base_url(); ?>auth/signout" class="btn btn-warning btn-lg">Yes</a>
                            <button class="btn btn-danger btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error 403 -->
        <div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="not-authorized">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-warning"></span> Error 403</div>
                    <div class="mb-content">
                        <p>You are not authorized to view this page</p>
                        <p>Trying to access an external Web site that requires authentication, you are not prompted to enter your account credentials.</p>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Error 403 -->
        
        <div class="modal fade" id="db-modal" tabindex="-1" aria-hidden="true"  data-backdrop="static"  data-keyboard="false" role="dialog">
            <div class="load-content">
                <!-- LOAD MODAL CONTENT -->
            </div>
        </div>

        <audio id="audio-alert" src="<?php echo base_url().FOLDER_AUDIO; ?>alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo base_url().FOLDER_AUDIO; ?>fail.mp3" preload="auto"></audio>

        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/bootstrap/bootstrap.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/bootstrap/bootstrap-select.js"></script>      
     
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/summernote/summernote.js"></script>  
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/noty/layouts/topRight.js'></script>
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/noty/themes/default.js'></script>
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/validationengine/jquery.validationEngine.js'></script>  
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/jquery-validation/jquery.validate.js'></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/dropzone/dropzone.min.js"></script>
        <script type='text/javascript' src='<?php echo base_url().FOLDER_JS; ?>plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/daterangepicker/daterangepicker.js"></script> 
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins/owl/owl.carousel.min.js"></script>                

        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>plugins.js"></script>        
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>actions.js"></script>
        <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>application.js"></script>

        <!--
        /*! Designblue Manila - creative instinct
        //@ Web Developer: Ralph Dayne B. Banzon
        */
        -->
      
    </body>
</html>