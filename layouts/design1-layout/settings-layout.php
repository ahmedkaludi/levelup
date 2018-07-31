<?php
$design_controls = array(
					array(
						'section_id' => 'section_content',
						'type'=>'section_start',
						'label' => 'Controls',
						'tab' => 'content',
						),
					array(
						'id' => 'design_library',
						'label' => 'Designs Library',
						'type' => 'button',
						'separator' => 'before',
						'button_type' => 'default',
						'show_label' => true,
						'description' =>'',
						'label_block' => false,
						'text' => 'Designs',
						'event' => 'namespace:editor:delete',
						),
					array(
						'id' => 'title',
						'label' => 'Title',
						'type' => 'text',
						'placeholder' => 'Type your title here',
						'title' =>'Text Field',
						'separator' => 'default',
						'show_label' => true,
						'description' => '',
						'label_block' => true,
						'input_type' => false,
						'default' =>'Enter Your Title Here',
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'designs_layout',
									'value' => 'design1',
								],
								[
									'name' => 'designs_layout',
									'value' => '',
								],
							],
						],
					),
					array(
						'id'=>'description',
						'label' =>'Description',
						'description' => '',
						'type' => 'textarea',
						'show_label' => true,
						'label_block' => true,
						'separator' => 'default',
						'rows' => 5,
						'placeholder' =>'Type your description here',
						'default' => 'Enter Your Description Here',
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'designs_layout',
									'value' => 'design2',
								],
								[
									'name' => 'designs_layout',
									'value' => '',
								],
							],
						],

					),
					array(
						'id'=>'content',
						'label' => 'Content',
						'description' =>'',
						'type' =>'textarea',
						'show_label' => true,
						'label_block' => true,
						'separator' => 'default',
						'rows' => 5,
						'placeholder' => 'Type your Content here',
						'default' => 'Enter Your Content Here',
						'conditions' => [
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'designs_layout',
									'value' => 'design2',
								],
								[
									'name' => 'designs_layout',
									'value' => '',
								],
							],
						],
					),
					array(
						'id' => 'image',
						'label' =>'Choose Image',
						'type' => 'media',
						'default' => '',
					),
					array(
						'type'=>'section_end',
						),
					array(
						'section_id' => 'section_style',
						'type'=>'section_start',
						'label' => 'Styles',
						'tab' => 'style',
						),
					array(
						'id' => 'text_transform',
						'label' => 'Text Transform',
						'type' => 'select',
						'default' => '',
						'options' => [
							'' =>'None',
							'uppercase' => 'UPPERCASE',
							'lowercase' => 'lowercase',
							'capitalize' => 'Capitalize',
						],
						'selectors' => [
								'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
							],
					),
					array(
						'type'=>'section_end',
						),
);
return $design_controls;