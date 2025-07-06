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


document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formulario-crear') || document.getElementById('formulario-editar');
  if (!form) return;

  const campos = {
    nombre: document.getElementById('nombre'),
    descripcion: document.getElementById('descripcion'),
    precio: document.getElementById('precio'),
    stock: document.getElementById('stock'),
    marca: document.getElementById('marca'),
    modelo: document.getElementById('modelo'),
    tipoRepuesto: form.elements['tipoRepuesto'],
    estado: document.getElementById('estado'),
    imagen: document.getElementById('imagen')
  };

  function limpiar(texto) {
    return texto.trim().replace(/</g, "&lt;").replace(/>/g, "&gt;");
  }

  function mostrarError(campo, mensaje) {
    const errorEl = document.getElementById(`error-${campo}`);
    if (errorEl) {
      errorEl.textContent = mensaje;
    }
  }

  form.addEventListener('submit', (e) => {
    let valido = true;

    Object.keys(campos).forEach(campo => {
      const errorEl = document.getElementById(`error-${campo}`);
      if (errorEl) errorEl.textContent = '';
    });

    const nombre = limpiar(campos.nombre.value);
    if (!nombre || nombre.length < 3) {
      mostrarError('nombre', 'El nombre debe tener al menos 3 caracteres.');
      valido = false;
    }

    const descripcion = limpiar(campos.descripcion.value);
    if (!descripcion || descripcion.length < 3) {
      mostrarError('descripcion', 'La descripción debe tener al menos 3 caracteres.');
      valido = false;
    }

    const precio = limpiar(campos.precio.value);
    if (!precio || isNaN(precio) || Number(precio) <= 0) {
      mostrarError('precio', 'El precio debe ser un número válido mayor a 0.');
      valido = false;
    }

    const stock = limpiar(campos.stock.value);
    if (!stock || isNaN(stock) || Number(stock) < 0) {
      mostrarError('stock', 'El stock debe ser un número válido igual o mayor a 0.');
      valido = false;
    }

    if (!campos.marca.value.trim()) {
      mostrarError('marca', 'Debe seleccionar una marca.');
      valido = false;
    }

    if (!campos.modelo.value.trim()) {
      mostrarError('modelo', 'Debe seleccionar un modelo.');
      valido = false;
    }

    const tipoSeleccionado = Array.from(campos.tipoRepuesto).some(r => r.checked);
    if (!tipoSeleccionado) {
      mostrarError('tipoRepuesto', 'Debe seleccionar un tipo de repuesto.');
      valido = false;
    }

    if (!valido) {
      e.preventDefault(); 
    }
  });
});