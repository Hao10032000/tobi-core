<?php
wp_enqueue_style( 'tf-project');
wp_enqueue_script( 'job-form-ajax' );
get_header(); 

?>

<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="wrap-content-area">

                <div id="primary" class="content-area">

                    <main id="main" class="main-content" role="main">

                        <div class="entry-content">

                            <?php while ( have_posts() ) : the_post(); 
						
							$client_info = get_post_meta( get_the_ID(), '_job_client', true );
							$profil_info = get_post_meta( get_the_ID(), '_job_profil', true );
							$ref = get_post_meta( get_the_ID(), '_job_ref', true );
						?>
                            <div class="single-content-job-over">

                                <div class="header-single">
                                    <a href="<?php echo esc_url( home_url('/job/') ); ?>" class="btn-goback"
                                        onclick="if(document.referrer && document.referrer.includes(location.host)) { history.back(); return false; }">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 14 14" fill="none">
                                            <path
                                                d="M7 0L8.22 1.23L3.32001 6.12H13.5V7.88H3.32001L8.22 12.78L7 14L0 7L7 0Z"
                                                fill="#FF9366" />
                                        </svg>
                                        <?php echo esc_html_e('Retour', 'themesflat-core'); ?>
                                    </a>

                                    <h1 class="title">
                                        <?php echo get_the_title(); ?>
                                    </h1>
                                </div>


                                <div class="single-content-job">
                                    <div class="content-left">


                                        <div class="content">
                                            <?php if (!empty($profil_info)): ?>
                                            <div class="inner">
                                                <?php echo $profil_info; ?>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="content-right">
                                        <div class="information-box">
                                            <h3><?php echo esc_html_e('Informations :', 'themesflat-core'); ?></h3>
                                            <ul>
                                                <?php if (!empty($ref)): ?>
                                                <li><?php echo $ref; ?></li>
                                                <?php endif;?>
                                                <li><?php echo get_the_date( 'm/d/Y' );?></li>
                                            </ul>
                                        </div>
                                        <button id="open-application-popup" class="btn-goback">
                                            <?php echo esc_html_e('Postuler', 'themesflat-core'); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                                viewBox="0 0 11 11" fill="#FF9366">
                                                <path
                                                    d="M0.27002 0V1.73H7.19995L0 8.92L1.23999 10.16L8.43994 2.97V9.9H10.17V0H0.27002Z" />
                                            </svg>
                                        </button>
                                    </div>


                                </div>
                            </div>


                            <?php endwhile; ?>


                        </div><!-- ./entry-content -->

                    </main><!-- #main -->

                </div><!-- #primary -->

            </div>

        </div>

    </div>

</div>

<div id="job-application-modal" style="display:none;">
    <div class="modal-overlay"></div>
    <div class="modal-content-wrapper">
        <button class="modal-close-btn" id="close-application-popup">&times;</button>

        <div class="modal-header">
            <h2 id="modal-title">
                <?php echo esc_html_e('Candidature pour : Directeur général des services mutualisé', 'themesflat-core'); ?>
            </h2>
        </div>

        <form id="job-application-form" enctype="multipart/form-data">

            <input type="hidden" name="action" value="<?php echo JOB_APPLICATION_ACTION; ?>">
            <input type="hidden" name="security" id="job-app-nonce"
                value="<?php echo wp_create_nonce('job_application_nonce'); ?>">
            <input type="hidden" name="job_id" id="job-id-field" value="<?php echo get_the_ID(); ?>">

            <div class="form-row">
                <div class="form-group">
                    <label for="civility"><?php echo esc_html_e('Civilité', 'themesflat-core'); ?></label>
                    <input type="text" name="civility" id="civility" placeholder="Civilité" required>
                </div>
                <div class="form-group">
                    <label for="prenom"><?php echo esc_html_e('Prénom', 'themesflat-core'); ?></label>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nom"><?php echo esc_html_e('Nom', 'themesflat-core'); ?></label>
                    <input type="text" name="nom" id="nom" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <label for="ville"><?php echo esc_html_e('Ville', 'themesflat-core'); ?></label>
                    <input type="text" name="ville" id="ville" placeholder="Ville">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tel_mobile"><?php echo esc_html_e('Tél mobile', 'themesflat-core'); ?></label>
                    <input type="number" name="tel_mobile" id="tel_mobile" placeholder="Tél mobile">
                </div>
                <div class="form-group">
                    <label for="email_perso"><?php echo esc_html_e('Email perso', 'themesflat-core'); ?></label>
                    <input type="email" name="email_perso" id="email_perso" placeholder="Email perso" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="cv_file"><?php echo esc_html_e('CV.', 'themesflat-core'); ?></label>
                    <input type="file" name="cv_file" id="cv_file" accept=".pdf,.doc,.docx" class="cv-file-input" required>
                </div>
            </div>

            <div class="data-protection">
                <input type="checkbox" name="data_consent" id="data_consent" required checked>
                <div class="inner">
                    <label for="data_consent" class="label-consent">
                        En cochant cette case, vous reconnaissez avoir pris connaissance et accepter sans réserve les
                        <a href="#">Conditions Générales d'Utilisation</a> ainsi que la
                        <a href="#">Protection des Données Personnelles.</a>
                    </label>
                    <p class="gdpr-text">
                        Les données à caractère personnel recueillies font l’objet d’un traitement informatique par
                        notre cabinet afin de gérer votre candidature. Conformément à la loi n°78-17 du 6 janvier 1978,
                        vous bénéficiez d’un droit d’accès, de rectification et de suppression aux données à caractère
                        personnel qui vous concernent ainsi que d’un droit d’opposition pour des motifs légitimes au
                        traitement de ces données. Vous pouvez exercer ces droits en vous adressant à l’adresse suivante
                        : XXXXX
                    </p>
                </div>
            </div>

            <div class="form-messages" id="form-messages" style="margin-top: 15px;"></div>

            <button type="submit" class="btn-postuler-submit">Postuler <svg xmlns="http://www.w3.org/2000/svg"
                    width="11" height="11" viewBox="0 0 11 11" fill="none">
                    <path d="M0.27002 0V1.73H7.19995L0 8.92L1.23999 10.16L8.43994 2.97V9.9H10.17V0H0.27002Z"
                        fill="#FF9366" />
                </svg></button>
        </form>
    </div>
</div>

<?php 
echo do_shortcode('[my_elementor_template id=1668]'); ?>

<?php get_footer(); ?>