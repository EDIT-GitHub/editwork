<?php $aUniAllowedHtmlWithA = uni_coworking_theme_allowed_html_with_a(); ?>
<footer id="footer">

    <?php uni_coworking_theme_footer_social_icons_output(); ?>

    <div class="footerMenu">
        <?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'menu_class' => 'uni-clear', 'theme_location' => 'footer', 'depth' => 1, 'fallback_cb'=> 'uni_coworking_theme_nav_footer_fallback' ) ); ?>
    </div>

    <div class="footerLogo">
        <?php uni_coworking_theme_footer_logo_output(); ?>
    </div>

    <div class="copyright">
        <?php if ( ot_get_option( 'uni_footer_text' ) ) { ?>
        <?php $sTextInFooter = ot_get_option( 'uni_footer_text' );
        echo wp_kses( $sTextInFooter, $aUniAllowedHtmlWithA ); ?>
        <?php } else { ?>
        <p><?php echo sprintf( esc_html__('Copyright &copy; %d. Coworking Co.', 'coworking' ), date('Y') ); ?></p>
        <?php } ?>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>