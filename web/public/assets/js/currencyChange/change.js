const getCurrentRatesData = () => {
  return JSON.parse(document.getElementById('current-rates-data').dataset.currentRatesData);
};

const sell = (value, rate) => {
  return value * rate;
}

const buy = (value, rate) => {
  return value / rate;
};

const format = (value) => {
  const formatter = new Intl.NumberFormat('ru-RU', {
    minimumFractionDigits: 2, maximumFractionDigits: 2 
  });
  return formatter.format(value).replace(',', '.');
};

const render = (state) => {
  const changeResult = document.getElementById('change-result');
  const changeValueInput = document.getElementById('change-value-input');
  const changeValueIso = document.getElementById('change-value-iso');

  changeValueIso.textContent = state.changeValueIso;

  changeResult.textContent = '';

  if (state.afterSelect) {
    changeValueInput.value = '';
  }
  
  if (!state.changeValueInputValid) {
    changeValueInput.classList.add('is-invalid');
  } else {
    changeValueInput.classList.remove('is-invalid');

    if (state.value !== null) {
      const result = state.operation(state.value, state.rateData.currencyRate);
      const formattedResult = format(result);
      const currencyIso = state.operationType === 'sell' ? 'RUB' : state.rateData.currencyIso;
      changeResult.textContent = `Вы получите: ${formattedResult} ${currencyIso}`; 
    }
  }
}

const validateChangeValueInput = (rawValue) => {
  const pattern = /^[0-9]+(\.[0-9]{1,2})?$/;
  
  if (!rawValue.match(pattern)) {
    return false;
  }

  const value = parseFloat(rawValue);
  return value > 0 && value <= 1000000;
};

const change = () => {
  const currentRatesData = getCurrentRatesData();

  const operationSelect = document.getElementById('operation');
  const operationType = operationSelect[operationSelect.selectedIndex].value;
  const operation = (operationType === 'sell') ? sell : buy;
  
  const currencySelect = document.getElementById('currency');
  const currencyId = parseInt(currencySelect[currencySelect.selectedIndex].value, 10);
  const rateData = currentRatesData.find((item) => item.currencyId === currencyId);

  const changeValueInput = document.getElementById('change-value-input');
  const changeValueIso = operationType === 'sell' ? rateData.currencyIso : 'RUB';

  const state = {
    value: null,
    rateData,
    operationType,
    operation,
    changeValueIso,
    changeValueInputValid: true,
    afterSelect: true,
  };

  changeValueInput.addEventListener('keyup', (e) => {
    const rawValue = changeValueInput.value;
    
    if (validateChangeValueInput(rawValue) || rawValue === '') {
      state.changeValueInputValid = true;
      state.value = rawValue === '' ? null : parseFloat(rawValue);
    } else {
      state.changeValueInputValid = false;
    }

    state.afterSelect = false;

    render(state);
  });

  operationSelect.addEventListener('change', (e) => {
    const currencyId = parseInt(currencySelect[currencySelect.selectedIndex].value, 10);
    const rateData = currentRatesData.find((item) => item.currencyId === currencyId);
    const operationType = operationSelect[operationSelect.selectedIndex].value;
    const operation = operationType === 'sell' ? sell : buy;
    const changeValueIso = operationType === 'sell' ? rateData.currencyIso : 'RUB';

    state.value = null;
    state.changeValueInputValid = true;
    state.changeValueIso = changeValueIso;
    state.operationType = operationType;
    state.operation = operation;
    state.afterSelect = true;

    console.log(state);

    render(state);
  });

  currencySelect.addEventListener('change', (e) => {
    const currencyId = parseInt(currencySelect[currencySelect.selectedIndex].value, 10);
    const rateData = currentRatesData.find((item) => item.currencyId === currencyId);
    const changeValueIso = state.operationType === 'sell' ? rateData.currencyIso : 'RUB';

    state.value = null;
    state.changeValueIso = changeValueIso;
    state.changeValueInputValid = true;
    state.rateData = rateData;
    state.afterSelect = true;

    render(state);
  });

  render(state);
};

change();
