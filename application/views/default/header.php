<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$pageInfo['title']?></title>           
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <meta property='cpanel:url' content="<?=base_url()?>" />
    <meta property="cpanel:navigation" content="<?=(($this->input->cookie('xnavigation',true)!=NULL) ? $this->input->cookie('xnavigation',true) : '0')?>" />
    <meta property="cpanel:order" content="<?=(!empty($tableOrder) ? $tableOrder : 'desc')?>" />
    <meta property="cpanel:sort" content="<?=(!empty($tableSortable) ? $tableSortable : 'null')?>" />
    
    <link rel="shortcut icon" href="<?php echo base_url().FOLDER_IMG; ?>favicon.ico" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url().FOLDER_CSS; ?>designbluemanila.css"/>   

    <script type="text/javascript" src="<?php echo base_url().FOLDER_JS; ?>jquery-1.10.1.min.js"></script> 
</head>
<?php 
    echo (isset($_SESSION['action_message']) ? "<body onload=\"noty({text: '".$_SESSION['action_message']."', layout: 'topRight', type: 'success'});\">" : '<body>'); 
    unset($_SESSION['action_message']);
?>
    <div class="page-container page-navigation-top-fixed <?php echo (($this->input->cookie('xnavigation') == 1)?'page-navigation-toggled page-container-wide':''); ?>">

        <div class="page-sidebar page-sidebar-fixed scroll">
            <ul class="x-navigation <?php echo (($this->input->cookie('xnavigation'))?'x-navigation-minimized':''); ?>">
                <li class="xn-logo">
                    <a href="<?php echo base_url() ?>">designblue</a>
                    <a href="#" class="x-navigation-control"></a>
                </li>
                <li class="xn-profile">
                    <a href="#" class="profile-mini">
                        <img src="<?php echo base_url().FOLDER_USERS.$this->mgeneral->getUserAvatar($userType) ?>" alt=""/>
                    </a>
                    <div class="profile">
                        <div class="profile-image">
                            <img src="<?php echo base_url().FOLDER_USERS.$this->mgeneral->getUserAvatar($userType) ?>" alt=""/>
                        </div>
                        <div class="profile-data">
                            <div class="profile-data-name"><?=$userName?></div>
                            <div class="profile-data-title"><?=$userLevel?></div>
                        </div>
                    </div>                                                                        
                </li>
                
                <li <?php echo (($this->uri->segment(1)=='home')?'class="is_active"':''); ?>>
                    <a href="<?php echo base_url() ?>"><span class="fa fa-custom-dashboard"></span> <span class="xn-text">Dashboard</span></a>
                </li>
                <?php if($userType == 1 || $userType == 2) : ?>
                    <li <?php echo (($this->uri->segment(1)=='accounts')?'class="is_active"':''); ?>>
                        <a href="<?php echo base_url() ?>accounts"><span class="fa fa-custom-admin-accounts"></span> <span class="xn-text">Admin Accounts</span></a>
                    </li>
                <?php endif; ?>
                <?php if($userType == 1 || $userType == 2) : ?>
                    <li <?php echo (($this->uri->segment(1)=='users')?'class="is_active"':''); ?>>
                        <a href="<?php echo base_url() ?>users"><span class="fa fa-custom-front-end-users"></span> <span class="xn-text">Front End Users</span></a>
                    </li>
                <?php endif; ?>
                <?php if($userType == 2 || $userType == 4) : ?>
                    <li <?php echo (($this->uri->segment(1)=='movies')?'class="is_active"':''); ?>><a href="<?php echo base_url() ?>movies"><span class="fa fa-custom-movies"></span> <span class="xn-text">Movies</span></a></li>
                <?php endif; ?>
                <?php if($userType == 2 || $userType == 3) : ?>
                    <?php $ads_pages_arr = array('banner_ads','video_ads'); ?>
                    <!-- <li class="xn-openable <?php echo ((in_array($this->uri->segment(1), $ads_pages_arr))?'active':''); ?>">
                        <a href="#"><span class="glyphicon glyphicon-bullhorn"></span> <span class="xn-text">Advertisement</span></a>
                        <ul>
                            <li <?php echo (($this->uri->segment(1)=='video_ads')?'class="is_active"':''); ?>><a href="<?php echo base_url() ?>banner_ads"><span class="fa fa-custom-video-ads"></span> Video Ads</a></li>
                            <li <?php echo (($this->uri->segment(1)=='banner_ads')?'class="is_active"':''); ?>><a href="<?php echo base_url() ?>banner_ads"><span class="fa fa-custom-banner-ads"></span> Banner Ads</a></li>
                        </ul>
                    </li> -->
                    <li <?php echo (($this->uri->segment(1)=='video_ads')?'class="is_active"':''); ?>><a href="<?php echo base_url() ?>video_ads"><span class="fa fa-custom-video-ads"></span> <span class="xn-text">Video Advertisement</span></a></li>
                    <li <?php echo (($this->uri->segment(1)=='banner_ads')?'class="is_active"':''); ?>><a href="<?php echo base_url() ?>banner_ads"><span class="fa fa-custom-banner-ads"></span> <span class="xn-text">Banner Advertisement</span></a></li>
                <?php endif; ?>
                <?php if($userType == 2) : ?>
                    <li <?php echo (($this->uri->segment(1)=='ads_pricing')?'class="is_active"':''); ?>>
                        <a href="<?php echo base_url() ?>ads_pricing"><span class="fa fa-custom-pricing"></span> <span class="xn-text">Ads Pricing</span></a>
                    </li>
                <?php endif; ?>
                <?php if($userType == 1) : ?>
                    <li <?php echo (($this->uri->segment(1)=='android')?'class="is_active"':''); ?>>
                        <a href="<?php echo base_url() ?>android"><span class="fa fa-custom-anroid"></span> <span class="xn-text">Android Update</span></a>
                    </li>
                <?php endif; ?>
                <li <?php echo (($this->uri->segment(1)=='support')?'class="is_active"':''); ?>>
                    <a href="<?php echo base_url() ?>support"><span class="fa fa-custom-support"></span> <span class="xn-text">Report a Problem</span></a>
                </li>
                
            </ul>
        </div>
        
        <div class="page-content">

            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize" id="x-navigation"><span class="fa fa-minus-square"></span></a>
                </li>
                <li class="xn-search">
                    <form role="form">
                        <input type="text" name="search" placeholder="Search..."/>
                    </form>
                </li>   
                <li class="xn-icon-button pull-right">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span></a>
                </li>
                <?php //if($userType == 1) : ?>
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-bug"></span></a>
                        <div class="informer informer-danger"><?=$support['total']?></div>
                        <div class="panel-notification panel panel-primary animated zoomIn xn-drop-left">
                            <div class="panel-heading">
                                <h4 class="panel-title">Support</h4>                                
                                <div class="pull-right">
                                    <span class="label text-danger"><?=$support['total']?> unresolved issue</span>
                                </div>
                            </div>
                                <?php if(!empty($support['details'])) : ?>
                                <div class="panel-body list-group list-group-contacts scroll" style="max-height: 185px;">
                                    <?php foreach($support['details'] as $support) : ?>
                                        <a href="<?php echo base_url().'support/issue/id/'.$support['support_id']; ?>" class="list-group-item">
                                            <div class="list-group-status status-<?=$support['priority']?>"></div>
                                            <img src="<?php echo base_url().FOLDER_USERS.$this->mgeneral->getUserAvatar($support['account_id']) ?>" class="pull-left" alt=""/>
                                            <span class="contacts-title"><?=$support['fullname']?></span>
                                            <p><?=$support['title']?></p>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <?php else: ?>
                                    <div class="panel-body list-group list-group-contacts scroll" style="max-height: 101px;">
                                        <a href="<?php echo base_url(); ?>support" class="list-group-item">
                                            <span class="contacts-title">No Issues Found</span>
                                            <p>If you encounter a bug or wants an improvement on the current system, make sure to send a detailed bug/improvement description so we can continue to track and work these issues.</p>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                 
                            <div class="panel-footer text-center">
                                <a href="<?php echo base_url(); ?>support">See All</a>
                            </div>                            
                        </div>                        
                    </li>
                <?php //endif; ?>
            </ul>

            <ul class="breadcrumb">
                <li class="active">You are here</li>         
                <?php echo $this->breadcrumbs->show(); ?>
            </ul>