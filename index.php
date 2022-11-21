<!DOCTYPE html>
<html lang="cs-cz">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Pojištění" />
  <meta name="keywords" content="pojištění, pojištěnci, evidence, registrace" />
  <meta name="author" content="Ondrej Brumar" />
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>


<header>

  <nav>
    <ul>
      <li class="aktivni"><a href="index.html">Pojištěnci</a></li>
      <li><a href="appinfo.html">O aplikaci</a></li>
    </ul>
  </nav>
</header>

<body>
  <div id="centrovac">
        <?php
        require_once('Db.php');
        Db::connect('localhost', 'databaze_pojistenci', 'root', '');
        if ($_POST)
        {
            $datum = date("Y-m-d H:i:s", strtotime($_POST['dat_narozeni']));
            Db::query('INSERT INTO pojistenci (jmeno, prijmeni, dat_narozeni, tel_cislo) 
                       VALUES (?, ?, ?, ?)
                       ', $_POST['jmeno'], $_POST['prijmeni'], $datum, $_POST['tel_cislo']);

            echo "<p class='potvrzeni'>Byl jste úspěšně zaregistrován</p>";}

      $pojistenci = Db::queryAll('
      SELECT *
      FROM pojistenci
      ');
      echo('<h2 id="centrovac">Pojištěnci</h2><table border="1">');
          foreach ($pojistenci as $u)
          {
          echo('<tr><td>' . htmlspecialchars($u['jmeno']));
                  echo('</td><td>' . htmlspecialchars($u['prijmeni']));
                  $datum = date("d.m.Y", strtotime($u['dat_narozeni']));
                  echo('</td><td>' . htmlspecialchars($datum));
                  echo('</td><td>' . htmlspecialchars($u['tel_cislo']));
                  echo('</td></tr>');
          }
          echo('</table>');

?>
      <h1>Registrace pojištěnce</h1>

      <form method="post">
        <table>
          <tr>
            <td>
              <label for="jmeno">Jméno</label><br />
              <input type="text" name="jmeno" /><br />
            </td>
            <td>
              <label for="prijmeni">Příjmení</label><br />
              <input type="text" name="prijmeni" /><br />
            </td>
          </tr>
          <tr>
            <td>
                <label for="dat_narozeni">Datum narození</label><br />
                <input type="text" name="dat_narozeni" /><br />
            </td>
            <td>
              <label for="tel_cislo">Telefonní číslo</label><br />
              <input type="text" name="tel_cislo" /><br />
            </td>
          </tr>

        </table>
          <input type="submit" value="Registrovat" />

  </form>
  </div>
</body>
<footer>
  <a>Vytvořil Ondra Brumar 2022 pro závěrečnou zkoušku rekvalifikačního kurzu na <a href="https://itnetwork.cz">itnetwork.cz</a>
</footer>
</html>