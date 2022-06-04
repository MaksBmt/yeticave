<main>
<nav class="nav">
      <ul class="nav__list container">
      <?php foreach($categories as $categori): ?>
        <li class="nav__item">
          <a href="all-lots.html"><?= $categori['name_category']; ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
    </nav>
    <div class="container">
      <section class="lots">
     <?php if($count_lots): ?>     
        <h2>Результаты поиска по запросу «<span><?=$search ?></span>»</h2>
        <ul class="lots__list">

     <?php foreach($lots as $lot): ?>
          
          <li class="lots__item lot">
              <div class="lot__image">
                  <img src="<?= $lot["img"]; ?>" width="350" height="260" alt="<?= $lot["title"]; ?>">
              </div>
              <div class="lot__info">
                  <span class="lot__category"><?= $lot["name_category"]; ?></span>
                  <h3 class="lot__title"><a class="text-link" href="lot.php?lot=<?=$lot["id"]; ?>"><?= htmlspecialchars($lot["title"]); ?></a></h3>
                  <div class="lot__state">
                      <div class="lot__rate">
                          <span class="lot__amount">Стартовая цена</span>
                          <span class="lot__cost"><?= format_price(htmlspecialchars($lot["start_price"])); ?></span>
                      </div>
                      <?php $res = get_time_left(htmlspecialchars($lot["date_finish"])) ?>
                      <div class="lot__timer timer <?php if($res[0]<1): ?>timer--finishing<?php endif; ?>">
                        <?= "$res[0] : $res[1]"; ?>
                      </div>
                  </div>
              </div>
          </li>
      <?php endforeach; ?>   

        </ul>
      </section>
     
      <?php if(count($pages) > 1): ?>
       
      <ul class="pagination-list">
      <?php $prev = $page - 1; ?>
      <?php $next = $page + 1; ?>
     
      <li class="pagination-item pagination-item-prev">
        <a <?php if ($page >= 2): ?> href="search.php?search=<?= $search; ?>&page=<?= $prev; ?>"<?php endif; ?>>Назад</a>
      </li>
      <?php foreach($pages as $item): ?>
        <li class="pagination-item <?php if ($page == $item): ?>pagination-item-active<?php endif; ?>">
            <a href="search.php?search=<?= $search; ?>&page=<?= $item; ?>"><?= $item; ?></a>
        </li>
        <?php endforeach; ?>
        <li class="pagination-item pagination-item-next">
            <a <?php if ($page < count($pages)): ?> href="search.php?search=<?= $search; ?>&page=<?= $next; ?>"<?php endif; ?>>Вперед</a>
        </li>
      </ul>
      <?php endif; ?>
      <?php else: ?>
        <h2>Ничего не найдено по вашему запросу</h2>
    <?php endif; ?>
    </div>
  </main>