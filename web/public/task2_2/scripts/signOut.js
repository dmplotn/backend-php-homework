const signOut = () => {
  fetch('/task2_2/ajax_handlers/signOut.php', { method: 'POST' });
  document.location.href = '/task2_2/index.php';
};
