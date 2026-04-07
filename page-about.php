<?php
/**
 * Template Name: About
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1><?php echo esc_html(eot_t('about.title')); ?></h1>
      <div class="grid two-columns about-grid">
        <article class="card">
          <h2><?php echo esc_html(eot_t('about.story.title')); ?></h2>
          <p><?php echo esc_html(eot_t('about.story.p1')); ?></p>
          <p><?php echo esc_html(eot_t('about.story.p2')); ?></p>
          <p><?php echo esc_html(eot_t('about.story.p3')); ?></p>
        </article>
        <article class="card">
          <h2><?php echo esc_html(eot_t('about.practice.title')); ?></h2>
          <p><?php echo esc_html(eot_t('about.practice.intro')); ?></p>
          <ul>
            <li><?php echo esc_html(eot_t('about.practice.items.1')); ?></li>
            <li><?php echo esc_html(eot_t('about.practice.items.2')); ?></li>
            <li><?php echo esc_html(eot_t('about.practice.items.3')); ?></li>
            <li><?php echo esc_html(eot_t('about.practice.items.4')); ?></li>
            <li><?php echo esc_html(eot_t('about.practice.items.5')); ?></li>
            <li><?php echo esc_html(eot_t('about.practice.items.6')); ?></li>
          </ul>
        </article>
        <article class="card">
          <h2><?php echo esc_html(eot_t('about.educationPath.title')); ?></h2>
          <p><?php echo esc_html(eot_t('about.educationPath.intro')); ?></p>
          <ul>
            <li><?php echo esc_html(eot_t('about.educationPath.items.1')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.2')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.3')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.4')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.5')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.6')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.7')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.8')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.9')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.10')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.11')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.12')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.13')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.14')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.15')); ?></li>
            <li><?php echo esc_html(eot_t('about.educationPath.items.16')); ?></li>
          </ul>
        </article>
        <article class="card">
          <h2><?php echo esc_html(eot_t('about.creative.title')); ?></h2>
          <p><?php echo esc_html(eot_t('about.creative.text')); ?></p>
          <p class="about-education-note"><?php echo esc_html(eot_t('about.creative.education')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft">
    <div class="container">
      <div class="section-head">
        <h2><?php echo esc_html(eot_t('about.certs.title')); ?></h2>
        <p class="muted"><?php echo esc_html(eot_t('about.certs.subtitle')); ?></p>
      </div>
      <div class="gallery cert-gallery cert-pairs" data-gallery="certs">
        <?php
        $paired_cert_pairs = [
          ['main' => 1, 'appendix' => 11],
          ['main' => 2, 'appendix' => 12],
          ['main' => 3, 'appendix' => 13],
        ];
        $main_only_certs = [4, 5, 6, 7, 8, 9, 10];
        ?>
        <div class="cert-pairs-top">
          <?php foreach ($paired_cert_pairs as $pair) :
            $main = (int) $pair['main'];
            ?>
            <div class="cert-pair">
              <button class="gallery-item cert-item cert-item-main landscape" type="button" data-full="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>">
                <img src="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.certs.items.' . $main . '.alt')); ?>" />
              </button>
              <?php if (isset($pair['appendix'])) :
                $appendix = (int) $pair['appendix'];
                ?>
                <button class="gallery-item cert-item cert-item-appendix portrait" type="button" data-full="<?php echo eot_image_url('cert-' . $appendix . '.jpg'); ?>">
                  <img src="<?php echo eot_image_url('cert-' . $appendix . '.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.certs.items.' . $appendix . '.alt')); ?>" />
                </button>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="cert-main-grid">
          <?php foreach ($main_only_certs as $main) :
            $main = (int) $main;
            ?>
            <button class="gallery-item cert-item cert-item-main landscape" type="button" data-full="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.certs.items.' . $main . '.alt')); ?>" />
            </button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <div class="section-head">
        <h2><?php echo esc_html(eot_t('about.art.title')); ?></h2>
        <p class="muted"><?php echo esc_html(eot_t('about.art.subtitle')); ?></p>
      </div>
      <div class="gallery grid cards-3" data-gallery="art">
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-1.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-1.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.1.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-2.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-2.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.2.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-3.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-3.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.3.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-4.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-4.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.4.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-5.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-5.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.5.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-6.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-6.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.6.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-7.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-7.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.7.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-8.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-8.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.8.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-9.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-9.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.9.alt')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-10.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-10.jpg'); ?>" alt="<?php echo esc_attr(eot_t('about.art.items.10.alt')); ?>" />
        </button>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
