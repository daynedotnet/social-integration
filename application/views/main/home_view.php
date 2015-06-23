<?php $this->load->view('default/header'); ?>


<div class="content-frame">  

    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2> <?=$pageInfo['header']?></h2>
        </div>                  
    </div> 

	<div class="page-content-wrap">

		<div class="block">

        	<div class="col-md-12">    
        		<h2>Movieclub Analytics</h2>                                        
                <p>Generates detailed statistics about movieclub website's traffic and traffic sources.</p>
            </div>
            
            <div class="row">
	            <div class="col-md-4">
                     <div class="widget widget-primary widget-item-icon">
                        <div class="widget-item-left">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"><?=$this->mhome->getNumberOfRegisteredUsers()?></div>
                            <div class="widget-title">Users</div>
                            <div class="widget-subtitle">Number of user registered on movieclub</div>
                        </div>                          
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfNewUsers()?></span></div>                            
                        <div class="widget-subtitle">New Users</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 30 days" class="widget-control-left"><span class="fa fa-custom-30-days"></a>
                        </div>                          
                    </div>   
                </div>


                <div class="col-md-4">
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfActiveUsers()?></span></div>                            
                        <div class="widget-subtitle">Active Users</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 24 hours" class="widget-control-left"><span class="fa fa-custom-24-hours"></span></a>
                        </div>                          
                    </div>   
                </div>
            </div>

            <div class="row">
	            <div class="col-md-4">
                     <div class="widget widget-primary widget-item-icon">
                        <div class="widget-item-left">
                            <span class="glyphicon glyphicon-film"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"><?=$this->mhome->getNumberOfMovies()?></div>
                            <div class="widget-title">Movies</div>
                            <div class="widget-subtitle">Number of movies uploaded on movieclub</div>
                        </div>                          
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfNewMovies()?></span></div>                            
                        <div class="widget-subtitle">New Movies</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 30 days" class="widget-control-left"><span class="fa fa-custom-30-days"></a>
                        </div>                          
                    </div>    
                </div>

                <div class="col-md-4"> 
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfWatchedMovies()?></span></div>                            
                        <div class="widget-subtitle">Movies Watched</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 24 hours" class="widget-control-left"><span class="fa fa-custom-24-hours"></span></a>
                        </div>                          
                    </div>   
                </div>
            </div>

            <div class="row">
	            <div class="col-md-4">
                     <div class="widget widget-primary widget-item-icon">
                        <div class="widget-item-left">
                            <span class="glyphicon glyphicon-facetime-video"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"><?=$this->mhome->getNumberOfVideoAds()?></div>
                            <div class="widget-title">Video Advertisement</div>
                            <div class="widget-subtitle">Number of video ads uploaded on movieclub</div>
                        </div>                          
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfNewVideoAds()?></span></div>                            
                        <div class="widget-subtitle">New Video Advertisement</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 30 days" class="widget-control-left"><span class="fa fa-custom-30-days"></a>
                        </div>                          
                    </div>    
                </div>

                <div class="col-md-4"> 
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfViewedVideoAds()?></span></div>                            
                        <div class="widget-subtitle">Video Advertisement Viewed</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 24 hours" class="widget-control-left"><span class="fa fa-custom-24-hours"></span></a>
                        </div>                          
                    </div>   
                </div>
            </div>

            <div class="row">
	            <div class="col-md-4">
                     <div class="widget widget-primary widget-item-icon">
                        <div class="widget-item-left">
                            <!-- <span class="fa fa-custom-home-banner-ads"></span> -->
                            <span class="glyphicon glyphicon-picture"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count"><?=$this->mhome->getNumberOfBannerAds()?></div>
                            <div class="widget-title">Banner Advertisement</div>
                            <div class="widget-subtitle">Number of banner ads uploaded on movieclub</div>
                        </div>                          
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfNewBannerAds()?></span></div>                            
                        <div class="widget-subtitle">New Banner Advertisement</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 30 days" class="widget-control-left"><span class="fa fa-custom-30-days"></a>
                        </div>                          
                    </div>    
                </div>

                <div class="col-md-4"> 
                    <div class="widget widget-no-subtitle home-analytics">
                        <div class="widget-big-int"><span class="num-count"><?=$this->mhome->getNumberOfClickedBannerAds()?></span></div>                            
                        <div class="widget-subtitle">Banner Advertisement Clicked</div>  
                        <div class="widget-controls">
                            <a href="#" data-toggle="tooltip" data-placement="right" data-original-title="Last 24 hours" class="widget-control-left"><span class="fa fa-custom-24-hours"></span></a>
                        </div>                          
                    </div>   
                </div>
            </div>


            <!-- <div class="col-md-12">                                            
                <p><span class="fa fa-warning"></span> Movieclub analytics data refreshed end of each hour.</p>
            </div> -->

        </div>
    </div>

</div>

<?php $this->load->view('default/footer'); ?>