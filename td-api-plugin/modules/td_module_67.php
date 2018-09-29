<?php

class td_module_67 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = 50;
        $excerpt_length = 50;
        ?>

        <div class="<?php echo $this->get_module_classes();?> result">
            <?php echo $this->get_image('td_218x150');?>

            <div class="item-details">
            <?php echo $this->get_title($title_length);?>

                <div class="td-module-meta-info">
                    <?php if (td_util::get_option('tds_category_module_10') == 'yes') { echo $this->get_category(); }?>
                        
                        <?php echo $this->get_date();?>
                        <?php
		$todays_dt = date('F j, Y'); //setup todays date
		$posted_dt = get_the_date("F j, Y",$this->post->ID );; //posted date
		//echo '<span class="td-post-date"><time class="entry-date updated td-module-date">'.$posted_dt.'</time></span>';
		if( $todays_dt == $posted_dt )
				{
					$is_repost = get_field('repost', $this->post->ID);
					if($is_repost == 'Yes')
						{
						$first_published_on = get_field('first_published_on', $this->post->ID);
						$date_fpo = date("F j, Y", strtotime($first_published_on));
							if($todays_dt == $date_fpo)
							{
								echo '<span class="td-post-date new-post-label"><time class="entry-date updated td-module-date">New Post</time></span>';
							}
						}else{
							echo '<span class="td-post-date new-post-label"><time class="entry-date updated td-module-date">New Post</time></span>';
						}
				}
		?>
                </div>

                
            </div>

        </div>

        <?php return ob_get_clean();
    }

}