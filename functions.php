<?php 
function t4a_generate_google_ad_code() {
    if (!isset($GLOBALS['AddCounter'])) {
        $GLOBALS['AddCounter']=1;
    } else {
        $GLOBALS['AddCounter']=$GLOBALS['AddCounter']+1;
    }
    if ($GLOBALS['AddCounter']>3) { return; } //limiting ads to 3 ads per page
    // If the value exceed 3 then it will just return no ad, else it will return the code for a Google Ad.
    $adcode = '<div><h3>Ads code goes here</h3></div>'; 
    echo '<h3>Impression Counter: ' . $GLOBALS['AddCounter'] . '</h2>';
    return $adcode;
        
}
function t4a_insert_ad_in_content($content)
{
    if ((!is_singular('post')) || (strpos($content, '<p') === FALSE) ) {  return $content; }

    $ChapterCount = 2; // Enter the chapter number, which you'd like an add in front of

    $content = explode("<p", $content);

    $new_content = '';
    
    for ($i = 0; $i < count($content); $i++) {
        if ($i == $ChapterCount) {
            $new_content .= t4a_generate_google_ad_code(); // call function for generating ad code
        }
        
        if($i>0) { 
          $new_content.= "<p".$content[$i];
        } else {
          $new_content.= $content[$i];
        }
    }
    
    return $new_content;
}
add_filter('the_content', 't4a_insert_ad_in_content');