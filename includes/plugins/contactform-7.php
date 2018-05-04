<?php
/**
 * Default Template
 */
add_filter('wpcf7_default_template', 'wpsst_contact_form7_default_template', 10, 2);
function wpsst_contact_form7_default_template($template, $prop){
    
	if($prop != 'form')
		return $template;
	
	return implode("\n", array(
		'<p class="input-block">',
        '    <label for="contact-name"><strong>Name</strong> (required)</label>',
        '    [text* contact-name id:contact-name]',
        '</p>',
        '<p class="input-block">',
        '    <label for="contact-email"><strong>Email</strong> (required)</label>',
        '    [email* contact-email id:contact-email]',
        '</p>',
        '<p class="input-block">',
        '    <label for="contact-subject"><strong>Subject</strong></label>',
        '    [text contact-subject id:contact-subject]',
        '</p>',
        '<p class="textarea-block">',
        '    <label for="contact-message"><strong>Your Message</strong> (required)</label>',
        '    [textarea* contact-message id:contact-message 88x6]',
        '</p>',
        '<div class="hidden">',
        '    <label for="contact-spam-check">Do not fill out this field:</label>',
        '    [text contact-spam-check id:contact-spam-check]',
        '</div>',
        '<div class="clear"></div>',
        '[submit "Submit"]'
	));
}

/**
 * Default Title
 */
add_filter('wpcf7_contact_form_default_pack', 'wpsst_contact_form7_default_pack');
function wpsst_contact_form7_default_pack($template){
	$template->set_title('Contact');
	return $template;
}