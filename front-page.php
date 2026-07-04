<?php get_header();
$eot_lang = eot_get_current_lang();
?>

<main>
  <section class="hero section">
    <div class="container hero-grid">
      <div class="hero-content">
        <h1 class="hero-title"><?php echo esc_html__('Русскоговорящий психолог, коуч за рубежом', 'eot-theme'); ?></h1>
        <p class="hero-subtitle"><?php echo esc_html__('Провокативное, психологическое консультирование и коучинг.', 'eot-theme'); ?></p>
        <ul class="hero-list">
          <li><?php echo esc_html__('Эмоционально-образная терапия.', 'eot-theme'); ?></li>
          <li><?php echo esc_html__('Гипнокоучинг', 'eot-theme'); ?></li>
          <li><?php echo esc_html__('Аромопсихология, ольфактотерапия', 'eot-theme'); ?></li>
        </ul>
        <p class="hero-text"><?php echo esc_html__('Работаю с тревогой, самооценкой, страхом проявленности, бессонницей, фобиями, психоблоками, эмоциональными травмами и другими запросами.', 'eot-theme'); ?></p>
        <div class="badges">
          <span class="badge"><?php echo esc_html__('Конфиденциально', 'eot-theme'); ?></span>
          <span class="badge"><?php echo esc_html__('Онлайн', 'eot-theme'); ?></span>
          <span class="badge"><?php echo esc_html__('Полимодальный подход', 'eot-theme'); ?></span>
        </div>
        <div class="button-row">
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(eot_localized_url('contacts') . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
          <a class="btn btn-outline" href="https://t.me/larysamotz"><?php echo esc_html__('Отзывы', 'eot-theme'); ?></a>
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
            <img src="<?php echo eot_image_url('hero-1.webp'); ?>" alt="<?php echo esc_attr__('Фото психолога', 'eot-theme'); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-2.webp'); ?>" alt="<?php echo esc_attr__('Фото психолога', 'eot-theme'); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-3.webp'); ?>" alt="<?php echo esc_attr__('Фото психолога', 'eot-theme'); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-4.webp'); ?>" alt="<?php echo esc_attr__('Фото психолога', 'eot-theme'); ?>" />
          </div>
          <div class="hero-slide">
            <img src="<?php echo eot_image_url('hero-5.webp'); ?>" alt="<?php echo esc_attr__('Фото психолога', 'eot-theme'); ?>" />
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
      <h2><?php echo esc_html__('С какими запросами можно прийти', 'eot-theme'); ?></h2>
      <div class="grid cards-3">
        <article class="card query-card">
          <h3><?php echo esc_html__('Тревога', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Снижение внутреннего напряжения, восстановление опоры.', 'eot-theme'); ?></p>
          <a class="btn btn-outline" href="<?php echo esc_url(eot_localized_url('anxiety', $eot_lang)); ?>"><?php echo esc_html__('Подробнее', 'eot-theme'); ?></a>
        </article>
        <article class="card query-card">
          <h3><?php echo esc_html__('Самооценка', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Укрепление самоценности и уверенности в себе.', 'eot-theme'); ?></p>
          <a class="btn btn-outline" href="<?php echo esc_url(eot_localized_url('self-esteem', $eot_lang)); ?>"><?php echo esc_html__('Подробнее', 'eot-theme'); ?></a>
        </article>
        <article class="card query-card">
          <h3><?php echo esc_html__('Страх проявленности', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Преодоление внутренних барьеров, обретение смелости заявлять о себе и своих талантах.', 'eot-theme'); ?></p>
          <a class="btn btn-outline" href="<?php echo esc_url(eot_localized_url('fear-of-visibility', $eot_lang)); ?>"><?php echo esc_html__('Подробнее', 'eot-theme'); ?></a>
        </article>
        <article class="card query-card">
          <h3><?php echo esc_html__('Бессонница', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Работа с причинами нарушения сна, нормализация режима и обретение ночного спокойствия.', 'eot-theme'); ?></p>
          <a class="btn btn-outline" href="<?php echo esc_url(eot_localized_url('insomnia', $eot_lang)); ?>"><?php echo esc_html__('Подробнее', 'eot-theme'); ?></a>
        </article>
        <article class="card query-card">
          <h3><?php echo esc_html__('Психоблоки', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Выявление скрытых барьеров и устранение внутренних препятствий на пути к вашим целям.', 'eot-theme'); ?></p>
          <a class="btn btn-outline" href="<?php echo esc_url(eot_localized_url('mental-blocks', $eot_lang)); ?>"><?php echo esc_html__('Подробнее', 'eot-theme'); ?></a>
        </article>
        <article class="card query-card">
          <h3><?php echo esc_html__('Эмоциональные травмы', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Бережная проработка болезненного опыта и возвращение психологической целостности.', 'eot-theme'); ?></p>
          <a class="btn btn-outline" href="<?php echo esc_url(eot_localized_url('emotional-trauma', $eot_lang)); ?>"><?php echo esc_html__('Подробнее', 'eot-theme'); ?></a>
        </article>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <h2><?php echo esc_html__('Что такое эмоционально-образная терапия?', 'eot-theme'); ?></h2>
      <div class="grid cards-3 eot-cards">
        <article class="card step-card">
          <p><?php echo esc_html__('Эмоционально-образная терапия (ЭОТ) - современный и эффективный метод психологической помощи. Я работаю как русскоязычный психолог онлайн с людьми, живущими в Европе и за рубежом. В процессе ЭОТ человек учится работать со своими эмоциями и внутренними образами, которые стоят за сложными чувствами, страхами, тревогой или стрессом. Психолог помогает выявить причины дискомфорта и изменить внутренние реакции, что делает терапию глубокой и результативной.', 'eot-theme'); ?></p>
        </article>
        <article class="card step-card">
          <p><?php echo esc_html__('Главная особенность ЭОТ - работа с чувствами, состояниями на самом глубинном уровне личности. Вместе с психологом клиент исследует образы своих эмоций и дискомфорта, находит внутренние ресурсы для разрешения сложных ситуаций. Такой подход особенно полезен, если кажется, что стандартные разговорные методы не дают результата, а напряжение, тревога или обиды как будто "живут внутри".', 'eot-theme'); ?></p>
        </article>
        <article class="card step-card">
          <p><?php echo esc_html__('Причиной телесного дискомфорта, боли, недомогания или хронических заболеваний часто становятся подавленные чувства и нерешенные конфликты. Эмоционально-образная терапия (ЭОТ) помогает выявить и проработать эти скрытые причины - тревогу, бессонницу, психоблоки, эмоциональные травмы. Через работу с образами и чувствами ЭОТ способствует восстановлению гармонии между психикой и телом, что проявляется улучшением самочувствия и избавлением от психосоматических симптомов.', 'eot-theme'); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <h2><?php echo esc_html__('Для кого подходит работа со мной', 'eot-theme'); ?></h2>
      <p class="lead"><?php echo esc_html__('Я работаю с русскоязычными людьми в Европе, для которых важно говорить о сложном на родном языке - бережно, профессионально и без необходимости объяснять культурный контекст.', 'eot-theme'); ?></p>
      <div class="grid cards-3">
        <article class="card">
          <h3><?php echo esc_html__('Русскоязычные в Европе', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Если вы переехали в Словакию, Чехию, Германию, Австрию или другую европейскую страну, и вам важно работать с психологом на родном языке - вы попали по адресу. Я понимаю контекст эмиграции, проблемы адаптации, потерю опоры и языковой барьер с местными специалистами.', 'eot-theme'); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html__('Те, кому помогает онлайн-формат', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Все консультации проходят онлайн через Zoom. Это удобно, если у вас плотный график, маленький ребенок, ограниченная мобильность, или просто нет рядом подходящего русскоязычного специалиста. Эффективность онлайн-сессий не уступает очным.', 'eot-theme'); ?></p>
        </article>
        <article class="card">
          <h3><?php echo esc_html__('Те, кто пробовал и не получил результат', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Если разговорные методы психотерапии не помогли, ЭОТ часто становится решением. Метод работает не через анализ и обсуждение, а через образы, в которых живут эмоции - это позволяет добраться до того, что обычные подходы не затрагивают.', 'eot-theme'); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <h2><?php echo esc_html__('Как проходит консультация', 'eot-theme'); ?></h2>
      <div class="grid cards-4">
        <article class="card step-card">
          <span class="step-number">01</span>
          <h3><?php echo esc_html__('Заявка', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Вы можете записаться на консультацию на этом сайте. Для этого войдите в раздел "Записаться". Выберите: услугу, дату, время, напишите свои данные.', 'eot-theme'); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">02</span>
          <h3><?php echo esc_html__('Обратная связь', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('На указанную Вами почту прийдет письмо с подтверждением записи.', 'eot-theme'); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">03</span>
          <h3><?php echo esc_html__('Сессия', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('За 10 минут до сессии Вам на почту прийдет ссылка, по которой вы подключитесь к Zoom.', 'eot-theme'); ?></p>
        </article>
        <article class="card step-card">
          <span class="step-number">04</span>
          <h3><?php echo esc_html__('Оплата услуг', 'eot-theme'); ?></h3>
          <p><?php echo wp_kses_post(__('Оплату учлуг Вы проводите после встречи. Оплата происходит через сайт <a class="inline-link" href="https://gipnocouch.com" target="_blank" rel="noopener noreferrer">gipnocouch.com</a>', 'eot-theme')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft" data-reveal>
    <div class="container">
      <div class="section-head between">
        <div>
          <h2><?php echo esc_html__('Услуги', 'eot-theme'); ?></h2>
          <p class="muted"><?php echo esc_html__('Подберите формат, который подходит вашему запросу.', 'eot-theme'); ?></p>
        </div>
      </div>
      <div class="grid cards-3">
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html__('1 час', 'eot-theme'); ?></span>
          </div>
          <h3><?php echo esc_html__('Первая сессия по специальной цене', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('На первой встрече мы познакомимся, проясним ваш запрос и проведём полноценную часовую сессию с опорой на эмоционально-образную терапию. Стоимость первой встречи — 30 € вместо обычных 60 €. Последующие индивидуальные сессии — 60 € / час.', 'eot-theme'); ?></p>
          <p class="price"><?php echo esc_html__('€30', 'eot-theme'); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'intro', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html__('60–90 минут', 'eot-theme'); ?></span>
          </div>
          <h3><?php echo esc_html__('Индивидуальная сессия', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Разбор одного запроса с опорой на ЭОТ.', 'eot-theme'); ?></p>
          <p class="price"><?php echo esc_html__('€60 в час', 'eot-theme'); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'individual', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
        </article>
        <article class="card service-card">
          <div class="service-meta">
            <span class="badge"><?php echo esc_html__('8 часов', 'eot-theme'); ?></span>
          </div>
          <h3><?php echo esc_html__('Семинар возрождения внутренней силы', 'eot-theme'); ?></h3>
          <p><?php echo esc_html__('Тренировка практических навыков саморегуляции и снятия психоблоков. Индивидуальная и групповая работа в течение месяца. Две личных встречи. Три групповых сессии. Теоретические лекции в записи.', 'eot-theme'); ?></p>
          <p class="price"><?php echo esc_html__('€300', 'eot-theme'); ?></p>
          <a class="btn btn-primary btn-booking" href="<?php echo esc_url(add_query_arg('service', 'package', eot_localized_url('contacts')) . '#booking'); ?>"><?php echo esc_html__('Записаться', 'eot-theme'); ?></a>
        </article>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
