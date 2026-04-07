<?php
/**
 * Template Name: About
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1><?php echo esc_html(eot_translate('Обо мне')); ?></h1>
      <div class="grid two-columns about-grid">
        <article class="card">
          <h2><?php echo esc_html(eot_translate('Путь в профессию')); ?></h2>
          <p><?php echo esc_html(eot_translate('Я увлекаюсь психологией с детства. В моей юности профессия психолога была редкой. Я поступила в Донецкий государственный университет на специальность экономист и обучалась заочно.')); ?></p>
          <p><?php echo esc_html(eot_translate('Работала на заводе экономистом и комсоргом. С 1992 года стала предпринимателем: работала директором магазина и коммерческим директором кирпичного завода, стала автором рецептур, изобретений, промышленных образцов и рационализаторских предложений в сфере кирпичного производства.')); ?></p>
          <p><?php echo esc_html(eot_translate('На завод приглашала специалистов-психологов для проведения тренингов, исследований и тестирования. Медитациями и энергопрактиками занимаюсь с 1997 года. С 2022 года обучаюсь и практикую в сфере коучинга и психологии.')); ?></p>
        </article>
        <article class="card">
          <h2><?php echo esc_html(eot_translate('Опыт и направления')); ?></h2>
          <p><?php echo esc_html(eot_translate('Мой опыт включает:')); ?></p>
          <ul>
            <li><?php echo esc_html(eot_translate('Коучинг и провокативный коучинг.')); ?></li>
            <li><?php echo esc_html(eot_translate('Психологическое консультирование.')); ?></li>
            <li><?php echo esc_html(eot_translate('Энергопрактики, медитации и звуковую терапию.')); ?></li>
            <li><?php echo esc_html(eot_translate('Эмоционально-образную терапию (ЭОТ).')); ?></li>
            <li><?php echo esc_html(eot_translate('Аромакоучинг, аромапсихологию и ольфактотерапию.')); ?></li>
            <li><?php echo esc_html(eot_translate('Регрессивный гипноз.')); ?></li>
          </ul>
        </article>
        <article class="card">
          <h2><?php echo esc_html(eot_translate('Обучение и школы')); ?></h2>
          <p><?php echo esc_html(eot_translate('Я обучаюсь у сильных специалистов и в профильных институтах:')); ?></p>
          <ul>
            <li><?php echo esc_html(eot_translate('Олег Шаповалов — интегральная парапсихология, айкидо.')); ?></li>
            <li><?php echo esc_html(eot_translate('Светлана Бугела — гипнокоучинг, самогипноз.')); ?></li>
            <li><?php echo esc_html(eot_translate('Алуника Добровольская, Андрей Яценко — самогипноз.')); ?></li>
            <li><?php echo esc_html(eot_translate('Альфрид Ленгле — годовая программа, курсы по личностным расстройствам и депрессии.')); ?></li>
            <li><?php echo esc_html(eot_translate('Александр Стручаев — коучинг.')); ?></li>
            <li><?php echo esc_html(eot_translate('Академия экспоненциального коучинга — гранты.')); ?></li>
            <li><?php echo esc_html(eot_translate('Андрей Треногов — зеркальная психология.')); ?></li>
            <li><?php echo esc_html(eot_translate('Школа 3 волны КПТ Вячеслава Яковлева — полимодальный подход в работе с психологической травмой, ПТСР и кПТСР.')); ?></li>
            <li><?php echo esc_html(eot_translate('Анна Мария Аре Буайе — ольфактотерапия, аромапсихология, аромакоучинг.')); ?></li>
            <li><?php echo esc_html(eot_translate('Наталья Стишова — образно-полевой подход и метод расстановок.')); ?></li>
            <li><?php echo esc_html(eot_translate('Леонид Тальпис — мировоззренческий семинар, метод «Две точки».')); ?></li>
            <li><?php echo esc_html(eot_translate('Ксения Зиганшина — курс энергопрактик.')); ?></li>
            <li><?php echo esc_html(eot_translate('Институт психологии творчества Павла Пискарева — нейрографика.')); ?></li>
            <li><?php echo esc_html(eot_translate('Оксана Авдеева — нейрографика.')); ?></li>
            <li><?php echo esc_html(eot_translate('Московский институт психоанализа — провокативный коучинг и психологическое консультирование.')); ?></li>
            <li><?php echo esc_html(eot_translate('Институт эмоционально-образной терапии им. Николая Линде — психологическое консультирование.')); ?></li>
          </ul>
        </article>
        <article class="card">
          <h2><?php echo esc_html(eot_translate('Творчество и авторские практики')); ?></h2>
          <p><?php echo esc_html(eot_translate('Пишу стихи, картины, песни. Интересуюсь физиологией, суплементологией, массажем, биоэнергетикой. Практикую авторские сессии «Энергосканер».')); ?></p>
          <p class="about-education-note"><?php echo esc_html(eot_translate('Имею среднее медицинское и высшее экономическое образование.')); ?></p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft">
    <div class="container">
      <div class="section-head">
        <h2><?php echo esc_html(eot_translate('Сертификаты')); ?></h2>
        <p class="muted"><?php echo esc_html(eot_translate('Подтверждение обучения и повышения квалификации.')); ?></p>
      </div>
      <div class="gallery cert-gallery cert-pairs" data-gallery="certs">
        <?php
        $paired_cert_pairs = [
          ['main' => 1, 'appendix' => 11],
          ['main' => 2, 'appendix' => 12],
          ['main' => 3, 'appendix' => 13],
        ];
        $main_only_certs = [4, 5, 6, 7, 8, 9, 10];
        $cert_alt_map = [
          1 => 'Сертификат по ЭОТ',
          2 => 'Сертификат по консультированию',
          3 => 'Сертификат по супервизии',
          4 => 'Сертификат по практикам осознанности',
          5 => 'Сертификат 5',
          6 => 'Приложение к диплому 1',
          7 => 'Приложение к диплому 2',
          8 => 'Приложение к диплому 3',
          9 => 'Сертификат 9',
          10 => 'Сертификат 10',
          11 => 'Приложение к сертификату 11',
          12 => 'Приложение к сертификату 12',
          13 => 'Приложение к сертификату 13',
        ];
        ?>
        <div class="cert-pairs-top">
          <?php foreach ($paired_cert_pairs as $pair) :
            $main = (int) $pair['main'];
            ?>
            <div class="cert-pair">
              <button class="gallery-item cert-item cert-item-main landscape" type="button" data-full="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>">
                <img src="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>" alt="<?php echo esc_attr(eot_translate($cert_alt_map[$main] ?? '')); ?>" />
              </button>
              <?php if (isset($pair['appendix'])) :
                $appendix = (int) $pair['appendix'];
                ?>
                <button class="gallery-item cert-item cert-item-appendix portrait" type="button" data-full="<?php echo eot_image_url('cert-' . $appendix . '.jpg'); ?>">
                  <img src="<?php echo eot_image_url('cert-' . $appendix . '.jpg'); ?>" alt="<?php echo esc_attr(eot_translate($cert_alt_map[$appendix] ?? '')); ?>" />
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
              <img src="<?php echo eot_image_url('cert-' . $main . '.jpg'); ?>" alt="<?php echo esc_attr(eot_translate($cert_alt_map[$main] ?? '')); ?>" />
            </button>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <div class="section-head">
        <h2><?php echo esc_html(eot_translate('Картины')); ?></h2>
        <p class="muted"><?php echo esc_html(eot_translate('Творчество помогает мне сохранять внутренний баланс и вдохновение.')); ?></p>
      </div>
      <div class="gallery grid cards-3" data-gallery="art">
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-1.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-1.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 1')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-2.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-2.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 2')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-3.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-3.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 3')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-4.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-4.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 4')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-5.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-5.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 5')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-6.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-6.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 6')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-7.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-7.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 7')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-8.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-8.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 8')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-9.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-9.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 9')); ?>" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-10.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-10.jpg'); ?>" alt="<?php echo esc_attr(eot_translate('Картина 10')); ?>" />
        </button>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
