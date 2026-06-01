<html>

<head>

<style>

.error {
  border: 2px solid red;
}

</style>

</head>

<body>

<?php

if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

?>

<form action="" method="POST">
  <label>ФИО:</label>
  <input type="text" name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required /><br/>
  <label>Телефон:</label>
  <input type="tel" name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" /><br/>
  <label>E-mail:</label>
  <input type="email" name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" /><br/>
  <label>Дата рождения:</label>
  <input type="date" name="birthdate" <?php if ($errors['birthdate']) {print 'class="error"';} ?> value="<?php echo isset($_POST['birthdate']) ? htmlspecialchars($_POST['birthdate']) : ''; ?>" /><br/>
  <label>Пол:</label>
  <input type="radio" name="sex" <?php if ($errors['sex']) {print 'class="error"';} ?> value="male" <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'male') ? 'checked' : ''; ?> /> Мужской
  <input type="radio" name="sex" <?php if ($errors['sex']) {print 'class="error"';} ?> value="female" <?php echo (isset($_POST['sex']) && $_POST['sex'] == 'female') ? 'checked' : ''; ?> /> Женский<br/>
  <label>Любимый язык программирования:</label><br/>
  <?php
  if ($errors['languages']) {print 'class="error"';}
  $languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
  $selected_langs = isset($_POST['languages']) ? $_POST['languages'] : [];
  foreach ($languages as $lang) {
    $checked = in_array($lang, $selected_langs) ? 'checked' : '';
    echo "<input type='checkbox' name='languages[]' value='" . htmlspecialchars($lang) . "' $checked /> $lang<br/>";
  }
  ?>
  <label>Биография:</label><br/>
  <textarea name="biography" rows="5" cols="40"><?php echo isset($_POST['biography']) ? htmlspecialchars($_POST['biography']) : ''; ?></textarea><br/>
  <label>
    <input type="checkbox" name="contract" <?php if ($errors['contract']) {print 'class="error"';} ?> value="1" <?php echo (isset($_POST['contract']) && $_POST['contract'] == '1') ? 'checked' : ''; ?> />
    Ознакомлен
  </label><br/>
  
  <input type="submit" value="Сохранить" />

</form>

</body>

</html>
