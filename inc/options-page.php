<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/28/2016
 * Time: 11:00 AM
 */

/**
 * Adds A new Options page to the Settings Menu
 * Class AtelierOptions
 */
class AtelierOptions
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    private $newsletter_img;
    private $account_settings;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'atelier_add_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    public function atelier_add_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin',
            'Atelier Settings',
            'manage_options',
            'atelier_settings',
            array($this, 'create_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option('atelier_social_media_options');
        $this->newsletter_img = get_option('atelier_newsletter_image');
        $this->account_settings = get_option('atelier_account_setting_image');
        ?>
        <div class="wrap">
            <h2>Atelierul De Fapte Bune Settings</h2>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('atelier_option_group');
                do_settings_sections('atelier_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        /*Newsletter*/
        register_setting(
            'atelier_option_group',
            'atelier_newsletter_image',
            array($this, 'sanitize')
        );

        add_settings_section(
            'atelier_newsletter_field', // ID
            'Newsletter Setting', // Title
            array($this, 'print_newsletter_info'), // Callback
            'atelier_settings' // Page
        );

        add_settings_field(
            'newsletter_img_url', // ID
            'Newsletter image', // Title
            array($this, 'newsletter_img_callback'), // Callback
            'atelier_settings', // Page
            'atelier_newsletter_field' // Section
        );

        /*Account page*/
        register_setting(
            'atelier_option_group',
            'atelier_account_setting_image',
            array($this, 'sanitize')
        );

        add_settings_section(
            'atelier_account_setting_field', // ID
            'Account Setting', // Title
            array($this, 'print_account_setting_info'), // Callback
            'atelier_settings' // Page
        );

        add_settings_field(
            'account_setting_img_url', // ID
            'Account setting image', // Title
            array($this, 'account_setting_img_callback'), // Callback
            'atelier_settings', // Page
            'atelier_account_setting_field' // Section
        );

        /*Social Media*/
        register_setting(
            'atelier_option_group', // Option group
            'atelier_social_media_options', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'atelier_social_fields', // ID
            'Social Media Settings', // Title
            array($this, 'print_section_info'), // Callback
            'atelier_settings' // Page
        );

        add_settings_field(
            'facebook_link', // ID
            'Facebook', // Title
            array($this, 'facebook_link_callback'), // Callback
            'atelier_settings', // Page
            'atelier_social_fields' // Section
        );

        add_settings_field(
            'twitter_link', // ID
            'Twitter', // Title
            array($this, 'twitter_link_callback'), // Callback
            'atelier_settings', // Page
            'atelier_social_fields' // Section
        );

        add_settings_field(
            'linkedin_link',
            'LinkedIn',
            array($this, 'linkedin_link_callback'),
            'atelier_settings',
            'atelier_social_fields'
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();
        if (isset($input['newsletter_img_url']))
            $new_input['newsletter_img_url'] = sanitize_text_field($input['newsletter_img_url']);

        if (isset($input['account_setting_img_url']))
            $new_input['account_setting_img_url'] = sanitize_text_field($input['account_setting_img_url']);

        if (isset($input['facebook_link']))
            $new_input['facebook_link'] = sanitize_text_field($input['facebook_link']);

        if (isset($input['twitter_link']))
            $new_input['twitter_link'] = sanitize_text_field($input['twitter_link']);

        if (isset($input['linkedin_link']))
            $new_input['linkedin_link'] = sanitize_text_field($input['linkedin_link']);

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Please enter your social media links below:';
    }

    /**
     * Print the Section text
     */
    public function print_newsletter_info()
    {
        print 'Please upload an image for newsletter section';
    }

    /**
     * Print the Section text
     */
    public function print_account_setting_info()
    {
        print 'Please upload an image for account settings page';
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function newsletter_img_callback()
    {
        ?>
        <div id="nl-img-cont" class="ta-table-logo"><?php

        printf(
            '<input id="newsletter_img" class="logo-url regular-text" name="atelier_newsletter_image[newsletter_img_url]" type="hidden" value="%s"/>',
            isset($this->newsletter_img['newsletter_img_url']) ? esc_attr($this->newsletter_img['newsletter_img_url']) : ''
        ); ?>

        <div class="custom-img-container">
            <?php if ($this->newsletter_img['newsletter_img_url']) : ?>
                <img src="<?php echo $this->newsletter_img['newsletter_img_url'] ?>" alt="" style="max-width:100%;"/>
            <?php endif; ?>
        </div>
        <p class="hide-if-no-js" data-metaboxid="nl-img-cont">
            <a class="upload-custom-img <?php if ($this->newsletter_img['newsletter_img_url']) {
                echo 'hidden';
            } ?>"
               href="">
                <?php _e('Set newsletter image') ?>
            </a>
            <a class="delete-custom-img <?php if (!$this->newsletter_img['newsletter_img_url']) {
                echo 'hidden';
            } ?>"
               href="#">
                <?php _e('Remove newsletter image') ?>
            </a>
        </p>
        </div>
        <?php
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function account_setting_img_callback()
    {
        ?>
        <div id="ac-img-cont" class="ta-table-logo"><?php

            printf(
                '<input id="account_setting_img" class="logo-url regular-text" name="atelier_account_setting_image[account_setting_img_url]" type="hidden" value="%s"/>',
                isset($this->account_settings['account_setting_img_url']) ? esc_attr($this->account_settings['account_setting_img_url']) : ''
            ); ?>

            <div class="custom-img-container">
                <?php if ($this->account_settings['account_setting_img_url']) : ?>
                    <img src="<?php echo $this->account_settings['account_setting_img_url'] ?>" alt="" style="max-width:100%;"/>
                <?php endif; ?>
            </div>
            <p class="hide-if-no-js" data-metaboxid="ac-img-cont" >
                <a  class="upload-custom-img <?php if ($this->account_settings['account_setting_img_url']) {
                    echo 'hidden';
                } ?>"
                   href="">
                    <?php _e('Set account setting image') ?>
                </a>
                <a class="delete-custom-img <?php if (!$this->account_settings['account_setting_img_url']) {
                    echo 'hidden';
                } ?>"
                   href="#">
                    <?php _e('Remove account setting image') ?>
                </a>
            </p>
        </div>
        <?php
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function facebook_link_callback()
    {
        printf(
            '<input type="text" id="facebook_link" class="regular-text" name="atelier_social_media_options[facebook_link]" value="%s" />',
            isset($this->options['facebook_link']) ? esc_attr($this->options['facebook_link']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function twitter_link_callback()
    {
        printf(
            '<input type="text" id="facebook_link" class="regular-text" name="atelier_social_media_options[twitter_link]" value="%s" />',
            isset($this->options['twitter_link']) ? esc_attr($this->options['twitter_link']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function linkedin_link_callback()
    {
        printf(
            '<input type="text" id="linkedin_link" class="regular-text" name="atelier_social_media_options[linkedin_link]" value="%s" />',
            isset($this->options['linkedin_link']) ? esc_attr($this->options['linkedin_link']) : ''
        );
    }
}

if (is_admin())
    $my_settings_page = new AtelierOptions();