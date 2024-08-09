<?php
require_once "./ctrl.php";
?>

<!DOCTYPE html>
<html lang="fr">
<?php require_once CMPS . "head.php" ?>

<body data-page="<?= $page ?>">
  <?php require_once CMPS . "header.php" ?>

  <main>
    <section id="search">
      <form target="_self" class="form">
        <input type="search" name="place" maxlength="100" placeholder="Localisation ...">
        <button class="bt">Chercher</button>
      </form>
    </section>

    <section id="result">
      <?php if (isset($weather) && $weather) : ?>
      <h3><?= $weather["place"] ?></h3>
      <aside>
        <p class="flex">
          <span><?= $weather["country"] ?></span> |
          <span>Mise à jour: <?= $weather["time"] . " " . $weather["is_day"] ?></span>
        </p>
        <p class="flex">
          <span>Lever du Soleil: <?= $weather["sunrise"] ?></span>
          <span>Coucher du Soleil: <?= $weather["sunset"] ?></span>
        </p>
      </aside>

      <article>
        <h2><?= $weather["temp"] ?></h2>

        <div class="grid">
          <ul>
            <li>Maximum: <?= $weather["temp_max"] ?></li>
            <li>Minimum: <?= $weather["temp_min"] ?></li>
            <li>Ressenti: <?= $weather["temp_feel"] ?></li>
            <li>Humidité: <?= $weather["humidity"] ?></li>
            <li>Pression atmosphérique: <?= $weather["pressure"] ?></li>
          </ul>

          <ul>
            <li>Couverture nuageuse: <?= $weather["cloud_cover"] ?></li>
            <li>Précipitation: <?= $weather["precipitation"] ?></li>
            <li>Force du vent: <?= $weather["wind_speed"] ?></li>
            <li>Sens du vent: <?= $weather["wind_direction"] ?></li>
          </ul>
        </div>
      </article>
      <?php elseif (isset($place)) : ?>

      <h2>Pas de résultat pour '<?= $place ?>'</h2>
      <?php endif ?>
    </section>
  </main>

  <?php require_once CMPS . "footer.php" ?>
</body>

</html>