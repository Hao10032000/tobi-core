<?php
wp_enqueue_style( 'tf-project');
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
																			<a href="#" class="btn-goback"> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
	<path d="M7 0L8.22 1.23L3.32001 6.12H13.5V7.88H3.32001L8.22 12.78L7 14L0 7L7 0Z" fill="#FF9366"/>
	</svg> <?php echo esc_html_e('Retour', 'themesflat-core'); ?></a>
	
											<h1 class="title">
												<?php echo get_the_title(); ?>
											</h1>
								</div>
	
								<div class="single-content-job">
									<div class="content-left">
	
	
											<div class="content">
												<div class="inner">
													<h2><?php echo esc_html_e('Client', 'themesflat-core'); ?></h2>
													<?php echo $client_info; ?>
												</div>
												<div class="inner">
													<h2><?php echo esc_html_e('Profil', 'themesflat-core'); ?></h2>
													<?php echo $profil_info; ?>
												</div>
											</div>
									</div>
	
									<div class="content-right">
										<div class="information-box">
											<h3><?php echo esc_html_e('Informations :', 'themesflat-core'); ?></h3>
											<ul>
												<li><?php echo $ref; ?></li>
												<li><?php echo get_the_date( 'm/d/Y' );?></li>
											</ul>
										</div>
										<a href="#" class="btn-goback"> <?php echo esc_html_e('Postuler', 'themesflat-core'); ?> <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11" fill="none">
	<path d="M0.27002 0V1.73H7.19995L0 8.92L1.23999 10.16L8.43994 2.97V9.9H10.17V0H0.27002Z" fill="#FF9366"/>
	</svg> </a>
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



<?php get_footer(); ?>