<?php  
class AI_Generator {  
    private $api_key = 'YOUR_OPENAI_KEY';  

    public function __construct() {  
        add_action('admin_menu', [$this, 'add_ai_tool_page']);  
    }  

    public function add_ai_tool_page() {  
        add_menu_page(  
            'AI Content Generator',  
            'AI Auto Pilot',  
            'manage_options',  
            'ai-auto-pilot',  
            [$this, 'render_ai_tool'],  
            'dashicons-edit'  
        );  
    }  

    public function render_ai_tool() {  
        echo '<div class="wrap"><h1>Generate AI Content</h1>';  
        echo '<textarea id="ai-prompt" placeholder="Enter topic..."></textarea>';  
        echo '<button id="generate-content">Generate Post</button>';  
        echo '<div id="ai-result"></div></div>';  
    }  

    public function generate_content($prompt) {  
        $response = wp_remote_post('https://api.openai.com/v1/chat/completions', [  
            'headers' => ['Authorization' => 'Bearer ' . $this->api_key],  
            'body' => json_encode([  
                'model' => 'gpt-4',  
                'messages' => [['role' => 'user', 'content' => $prompt]],  
                'max_tokens' => 1000  
            ])  
        ]);  
        return json_decode($response['body'])->choices[0]->message->content;  
    }  
}  