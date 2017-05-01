<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
global $post;

$options = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'Testimonial-Submitter-Rank' => array(
				'label' => __( 'Insert the position of the submitter', 'saiph-lite' ),
				'desc'  => __( 'e.g. :Project Manager at Pied Piper', 'saiph-lite' ),
				'type'  => 'text',
			),
		),
	),
);
