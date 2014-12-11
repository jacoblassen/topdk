<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>XML</title>
  <link rel="stylesheet" href="stylesheet.css" />
</head>
  <body>
    <div id="master">
      <h1>XML</h1>
      <form action="#" method="POST" id="form">
        <div>
          <label for="name">Navn</label>
          <input type="text" name="name" id="name" />
        </div>
        <div>
          <label for="cpr">CPR-/kundenummer</label>
          <input type="text" name="cpr" id="cpr" />
        </div>
        <div>
          <label for="email">E-mail</label>
          <input type="text" name="email" id="email" />
        </div>
        <div>
          <label for="tlf">Telefon</label>
          <input type="text" name="tlf" id="tlf" />
        </div>
        <div>
          <label for="tlfTime">Bedste træffetid</label>
          <input type="text" name="tlfTime" id="tlfTime" />
        </div>
        <div>
          <label for="accidentDate">Dato for ulykke</label>
          <input type="text" name="accidentDate" id="accidentDate" />
        </div>
        <div>
          <label for="where">Hvor</label>
          <textarea name="where" rows="8" cols="40" form="form"></textarea>
        </div>
        <div>
          <label for="how">Hvordan</label>
          <textarea name="how" rows="8" cols="40" form="form"></textarea>
        </div>
        <div>
          <label for="injured">Antal tilskadekomne</label>
          <input type="text" name="injured" id="injured" />
        </div>
        <div>
          <input type="hidden" name="flowType" value="XML" />
        </div>
        <div>
          <input type="submit">
        </div>
      </form>
    </div>
  </body>
</html>
