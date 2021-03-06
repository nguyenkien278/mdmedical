<div id="watu_quiz" class="quiz-area <?php if($single_page) echo 'single-page-quiz'; ?>">
<div class="quiz-desc">
<?php if(!empty($exam->description)):?><p><?php echo apply_filters(WATU_CONTENT_FILTER,wpautop(stripslashes($exam->description)));?></p><?php endif;?>
</div>
<form action="" method="post" class="quiz-form" id="quiz-<?php echo $exam_id?>" <?php if(!empty($exam->no_ajax)):?>onsubmit="return Watu.submitResult(this)"<?php endif;?>>
<?php
if(!empty($exam->notify_user) and empty($user_ID)):?>
	<p class="watu_taker_email"><?php _e('Please enter your email:', 'watu')?> <input type="text" name="watu_taker_email" id="watuTakerEmail"></p>
<?php
endif; // end showing enter email field

if($single_page != 1 and $answer_display!=2): ?>
<div class="quiz-head-action">
	<div class="head-label"><?php _e('Câu hỏi', 'watu')?> <span id='numQ'>1</span> <?php //_e('of', 'watu')?> <?php //echo $num_questions;?></div>
	<div class="next-back-question">
	<?php if($exam->show_prev_button):?>
		<button type="button" id="prev-question" onclick="Watu.nextQuestion(event, 'prev');" disabled><i class="fa fa-angle-left"></i></button>
	<?php endif;?>
	<button type="button" id="next-question"><i class="fa fa-angle-right"></i></button>
	</div>
<?php endif; ?>

</div>

<?php
$question_count = 1;
$question_ids = '';
$output = $answer_class = '';
$answers_orderby = empty($exam->randomize_answers) ? 'sort_order, ID' : 'RAND()';
foreach ($questions as $qct => $ques) {
	$qnum = $qct+1;
	$question_number = empty($exam->dont_display_question_numbers) ? "<span class='watu_num'>$qnum. </span>"  : '';
		
	$output .= "<div class='watu-question' id='question-$question_count'>";
	$output .= "<div class='question-content'>". wpautop($question_number .  stripslashes($ques->question)) . "</div>";
	$output .= "<input type='hidden' name='question_id[]' value='{$ques->ID}' />";
	$question_ids .= $ques->ID.',';
	$dans = $wpdb->get_results("SELECT ID,answer,correct FROM ".WATU_ANSWERS." 
		WHERE question_id={$ques->ID} ORDER BY $answers_orderby");
	$ans_type = $ques->answer_type;
	
	// display textarea
	if($ans_type=='textarea') {
		$output .= "<textarea name='answer-{$ques->ID}[]' rows='5' cols='40' id='textarea_q_{$ques->ID}' class='watu-textarea-$question_count'></textarea>"; 
	}	
	$output .= '<div class="answer-wrap">';
	foreach ($dans as $ans) {
		// add this to track the order		
		$output .= "<input type='hidden' name='answer_ids[]' class='watu-answer-ids' value='{$ans->ID}' />";
		
		if($ques->answer_type == 'textarea') continue;
		
		if($answer_display == 2) {
			$answer_class = 'js-answer-label';
			if($ans->correct) $answer_class = 'php-answer-label';
		}
		$output .= wpautop("<div class='answer-item'><input type='$ans_type' name='answer-{$ques->ID}[]' id='answer-id-{$ans->ID}' class='answer answer-$question_count $answer_class answerof-{$ques->ID}' value='{$ans->ID}' /><label for='answer-id-{$ans->ID}' id='answer-label-{$ans->ID}' class='$answer_class answer label-$question_count'><span>" . stripslashes($ans->answer) . "</span></label></div>");
	}
	$output .= '</div>';

	$output .= "<input type='hidden' id='questionType".$question_count."' value='{$ques->answer_type}' class='".($ques->is_required?'required':'')."'>";
	
	if($answer_display == 2 and $single_page != 1 and !empty($ques->feedback)) {
		$output .= '<div class="watu-feedback watu-padded" id="watuQuestionFeedback-'.$question_count.'" style="display:none;">'.wpautop(stripslashes($ques->feedback)).'</div>';
	}	
	
	$output .= "</div>";
	$question_count++;
}
$output .= "<div style='display:none' id='question-$question_count'>";
$output .= "<br /><div class='question-content'><img src=\"".plugins_url('watu/loading.gif')."\" width=\"16\" height=\"16\" alt=\"".__('Loading', 'watu')." ...\" title=\"".__('Loading', 'watu')." ...\" />&nbsp;".__('Loading', 'watu')." ...</div>";
$output .= "</div>";
echo apply_filters(WATU_CONTENT_FILTER,$output);
$question_ids = preg_replace('/,$/', '', $question_ids );
echo @$text_captcha_html;
?>

<?php if(empty($exam->no_ajax)):?>
	<div class="btn-submit-view-result">
		<input type="button" name="action" onclick="Watu.submitResult()" id="action-button" value="<?php echo empty($advanced_settings['submit_button_value']) ? __('Submit', 'watu') : $advanced_settings['submit_button_value']; ?>"  />
	</div>
<?php else:?>
	<div class="btn-submit-view-result">
		<input type="submit" name="submit_no_ajax" id="action-button" value="<?php echo empty($advanced_settings['submit_button_value']) ? __('Xem kết quả', 'watu') : $advanced_settings['submit_button_value']; ?>" />
	</div>
<?php endif; ?>

<?php if($answer_display == 2 and $single_page != 1) : ?>
<input type="button" id="show-answer" value="<?php _e('Show Answer', 'watu') ?>"  /><br />
<?php endif; ?>

<input type="hidden" name="no_ajax" value="<?php echo $exam->no_ajax?>"><?php if(!empty($exam->no_ajax)):?>
<input type="hidden" name="do" value="show_exam_result">
<input type="hidden" name="post_id" value="<?php echo $post->ID?>">
<?php endif; // end if(!empty($exam->no_ajax))?>
<input type="hidden" name="quiz_id" value="<?php echo $exam_id ?>" />
<input type="hidden" id="watuStartTime" name="start_time" value="<?php echo current_time('mysql'); ?>" />
<?php if(!empty($exam->use_honeypot)):?>		
		<input class="watu-beehive" type="text" value="_<?php echo md5('honeyforme' . $_SERVER['REMOTE_ADDR']) /* honeypot value */?>" id="watuAppSourceID<?php echo $exam->ID?>">
		<input class="watu-beehive" name="h_app_id" type="text" value="_<?php echo microtime() /* honeypot value */?>" id="watuAppID<?php echo $exam->ID?>">
<?php endif;?>
</form>
</div>
<script type="text/javascript">
var exam_id=0;
var question_ids='';
var watuURL='';
jQuery(function($){
question_ids = "<?php print $question_ids ?>";
exam_id = <?php print $exam_id ?>;
Watu.exam_id = exam_id;
Watu.qArr = question_ids.split(',');
Watu.post_id = <?php echo $post->ID ?>;
Watu.singlePage = '<?php echo $exam->single_page?>';
Watu.hAppID = "<?php echo microtime(); /* honeypot */ ?>";
watuURL = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
Watu.noAlertUnanswered = <?php echo intval($exam->no_alert_unanswered);?>;
});
</script>