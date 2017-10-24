<footer class="section-div  <?php if ( is_front_page() ) echo 'abs'; ?>">
    <div class="row expanded">
        <div class="small-12 columns">
            <div class="small-12 medium-4 columns centerhome pad-und-top">
                    <h1>Contact Us</h1>
                    <p>Tel: (415) 154 4971 / 72</p>
                        <p>Vonage: (339) 309 5639</p>
                        <p>Correo #3, Centro.</p>
                        <p>San Miguel de Allende, Gto.</p>
                    </p>
            </div>
            <div class="small-12 medium-4 columns pad-und-ssm">
                    <div class="small-12 columns centerhome">
                        <img  src="<?php res() ?>/img/logo-colonial-footer.png">
                    </div>
                    <div class="small-12 columns centerhome pad-und-ssm">
                        <img class="logo-footer" src="<?php res() ?>/img/ampi.png">
                        <img class="logo-footer" src="<?php res() ?>/img/national.png">
                    
                    </div>
            </div>
            <div class="small-12 medium-4 columns  ">
                <ul class="menu vertical">
                    <?php 
                    $menu = wp_get_nav_menu_items('main');
                    foreach ($menu as $e) :
                        ?>
                    <li><a class="elements" href="<?php echo $e->url ?>" class="hvr-underline-from-center"><?php echo $e->title ?></a></li>
                <?php endforeach ?>

                    </ul>
            </div>
        </div>
    </div>
</footer>

<?php get_template_part('menu', 'mobile'); ?>

<?php wp_footer(); ?>
</body>
</html>