<?php get_header(); ?>

<main>
  <section class="hero section">
    <div class="container hero-grid">
      <div class="hero-content">
        <h1 class="hero-title"><?php echo esc_html(eot_translate('Русскоговорящий психолог, коуч за рубежом')); ?></h1>
        <p class="hero-subtitle"><?php echo esc_html(eot_translate('Провокативное, психологическое консультирование и коучинг.')); ?></p>
        <ul class="hero-list">
          <li><?php echo esc_html(eot_translate('Эмоционально-образная терапия.')); ?></li>
          <li><?php echo esc_html(eot_translate('Гипнокоучинг')); ?></li>
          <li><?php echo esc_html(eot_translate('Аромопсихология, ольфактотерапия')); ?></li>
        </ul>
        <p class="hero-text"><?php echo esc_html(eot_translate('Работаю с тревогой, самооценкой, страхом проявленности, бессонницей, фобиями, психоблоками, эмоциональными травмами и другими запросами.')); ?></p>
        <div class="badges">
          <span class="badge"><?php echo esc_html(eot_translate('Конфиденциально')); ?></span>
          <span class="badge"><?php echo esc_html(eot_translate('Онлайн')); ?></span>
          <span class="badge"><?php echo esc_html(eot_translate('Полимодальный подход')); ?></span>
        </div>
        <div class="button-row">
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(eot_localized_url('contacts') . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
          <a class="btn btn-outline" href="https://t.me/larysamotz"><?php echo esc_html(eot_translate('Отзывы')); ?></a>
        </div>
        <div class="hero-social-row">
          <a class="btn btn-social social-telegram" href="https://t.me/LaraLorein" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-telegram.svg'); ?>" alt="" aria-hidden="true" />
            <span>Telegram</span>
          </a>
          <a class="btn btn-social social-instagram" href="https://www.instagram.com/larisamomotova?utm_source=qr&igsh=ajR4dWpsMDJ2cHFw" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-instagram.svg'); ?>" alt="" aria-hidden="true" />
            <span>Instagram</span>
          </a>
          <a class="btn btn-social social-youtube" href="https://youtube.com/@larysamomotova?si=Czm1zGo4rbFc5QG-" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-youtube.svg'); ?>" alt="" aria-hidden="true" />
            <span>YouTube</span>
          </a>
          <a class="btn btn-social social-facebook" href="https://www.facebook.com/share/17xxhgL4zL/" target="_blank" rel="noopener noreferrer">
            <img class="social-icon" src="<?php echo eot_image_url('icon-facebook.svg'); ?>" alt="" aria-hidden="true" />
            <span>Facebook</span>
          </a>
        </div>
      </div>
      <div class="hero-media">
        <div class="hero-slider" data-slider>
          <div class="hero-slide active">
            <img src="<?php echo eot_image_url('hero-1.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Фото психолога')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-2.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Фото психолога')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-3.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Фото психолога')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-4.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Фото психолога')); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-5.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Фото психолога')); ?>" />
          </div>
          <button class="hero-arrow hero-arrow-prev" type="button" aria-label="Назад">&#8249;</button>
          <button class="hero-arrow hero-arrow-next" type="button" aria-label="Вперёд">&#8250;</button>
          <div class="hero-dots" role="tablist" aria-label="Слайдер">
            <button class="hero-dot active" type="button" data-slide="0"></button>
            <button class="hero-dot" type="button" data-slide="1"></button>
            <button class="hero-dot" type="button" data-slide="2"></button>
            <button class="hero-dot" type="button" data-slide="3"></button>
            <button class="hero-dot" type="button" data-slide="4"></button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <h2><?php echo esc_html(eot_translate('С какими запросами можно прийти')); ?></h2>
      <div class="grid cards-3">
        <article class="card">
          <h3><?php echo esc_html(eot_translate('Тревога')); ?></h3>
          <p><?php echo esc_html(eot_translate('Снижение внутреннего напряжения, восстановление опоры.')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_translate('Самооценка')); ?></h3>
          <p><?php echo esc_html(eot_translate('Укрепление самоценности и уверенности в себе.')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_translate('Страх проявленности')); ?></h3>
          <p><?php echo esc_html(eot_translate('Преодоление внутренних барьеров, обретение смелости заявлять о себе и своих талантах.')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_translate('Бессонница')); ?></h3>
          <p><?php echo esc_html(eot_translate('Работа с причинами нарушения сна, нормализация режима и обретение ночного спокойствия.')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_translate('Психоблоки')); ?></h3>
          <p><?php echo esc_html(eot_translate('Выявление скрытых барьеров и устранение внутренних препятствий на пути к вашим целям.')); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html(eot_translate('Эмоциональные травмы')); ?></h3>
          <p><?php echo esc_html(eot_translate('Бережная проработка болезненного опыта и возвращение психологической целостности.')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <h2><?php echo esc_html(eot_translate('Что такое эмоционально-образная терапия?')); ?></h2>
      <div class="grid cards-3 eot-cards">
        <article class="card step-card">
          <p><?php echo esc_html(eot_translate('Эмоционально-образная терапия - современный и эффективный метод психологической помощи. В процессе ЭОТ человек учится работать со своими эмоциями и внутренними образами, которые стоят за сложными чувствами, страхами, тревогой или стрессом. Психолог помогает выявить причины дискомфорта и изменить внутренние реакции, что делает терапию глубокой и результативной.')); ?></p>
        </article>
        <article class="card step-card">
          <p><?php echo esc_html(eot_translate('Главная особенность ЭОТ - работа с чувствами, состояниями на самом глубинном уровне личности. Вместе с психологом клиент исследует образы своих эмоций и дискомфорта, находит внутренние ресурсы для разрешения сложных ситуаций. Такой подход особенно полезен, если кажется, что стандартные разговорные методы не дают результата, а напряжение, тревога или обиды как будто "живут внутри".')); ?></p>
        </article>
        <article class="card step-card">
          <p><?php echo esc_html(eot_translate('Причиной телесного дискомфорта, боли, недомогания или хронических заболеваний часто становятся подавленные чувства и нерешенные конфликты. Эмоционально-образная терапия (ЭОТ) помогает выявить и проработать эти скрытые причины, позволяя человеку осознать свои эмоции и снять внутренние блоки. Благодаря работе с образами и чувствами, ЭОТ способствует восстановлению гармонии между психикой и телом, что проявляется улучшением самочувствия и избавлением от психосоматических симптомов.')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <h2><?php echo esc_html(eot_translate('Как проходит консультация')); ?></h2>
      <div class="grid cards-4">
        <article class="card step-card">
          <span class="step-number">01</span>
          <h3><?php echo esc_html(eot_translate('Заявка')); ?></h3>
          <p><?php echo esc_html(eot_translate('Вы можете записаться на консультацию на этом сайте. Для этого войдите в раздел "Записаться". Выберите: услугу, дату, время, напишите свои данные.')); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">02</span>
          <h3><?php echo esc_html(eot_translate('Обратная связь')); ?></h3>
          <p><?php echo esc_html(eot_translate('На указанную Вами почту прийдет письмо с подтверждением записи.')); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">03</span>
          <h3><?php echo esc_html(eot_translate('Сессия')); ?></h3>
          <p><?php echo esc_html(eot_translate('За 10 минут до сессии Вам на почту прийдет ссылка, по которой вы подключитесь к Zoom.')); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">04</span>
          <h3><?php echo esc_html(eot_translate('Оплата услуг')); ?></h3>
          <p><?php echo wp_kses_post(eot_translate('Оплату учлуг Вы проводите после встречи. Оплата происходит через сайт <a class="inline-link" href="https://gipnocouch.com" target="_blank" rel="noopener noreferrer">gipnocouch.com</a>')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <div class="section-head between">
        <div>
          <h2><?php echo esc_html(eot_translate('Услуги')); ?></h2>
          <p class="muted"><?php echo esc_html(eot_translate('Подберите формат, который подходит вашему запросу.')); ?></p>
        </div>
      </div>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_translate('30 минут')); ?></span>
          </div>
          <h3><?php echo esc_html(eot_translate('Вводная встреча')); ?></h3>
          <p><?php echo esc_html(eot_translate('Короткое знакомство и уточнение запроса.')); ?></p>
          <p class="price"><?php echo esc_html(eot_translate('€0')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'intro', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_translate('60–90 минут')); ?></span>
          </div>
          <h3><?php echo esc_html(eot_translate('Индивидуальная сессия')); ?></h3>
          <p><?php echo esc_html(eot_translate('Разбор одного запроса с опорой на ЭОТ.')); ?></p>
          <p class="price"><?php echo esc_html(eot_translate('€60 в час')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'individual', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html(eot_translate('4 часа')); ?></span>
          </div>
          <h3><?php echo esc_html(eot_translate('Семинар возрождения внутренней силы')); ?></h3>
          <p><?php echo esc_html(eot_translate('Тренировка практических навыков саморегуляции и снятия психоблоков. Индивидуальная и групповая работа в течение месяца. Две личных встречи. Три групповых сессии. Теоретические лекции в записи.')); ?></p>
          <p class="price"><?php echo esc_html(eot_translate('€300')); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'package', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html(eot_translate('Записаться')); ?></a>
        </article>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
