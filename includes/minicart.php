<?php global $woocommerce; ?>
				<div class="showMiniCart">
					<i></i>
                    <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
					<span><?php echo sizeof( $woocommerce->cart->get_cart() ) ?></span>
                    <?php else : ?>
                    <span>0</span>
                    <?php endif; ?>
				</div>