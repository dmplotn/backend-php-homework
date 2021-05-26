const removeErrorContainer = () => {
  const container = document.getElementById('errorContainer');
  if (container) {
    container.remove();
  }
}

const displayErrorContainer = (errors) => {
  const ul = document.createElement('ul');
  ul.className = 'list-group mb-5';
  ul.id = 'errorContainer';
  const listItems = errors.map((error) => {
    const li = document.createElement("li");
    li.className = 'list-group-item list-group-item-danger';
    li.textContent = error;
    return li;
  });
  ul.append(...listItems);

  const target = document.getElementById('displayErrorsTarget');
  target.after(ul);
};
