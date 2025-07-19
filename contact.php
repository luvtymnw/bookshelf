<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Контакты</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
  <header>
    <h1>Связаться со мной</h1>
    <nav>
      <a href="index.php">Главная</a>
      <a href="genres.php">Жанры</a>
      <a href="favorites.php">Избранное</a>
      <a href="contact.php" class="active">Контакты</a>
      <a href="reading-list.php">Список для чтения</a>
    </nav>
  </header>

  <main>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      <div class="alert success">
        Ваше сообщение успешно отправлено!
      </div>
    <?php endif; ?>

    <h2>Напишите мне:</h2>
    <form action="process_form.php" method="post">
      <label>Имя: 
        <input type="text" name="name" required />
      </label>
      
      <label>Email: 
        <input type="email" name="email" required />
      </label>
      
      <label>Сообщение:
        <textarea rows="6" name="message" required></textarea>
      </label>
      
      <button type="submit">Отправить</button>
    </form>

    <div class="contact-info">
      <h3>Другие способы связи:</h3>
      <p>Email: <a href="mailto:luvtymnw@gmail.com">luvtymnw@gmail.com</a></p>
      <p>Телефон: +7 (925) 102-72-78</p>
      <p>Социальные сети: 
        <a href="">ВКонтакте</a> | 
        <a href="https://t/me/luvtymnw">Telegram</a>
      </p>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Моя книжная полка</p>
  </footer>
</body>
</html>