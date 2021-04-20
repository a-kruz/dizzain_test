<?php
/**
 * The template for displaying the homepage.
 *
 * Template name: Homepage
 */

get_header(); ?>

    <main role="main homepage">

        <section class="top" style="background-image: url('<?= get_field('top_bg'); ?>')">
            <div class="container">

                <div class="top__logo">
                    <a href="<?= home_url(); ?>"><img src="<?= get_field('top_logo'); ?>" alt=""></a>
                </div>

                <div class="top__header">
                    <h1 class="top__title"><?= get_field('top_title'); ?></h1>
                    <p class="top__subtitle"><?= get_field('top_subtitle'); ?></p>
                </div>

            </div>
        </section>


        <section class="services">
            <div class="container">

                <h2 class="services__title title"><?= get_field('services_title'); ?></h2>

                <?php

                // задаем нужные нам критерии выборки данных из БД
                $args = array(
                    'posts_per_page' => 5,
                    'post_type'      => 'service'
                );

                $query = new WP_Query( $args );

                // Loop
                if ( $query->have_posts() ) : ?>

                    <?php // переписать табы в один цикл ?>
                    <div class="services__mobile-tabs">

                        <?php $i = 0; ?>
                        <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                            <div class="services__mobile-tab">
                                <div class="services__mobile-tab-title tablinksmob <?= (!$i) ? 'active' : ''; ?>" onclick="openTabMob(event, 'service_mob_<?php the_ID(); ?>')"><?php the_title(); ?><span class="service__mobile-tab-arrow"></span></div>
                                <div id="service_mob_<?php the_ID(); ?>" class="services__mobile-tab-content tabcontentmob">
                                    <?php the_content(); ?>
                                </div>
                            </div>

                            <?php $i++; ?>

                        <?php endwhile; ?>

                    </div>

                    <div class="services__tabs">
                        <div class="services__tabs-head">

                            <?php $i = 0; ?>
                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                                <div class="services__tabs-title tablinks <?= (!$i) ? 'active' : ''; ?>" onclick="openTab(event, 'service_<?php the_ID(); ?>')"><?php the_title(); ?></div>
                                <?php $i++; ?>

                            <?php endwhile; ?>

                        </div>
                        <div class="services__tabs-body">

                            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                                <div id="service_<?php the_ID(); ?>" class="services__tabs-content tabcontent">
                                    <?php the_content(); ?>
                                </div>

                            <?php endwhile; ?>

                        </div>
                    </div>

                <?php
                endif;
                wp_reset_postdata();
                ?>

            </div>
        </section>


        <section class="works">
            <div class="container">

                <h2 class="works__title title"><?= get_field('works_title'); ?></h2>
                <p class="works__subtitle"><?= get_field('works_subtitle'); ?></p>

                <?php if( have_rows('works_slider') ): ?>
                    <div class="works__slider" id="works_slider">
                        <?php while( have_rows('works_slider') ): the_row(); ?>
                            <div class="works__slide">
                                <div class="works__slide-inner">
                                    <img src="<?php the_sub_field('image'); ?>" alt="">
                                    <p><?php the_sub_field('title'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

            </div>
        </section>


    </main><!-- #main -->

<?php
get_footer();
