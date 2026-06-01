<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $messages = array();

  if (!empty($_COOKIE['save'])) {

    print('Результаты сохранены');
    setcookie('save','',100000);
    $messages[] = 'Спасибо, результаты сохранены.';

  }

  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['phone'] = !empty($_COOKIE['phone_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['birthdate'] = !empty($_COOKIE['birthdate_error']);
  $errors['sex'] = !empty($_COOKIE['sex_error']);
  $errors['languages'] = !empty($_COOKIE['languages_error']);
  $errors['contract'] = !empty($_COOKIE['contract_error']);

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    setcookie('name_value', '', 100000);
    $messages[] = '<div class="error">Введите корректное имя</div>';
  }

  if($errors['phone'])
  {
    setcookie('phone_error', '', 100000);
    setcookie('phone_value', '', 100000);
    $messages[] = '<div class="error">Введите корректный номер</div>';
  }

    if($errors['email'])
  {
    setcookie('email_error', '', 100000);
    setcookie('email_value', '', 100000);
    $messages[] = '<div class="error">Введите корректную почту</div>';
  }

    if($errors['birthdate'])
  {
    setcookie('birthdate_error', '', 100000);
    setcookie('birthdate_value', '', 100000);
    $messages[] = '<div class="error">Введите корректную дату</div>';
  }

    if($errors['sex'])
  {
    setcookie('sex_error', '', 100000);
    setcookie('sex_value', '', 100000);
    $messages[] = '<div class="error">Выберите корректный пол</div>';
  }

  if($errors['languages'])
  {
    setcookie('languages_error', '', 100000);
    setcookie('languages_value', '', 100000);
    $messages[] = '<div class="error">Выберите корректные языки</div>';
  }

  if($errors['contract'])
  {
    setcookie('contract_error', '', 100000);
    setcookie('contract_value', '', 100000);
    $messages[] = '<div class="error">Ознакомьтесь с условиями</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['phone'] = empty($_COOKIE['phone_value']) ? '' : $_COOKIE['phone_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['birthdate'] = empty($_COOKIE['birthdate_value']) ? '' : $_COOKIE['birthdate_value'];
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' : $_COOKIE['sex_value'];
  $values['languages'] = empty($_COOKIE['languages_value']) ? '' : $_COOKIE['languages_value'];
  $values['contract'] = empty($_COOKIE['contract_value']) ? '' : $_COOKIE['contract_value'];

  include('form.php');
}


else
{

$errors = FALSE;

if (empty($_POST['name'])) {
  $errors = TRUE;
  setcookie('name_error', '1', time() + 24 * 60 * 60);
} elseif (strlen($_POST['name']) > 150) {
  $errors = TRUE;
  setcookie('name_error', '1', time() + 24 * 60 * 60);
} elseif (!preg_match('/^[a-zA-Zа-яА-ЯёЁ\s]+$/u', $_POST['name'])) {
  $errors = TRUE;
  setcookie('name_error', '1', time() + 24 * 60 * 60);
}

if (!empty($_POST['phone']) && !preg_match('/^[\+0-9\s\-\(\)]{10,20}$/', $_POST['phone'])) {
  $errors = TRUE;
  setcookie('phone_error', '1', time() + 24 * 60 * 60);
}

if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $errors = TRUE;
  setcookie('email_error', '1', time() + 24 * 60 * 60);
}

if (!empty($_POST['birthdate'])) {
  $date = DateTime::createFromFormat('Y-m-d', $_POST['birthdate']);
  if (!$date || $date->format('Y-m-d') !== $_POST['birthdate']) {
    $errors = TRUE;
    setcookie('birthdate_error', '1', time() + 24 * 60 * 60);
  }
}

$allowed_genders = ['male', 'female'];
if (empty($_POST['gender'])) {
  $errors = TRUE;
  setcookie('sex_error', '1', time() + 24 * 60 * 60);
} elseif (!in_array($_POST['sex'], $allowed_genders)) {
  $errors = TRUE;
  setcookie('sex_error', '1', time() + 24 * 60 * 60);
}

$allowed_languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
if (empty($_POST['languages'])) {
  $errors = TRUE;
  setcookie('languages_error', '1', time() + 24 * 60 * 60);
} else {
  foreach ($_POST['languages'] as $lang) {
    if (!in_array($lang, $allowed_languages)) {
      $errors = TRUE;
      setcookie('languages_error', '1', time() + 24 * 60 * 60);
      break;
    }
  }
}

if (empty($_POST['contract']) || $_POST['contract'] != '1') {
  $errors = TRUE;
  setcookie('contract_error', '1', time() + 24 * 60 * 60);
}

if ($errors) {

    header('Location: index.php');
    exit();
  }

else{
    setcookie('name_error', '', 100000);
    setcookie('phone_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('birthdate_error', '', 100000);
    setcookie('sex_error', '', 100000);
    setcookie('languages_error', '', 100000);
}

$user = 'u82197';
$pass = '6410666';
$db = new PDO('mysql:host=localhost;dbname=u82197', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

try {
  $db->beginTransaction();
  
  $stmt = $db->prepare("INSERT INTO users (name, phone, email, birthdate, sex, biography) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->execute([
    $_POST['name'],
    $_POST['phone'] ?? null,
    $_POST['email'] ?? null,
    $_POST['birthdate'] ?? null,
    $_POST['sexr'],
    $_POST['biography'] ?? null
  ]);
  
  $user_id = $db->lastInsertId();
  
  $lang_stmt = $db->prepare("INSERT INTO user_languages (user_id, language) VALUES (?, ?)");
  foreach ($_POST['languages'] as $lang) {
    $lang_stmt->execute([$user_id, $lang]);
  }
  
  $db->commit();
  
} catch(PDOException $e){
  $db->rollBack();
  print('Error : ' . $e->getMessage());
  exit();
}

setcookie('save','1');

header('Location: index.php');
}
