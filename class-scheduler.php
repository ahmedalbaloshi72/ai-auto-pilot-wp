<?php  
class Content_Scheduler {  
    public function __construct() {  
        add_action('init', [$this, 'schedule_ai_posts']);  
        add_action('ai_daily_content_hook', [$this, 'generate_daily_post']);  
    }  

    public function schedule_ai_posts() {  
        if (!wp_next_scheduled('ai_daily_content_hook')) {  
            wp_schedule_event(time(), 'daily', 'ai_daily_content_hook');  
        }  
    }  

    public function generate_daily_post() {  
        $ai = new AI_Generator();  
        $post_content = $ai->generate_content("Write a tech blog post about AI trends.");  
        wp_insert_post([  
            'post_title' => 'AI-Generated Post ' . time(),  
            'post_content' => $post_content,  
            'post_status' => 'publish'  
        ]);  
    }  
}  