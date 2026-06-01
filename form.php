<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета программиста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Анкета программиста</h1>
        <p>Заполните форму, чтобы стать частью нашего сообщества</p>
    </div>
    
    <div class="form-content">
        <?php
        if (!empty($messages)) {
            print('<div id="messages">');
            foreach ($messages as $message) {
                print($message);
            }
            print('</div>');
        }
        ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label>ФИО <span class="required">*</span></label>
                <input type="text" name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php echo isset($values['name']) ? htmlspecialchars($values['name']) : ''; ?>" required />
            </div>
            
            <div class="form-group">
                <label>Телефон</label>
                <input type="tel" name="phone" <?php if ($errors['phone']) {print 'class="error"';} ?> value="<?php echo isset($values['phone']) ? htmlspecialchars($values['phone']) : ''; ?>" />
            </div>
            
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php echo isset($values['email']) ? htmlspecialchars($values['email']) : ''; ?>" />
            </div>
            
            <div class="form-group">
                <label>Дата рождения</label>
                <input type="date" name="birthdate" <?php if ($errors['birthdate']) {print 'class="error"';} ?> value="<?php echo isset($values['birthdate']) ? htmlspecialchars($values['birthdate']) : ''; ?>" />
            </div>
            
            <div class="form-group">
                <label>⚧ Пол <span class="required">*</span></label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="sex" value="male" <?php echo (isset($values['sex']) && $values['sex'] == 'male') ? 'checked' : ''; ?> />
                        Мужской
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="sex" value="female" <?php echo (isset($values['sex']) && $values['sex'] == 'female') ? 'checked' : ''; ?> />
                        Женский
                    </label>
                </div>
                <?php if ($errors['sex']): ?>
                    <div class="error-message" style="color:#e74c3c; font-size:12px; margin-top:5px;">Выберите пол</div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label>💻 Любимые языки программирования <span class="required">*</span></label>
                <div class="checkbox-group <?php if ($errors['languages']) echo 'error'; ?>">
                    <?php
                    $languages = ['Pascal', 'C', 'C++', 'JavaScript', 'PHP', 'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 'Scala', 'Go'];
                    $selected_langs = isset($values['languages']) && !empty($values['languages']) ? explode('|', $values['languages']) : [];
                    foreach ($languages as $lang) {
                        $checked = in_array($lang, $selected_langs) ? 'checked' : '';
                        echo "<label class='checkbox-label'><input type='checkbox' name='languages[]' value='" . htmlspecialchars($lang) . "' $checked /> " . htmlspecialchars($lang) . "</label>";
                    }
                    ?>
                </div>
            </div>
            
            <div class="form-group">
                <label>📖 Биография</label>
                <textarea name="biography" rows="5"><?php echo isset($_POST['biography']) ? htmlspecialchars($_POST['biography']) : ''; ?></textarea>
            </div>
            
            <div class="contract-group">
                <label class="contract-label">
                    <input type="checkbox" name="contract" value="1" <?php echo (isset($values['contract']) && $values['contract'] == '1') ? 'checked' : ''; ?> />
                    Я ознакомлен(а) с условиями контракта и соглашаюсь с ними <span class="required">*</span>
                </label>
            </div>
            
            <button type="submit" class="btn-submit">Сохранить анкету</button>
        </form>
    </div>
</div>
</body>
</html>
