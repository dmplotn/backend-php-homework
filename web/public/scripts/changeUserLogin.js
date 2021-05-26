const changeUserLogin = async () => {
  removeErrorContainer();

  const newLogin = document.getElementById('newLogin').value;
  const searchParams = new URLSearchParams(window.location.search);
  const id = searchParams.get('id');

  const response = await fetch('/ajax_handlers/changeUserLogin.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `newLogin=${newLogin}&id=${id}`
  });

  const { status, errors = [] } = await response.json();

  switch (status) {
    case 'success':
      document.location.href = '/index.php';
      break;
    case 'error':
    default:
      displayErrorContainer(errors);
      break;
  }
};
