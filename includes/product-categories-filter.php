<?php
if ( is_singular('product') ) {
    global $post;
    $aCatsAttached = wp_get_post_terms( $post->ID, 'product_cat');
    $aCatsAttachedFormatted = array();
    if ( !empty($aCatsAttached) ) {
        foreach ( $aCatsAttached as $oCat ) {
            $aCatsAttachedFormatted[] = $oCat->slug;
        }
    }
?>
				<ul class="productFilter clear">
					<li><a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>"><?php esc_html_e('All', 'coworking') ?></a></li>
                <?php
                $aProdCatsToBeExcluded = ( ot_get_option('uni_prod_tax_exclude') ) ? ot_get_option('uni_prod_tax_eclude') : array();
                $aAllParentCats = get_terms( 'product_cat', array('hide_empty' => false, 'parent' => 0, 'exclude' => $aProdCatsToBeExcluded) );
                if ( isset($aAllParentCats) ) {
                    foreach ( $aAllParentCats as $oParentCat ) {
                ?>
					<li><a<?php if ( in_array($oParentCat->slug, $aCatsAttachedFormatted) ) { echo ' class="active"'; } ?> href="<?php echo get_term_link($oParentCat) ?>"><?php echo esc_html( $oParentCat->name ); ?></a></li>
				<?php }
                } ?>
				</ul>
<?php
} else {
    $sProdCatSlug = get_query_var( 'product_cat', null );
?>
				<ul class="productFilter clear">
					<li><a<?php if ( $sProdCatSlug == null ) { echo ' class="active"'; } ?> href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>"><?php esc_html_e('All', 'coworking') ?></a></li>
                <?php
                $aProdCatsToBeExcluded = ( ot_get_option('uni_prod_tax_exclude') ) ? ot_get_option('uni_prod_tax_eclude') : array();
                $aAllParentCats = get_terms( 'product_cat', array('hide_empty' => false, 'parent' => 0, 'exclude' => $aProdCatsToBeExcluded) );
                if ( isset($aAllParentCats) ) {
                    foreach ( $aAllParentCats as $oParentCat ) {
                ?>
					<li><a<?php if ( $sProdCatSlug == $oParentCat->slug ) { echo ' class="active"'; } ?> href="<?php echo get_term_link($oParentCat) ?>"><?php echo esc_html( $oParentCat->name ); ?></a></li>
				<?php }
                } ?>
				</ul>
<?php
}
?>