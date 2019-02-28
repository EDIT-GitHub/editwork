jQuery( document ).ready( function( $ ) {
    'use strict';

    var $page_template      = $('#page_template'),
        $events_metabox     = $('#events_meta_box'),
        $schedule_metabox   = $('#schedule_meta_box'),
        $about_metabox      = $('#about_meta_box'),
        $plans_metabox      = $('#plans_meta_box'),
        $contact_metabox    = $('#contact_meta_box');

    $events_metabox.hide();
    $schedule_metabox.hide();
    $about_metabox.hide();
    $plans_metabox.hide();
    $contact_metabox.hide();

    $page_template.on("change", function() {
    
        switch ( $(this).val() ) {

            case 'templ-events.php' :
            $events_metabox.show();
            $schedule_metabox.hide();
            $about_metabox.hide();
            $plans_metabox.hide();
            $contact_metabox.hide();
            break;

            case 'templ-events-tickera.php' :
            $events_metabox.show();
            $schedule_metabox.hide();
            $about_metabox.hide();
            $plans_metabox.hide();
            $contact_metabox.hide();
            break;

            case 'templ-schedule.php' :
            $events_metabox.hide();
            $schedule_metabox.show();
            $about_metabox.hide();
            $plans_metabox.hide();
            $contact_metabox.hide();
            break;

            case 'templ-about.php' :
            $events_metabox.hide();
            $schedule_metabox.hide();
            $about_metabox.show();
            $plans_metabox.hide();
            $contact_metabox.hide();
            break;

            case 'templ-plans.php' :
            $events_metabox.hide();
            $schedule_metabox.hide();
            $about_metabox.hide();
            $plans_metabox.show();
            $contact_metabox.hide();
            break;

            case 'templ-contact.php' :
            $events_metabox.hide();
            $schedule_metabox.hide();
            $about_metabox.hide();
            $plans_metabox.hide();
            $contact_metabox.show();
            break;

            default :
            $events_metabox.hide();
            $schedule_metabox.hide();
            $about_metabox.hide();
            $plans_metabox.hide();
            $contact_metabox.hide();
            break;
        }

    }).change();

});