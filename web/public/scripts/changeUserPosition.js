const changeUserPosition = async () => {
  removeErrorContainer();

  const positionId = document.getElementById('position').value;
  const searchParams = new URLSearchParams(window.location.search);
  const id = searchParams.get('id');

  const response = await fetch('/ajax_handlers/changeUserPosition.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `positionId=${positionId}&id=${id}`
  });

  const { status } = await response.json();

  console.log(status);

  switch (status) {
    case 'success':
      document.location.href = '/admin.php';
      break;
    default:
      break;
  }
};
