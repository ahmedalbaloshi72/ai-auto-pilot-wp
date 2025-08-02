<?php  
/*
Plugin Name: AI Auto Pilot  
Description: Auto-generate & pin AI content to Pinterest.  
Version: 1.0  
Author: Your Name  
*/  

if (!defined('ABSPATH')) exit;  

// Load dependencies  
require_once plugin_dir_path(__FILE__) . 'includes/class-ai-generator.php';  
require_once plugin_dir_path(__FILE__) . 'includes/class-pinterest.php';  
require_once plugin_dir_path(__FILE__) . 'includes/class-scheduler.php';  

// Initialize classes  
new AI_Generator();  
new Pinterest_Auto_Pin();  
new Content_Scheduler();  