<?php
session_start();
if (!isset($_SESSION['nombre_completo'])) {
  echo '
		<script> 
		alert("Por favor, debes iniciar sesión para acceder a esta página");
		 window.location = "../static/pages-sign-in.php";
		</script>
		';
  session_destroy();
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5" />
  <meta name="author" content="AdminKit" />
  <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="shortcut icon" href="/static/assets/Iconos/logo.png" />
  <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />
  <title>Edición Agenda de Dividendos</title>
  <link href="css/app.css" rel="stylesheet" />
  <link href="css/estilos.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="pages-admin.php">
          <span class="align-middle">+Dividendos</span>
        </a>
        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a class="sidebar-link" href="pages-admin.php">
              <i class="align-middle" data-feather="book"></i>
              <span class="align-middle">Edición Agenda Dividendos</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="main">
      <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
          <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown">
              <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

              <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">

                <span class="text-dark">Bienvenido, <?php echo $_SESSION['nombre_completo']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end">

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/static/php/cerrar_sesion.php">Cerrar sesión</a>
              </div>
            </li>
          </ul>
          <button class="switch" id="switch">
            <span><i class='bx bxs-moon'></i></span>
            <span><i class='bx bx-moon'></i></span>
          </button>
        </div>
      </nav>

      <main class="content">
        <div class="container-fluid p-0">
          <h1 class="h3 mb-3">Agenda de Dividendos</h1>
          <div class="calendar">
            <div class="calendar-header">
              <button onclick="prevMonth()">Anterior</button>
              <h2 id="calendar-title"></h2>
              <button onclick="nextMonth()">Siguiente</button>
              <div class="add-event" onclick="showModal(null)">+</div>
            </div>
            <div class="calendar-grid" id="calendar-grid"></div>
          </div>

          <div id="event-modal" class="modal">
            <div class="modal-content">
              <div class="content-title">
                <h2 id="event-title"></h2>
                <span class="close" onclick="closeModal()">&times;</span>
              </div>
              <div class="content-modal">
                <form id="event-form">
                  <label for="event-empresa">Empresa:</label>
                  <select id="event-empresa" name="event-empresa"></select>
                  <label for="event-ticker">Ticker:</label>
                  <input id="event-ticker" name="event-ticker" type="text">
                  <label for="event-costo">Monto:</label>
                  <input id="event-costo" name="event-costo" type="text">
                  <label for="event-comentario">Comentario:</label>
                  <input id="event-comentario" name="event-comentario" type="text">
                  <label for="event-date">Fecha Pago:</label>
                  <input id="event-date" name="event-date" type="date">
                  <label for="event-ex-derecho">Fecha Ex-Derecho:</label>
                  <input id="event-ex-derecho" name="event-ex-derecho" type="date">
                  <label for="event-aviso">Link Aviso:</label>
                  <input id="event-aviso" name="event-aviso" type="text">
                  <div class="button-content">
                    <button type="button" class="act-event" onclick="saveEvent()">Guardar</button>
                    <button type="button" class="del-event" onclick="deleteEvent()">Eliminar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <script>
            const calendarGrid = document.getElementById("calendar-grid");
            const calendarTitle = document.getElementById("calendar-title");
            const eventModal = document.getElementById("event-modal");
            const eventTitle = document.getElementById("event-title");
            const eventEmpresa = document.getElementById("event-empresa");
            const eventTicker = document.getElementById("event-ticker");
            const eventCosto = document.getElementById("event-costo");
            const eventComentario = document.getElementById("event-comentario");
            const eventDate = document.getElementById("event-date");
            const eventExDerecho = document.getElementById("event-ex-derecho");
            const eventAviso = document.getElementById("event-aviso");

            const daysOfWeek = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];
            let currentDate = new Date();
            let currentEvent = null;

            function formatDate(date) {
              const year = date.getFullYear();
              const month = String(date.getMonth() + 1).padStart(2, '0');
              const day = String(date.getDate()).padStart(2, '0');
              return `${year}-${month}-${day}`;
            }

            const events = [];

            function prevMonth() {
              currentDate.setMonth(currentDate.getMonth() - 1);
              renderCalendar();
            }

            function nextMonth() {
              currentDate.setMonth(currentDate.getMonth() + 1);
              renderCalendar();
            }

            function closeModal() {
              eventModal.style.display = "none";
            }

            window.onclick = function(event) {
              if (event.target == eventModal) {
                closeModal();
              }
            };
            eventModal.style.display = "none";

            function showModal(event) {
              currentEvent = event;
              loadCompanies(event);
              if (event) {
                eventTitle.textContent = event.empresa;
                eventTicker.value = event.ticker || "";
                eventCosto.value = event.monto;
                eventComentario.value = event.comentario || "";
                eventDate.value = event.fecha_pago ? formatDate(event.fecha_pago) : "";
                eventExDerecho.value = event.fecha_ex_derecho ? formatDate(event.fecha_ex_derecho) : "";
                eventAviso.value = event.link_aviso || "";
              } else {
                eventTitle.textContent = "Nuevo Evento";
                eventEmpresa.value = "";
                eventTicker.value = "";
                eventCosto.value = "";
                eventComentario.value = "";
                eventDate.value = "";
                eventExDerecho.value = "";
                eventAviso.value = "";
              }
              eventModal.style.display = "block";
            }

            function deleteEvent() {
              if (!currentEvent) return;
              const formData = new FormData();
              formData.append('event-id', currentEvent.id);
              fetch('php/delete_event.php', {
                  method: 'POST',
                  body: formData
                })
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                  }
                  return response.json();
                })
                .then(data => {
                  if (data.success) {
                    alert('Evento eliminado correctamente');
                    const index = events.indexOf(currentEvent);
                    if (index > -1) {
                      events.splice(index, 1);
                      renderCalendar();
                    }
                  } else {
                    alert('Error al eliminar el evento: ' + data.message);
                  }
                })
                .catch(error => {
                  console.error('Error:', error);
                  alert('Error al eliminar el evento: ' + error.message);
                });
              closeModal();
            }

            function saveEvent() {
              const formData = new FormData(document.getElementById("event-form"));
              const empresaSelect = document.getElementById("event-empresa");
              formData.set("event-empresa", empresaSelect.options[empresaSelect.selectedIndex].value);

              if (currentEvent) {
                formData.append("event-id", currentEvent.id);
              }

              fetch('php/save_event.php', {
                  method: 'POST',
                  body: formData
                })
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                  }
                  return response.json();
                })
                .then(data => {
                  if (data.success) {
                    alert('Evento guardado correctamente');
                    loadEventsFromDatabase();
                    closeModal();
                    renderCalendar();
                  } else {
                    alert('Error al guardar el evento: ' + data.message);
                  }
                })
                .catch(error => {
                  console.error('Error:', error);
                  alert('Error al guardar el evento: ' + error.message);
                });
            }

            function renderCalendar() {
              calendarGrid.innerHTML = "";
              calendarTitle.textContent = currentDate.toLocaleDateString("es-ES", {
                month: "long",
                year: "numeric",
              });
              daysOfWeek.forEach((day) => {
                const cell = document.createElement("div");
                cell.classList.add("calendar-cell", "calendar-cell-header");
                cell.textContent = day;
                calendarGrid.appendChild(cell);
              });
              const firstDayOfMonth = new Date(
                currentDate.getFullYear(),
                currentDate.getMonth(),
                1
              );
              const lastDayOfMonth = new Date(
                currentDate.getFullYear(),
                currentDate.getMonth() + 1,
                0
              );
              const startDay = firstDayOfMonth.getDay();
              for (let i = 0; i < startDay; i++) {
                const cell = document.createElement("div");
                cell.classList.add("calendar-cell");
                calendarGrid.appendChild(cell);
              }
              for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
                const cell = document.createElement("div");
                cell.classList.add("calendar-cell");
                cell.textContent = i;
                const dateToCheck = new Date(currentDate.getFullYear(), currentDate.getMonth(), i);
                const eventsOfDay = events.filter(
                  (e) =>
                  e.fecha_pago.getDate() === dateToCheck.getDate() &&
                  e.fecha_pago.getMonth() === dateToCheck.getMonth() &&
                  e.fecha_pago.getFullYear() === dateToCheck.getFullYear()
                );
                if (eventsOfDay.length > 0) {
                  cell.classList.add("calendar-cell-event");
                  const eventList = document.createElement("div");
                  eventList.classList.add("event-list");
                  eventsOfDay.forEach((event) => {
                    const eventItem = document.createElement("div");
                    eventItem.classList.add("event-item");
                    eventItem.textContent = event.ticker;
                    eventItem.addEventListener("click", () => {
                      showModal(event);
                    });
                    eventList.appendChild(eventItem);
                  });
                  cell.appendChild(eventList);
                }
                calendarGrid.appendChild(cell);
              }
            }

            function parseDate(dateStr) {
              const parts = dateStr.split('-');
              return new Date(parts[0], parts[1] - 1, parts[2]);
            }

            function loadCompanies(event) {
    fetch("php/get_companies.php")
        .then(response => response.json())
        .then(data => {
            const empresaSelect = document.getElementById("event-empresa");
            empresaSelect.innerHTML = "";
            data.forEach(company => {
                const option = document.createElement("option");
                option.value = company.nombre;
                option.textContent = company.nombre;
                empresaSelect.appendChild(option);
            });

            // Set the selected company if an event is provided
            if (event && event.empresa) {
                empresaSelect.value = event.empresa;
                console.log("Selected company:", event.empresa);
            }
        })
        .catch(error => console.error("Error cargando empresas:", error));
}

           function loadEventsFromDatabase() {
    fetch("php/database.php")
        .then(response => response.json())
        .then(data => {
            events.length = 0;
            data.forEach(event => {
                const formattedEvent = {
                    id: event.id,
                    empresa: event.empresa,
                    monto: event.monto,
                    ticker: event.ticker,
                    comentario: event.comentario,
                    exento_impuesto: event.exento_impuesto,
                    fecha_pago: parseDate(event.fecha_pago),
                    fecha_ex_derecho: parseDate(event.fecha_ex_derecho),
                    link_aviso: event.link_aviso,
                };
                events.push(formattedEvent);
            });
            renderCalendar();
        })
        .catch(error => console.error("Error cargando eventos:", error));
}


            loadEventsFromDatabase();
            renderCalendar();
          </script>
        </div>
      </main>



      <footer class="footer">
        <div class="container-fluid">

        </div>
    </div>
    </footer>
  </div>
  </div>
  <script src="js/main.js"></script>
  <script src="js/app.js"></script>
</body>

</html>