<?php
// v3 - for wp_010

class td_block_55 extends td_block {



    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        $buffy = ''; //output buffer

        //get the js for this block
        $buffy .= $this->get_block_js();

        $buffy .= '<div class="' . $this->get_block_classes() . '">';

            //get the block title
            $buffy .= $this->get_block_title();

            //get the sub category filter for this block
            $buffy .= $this->get_pull_down_filter();

            $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
                $buffy .= $this->inner($this->td_query->posts);  //inner content of the block
            $buffy .= '</div>';

            //get the ajax pagination for this block
            $buffy .= $this->get_block_pagination();
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {

        $buffy = '';

        $td_block_layout = new td_block_layout();
        if (empty($td_column_number)) {
            $td_column_number = td_global::vc_get_column_number(); // get the column width of the block from the page builder API
        }
        $td_post_count = 0; // the number of posts rendered
        $td_current_column = 1; //the current columng
		$place_counter=0; // placing ads properly
		$ad_numnber=1; // display the ad from their numbers
        if (!empty($posts)) {
            foreach ($posts as $post) {
				
				//Placing ads ends
								
                $td_module_55 = new td_module_55($post);

                switch ($td_column_number) {

                    case '1': //one column layout
				//placing ad start
						if ($place_counter % 4 == 0) {
							if($ad_numnber == 1){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(1).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(1).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(1).'</div>';
                                $ad_numnber++;
                             }elseif($ad_numnber == 2){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(5).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(5).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(5).'</div>';
                                $ad_numnber++;
                             }elseif($ad_numnber == 3){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(3).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(3).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(3).'</div>';
                                $ad_numnber++;
                             }elseif($ad_numnber == 4){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(4).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(4).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(4).'</div>';
                                $ad_numnber++;
                             }elseif($ad_numnber == 5){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(2).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(2).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(2).'</div>';
                                $ad_numnber++;
                             }elseif($ad_numnber == 6){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(6).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(6).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(6).'</div>';
                                $ad_numnber=1;
                             }elseif($ad_numnber == 7){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(1).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(1).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(1).'</div>';
                                $ad_numnber++;
                             }elseif($ad_numnber == 8){
                                $buffy .='<div class="td-visible-tablet-landscape">'.adrotate_ad(5).'</div>
                                <div class="td-visible-tablet-portrait">'.adrotate_ad(5).'</div>
                                <div class="td-visible-phone">'.adrotate_ad(5).'</div>';
                                $ad_numnber=1;
                             }
							 
						}$place_counter++;//endplace counter
					
                        $buffy .= $td_block_layout->open12(); //added in 010 theme - span 12 doesn't use rows
                        $buffy .= $td_module_55->render($post);
                        $buffy .= $td_block_layout->close12();
                        break;

                    case '2': //two column layout
                        $buffy .= $td_block_layout->open_row();

                        $buffy .= $td_block_layout->open6();
                        $buffy .= $td_module_55->render($post);
                        $buffy .= $td_block_layout->close6();

                        if ($td_current_column == 2) {
                            $buffy .= $td_block_layout->close_row();
                        }


                        break;

                    case '3': //three column layout
                        $buffy .= $td_block_layout->open_row();

                        $buffy .= $td_block_layout->open4();
                        $buffy .= $td_module_55->render($post);
                        $buffy .= $td_block_layout->close4();

                        if ($td_current_column == 3) {
                            $buffy .= $td_block_layout->close_row();
                        }

                        break;
                }

                //current column
                if ($td_current_column == $td_column_number) {
                    $td_current_column = 1;
                } else {
                    $td_current_column++;
                }

                $td_post_count++;
            }
        }
        $buffy .= $td_block_layout->close_all_tags();
        return $buffy;
    }
}