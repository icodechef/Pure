<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */
?>
        </div><!-- .row -->
    </div><!-- .site-content -->

    <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="site-info container">
            <div class="copyright">&copy; <?php echo pure_copyright(2015) ?> <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>. 版权所有.<?php pure_icp_number(function($icp) {printf(" %s.", $icp); }) ?> 基于 <a class="copyright" href="<?php echo esc_url( __( 'https://wordpress.org/', 'pure' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'pure' ); ?>">WordPress</a> 搭建, 采用 <a class="copyright" href="http://www.icodechef.com" title="编程小厨">Pure</a> 作为主题
            </div>
            
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
    
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>