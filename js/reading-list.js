document.addEventListener('DOMContentLoaded', () => {
  const bookInput = document.getElementById('bookInput');
  const bookPriority = document.getElementById('bookPriority');
  const addBookBtn = document.getElementById('addBookBtn');
  const bookList = document.getElementById('bookList');
  const filterButtons = document.querySelectorAll('.filter-btn');

  let books = JSON.parse(localStorage.getItem('readingList')) || [];

  // Загрузка списка
  function loadBooks() {
    bookList.innerHTML = '';
    const filter = document.querySelector('.filter-btn.active').dataset.filter;
    const filteredBooks = filter === 'all' ? books : books.filter(book => book.priority === filter);

    filteredBooks.forEach((book, index) => {
      const bookItem = document.createElement('div');
      bookItem.className = `book-item ${book.priority} ${book.completed ? 'completed' : ''}`;
      bookItem.innerHTML = `
        <input 
          type="checkbox" 
          class="book-checkbox" 
          data-index="${index}" 
          ${book.completed ? 'checked' : ''}
        >
        <div class="book-title">${book.title}</div>
        <div class="book-priority">${getPriorityLabel(book.priority)}</div>
        <button class="delete-btn" data-index="${index}">❌</button>
      `;
      bookList.appendChild(bookItem);
    });
  }

  // Метки приоритетов
  function getPriorityLabel(priority) {
    const labels = {
      high: '🔴 Высокий',
      medium: '🟡 Средний',
      low: '🟢 Низкий'
    };
    return labels[priority];
  }

  // Добавление книги
  addBookBtn.addEventListener('click', () => {
    const title = bookInput.value.trim();
    const priority = bookPriority.value;

    if (title) {
      books.push({ title, priority, completed: false });
      saveBooks();
      bookInput.value = '';
      loadBooks();
    }
  });

  // Отметка прочитанной/непрочитанной
  bookList.addEventListener('change', (e) => {
    if (e.target.classList.contains('book-checkbox')) {
      const index = e.target.dataset.index;
      books[index].completed = e.target.checked;
      saveBooks();
      loadBooks();
    }
  });

  // Удаление книги
  bookList.addEventListener('click', (e) => {
    if (e.target.classList.contains('delete-btn')) {
      const index = e.target.dataset.index;
      books.splice(index, 1);
      saveBooks();
      loadBooks();
    }
  });

  // Фильтрация
  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      filterButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      loadBooks();
    });
  });

  // Сохранение в localStorage
  function saveBooks() {
    localStorage.setItem('readingList', JSON.stringify(books));
  }

  // Первая загрузка
  loadBooks();
});