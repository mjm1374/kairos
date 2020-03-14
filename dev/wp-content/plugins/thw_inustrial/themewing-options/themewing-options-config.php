<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
                $this->setHelpTabs();

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }

                // If Redux is running as a plugin, this will remove the demo notice and links
                //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

                // Function to test the compiler hook and demo CSS output.
                // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
                //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

                // Change the arguments after they've been declared, but before the panel is created
                //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

                // Change the default value of a field after it's been set, but before it's been useds
                //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

                // Dynamically add a section. Can be also used to modify sections/fields
                //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
                //print_r($options); //Option values
                //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

                /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = get_template_directory() . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    remove_filter( 'plugin_row_meta', array(
                        ReduxFrameworkPlugin::instance(),
                        'plugin_metalinks'
                    ), null, 2 );

                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'redux-framework-demo' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'redux-framework-demo' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'redux-framework-demo' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'redux-framework-demo' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'redux-framework-demo' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'redux-framework-demo' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'redux-framework-demo' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'redux-framework-demo' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
                if ( file_exists( get_template_directory() . '/framework/info-html.html' ) ) {
                    Redux_Functions::initWpFilesystem();

                    global $wp_filesystem;

                    $sampleHTML = $wp_filesystem->get_contents( get_template_directory() . '/framework/info-html.html' );
                }


                //--------------------------------------
                //--------------- General --------------
                //--------------------------------------

                $this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'General', 'themewing' ),
                    'fields' => array(

                            array( 
                                'id'        => 'favicon', 
                                'type'      => 'media',
                                'desc'      => __('Upload favicon image', 'themewing'),
                                'title'      => __('Favicon', 'themewing'),
                                'subtitle' => __('Upload favicon image', 'themewing'),
                                'default' => array( 'url' => get_template_directory_uri() .'/images/favicon.png' ), 
                            ),  

                            array(
                                'id'        => 'scroll_en',
                                'type'      => 'switch',
                                'title'     => __('Scroll to top button', 'themewing'),
                                'subtitle' => __('Enable or disable Scroll To top', 'themewing'),
                                'default'  =>true,
                                'on'       => 'Enabled',
                                'off'      => 'Disabled',
                            ),                                                         
                            array(
                                'id'        => 'enable_saerch',
                                'type'      => 'switch',
                                'title'     => __('Search', 'themewing'),
                                'subtitle' => __('Enable or disable Search', 'themewing'),
                                'default'  =>true,
                                'on'       => 'Enabled',
                                'off'      => 'Disabled',
                            ),  
                            array(
                                'id'        => 'custom_css',
                                'type'      => 'textarea',
                                'title'     => __('Costom CSS', 'themewing'),
                                'subtitle'  => __('Custom CSS', 'themewing'),                                            
                            ),
   
                        ),
                    );

                //--------------------------------------
                //--------------- Topbar --------------
                //--------------------------------------

                $this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'Topbar', 'themewing' ),
                    'fields' => array(
 
                             array(
                                'id'        => 'topbar_en',
                                'type'      => 'switch',
                                'title'     => __('Enable Topbar', 'themewing'),
                                'subtitle'  => __('Enable Topbar', 'themewing'),
                                'default'  =>false,
                                'on'       => 'Enabled',
                                'off'      => 'Disabled',
                            ),

                            array(
                                'id'        => 'topbar_share',
                                'type'      => 'switch',
                                'title'     => __('Menu Share Button', 'themewing'),
                                'subtitle'  => __('Enable Menu Share Button', 'themewing'),
                                'default'  =>true,
                                'on'       => 'Enabled',
                                'off'      => 'Disabled',
                            ),

                            array(
                                'id'        => 'btn_facebook',
                                'type'      => 'text',
                                'title'     => __('Facebook URL', 'themewing'),
                                'subtitle' => __('Add Facebook URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                      

                            array(
                                'id'        => 'btn_twitter',
                                'type'      => 'text',
                                'title'     => __('Twitter URL', 'themewing'),
                                'subtitle' => __('Add Twitter URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ), 

                            array(
                                'id'        => 'btn_gplus',
                                'type'      => 'text',
                                'title'     => __('gplus URL', 'themewing'),
                                'subtitle' => __('Add gplus URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),  

                            array(
                                'id'        => 'btn_instagram',
                                'type'      => 'text',
                                'title'     => __('Instagram URL', 'themewing'),
                                'subtitle' => __('Add Instagram URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                            

                            array(
                                'id'        => 'btn_flickr',
                                'type'      => 'text',
                                'title'     => __('Flickr URL', 'themewing'),
                                'subtitle' => __('Add Flickr URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                           

                            array(
                                'id'        => 'btn_linkedin',
                                'type'      => 'text',
                                'title'     => __('linkedin URL', 'themewing'),
                                'subtitle' => __('Add linkedin URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ), 

                            array(
                                'id'        => 'btn_pinterest',
                                'type'      => 'text',
                                'title'     => __('pinterest URL', 'themewing'),
                                'subtitle' => __('Add pinterest URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                        

                            array(
                                'id'        => 'btn_delicious',
                                'type'      => 'text',
                                'title'     => __('delicious URL', 'themewing'),
                                'subtitle' => __('Add delicious URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                       

                            array(
                                'id'        => 'btn_tumblr',
                                'type'      => 'text',
                                'title'     => __('tumblr URL', 'themewing'),
                                'subtitle' => __('Add delicious URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                      

                            array(
                                'id'        => 'btn_stumbleupon',
                                'type'      => 'text',
                                'title'     => __('stumbleupon URL', 'themewing'),
                                'subtitle' => __('Add stumbleupon URL', 'themewing'),
                                'required'  => array('topbar_share', "=", 1),
                            ),                             
   
                        ),
                    );


                //--------------------------------------
                //--------------- Header --------------
                //--------------------------------------

                $this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'Header', 'themewing' ),
                    'fields' => array(

                            array(
                                'id'        => 'sticky-header',
                                'type'      => 'switch',
                                'title'     => __('Sticky Header', 'themewing'),
                                'subtitle' => __('Enable or disable sicky Header', 'themewing'),
                                'default'  =>true,
                                'on'       => 'Enabled',
                                'off'      => 'Disabled',
                            ), 

                            array(
                                'id'       => 'header_layout',
                                'type'     => 'button_set',
                                'title'    => __( 'Header Layout', 'themewing' ),
                                'subtitle' => __( 'Select your header Layout', 'themewing' ),
                                'options'  => array(
                                    'headerdefault'  => 'Header Default',
                                    'header2'   => 'Header 2',
                                ),
                                'default'  => 'headerdefault'
                            ), 

                            array(
                                'id'       => 'header2_info',
                                'type'     => 'info',
                                'style'    => 'warning',
                                'title'    => __('Header 2', 'themewing'),
                                'desc'     => __('You had selected <strong>Header 2</strong> Layout. In order to display top bar elements', 'themewing'),
                                'required' => array('header_layout','=','header2', ),
                            ),

                            array(
                            'id'=>'logo_type',
                            'type' => 'select', 
                            'title' => __('Select Logo Type:', 'themewing'),
                            'options' => array(
                                    'logo_image' => __('Logo Image', 'themewing'),
                                    'logo_name' => __('Site Name', 'themewing'),
                                    ),
                            'default' => 'logo_image',
                            ),

                            array(
                            'id'=>'logo_img',
                            'type' => 'media', 
                            'title' => __('Upload your logo image', 'themewing'),
                            'url'=> true,
                            'default' => array( 'url' => get_template_directory_uri() .'/images/logo.png' ),
                            'required' => array('logo_type', '=' , 'logo_image'),
                            ), 

                            array(
                                'id'        => 'logo_text',
                                'type'      => 'text',
                                'title'     => __('Logo Text', 'themewing'),
                                'subtitle' => __('Use your Custom logo text Ex. Skyblog', 'themewing'),
                                'default'   => 'Skyblog',
                                'required' => array('logo_type', '=' , 'logo_name'),
                            ),  

                            array(
                                'id'        => 'logo_slogan',
                                'type'      => 'text',
                                'title'     => __('Logo Slogan', 'themewing'),
                                'subtitle' => __('Use your Custom logo Slogan Ex. Premium Petcare', 'themewing'),
                                'default'   => 'Premium Petcare',
                                'required' => array('logo_type', '=' , 'logo_name'),
                            ),                                                      

                            array(
                                'id'            => 'logo_font',
                                'type'          => 'typography',
                                'title'         => __('Logo Font', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,    
                                'font-backup'   => false,  
                                'font-style'    => true,
                                'subsets'       => true, 
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false,
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true,
                                'all_styles'    => true,  
                                'output'        =>array('.logo-text'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Logo Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#666',
                                    'font-weight'    => '600',
                                    'font-family'   => 'Raleway',
                                    'google'        => true,
                                    'font-size'     => '48px',
                                    'line-height'   =>'48px'),

                                'required' => array('logo_type', '=' , 'logo_name'),

                            ),  

                            array(
                                'id'            => 'slogan_font',
                                'type'          => 'typography',
                                'title'         => __('Logo Slogan Font', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,    
                                'font-backup'   => false,  
                                'font-style'    => true,
                                'subsets'       => true, 
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false,
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true,
                                'all_styles'    => true,  
                                'output'        =>array('.logo-slogan'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Logo Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#666',
                                    'font-weight'    => '400',
                                    'font-family'   => 'Raleway',
                                    'google'        => true,
                                    'font-size'     => '48px',
                                    'line-height'   =>'48px'),

                                'required' => array('logo_type', '=' , 'logo_name'),

                            ),  

                            array(
                                'id' => 'logo_margin',
                                'type' => 'spacing',
                                'output' => array('.logo-text'),
                                'mode' => 'margin', 
                                'all'      => false, 
                                'units'         => 'px',
                                'display_units'=> true,  
                                'units_extended'=> 'true',
                                'title' => __('Logo Text Margin', 'themewing'),
                                'default' => array('margin-top' => '0', 'margin-left' => '0', 'margin-bottom' => '10px', 'margin-right' => '0'),                            
                           ),

                            array(
                                'id' => 'header-margin',
                                'type' => 'spacing',
                                'output' => array('.site-header'),
                                'mode' => 'padding', 
                                'all'      => false,
                                'right'    => false,
                                'left'     => false, 
                                'units'         => 'px',
                                'display_units'=> true,  
                                'units_extended'=> 'true',
                                'title' => __('Header Padding', 'themewing'),
                                'default' => array('padding-top' => '20px', 'padding-bottom' => '20px'),
                            ),  

                            array(
                                'id'        => 'top_supports_en',
                                'type'      => 'switch',
                                'title'     => __('Customer Supports', 'themewing'),
                                'subtitle'  => __('Enable Customer Supports', 'themewing'),
                                'default'   => true,
                            ),    

                            array(
                                'id'        => 'top_supports_text',
                                'type'      => 'text',
                                'title'     => __('Customer Supports', 'themewing'),
                                'subtitle' => __('Customer Supports Text', 'themewing'),
                                'desc'     => __('Customer Supports & Sells', 'themewing'),
                                'default'   => '',
                                'required'  => array('top_supports_en', "=", 1),
                            ), 

                            array(
                                'id'        => 'top_supports_number',
                                'type'      => 'text',
                                'title'     => __('Customer Supports Number', 'themewing'),
                                'subtitle' => __('Customer Supports Phone Number', 'themewing'),
                                'desc'     => __('(+89) 530-352-3027', 'themewing'),
                                'default'   => '',
                                'required'  => array('top_supports_en', "=", 1),
                            ),                             

                            array(
                                'id'        => 'top_time_en',
                                'type'      => 'switch',
                                'title'     => __('Top open time', 'themewing'),
                                'subtitle'  => __('Enable top open time', 'themewing'),

                                'default'   => true,
                            ),    

                            array(
                                'id'        => 'top_time_text',
                                'type'      => 'text',
                                'title'     => __('Top open time', 'themewing'),
                                'subtitle' => __('Top open time Text', 'themewing'),
                                'desc'     => __('Opening Times', 'themewing'),
                                'default'   => '',
                                'required'  => array('top_time_en', "=", 1),
                            ), 

                            array(
                                'id'        => 'top_time_date',
                                'type'      => 'text',
                                'title'     => __('Top open date and time', 'themewing'),
                                'subtitle' => __('Top open time and time', 'themewing'),
                                'desc'     => __('Mon - Fri 10.00 - 18.00', 'themewing'),
                                'default'   => '',
                                'required'  => array('top_time_en', "=", 1),
                            ),  

                        ),
                    );

            //--------------------------------------
            //--------------- Theme Styling --------------
            //--------------------------------------

            $this->sections[] = array(
                'icon' => 'el-icon-brush',
                'icon_class' => 'el-icon-large',
                'title'     => __('Theme Styling', 'themewing'),
                'fields'    => array(

                   array(
                        'id'       => 'theme_layout',
                        'type'     => 'select',
                        'title'    => __('Select Layout', 'themewing'), 
                        'subtitle' => __('Select BoxWidth of FullWidth', 'themewing'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            'bizfullw' => 'FullWidth',
                            'bizboxw' => 'BoxWidth',
                        ),
                        'default'  => 'bizfullw',
                    ), 

                    array(
                        'id'        => 'body_background',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => __('Full Body Background', 'themewing'),
                        'subtitle'  => __('You can set Background color or images or patterns for Body', 'themewing'),
                        'transparent'   =>false,
                    ), 

                    array(
                        'id'        => 'link_color',
                        'type'      => 'color',
                        'title'     => __('Major Color', 'themewing'),
                        'subtitle'  => __('Pick a link color (default: #fc5a0a)', 'themewing'),
                        'default'   => '#fc5a0a',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                     array(
                        'id'        => 'hover_color',
                        'type'      => 'color',
                        'title'     => __('Hover Color', 'themewing'),
                        'subtitle'  => __('Pick a hover color (default: #272d33)', 'themewing'),
                        'default'   => '#272d33',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ), 

                    array(
                        'id'        => 'topbar_bg',
                        'type'      => 'color',
                        'title'     => __('Topbar Background Color', 'themewing'),
                        'subtitle'  => __('Pick a background color for the Topbar (default: #f4f4f4).', 'themewing'),
                        'default'   => '#f4f4f4',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ), 

                    array(
                        'id'        => 'header_bg',
                        'type'      => 'color',
                        'title'     => __('Header Background Color', 'themewing'),
                        'subtitle'  => __('Pick a background color for the Header (default: #fff).', 'themewing'),
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),                     

                    array(
                        'id'        => 'menu_bg',
                        'type'      => 'color',
                        'title'     => __('Menu Background Color', 'themewing'),
                        'subtitle'  => __('Pick a background color for the Menu (default: #1e2227).', 'themewing'),
                        'default'   => '#1e2227',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ), 
                    
                    array(
                        'id'        => 'bottom_background',
                        'type'      => 'background',
                        'output'    => array('.footer'),
                        'title'     => __('Bottom Background', 'themewing'),
                        'subtitle'  => __('You can set Background color or images or patterns for Bottom', 'themewing'),
                        'transparent'   =>false,
                    ),                                      

                )
            );


                //--------------------------------------
                //--------------- Font --------------
                //--------------------------------------

                $this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'Font', 'themewing' ),
                    'fields' => array(

                            array(
                                'id'            => 'body_font',
                                'type'          => 'typography',
                                'title'         => __('Body Font', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('body'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#555555',
                                    'font-weight'    => '400',
                                    'font-family'   => 'Roboto',
                                    'google'        => true,
                                    'font-size'     => '14px',
                                    'line-height'   =>'24px'),
                            ), 

                            array(
                                'id'            => 'menu_font',
                                'type'          => 'typography',
                                'title'         => __('Menu Font', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('ul.main-menu>li>a'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Menu Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#fff',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto',
                                    'google'        => true,
                                    'font-size'     => '14px',
                                    'line-height'   =>'28px'),
                            ), 

                            array(
                                'id'            => 'submenu_font',
                                'type'          => 'typography',
                                'title'         => __('Sub Menu Font', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('ul.main-menu li ul li a'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Sub Menu Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#333',
                                    'font-weight'    => '400',
                                    'font-family'   => 'Roboto',
                                    'google'        => true,
                                    'font-size'     => '13px',
                                    'line-height'   =>'20px'),
                            ), 

                            array(
                                'id'            => 'h1_heading_font',
                                'type'          => 'typography',
                                'title'         => __('H1 Heading', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('h1'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#333',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto Slab',
                                    'google'        => true,
                                    'font-size'     => '36px',
                                    'line-height'   =>'36px'),
                            ), 

                            array(
                                'id'            => 'h2_heading_font',
                                'type'          => 'typography',
                                'title'         => __('H2 Heading', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('h2'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#333',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto Slab',
                                    'google'        => true,
                                    'font-size'     => '24px',
                                    'line-height'   =>'28px'),
                            ),


                            array(
                                'id'            => 'h3_heading_font',
                                'type'          => 'typography',
                                'title'         => __('H3 Heading', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('h3'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#333',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto Slab',
                                    'google'        => true,
                                    'font-size'     => '20px',
                                    'line-height'   =>'28px'),
                            ), 

                            array(
                                'id'            => 'h4_heading_font',
                                'type'          => 'typography',
                                'title'         => __('H4 Heading', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('h4'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#111',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto Slab',
                                    'google'        => true,
                                    'font-size'     => '18px',
                                    'line-height'   =>'24px'),
                            ),  


                            array(
                                'id'            => 'h5_heading_font',
                                'type'          => 'typography',
                                'title'         => __('H5 Heading', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('h5'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#333',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto Slab',
                                    'google'        => true,
                                    'font-size'     => '16px',
                                    'line-height'   =>'28px'),
                            ), 


                            array(
                                'id'            => 'h6_heading_font',
                                'type'          => 'typography',
                                'title'         => __('H6 Heading', 'themewing'),
                                'compiler'      => false,  
                                'google'        => true,  
                                'font-backup'   => false, 
                                'font-style'    => true,
                                'subsets'       => true,
                                'text-align'    => false,
                                'line-height'   => true,
                                'word-spacing'  => false, 
                                'letter-spacing'=> false,
                                'color'         => true,
                                'preview'       => true, 
                                'all_styles'    => true, 
                                'output'        =>array('h6'),
                                'units'         => 'px',
                                'subtitle'      => __('Select your website Body Font', 'themewing'),
                                'default'       => array(
                                    'color'         => '#333',
                                    'font-weight'    => '700',
                                    'font-family'   => 'Roboto Slab',
                                    'google'        => true,
                                    'font-size'     => '14px',
                                    'line-height'   =>'28px'),
                            ),                                                                                                                 

                        ),
                    );


            //--------------------------------------
            //--------------- Blog --------------
            //--------------------------------------

            $this->sections[] = array(
                'icon'      => 'el-icon-edit',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Blog', 'themewing'),
                'fields'    => array(

                    array(
                        'id'        => 'blog_comment',
                        'type'      => 'switch',
                        'title'     => __('Post Comment', 'themewing'),
                        'subtitle'  => __('Enable or disable post comment', 'themewing'),
                        'default'   => true,
                    ),                 

                    array(
                        'id'        => 'blog_author',
                        'type'      => 'switch',
                        'title'     => __('Blog Author', 'themewing'),
                        'subtitle'  => __('Enable Blog Author ex. Admin', 'themewing'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog_date',
                        'type'      => 'switch',
                        'title'     => __('Blog Date', 'themewing'),
                        'subtitle'  => __('Enable Blog Date ', 'themewing'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog_edit_en',
                        'type'      => 'switch',
                        'title'     => __('Post Edit', 'themewing'),
                        'subtitle'  => __('Enable or disable post edit', 'themewing'),
                        'default'   => false,
                    ),    


                    array(
                        'id'        => 'post_charlenght',
                        'type'      => 'switch',
                        'title'     => __('Custom Post Char Lenght', 'themewing'),
                        'subtitle'  => __('Enable or disable Custom Post Char Lenght', 'themewing'),
                        'default'   => true,
                    ),        

                    array(
                        'id'        => 'post_charlenght_limit',
                        'type'      => 'text',
                        'title'     => __('Post Char Limit', 'themewing'),
                        'subtitle' => __('Post Char Limit ex. 250', 'themewing'),
                        'default'   => "250",
                        'required'  => array('post_charlenght', "=", 1),
                    ),                                
                    

                    array(
                        'id'        => 'blog_continue_en',
                        'type'      => 'switch',
                        'title'     => __('Blog Readmore', 'themewing'),
                        'subtitle'  => __('Enable Blog Readmore', 'themewing'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog_continue',
                        'type'      => 'text',
                        'title'     => __('Continue Reading', 'themewing'),
                        'subtitle' => __('Continue Reading', 'themewing'),
                        'default'   => __('Continue Reading', 'themewing'),
                        'required'  => array('blog_continue_en', "=", 1),
                    ),  


                    array(
                        'id'        => 'blog_category',
                        'type'      => 'switch',
                        'title'     => __('Blog Category', 'themewing'),
                        'subtitle'  => __('Enable or disable blog category', 'themewing'),
                        'default'   => true,
                    ),  

                    array(
                        'id'        => 'blog_share_btn_en',
                        'type'      => 'switch',
                        'title'     => __('Blog Share', 'themewing'),
                        'subtitle'  => __('Enable or Disable Blog Share', 'themewing'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog_share_fb',
                        'type'      => 'switch',
                        'title'     => __('Facebook', 'themewing'),
                        'subtitle' => __('Enable of Disable Facebook Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ),                     

                    array(
                        'id'        => 'blog_share_tw',
                        'type'      => 'switch',
                        'title'     => __('Twitter', 'themewing'),
                        'subtitle' => __('Enable of Disable Twitter Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ),                     

                    array(
                        'id'        => 'blog_share_glus',
                        'type'      => 'switch',
                        'title'     => __('Google Plus', 'themewing'),
                        'subtitle' => __('Enable of Disable Google Plus Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ),                     

                    array(
                        'id'        => 'blog_share_ln',
                        'type'      => 'switch',
                        'title'     => __('Linkedin', 'themewing'),
                        'subtitle' => __('Enable of Disable Linkedin Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ),

                    array(
                        'id'        => 'blog_share_pin',
                        'type'      => 'switch',
                        'title'     => __('Pinterest', 'themewing'),
                        'subtitle' => __('Enable of Disable Pinterest Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ), 

                    array(
                        'id'        => 'blog_share_env',
                        'type'      => 'switch',
                        'title'     => __('Envelope', 'themewing'),
                        'subtitle' => __('Enable of Disable Envelope Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ),

                    array(
                        'id'        => 'blog_share_st',
                        'type'      => 'switch',
                        'title'     => __('Stumbleupon', 'themewing'),
                        'subtitle' => __('Enable of Disable Stumbleupon Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ), 

                    array(
                        'id'        => 'blog_share_digg',
                        'type'      => 'switch',
                        'title'     => __('Digg', 'themewing'),
                        'subtitle' => __('Enable of Disable Digg Share', 'themewing'),
                        'default'   => true,
                        'required'  => array('blog_share_btn_en', "=", 1),
                    ), 

                )
            );

            //--------------------------------------
            //--------------- Blog Single --------------
            //--------------------------------------

            $this->sections[] = array(
                'icon'      => 'el-icon-edit',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Blog Single', 'themewing'),
                'fields'    => array(

                        array(
                            'id'        => 'blog_single_comment_en',
                            'type'      => 'switch',
                            'title'     => __('Single Post Comment', 'themewing'),
                            'subtitle'  => __('Enable Single post comment ', 'themewing'),
                            'default'   => true,
                        ),

                        array(
                            'id'        => 'blog_tag',
                            'type'      => 'switch',
                            'title'     => __('Blog Tag', 'themewing'),
                            'subtitle'  => __('Enable Blog Tag ', 'themewing'),
                            'default'   => false,
                        ),     

                        array(
                            'id'        => 'post_nav_en',
                            'type'      => 'switch',
                            'title'     => __('Post navigation', 'themewing'),
                            'subtitle'  => __('Enable Post navigation ', 'themewing'),
                            'default'   => true,
                        ),                        

                        array(
                            'id'        => 'post_related',
                            'type'      => 'switch',
                            'title'     => __('Related Post', 'themewing'),
                            'subtitle'  => __('Enable Related Post ', 'themewing'),
                            'default'   => true,
                        ),

                    ),
                );


            /**********************************
            ********* Footer ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-bookmark',
                'icon_class' => 'el-icon-large', 
                'title'     => __('Footer', 'themewing'),
                'fields'    => array(
                 

                    array(
                        'id'        => 'copyright_en',
                        'type'      => 'switch',
                        'title'     => __('Copyright', 'themewing'),
                        'subtitle'  => __('Enable Copyright Text', 'themewing'),
                        'default'   => true,
                    ),                    

                    array(
                        'id'        => 'copyright',
                        'type'      => 'editor',
                        'title'     => __('Copyright Text', 'themewing'),
                        'subtitle'  => __('Add Copyright Text', 'themewing'),
                        'default'   => __('<div>Copyright © 2015 Bizspeak. Design by <a href="http://bizspeak.com/">Bizspeak</a></div>', 'themewing'),
                        'required'  => array('copyright_en', "=", 1),
                        
                    ),
                )
            );

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'redux-framework-demo' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'redux-framework-demo' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';


                $this->sections[] = array(
                    'icon'            => 'el-icon-list-alt',
                    'title'           => __( 'Customizer Only', 'redux-framework-demo' ),
                    'desc'            => __( '<p class="description">This Section should be visible only in Customizer</p>', 'redux-framework-demo' ),
                    'customizer_only' => true,
                    'fields'          => array(
                        array(
                            'id'              => 'opt-customizer-only',
                            'type'            => 'select',
                            'title'           => __( 'Customizer Only Option', 'redux-framework-demo' ),
                            'subtitle'        => __( 'The subtitle is NOT visible in customizer', 'redux-framework-demo' ),
                            'desc'            => __( 'The field desc is NOT visible in customizer.', 'redux-framework-demo' ),
                            'customizer_only' => true,
                            //Must provide key => value pairs for select options
                            'options'         => array(
                                '1' => 'Opt 1',
                                '2' => 'Opt 2',
                                '3' => 'Opt 3'
                            ),
                            'default'         => '2'
                        ),
                    )
                );

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'redux-framework-demo' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'themewing_options',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Bizspeak Options', 'themewing' ),
                    'page_title'           => __( 'Bizspeak Options', 'themewing' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => true,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'themes.php',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => '_options',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-docs',
                    'href'   => 'http://docs.reduxframework.com/',
                    'title' => __( 'Documentation', 'redux-framework-demo' ),
                );

                $this->args['admin_bar_links'][] = array(
                    //'id'    => 'redux-support',
                    'href'   => 'https://github.com/ReduxFramework/redux-framework/issues',
                    'title' => __( 'Support', 'redux-framework-demo' ),
                );

                $this->args['admin_bar_links'][] = array(
                    'id'    => 'redux-extensions',
                    'href'   => 'reduxframework.com/extensions',
                    'title' => __( 'Extensions', 'redux-framework-demo' ),
                );



                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
                } else {
                    $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
                }


            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
    } else {
        echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;