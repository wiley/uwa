<?php get_header(); ?>
<style media="screen">
	.search .intro {
	  max-width: 800px;
	  margin: -5.5em 1em 1em;
	  position: relative;
	  background: white;
	  margin-left: auto;
	  margin-right: auto;
	  text-align: left;
	  z-index: 9999;
	  padding-bottom: 5em;
	}
	.search-results article {
	  border-bottom: 1px solid lightgray;
	  margin: 1em 0;
	  padding: 1em 0;
	}

	.search-results article:last-of-type {
	  border-bottom: 0;
	}

	.search-results article header a {
	  font-family: "Open Sans", Helvetica, Arial, sans-serif;
	  font-weight: 100;
	  padding: 0 0.5em;
	  text-align: left;
	  margin-top: 1em;
	  margin-bottom: 1em;
	  font-size: 0.8em;
	}

	.search .intro {
	  padding-bottom: 0;
	}	
</style>
<div class="content">
	<div class="wrap cf">
		<main class="main-content cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
			<div class="intro">

				<div class="search-results">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article <?php post_class( 'cf' ); ?> role="article">

						<header class="post-header">

							<h1 class="h2 post-header__title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

						</header>

						<section class="post-content cf">
							<?php the_excerpt(); ?>
						</section>

					</article>

					<?php endwhile; ?>

							<?php bones_page_navi(); ?>

					<?php else : ?>

						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
						<?php
							get_search_form();

					endif;
					?>
				</div>
			</div>

		</main>

	</div>
	<?php include('includes/waiting.php'); ?>

</div>

<?php get_footer();
