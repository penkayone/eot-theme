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

        <article class="card booking-v2 booking-v2-full" id="booking">
          <h2 data-i18n="booking.title">Запись на консультацию</h2>
          <div class="booking-v2-controls">
            <div class="booking-v2-field">
              <span data-i18n="booking.serviceLabel">Выберите услугу</span>
              <div class="booking-v2-select-wrap">
                <button type="button" id="service-trigger" class="booking-v2-select-trigger" aria-haspopup="listbox" aria-expanded="false">
                  Выберите услугу
                </button>
                <ul id="service-menu" class="booking-v2-select-menu" role="listbox" hidden></ul>
              </div>
            </div>
            <div class="booking-v2-field">
              <span data-i18n="booking.yearLabel">Год</span>
              <div class="booking-v2-select-wrap">
                <button type="button" id="year-trigger" class="booking-v2-select-trigger" aria-haspopup="listbox" aria-expanded="false">
                  2026
                </button>
                <ul id="year-menu" class="booking-v2-select-menu" role="listbox" hidden></ul>
              </div>
            </div>
            <div class="booking-v2-field">
              <span data-i18n="booking.monthLabel">Месяц</span>
              <div class="booking-v2-select-wrap">
                <button type="button" id="month-trigger" class="booking-v2-select-trigger" aria-haspopup="listbox" aria-expanded="false">
                  Январь
                </button>
                <ul id="month-menu" class="booking-v2-select-menu" role="listbox" hidden></ul>
              </div>
            </div>
          </div>

          <div class="booking-v2-days" id="days-grid" aria-live="polite">
            <button type="button" class="booking-v2-day selected"><span>пн</span><strong>01</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>вт</span><strong>02</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>ср</span><strong>03</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>чт</span><strong>04</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>пт</span><strong>05</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>сб</span><strong>06</strong><small>янв</small></button>
            <button type="button" class="booking-v2-day"><span>вс</span><strong>07</strong><small>янв</small></button>
          </div>

          <div class="booking-v2-slots">
            <h3 class="booking-v2-subtitle" data-i18n="booking.slotsLabel">Доступные слоты</h3>
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
                <span data-i18n="booking.nameLabel">Имя</span>
                <input type="text" id="booking-name" name="name" required autocomplete="name" />
              </label>
              <label class="booking-v2-field">
                <span data-i18n="booking.emailLabel">Email</span>
                <input type="email" id="booking-email" name="email" required autocomplete="email" inputmode="email" />
              </label>
            </div>
            <div class="booking-v2-form-grid">
              <label class="booking-v2-field">
                <span data-i18n="booking.phoneLabel">Телефон</span>
                <input type="tel" id="booking-phone" name="phone" required inputmode="tel" autocomplete="tel" />
              </label>
              <label class="booking-v2-field">
                <span data-i18n="booking.messageLabel">Кратко запрос</span>
                <input type="text" id="booking-message" name="message" required />
              </label>
            </div>
            <button type="submit" class="booking-v2-submit" data-i18n="booking.submit">Забронировать</button>
            <p class="booking-v2-feedback" id="booking-feedback" aria-live="polite"></p>
          </form>
        </article>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
