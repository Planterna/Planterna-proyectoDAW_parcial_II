document.addEventListener('DOMContentLoaded', () => {
  const marcaSelect = document.getElementById('marca');
  const modeloSelect = document.getElementById('modelo');

  function cargarModelos(idMarca, modeloSeleccionado = null) {
    if (!idMarca) {
      modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
      modeloSelect.disabled = true;
      return;
    }
    modeloSelect.innerHTML = '<option disabled>Cargando modelos...</option>';
    modeloSelect.disabled = true;

    fetch(`index.php?c=modelo&f=getModel&idMarca=${idMarca}`)
      .then(res => res.json())
      .then(modelos => {
        modeloSelect.innerHTML = '<option value="">Seleccione un modelo</option>';
        modelos.forEach(m => {
          const option = document.createElement('option');
          option.value = m.mod_id;
          option.textContent = m.mod_nombre;
          if (modeloSeleccionado && m.mod_id == modeloSeleccionado) {
            option.selected = true;
          }
          modeloSelect.appendChild(option);
        });
        modeloSelect.disabled = false;
      })
      .catch(() => {
        modeloSelect.innerHTML = '<option disabled>Error al cargar modelos</option>';
      });
  }

  if (marcaSelect) {
    marcaSelect.addEventListener('change', () => {
      cargarModelos(marcaSelect.value);
    });

    const modeloSeleccionado = modeloSelect.dataset.selected || null;
    if (marcaSelect.value) {
      cargarModelos(marcaSelect.value, modeloSeleccionado);
    }
  }
});


