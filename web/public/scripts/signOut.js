const signOut = () => {
  fetch('/ajax_handlers/signOut.php', { method: 'POST' });
  document.location.href = '/index.php';
};
