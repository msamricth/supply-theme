<?php 
//Function to autofill new external links


/* pausing on this to fix later - currently is a curl error
//external image upload
function Generate_Featured_Image( $image_url, $post_id  ){
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if(wp_mkdir_p($upload_dir['path']))
      $file = $upload_dir['path'] . '/' . $filename;
    else
      $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
}
//Auto add and update external link fields:
function external_link_updater( $post_id ) {
    
 // wrap the function in this if infinite save loop happens   if ( ! wp_is_post_revision( $post_id ) ){ }
    if ( get_post_type( $post_id ) == 'external-link' ) {
        $my_post = array();
        $my_post['ID'] = $post_id;
        $external_url = get_field( 'url' ); 
        $post_content = '';
        $acf_image = get_field( 'image' );


        if($external_url){
            // Extract HTML using curl 
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_HEADER, 0); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_URL, $external_url); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
            
            $data = curl_exec($ch); 
            curl_close($ch); 
            
            // Load HTML to DOM object 
            $dom = new DOMDocument(); 
            @$dom->loadHTML($data); 
            
            // Parse DOM to get Title data 
            $nodes = $dom->getElementsByTagName('title'); 
            $title = $nodes->item(0)->nodeValue; 
            
            // Parse DOM to get meta data 
            $metas = $dom->getElementsByTagName('meta'); 
            
            $description = ''; 
            $keywords = ''; 
            $site_name = ''; 
            $extracted_external_image = ''; 

            for($i=0; $i<$metas->length; $i++){ 
                $meta = $metas->item($i); 
                if($meta->getAttribute('name') == 'description'){ 
                    $description = $meta->getAttribute('content'); 
                } 
                if($meta->getAttribute('name') == 'keywords'){ 
                    $keywords = $meta->getAttribute('content'); 
                }
                if($meta->getAttribute('property') == 'og:site_name'){
                    $site_name = $meta->getAttribute('content');
                }
                if($meta->getAttribute('property') == 'og:image'){
                    $extracted_external_image = $meta->getAttribute('content');
                }	
            } 
            $acf_content = get_field( 'content' ); 

            if(empty($post_content)){
                if($acf_content){
                    $my_post['post_content'] = $acf_content;
                } else {
                    $my_post['post_content'] = $description;
                }
                
            }
            if(has_post_thumbnail( $post_id)) {

            } else {
                if($acf_image){
                    Generate_Featured_Image( esc_url( $image['url'] ), $post_id );
                } else {
                    Generate_Featured_Image( $extracted_external_image, $post_id );
                }

            }
            wp_set_post_tags( $post_id , array( $site_name  . ', ' . $keywords), true );

        }
        // Update the post into the database
        wp_update_post( $my_post );

    }
}
  // run after ACF saves the $_POST['fields'] data
add_action('acf/save_post', 'external_link_updater', 20);

*/