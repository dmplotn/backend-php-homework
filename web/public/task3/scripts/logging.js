const logProperties = async () => {
  clearMessageContainers();

  const workerType = document.getElementById('workerType').value;
  const properties = Array
    .from(document.getElementsByTagName('input'))
    .map(({ id, value }) => [id, value]);
  const paramString = buildParamString(workerType, properties);
  
  const response = await fetch(`/task3/ajax_handlers/logWorkerProperties.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: paramString
  });

  const { status, message } = await response.json();
  
  if (status === 'success') {
    clearPropertyInputs();
  }

  displayMessage(status, message);
};

const buildParamString = (workerType, properties) => {
  const propertiesPart = properties
    .map(([id, value]) => `properties[${id}]=${value}`)
    .join('&');
  return `workerType=${workerType}&${propertiesPart}`;
};
