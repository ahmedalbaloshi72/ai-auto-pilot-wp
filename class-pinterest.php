<?php  
class Pinterest_Auto_Pin {  
    private $pinterest_token = 'YOUR_PINTEREST_TOKEN';  

    public function __construct() {  
        add_action('publish_post', [$this, 'auto_pin_post']);  
    }  

    public function auto_pin_post($post_id) {  
        $post = get_post($post_id);  
        $image_url = $this->generate_ai_image($post->post_title); // (Optional: DALL·E)  
        $this->pin_to_pinterest($post->post_title, $post->post_excerpt, $image_url, get_permalink($post_id));  
    }  

    private function pin_to_pinterest($title, $description, $image_url, $link) {  
        $api_url = 'https://api.pinterest.com/v5/pins';  
        $args = [  
            'headers' => ['Authorization' => 'Bearer ' . $this->pinterest_token],  
            'body' => json_encode([  
                'title' => $title,  
                'description' => $description . ' #WordPress #AIContent',  
                'image_url' => $image_url,  
                'link' => $link  
            ])  
        ];  
        wp_remote_post($api_url, $args);  
    }  
}  