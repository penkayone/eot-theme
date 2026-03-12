<?php
/**
 * Template Name: About
 */
get_header(); ?>

<main>
  <section class="section">
    <div class="container">
      <h1 data-i18n="about.title">Обо мне</h1>
      <div class="grid two-columns about-grid">
        <article class="card">
          <h2 data-i18n="about.story.title">Путь в профессию</h2>
          <p data-i18n="about.story.p1">
            Я увлекаюсь психологией с детства. В моей юности профессия психолога была редкой. Я поступила в Донецкий государственный университет на специальность экономист и обучалась заочно.
          </p>
          <p data-i18n="about.story.p2">
            Работала на заводе экономистом и комсоргом. С 1992 года стала предпринимателем: работала директором магазина и коммерческим директором кирпичного завода, стала автором рецептур, изобретений, промышленных образцов и рационализаторских предложений в сфере кирпичного производства.
          </p>
          <p data-i18n="about.story.p3">
            На завод приглашала специалистов-психологов для проведения тренингов, исследований и тестирования. Медитациями и энергопрактиками занимаюсь с 1997 года. С 2022 года обучаюсь и практикую в сфере коучинга и психологии.
          </p>
        </article>
        <article class="card">
          <h2 data-i18n="about.practice.title">Опыт и направления</h2>
          <p data-i18n="about.practice.intro">
            Мой опыт включает:
          </p>
          <ul>
            <li data-i18n="about.practice.items.1">Коучинг и провокативный коучинг.</li>
            <li data-i18n="about.practice.items.2">Психологическое консультирование.</li>
            <li data-i18n="about.practice.items.3">Энергопрактики, медитации и звуковую терапию.</li>
            <li data-i18n="about.practice.items.4">Эмоционально-образную терапию (ЭОТ).</li>
            <li data-i18n="about.practice.items.5">Аромакоучинг, аромапсихологию и ольфактотерапию.</li>
            <li data-i18n="about.practice.items.6">Регрессивный гипноз.</li>
          </ul>
        </article>
        <article class="card">
          <h2 data-i18n="about.educationPath.title">Обучение и школы</h2>
          <p data-i18n="about.educationPath.intro">Я обучаюсь у сильных специалистов и в профильных институтах:</p>
          <ul>
            <li data-i18n="about.educationPath.items.1">Олег Шаповалов — интегральная парапсихология, айкидо.</li>
            <li data-i18n="about.educationPath.items.2">Светлана Бугела — гипнокоучинг, самогипноз.</li>
            <li data-i18n="about.educationPath.items.3">Алуника Добровольская, Андрей Яценко — самогипноз.</li>
            <li data-i18n="about.educationPath.items.4">Альфрид Ленгле — годовая программа, курсы по личностным расстройствам и депрессии.</li>
            <li data-i18n="about.educationPath.items.5">Александр Стручаев — коучинг.</li>
            <li data-i18n="about.educationPath.items.6">Академия экспоненциального коучинга — гранты.</li>
            <li data-i18n="about.educationPath.items.7">Андрей Треногов — зеркальная психология.</li>
            <li data-i18n="about.educationPath.items.8">Школа 3 волны КПТ Вячеслава Яковлева — полимодальный подход в работе с психологической травмой, ПТСР и кПТСР.</li>
            <li data-i18n="about.educationPath.items.9">Анна Мария Аре Буайе — ольфактотерапия, аромапсихология, аромакоучинг.</li>
            <li data-i18n="about.educationPath.items.10">Наталья Стишова — образно-полевой подход и метод расстановок.</li>
            <li data-i18n="about.educationPath.items.11">Леонид Тальпис — мировоззренческий семинар, метод «Две точки».</li>
            <li data-i18n="about.educationPath.items.12">Ксения Зиганшина — курс энергопрактик.</li>
            <li data-i18n="about.educationPath.items.13">Институт психологии творчества Павла Пискарева — нейрографика.</li>
            <li data-i18n="about.educationPath.items.14">Оксана Авдеева — нейрографика.</li>
            <li data-i18n="about.educationPath.items.15">Московский институт психоанализа — провокативный коучинг и психологическое консультирование.</li>
            <li data-i18n="about.educationPath.items.16">Институт эмоционально-образной терапии им. Николая Линде — психологическое консультирование.</li>
          </ul>
        </article>
        <article class="card">
          <h2 data-i18n="about.creative.title">Творчество и авторские практики</h2>
          <p data-i18n="about.creative.text">
            Пишу стихи, картины, песни. Интересуюсь физиологией, суплементологией, массажем, биоэнергетикой. Практикую авторские сессии «Энергосканер».
          </p>
          <p class="about-education-note" data-i18n="about.creative.education">Имею среднее медицинское и высшее экономическое образование.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="section soft">
    <div class="container">
      <div class="section-head">
        <h2 data-i18n="about.certs.title">Сертификаты</h2>
        <p class="muted" data-i18n="about.certs.subtitle">Подтверждение обучения и повышения квалификации.</p>
      </div>
      <div class="cert-sections">
        <div class="cert-group">
          <div class="gallery grid cert-grid cert-gallery" data-gallery="certs-main">
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-1.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-1.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.1.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-2.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-2.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.2.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-3.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-3.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.3.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-4.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-4.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.4.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-5.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-5.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.5.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-6.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-6.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.6.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-7.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-7.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.7.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-8.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-8.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.8.alt" />
            </button>
            <button class="gallery-item cert-item landscape" type="button" data-full="<?php echo eot_image_url('cert-9.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-9.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.9.alt" />
            </button>
          </div>
        </div>
        <div class="cert-group">
          <div class="gallery grid cert-grid cert-gallery cert-gallery-appendix" data-gallery="certs-appendix">
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-10.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-10.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.10.alt" />
            </button>
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-11.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-11.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.11.alt" />
            </button>
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-12.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-12.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.12.alt" />
            </button>
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-13.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-13.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.13.alt" />
            </button>
            <button class="gallery-item cert-item portrait" type="button" data-full="<?php echo eot_image_url('cert-14.jpg'); ?>">
              <img src="<?php echo eot_image_url('cert-14.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.certs.items.14.alt" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section" data-reveal>
    <div class="container">
      <div class="section-head">
        <h2 data-i18n="about.art.title">Картины</h2>
        <p class="muted" data-i18n="about.art.subtitle">
          Творчество помогает мне сохранять внутренний баланс и вдохновение.
        </p>
      </div>
      <div class="gallery grid cards-3" data-gallery="art">
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-1.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-1.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.1.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-2.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-2.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.2.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-3.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-3.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.3.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-4.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-4.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.4.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-5.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-5.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.5.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-6.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-6.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.6.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-7.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-7.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.7.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-8.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-8.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.8.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-9.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-9.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.9.alt" />
        </button>
        <button class="gallery-item" type="button" data-full="<?php echo eot_image_url('art-10.jpg'); ?>">
          <img src="<?php echo eot_image_url('art-10.jpg'); ?>" alt="" data-i18n-attr="alt" data-i18n="about.art.items.10.alt" />
        </button>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
