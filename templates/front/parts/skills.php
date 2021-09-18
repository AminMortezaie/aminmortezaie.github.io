<?php

global $resume, $compact;

if ( !empty( $resume['skills'] ) ):

	$rand_rbt = rand( 100,999 );
	
	?><style type="text/css">
		<?php echo '#rb-template-' . $rand_rbt; ?> .rb-resume-skills-block { color: <?php echo $resume['display']['text_color']; ?>; }
		<?php echo '#rb-template-' . $rand_rbt; ?> .rb-resume-skills-block .rb-resume-skill-rating svg > path { stroke: <?php echo $resume['display']['star_color']; ?>; fill: <?php echo $resume['display']['star_color']; ?>; }
		<?php echo '#rb-template-' . $rand_rbt; ?> .rbt-section-heading { color: <?php echo $resume['display']['highlight_color']; ?>; }
		<?php if ( $resume['display']['rating_stars'] == 'hide' ): ?>
			<?php echo '#rb-template-' . $rand_rbt; ?> .rb-resume-skills-block .rb-resume-skill-rating { display:none; }
		<?php endif; ?>
	</style><?php

	do_action( 'rb_resume_before_resume_skills' );
	
	echo ( $compact || $resume['display']['max_width'] && $resume['display']['max_width'] < 950 ? '<div class="rb-compact">' : '' );

		echo '<div id="rb-template-' . $rand_rbt . '" class="rb-template-' . $resume['display']['template'] . '">';
	
			do_action( 'rb_resume_skills_start' );
	
			$started_skills_block = false;
	
			foreach( $resume['skills'] as $skill ):
			
				if ( $started_skills_block && isset( $exp['section_heading_name'] ) && $exp['section_heading_name'] ):
					$started_skills_block = false;
					echo '</div>';
				endif;
	
				if ( isset( $skill['section_heading_name'] ) && $skill['section_heading_name'] ):
					echo '<div class="rbt-section-heading">' . esc_html( $skill['section_heading_name'] ) . '</div>';
				else:
					
					if ( !$started_skills_block ):
						$started_skills_block = true;
						echo '<div class="rb-resume-skills-block-wrapper">';
					endif;
				
					if ( isset( $skill['title'] ) && $skill['title'] || isset( $skill['description'] ) && $skill['description'] ):
						echo '<div class="rb-resume-skills-block">';
							echo ( isset( $skill['title'] ) && $skill['title'] ? '<div class="rb-resume-skill-title">' . esc_html( $skill['title'] ) . '</div>' : '' );
							echo ( isset( $skill['rating'] ) && $skill['rating'] ? '<div class="rb-resume-skill-rating">' . Resume_Builder_Resumes::rating( $skill['rating'] ) . '</div>' : '' );
							echo ( isset( $skill['description'] ) && $skill['description'] ? '<div class="rb-resume-skill-description">' . $skill['description'] . '</div>' : '' );
						echo '</div>';
					endif;
				endif;
	
			endforeach;
			
			if ( $started_skills_block ):
				$started_skills_block = false;
				echo '</div>';
			endif;
	
			do_action( 'rb_resume_skills_end' );
	
		echo '</div>';
	
	echo ( $compact || $resume['display']['max_width'] && $resume['display']['max_width'] < 950 ? '</div>' : '' );

	do_action( 'rb_resume_after_resume_skills' );
	
endif;