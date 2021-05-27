const deleteUser = (id) => {
  fetch('/ajax_handlers/deleteUser.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `id=${id}` 
  });
  document.location.href = '/admin.php';
};
