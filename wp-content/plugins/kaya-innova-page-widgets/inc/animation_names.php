<?php
if(  !function_exists('animation_effects') ){
function animation_effects($id, $name){
  $animations_groups = array('Attention Seekers' => array(
                            'bounce' => 'Bounce',
                            'flash' => 'flash',
                            'pulse' => 'Pulse',
                            'shake' => 'Shake',
                            'tada' => 'Tada',
                            'rubberBand' => 'RubberBand',
                            'swing' => 'Swing',
                            'wobble' => 'Wobble',
                        ),
                        'Bouncing Entrances' => array(
                            'bounceIn'=> 'BounceIn',
                            'bounceInLeft' => 'BounceInLeft',
                            'bounceInUp' => 'BounceInUp',
                            'bounceInDown' => 'BounceInDown',
                            'bounceInRight' => 'BounceInRight'
                        ),
                        'Fading Entrances' => array(
                            'fadeIn'=> 'fadeIn',
                            'fadeInDownBig' => 'fadeInDownBig',
                            'fadeInLeftBig' => 'fadeInLeftBig',
                            'fadeInRightBig' => 'fadeInRightBig',
                            'fadeInUpBig' => 'fadeInUpBig',
                            'fadeInDown'=> 'fadeInDown',
                            'fadeInLeft' => 'fadeInLeft',
                            'fadeInRight' => 'fadeInRight',
                            'fadeInUp' => 'fadeInUp'
                        ),
                        'Flippers' => array(
                            'flip'=> 'flip',
                            'flipInX' => 'flipInX',
                            'flipInY' => 'flipInY',
                            'flipOutX' => 'flipOutX',
                            'flipOutY' => 'flipOutY',
                        ),
                        'Lightspeed' => array(
                            'lightSpeedIn'=> 'lightSpeedIn',
                            'lightSpeedOut' => 'lightSpeedOut',
                        ),
                        'Rotating Extrances' => array(
                            'rotateIn'=> 'rotateIn',
                            'rotateInDownLeft' => 'rotateInDownLeft',
                            'rotateInDownRight' => 'rotateInDownRight',
                            'rotateInUpLeft' => 'rotateInUpLeft',
                        ),
                        'Sliders' => array(
                            'slideInDown'=> 'slideInDown',
                            'slideInUp'=> 'slideInUp',
                            'slideInLeft' => 'slideInLeft',
                            'slideInRight' => 'slideInRight',
                            'slideOutLeft' => 'slideOutLeft',
                            'slideOutRight' => 'slideOutRight',
                        ),
                        'Specials' => array(
                            'hinge'=> 'hinge',
                            'rollIn' => 'rollIn',
                            'rollOut' => 'rollOut',
                        ),
                        'Zoom Entrances' => array(
                            'zoomIn'=> 'zoomIn',
                            'zoomInDown' => 'zoomInDown',
                            'zoomInLeft' => 'zoomInLeft',
                            'zoomInUp'=> 'zoomInUp',
                            'zoomInRight' => 'zoomInRight',
                        ),
            ); 
    echo  '<select class="animation-effect" name="'.$id.'">';
        echo '<option value="">Choose Animation</option>';
        foreach ($animations_groups as $key => $animations_group) { 
             echo '<optgroup label="'.$key.'">';
                foreach ($animations_group as $key => $effect) {
                    $selected = selected($key, $name);
                    echo '<option value="'.$key.'" '.$selected.'>'.ucfirst($effect).'</option>';
                }
            echo '</optgroup>';
         } 
    echo '</select>';
 }
}
 ?>