<?php
/**
 * Template Name: Contacts
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1 data-i18n="contacts.title">Соц.сети</h1>
      <div class="contacts-v2-grid">
        <article class="card contacts-v2-social">
          <div class="contacts-social-strip">
            <a class="btn btn-social social-telegram" href="https://t.me/LaraLorein" target="_blank" rel="noopener noreferrer" aria-label="" data-i18n-attr="aria-label" data-i18n="contacts.channels.telegram">
              <img class="social-icon" src="<?php echo eot_image_url('icon-telegram.svg'); ?>" alt="" aria-hidden="true" />
              <span data-i18n="contacts.channels.telegram">Telegram</span>
            </a>
            <a class="btn btn-social social-instagram" href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="" data-i18n-attr="aria-label" data-i18n="contacts.channels.instagram">
              <img class="social-icon" src="<?php echo eot_image_url('icon-instagram.svg'); ?>" alt="" aria-hidden="true" />
              <span data-i18n="contacts.channels.instagram">Instagram</span>
            </a>
            <a class="btn btn-social social-youtube" href="https://youtube.com" target="_blank" rel="noopener noreferrer" aria-label="" data-i18n-attr="aria-label" data-i18n="contacts.channels.youtube">
              <img class="social-icon" src="<?php echo eot_image_url('icon-youtube.svg'); ?>" alt="" aria-hidden="true" />
              <span data-i18n="contacts.channels.youtube">YouTube</span>
            </a>
            <a class="btn btn-social social-facebook" href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="" data-i18n-attr="aria-label" data-i18n="contacts.channels.facebook">
              <img class="social-icon" src="<?php echo eot_image_url('icon-facebook.svg'); ?>" alt="" aria-hidden="true" />
              <span data-i18n="contacts.channels.facebook">Facebook</span>
            </a>
          </div>
        </article>

        <?= do_shortcode('[booking_consult]'); ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
