const changeUserDepartment = async () => {
  removeErrorContainer();

  const departmentId = document.getElementById('department').value;
  const searchParams = new URLSearchParams(window.location.search);
  const id = searchParams.get('id');

  const response = await fetch('/ajax_handlers/changeUserDepartment.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `departmentId=${departmentId}&id=${id}`
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
