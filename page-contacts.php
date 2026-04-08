<?php
/**
 * Template Name: Contacts
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1><?php echo esc_html__('Соц.сети', 'eot-theme'); ?></h1>
      <div class="contacts-v2-grid">
        <article class="card contacts-v2-social">
          <div class="contacts-social-strip">
            <a class="btn btn-social social-telegram" href="https://t.me/LaraLorein" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__('Telegram', 'eot-theme'); ?>">
              <img class="social-icon" src="<?php echo eot_image_url('icon-telegram.svg'); ?>" alt="" aria-hidden="true" />
              <span><?php echo esc_html__('Telegram', 'eot-theme'); ?></span>
            </a>
            <a class="btn btn-social social-instagram" href="https://www.instagram.com/larisamomotova?utm_source=qr&igsh=ajR4dWpsMDJ2cHFw" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__('Instagram', 'eot-theme'); ?>">
              <img class="social-icon" src="<?php echo eot_image_url('icon-instagram.svg'); ?>" alt="" aria-hidden="true" />
              <span><?php echo esc_html__('Instagram', 'eot-theme'); ?></span>
            </a>
            <a class="btn btn-social social-youtube" href="https://youtube.com/@larysamomotova?si=Czm1zGo4rbFc5QG-" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__('YouTube', 'eot-theme'); ?>">
              <img class="social-icon" src="<?php echo eot_image_url('icon-youtube.svg'); ?>" alt="" aria-hidden="true" />
              <span><?php echo esc_html__('YouTube', 'eot-theme'); ?></span>
            </a>
            <a class="btn btn-social social-facebook" href="https://www.facebook.com/share/17xxhgL4zL/" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr__('Facebook', 'eot-theme'); ?>">
              <img class="social-icon" src="<?php echo eot_image_url('icon-facebook.svg'); ?>" alt="" aria-hidden="true" />
              <span><?php echo esc_html__('Facebook', 'eot-theme'); ?></span>
            </a>
          </div>
        </article>

        <article class="card booking-v2 booking-v2-full" id="booking">
          <h2><?php echo esc_html__('Запись на консультацию', 'eot-theme'); ?></h2>
          <div class="booking-v2-controls">
            <div class="booking-v2-field">
              <span><?php echo esc_html__('Выберите услугу', 'eot-theme'); ?></span>
              <div class="booking-v2-select-wrap">
                <button type="button" id="service-trigger" class="booking-v2-select-trigger" aria-haspopup="listbox" aria-expanded="false">
                  <?php echo esc_html__('Выберите услугу', 'eot-theme'); ?>
                </button>
                <ul id="service-menu" class="booking-v2-select-menu" role="listbox" hidden></ul>
              </div>
            </div>
          </div>

          <div class="booking-v2-days" id="days-grid" aria-live="polite">
            <button type="button" class="booking-v2-day selected weekday-long"><span>понедельник</span><strong>01</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>вторник</span><strong>02</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>среда</span><strong>03</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>четверг</span><strong>04</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>пятница</span><strong>05</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>суббота</span><strong>06</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day weekday-long"><span>воскресенье</span><strong>07</strong><small>янв</small></button>
          </div>

          <div class="booking-v2-slots">
            <h3 class="booking-v2-subtitle"><?php echo esc_html__('Доступное время', 'eot-theme'); ?></h3>
            <div class="booking-v2-slots-grid" id="slots-grid" aria-live="polite">
              <button type="button" class="booking-v2-slot free">09:00</button>
              <button type="button" class="booking-v2-slot free">10:00</button>
              <button type="button" class="booking-v2-slot free">11:00</button>
              <button type="button" class="booking-v2-slot free">12:00</button>
            </div>
          </div>

          <form id="booking-form" class="booking-v2-form" novalidate>
            <p class="booking-v2-selected" id="booking-selected" aria-live="polite"></p>
            <div class="booking-v2-form-grid">
              <label class="booking-v2-field">
                <span><?php echo esc_html__('Имя', 'eot-theme'); ?></span>
                <input type="text" id="booking-name" name="name" required autocomplete="name" />
              </label>
              <label class="booking-v2-field">
                <span><?php echo esc_html__('Email', 'eot-theme'); ?></span>
                <input type="email" id="booking-email" name="email" required autocomplete="email" inputmode="email" />
              </label>
            </div>
            <div class="booking-v2-form-grid">
              <label class="booking-v2-field">
                <span><?php echo esc_html__('Телефон', 'eot-theme'); ?></span>
                <input type="tel" id="booking-phone" name="phone" required inputmode="tel" autocomplete="tel" />
              </label>
              <label class="booking-v2-field">
                <span><?php echo esc_html__('Кратко запрос', 'eot-theme'); ?></span>
                <input type="text" id="booking-message" name="message" required />
              </label>
            </div>
            <button type="submit" class="booking-v2-submit"><?php echo esc_html__('Забронировать', 'eot-theme'); ?></button>
            <p class="booking-v2-feedback" id="booking-feedback" aria-live="polite"></p>
          </form>
        </article>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
