<?php
session_start();
if (!isset($_SESSION['nombre_completo'])) {
  echo '
		<script> 
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
  <link rel="shortcut icon" href="/static/assets/Iconos/logo png-08.png" />
  <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

  <title>Agenda de Dividendos</title>
  <link href="static/css/app.css" rel="stylesheet" />
  <link href="static/css/estilos.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <nav id="sidebar" class="sidebar js-sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.php">
          <img src="/static/assets/logo.png" alt="+Dividendos" class="align-middle">
        </a>

        <ul class="sidebar-nav">
          <li class="sidebar-item">
            <a class="sidebar-link" href="static/pages-blank.php">
              <i class="align-middle" data-feather="book"></i>
              <span class="align-middle">Agenda Dividendos</span>
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
              <button class="switch" id="switch">
                <span><i class="fas fa-sun"></i></span>
                <span><i class="fas fa-moon"></i></span>
              </button>
              <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">

                <span class="text-dark">Bienvenido, <?php echo $_SESSION['nombre_completo']; ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/static/php/cerrar_sesion.php">Cerrar sesión</a>
              </div>
            </li>
          </ul>
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
            </div>
            <div class="calendar-grid" id="calendar-grid"></div>
          </div>

          <div id="event-modal" class="modal">
            <div class="modal-content">
              <div class="content-title">
                <img id="dividendo-img" src="" alt="Dividendo Imagen" width="50" height="50">
                <h2 id="event-title"></h2>
                <span class="close" onclick="closeModal()">&times;</span>
              </div>
              <div class="content-modal">
                <p id="event-description"></p>
                <label>Ticker: </label>
                <p id="event-ticker"></p>
                <label>Monto: </label>
                <p id="event-costo"></p>
                <label>Comentario:</label>
                <p id="event-comentario"></p>
                <label>Fecha pago: </label>
                <p id="event-date"></p>
                <label>Fecha ex-derecho: </label>
                <p id="event-ex"></p>
                <label>Link aviso: </label>
                <a id="event-aviso" href="" target="_blank"></a>
              </div>
            </div>
          </div>
          <script>
            const calendarGrid = document.getElementById("calendar-grid");
            const calendarTitle = document.getElementById("calendar-title");
            const eventModal = document.getElementById("event-modal");
            const eventTitle = document.getElementById("event-title");
            const eventCosto = document.getElementById("event-costo");
            const eventTicker = document.getElementById("event-ticker");
            const eventExDerecho = document.getElementById("event-ex");
            const eventDate = document.getElementById("event-date");
            const eventAviso = document.getElementById("event-aviso");
            const eventComentario = document.getElementById("event-comentario");
            const eventDescription = document.getElementById("event-description");
            const daysOfWeek = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];
            const date = new Date();
            const events = [];

            function formatDate(date) {
              return `${date.getDate()}/${String(date.getMonth() + 1).padStart(2, "0")}/${date.getFullYear()}`;
            }

            function prevMonth() {
              date.setMonth(date.getMonth() - 1);
              renderCalendar();
            }

            function nextMonth() {
              date.setMonth(date.getMonth() + 1);
              renderCalendar();
            }

            eventModal.style.display = "none";

            function setDividendoImage(event) {
              const imagen = imagenes.find(img => img.titulo === event.title);
              if (imagen) {
                document.getElementById('dividendo-img').src = imagen.ruta;
              } else {
                document.getElementById('dividendo-img').src = 'LogosEmp/logoBlanck.png';
              }
            }

            function showModal(event) {
              eventTitle.textContent = event.title || "";
              eventCosto.textContent = event.monto || "";
              eventTicker.textContent = event.ticker || "";
              eventComentario.textContent = event.comentario || "";
              eventExDerecho.textContent = event.ex_derecho ? formatDate(event.ex_derecho) : "";
              eventDate.textContent = event.date ? formatDate(event.date) : "";
              eventAviso.textContent = event.aviso || "";
              eventAviso.href = event.aviso;
              setDividendoImage(event);
              eventModal.style.display = "block";
            }

            function closeModal() {
              eventModal.style.display = "none";
            }

            window.onclick = function(event) {
              if (event.target == eventModal) {
                closeModal();
              }
            };

            function renderCalendar() {
              calendarGrid.innerHTML = "";
              calendarTitle.textContent = date.toLocaleDateString("es-ES", {
                month: "long",
                year: "numeric",
              });

              daysOfWeek.forEach((day) => {
                const cell = document.createElement("div");
                cell.classList.add("calendar-cell", "calendar-cell-header");
                cell.textContent = day;
                calendarGrid.appendChild(cell);
              });

              const firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
              const lastDayOfMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0);
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

                const eventsOfDay = events.filter(
                  (e) =>
                  e.date instanceof Date &&
                  e.date.getDate() === i &&
                  e.date.getMonth() === date.getMonth() &&
                  e.date.getFullYear() === date.getFullYear()
                );

                if (eventsOfDay.length > 0) {
                  cell.classList.add("calendar-cell-event");
                  const eventList = document.createElement("div");
                  eventList.classList.add("event-list");
                  eventsOfDay.forEach((event) => {
                    const eventItem = document.createElement("div");
                    eventItem.classList.add("event-item");
                    eventItem.textContent = `${event.ticker} Pago`;
                    eventItem.addEventListener("click", () => {
                      showModal(event);
                    });
                    eventList.appendChild(eventItem);
                  });
                  cell.appendChild(eventList);
                }

                const eventsOfDayEx = events.filter(
                  (e) =>
                  e.ex_derecho instanceof Date &&
                  e.ex_derecho.getDate() === i &&
                  e.ex_derecho.getMonth() === date.getMonth() &&
                  e.ex_derecho.getFullYear() === date.getFullYear()
                );

                if (eventsOfDayEx.length > 0) {
                  cell.classList.add("calendar-cell-event-ex");
                  const eventListEx = document.createElement("div");
                  eventListEx.classList.add("event-list-ex");
                  eventsOfDayEx.forEach((event) => {
                    const eventItemEx = document.createElement("div");
                    eventItemEx.classList.add("event-item-ex");
                    eventItemEx.textContent = `${event.ticker} ex-derecho`;
                    eventItemEx.addEventListener("click", () => {
                      showModal(event);
                    });
                    eventListEx.appendChild(eventItemEx);
                  });
                  cell.appendChild(eventListEx);
                }

                calendarGrid.appendChild(cell);
              }
            }

            function parseDate(dateStr) {
              // Formato esperado: "YYYY-MM-DD"
              const parts = dateStr.split('-');
              return new Date(parts[0], parts[1] - 1, parts[2]);
            }

            function loadEventsFromDatabase() {
              fetch("static/php/database.php")
                .then((response) => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok');
                  }
                  return response.json();
                })
                .then((data) => {
                  data.forEach((event) => {
                    const formattedEvent = {
                      title: event.empresa,
                      ticker: event.ticker,
                      monto: `${event.monto}`,
                      ex_derecho: parseDate(event.fecha_ex_derecho),
                      date: parseDate(event.fecha_pago),
                      comentario: event.comentario,
                      aviso: event.link_aviso,
                    };
                    events.push(formattedEvent);
                  });
                  renderCalendar();
                })
                .catch((error) =>
                  console.error("Error cargando eventos:", error)
                );
            }

            document.addEventListener("DOMContentLoaded", function() {
              loadEventsFromDatabase();
            });


            function aceptarNotificaciones() {
              if (confirm('¿Está seguro de que desea recibir notificaciones?')) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'static/php/acceptar_notificaciones.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                  if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                  }
                };
                xhr.send('aceptar_notificaciones=1&id_usuario=id_usuario'); // Enviar los datos necesarios
              }
            }
          </script>
        </div>
      </main>

      <footer class="footer">
        <div class="container-fluid">
          <div class="row text-muted">
            <div class="col-6 text-start">

              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script src="static/js/app.js"></script>
  <script src="static/js/logos.js"></script>
</body>

</html>