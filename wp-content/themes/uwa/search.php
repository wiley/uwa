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
		display: block;
		margin: .25em 0;
	  font-size: 0.8em;
	}
	.search .intro {
	  padding-bottom: 0;
	}

	/* No Results */

	.intro .searchbox__innerwrapper {
	    margin: 0 auto;
	    padding: 0;
	}

	.intro .searchbox__close-button {
		display: none;
	}

	.search-no-results .intro {
    padding: 1.5em .5em;
    box-shadow: 0 0 12px 0 rgba(112, 112, 112, 0.17);
    margin-top: -2.5em;
		height: 450px;
	}

	.search-no-results .search-results form {
    display: none;
	}
	.search-no-results .intro p {
		/* font-family: "Open Sans", Helvetica, Arial, sans-serif; */
    padding: 0 0.5em;
    display: block;
    margin: .25em 0;
    font-size: 1.5em;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.45;
    text-align: center;
    /* font-weight: 500; */
		text-rendering: optimizelegibility;
		font-weight: normal;
		font-family: "Lora", Helvetica, Arial, serif;
		margin-bottom: 1.5em;
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
