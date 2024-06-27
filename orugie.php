<!DOCTYPE php>
<php lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="oru.css">
    <link rel="stylesheet" href="reset.css">
    <title>Оружие</title>
</head>
<body bgcolor="#1a1a1a">
    <header>
        <div class="sus">
            <div class="maggi">
                <img src="tf.png" class="rot" width="50px">
            </div>
            <a href="index.php" class="">Team Fortress2.com</a>
            <a href="team22.php" class="">Новости</a>
            <a href="lor.php" class="">История</a>
            <div class="dropdown">
                <button class="dropbtn"><a href="faf.php">Персонажи</a></button>
                <div class="dropdown-content">
                  <a href="inven.php" class="rrr">Шапки</a>
                </div>
              </div>
            <a href="https://tf2.a-comics.ru/" class="">Комиксы</a>
        </div>
    </header>
    <div class="block2">
        <div class="novosti colum">
            <h1 class="">Оружие классов</h1>
        </div>
    </div>
    <div class="maps">
                <? 
                    require_once "connect.php";
                    $pers = "SELECT * FROM characters";
                    $ress = mysqli_query($connect, $pers) or die(mysqli_error($connect));
                    for ($datach = []; $row = mysqli_fetch_assoc($ress); $datach[] = $row);
                    foreach($datach as $char) {
                        ?>
                        <div class="box2">
                            <p class="scoc"><?= $char["Class"] ?></p>
                            <p style="color: #3d3230"><?= $char["replica"] ?>
                                <p>— <?= $char["Class"] ?></p>
                                <a href="<?= $char["sound"] ?>" class="ssilka">нажмите сюда, чтобы прослушать</a> 
                            </p>
                            <br>
                        
                        <?
                        $query = "SELECT * FROM weapon WHERE Class_ID =".$char["ID"];
                        $res = mysqli_query($connect, $query) or die(mysqli_error($connect));
                        for ($data = []; $row = mysqli_fetch_assoc($res); $data[] = $row);
                        foreach ($data as $v) {
                ?>          
                        <p>
                            <p class="ss"><?= $v["Name"] ?></p> <?= $v["Description"] ?>
                        </p>
                        <img src="<?= $v["Picture"] ?>" class="image">

                        <div id="elem"></div>
                        <br>
                        <? } ?>
                        </div>
                    <? } ?>

                    
    </div>
    <div class="btn-up btn-up_hide"></div>
    <script>
        const btnUp = {
  el: document.querySelector('.btn-up'),
  scrolling: false,
  show() {
    if (this.el.classList.contains('btn-up_hide') && !this.el.classList.contains('btn-up_hiding')) {
      this.el.classList.remove('btn-up_hide');
      this.el.classList.add('btn-up_hiding');
      window.setTimeout(() => {
        this.el.classList.remove('btn-up_hiding');
      }, 300);
    }
  },
  hide() {
    if (!this.el.classList.contains('btn-up_hide') && !this.el.classList.contains('btn-up_hiding')) {
      this.el.classList.add('btn-up_hiding');
      window.setTimeout(() => {
        this.el.classList.add('btn-up_hide');
        this.el.classList.remove('btn-up_hiding');
      }, 300);
    }
  },
  addEventListener() {
    // при прокрутке окна (window)
    window.addEventListener('scroll', () => {
      const scrollY = window.scrollY || document.documentElement.scrollTop;
      if (this.scrolling && scrollY > 0) {
        return;
      }
      this.scrolling = false;
      // если пользователь прокрутил страницу более чем на 200px
      if (scrollY > 400) {
        // сделаем кнопку .btn-up видимой
        this.show();
      } else {
        // иначе скроем кнопку .btn-up
        this.hide();
      }
    });
    // при нажатии на кнопку .btn-up
    document.querySelector('.btn-up').onclick = () => {
      this.scrolling = true;
      this.hide();
      // переместиться в верхнюю часть страницы
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
      });
    }
  }
}

btnUp.addEventListener();
    </script>
</body>
</php>