const getParams = () => {
  const loginFilter = document.getElementById('login-filter').value;
  const positionFilter = document.getElementById('position-filter').value;
  const departmentFilter = document.getElementById('department-filter').value;
  const sort = document.querySelector('input[name=sort]:checked').value;

  return { loginFilter, positionFilter, departmentFilter, sort };
};

const getUserData = async (pageNumber) => {
  const params = getParams();

  const path = '/ajax_handlers/getUserData.php';
  const queryString = `?login=${params.loginFilter}&position=${params.positionFilter}&department=${params.departmentFilter}&page=${pageNumber}&sort=${params.sort}`;
  const url = `${path}${queryString}`;
  const response = await fetch(url, {
    method: 'GET'
  })

  return await response.json();
};

const displayUsersTable = async (pageNumber = 1) => {
  const { userData, pagesCount } = await getUserData(pageNumber);
  displayTableBody(userData);
  displayPagination(pagesCount, pageNumber);
};

const displayPagination = (pagesCount, currentPageNumber) => {
  const pagination = document.getElementById('pagination');
  pagination.innerHTML = '';

  const paginationItems = Array.from({ length: pagesCount}, (_, num) => {
    const pageNumber = num + 1;

    const li = document.createElement('li');
    li.classList.add('page-item');

    if (pageNumber === currentPageNumber) {
      li.classList.add('active');
    }

    const link = document.createElement('a');
    link.classList.add('page-link');
    link.textContent = pageNumber;
    link.onclick = () => displayUsersTable(pageNumber);

    li.append(link);
    
    return li;
  });

  pagination.append(...paginationItems);
};

const displayTableBody = (userData) => {
  const usersTableBody = document.getElementById('users-tbody');
  usersTableBody.innerHTML = '';

  const rows = userData.map((user) => {
    const row = document.createElement('tr');

    const idCell = document.createElement('th');
    idCell.scope = 'row';
    idCell.textContent = user.id;

    const loginCell = document.createElement('td');
    loginCell.textContent = user.login;

    const positionCell = document.createElement('td');
    positionCell.textContent = user.position;

    const departmentCell = document.createElement('td');
    departmentCell.textContent = user.department;

    const editCell = document.createElement('td');
    const link = document.createElement('a');
    link.href = `/userSettings.php?id=${user.id}`;
    link.textContent = 'Редактировать'
    editCell.append(link);

    const deleteCell = document.createElement('td');
    const button = document.createElement('button');
    button.type = 'button';
    button.classList.add('btn', 'btn-primary');
    button.setAttribute('data-bs-toggle', 'modal');
    button.setAttribute('data-bs-target', '#exampleModal');
    button.setAttribute('data-user-id', `${user.id}`);
    button.textContent = 'Удалить';
    button.onclick = () => {
      const deleteConfirmationButton = document.getElementById('delete-confirmation-button');
      const handler = () => {
        deleteUser(user.id);
        deleteConfirmationButton.removeEventListener('click', handler);
      }
      deleteConfirmationButton.addEventListener('click', handler);
    }
    deleteCell.append(button);    

    row.append(idCell, loginCell, positionCell, departmentCell, editCell, deleteCell);

    return row;
  });

  usersTableBody.append(...rows);
};
