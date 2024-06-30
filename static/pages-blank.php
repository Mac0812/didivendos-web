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
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta
      name="description"
      content="Responsive Admin & Dashboard Template based on Bootstrap 5"
    />
    <meta name="author" content="AdminKit" />
    <meta
      name="keywords"
      content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"
    />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" href="/static/assets/Iconos/logo png-08.png" />

    <link
      rel="canonical"
      href="https://demo-basic.adminkit.io/pages-blank.html"
    />

    <title>Agenda de Dividendos</title>

    <link href="css/app.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap"
      rel="stylesheet"
    />

    <!-- Include Babel -->
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    <!-- Include moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <style>
      body {
        font-family: Arial, sans-serif;
      }
      .calendar {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 70%;
      }
      .calendar-header {
        display: flex;
        justify-content: space-between;
        width: 600px;
        margin-bottom: 10px;
      }
      .calendar-header button {
        background-color: #41e2ba;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
      }
      .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        max-width: 600px;
      }
      .calendar-cell {
        padding: 20px;
        border: 1px solid #ddd;
        text-align: center;
      }
      .calendar-cell-header {
        background-color: #f0f0f0;
      }
      .calendar-cell-today {
        background-color: #41e2ba;
      }
      .modal {
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        height: 100%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: center;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        align-items: center;
      }
      .calendar-cell-event {
        position: relative;
      }

      .calendar-cell-event::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: rgb(111, 200, 186);
      }

      .modal-content {
        background-color: rgb(225, 251, 240);
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        width: 30%;
        height: 100%;
        margin-left: auto;
      }
      .event-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 5px;
      }

      .event-item {
        background-color: #41e2ba;
        padding: 5px 10px;
        border-radius: 5px;
        margin-bottom: 5px;
        cursor: pointer;
      }

      .event-item:hover {
        background-color: #0ad8a1;
      }

      .event-item:last-child {
        margin-bottom: 0;
      }

      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
      }

      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }
      .content-title {
        background-color: #41e2ba;
        height: 100px;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        padding: 20px;
        border-radius: 8px 8px 0 0;
      }
      .content-modal {
        background-color: rgb(225, 251, 240);
        padding: 20px;
        border-radius: 8px;
      }
      #event-title {
        width: 75%;
        font-size: 22px;
        margin-top: 20px;
      }
    </style>
  </head>

  <body>
    <div class="wrapper">
      <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
          <a class="sidebar-brand" href="index.php">
            <span class="align-middle">+Dividendos</span>
          </a>
          <ul class="sidebar-nav">
            <li class="sidebar-item">
              <a class="sidebar-link" href="pages-blank.php">
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
                <a
                  class="nav-icon dropdown-toggle d-inline-block d-sm-none"
                  href="#"
                  data-bs-toggle="dropdown"
                >
                  <i class="align-middle" data-feather="settings"></i>
                </a>

                <a
                  class="nav-link dropdown-toggle d-none d-sm-inline-block"
                  href="#"
                  data-bs-toggle="dropdown"
                >
                
                <span class="text-dark">Bienvenido, <?php echo $_SESSION['nombre_completo']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                  <a class="dropdown-item" href="pages-profile.html"
                    ><i class="align-middle me-1" data-feather="user"></i>
                    Profile</a
                  >
                  <a class="dropdown-item" href="#"
                    ><i class="align-middle me-1" data-feather="pie-chart"></i>
                    Analytics</a
                  >
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="index.html"
                    ><i class="align-middle me-1" data-feather="settings"></i>
                    Settings & Privacy</a
                  >
                  <a class="dropdown-item" href="#"
                    ><i
                      class="align-middle me-1"
                      data-feather="help-circle"
                    ></i>
                    Help Center</a
                  >
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
                  <h2 id="event-title"></h2>
                  <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="content-modal">
                  <p id="event-description"></p>
                  <label>Monto: </label>
                  <p id="event-costo"></p>
                  <label>Ticker: </label>
                  <p id="event-ticker"></p>
                  <label>Fecha ex-derecho: </label>
                  <p id="event-ex"></p>
                  <label>Fecha pago: </label>
                  <p id="event-date"></p>
                  <label>Link aviso: </label>
                  <p id="event-aviso"></p>
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
              const eventDescription =
                document.getElementById("event-description");
              const daysOfWeek = [
                "Dom",
                "Lun",
                "Mar",
                "Mié",
                "Jue",
                "Vie",
                "Sáb",
              ];
              const date = new Date();
              const events = [];

              function formatDate(date) {
                return `${date.getDate()}/${String(
                  date.getMonth() + 1
                ).padStart(2, "0")}/${date.getFullYear()}`;
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

              function showModal(event) {
                eventTitle.textContent = event.title || "";
                eventCosto.textContent = event.monto || "";
                eventTicker.textContent = event.ticker || "";
                eventExDerecho.textContent = event.ex_derecho
                  ? formatDate(event.ex_derecho)
                  : "";
                eventDate.textContent = event.date
                  ? formatDate(event.date)
                  : "";
                eventAviso.textContent = event.aviso || "";
                eventModal.style.display = "block";
              }

              function closeModal() {
                eventModal.style.display = "none";
              }

              window.onclick = function (event) {
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

                const firstDayOfMonth = new Date(
                  date.getFullYear(),
                  date.getMonth(),
                  1
                );
                const lastDayOfMonth = new Date(
                  date.getFullYear(),
                  date.getMonth() + 1,
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

                  const eventsOfDay = events.filter(
                    (e) =>
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
                      eventItem.textContent = event.title;
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

              function loadEventsFromDatabase() {
                fetch("php/database.php")
                  .then((response) => response.json())
                  .then((data) => {
                    data.forEach((event) => {
                      const formattedEvent = {
                        title: event.empresa,
                        ticker: event.ticker,
                        monto: `$${event.monto}`,
                        ex_derecho: new Date(event.fecha_ex_derecho),
                        date: new Date(event.fecha_pago),
                        description: event.comentario,
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

              loadEventsFromDatabase();
              renderCalendar();
            </script>
          </div>
        </main>

        <footer class="footer">
          <div class="container-fluid">
            <div class="row text-muted">
              <div class="col-6 text-start">
                <p class="mb-0">
                  <a
                    class="text-muted"
                    href="https://adminkit.io/"
                    target="_blank"
                    ><strong>DIVIDENDOS</strong></a
                  >
                </p>
              </div>
              <div class="col-6 text-end">
                <ul class="list-inline">
                  <li class="list-inline-item">
                    <a
                      class="text-muted"
                      href="https://adminkit.io/"
                      target="_blank"
                      >Support</a
                    >
                  </li>
                  <li class="list-inline-item">
                    <a
                      class="text-muted"
                      href="https://adminkit.io/"
                      target="_blank"
                      >Help Center</a
                    >
                  </li>
                  <li class="list-inline-item">
                    <a
                      class="text-muted"
                      href="https://adminkit.io/"
                      target="_blank"
                      >Privacy</a
                    >
                  </li>
                  <li class="list-inline-item">
                    <a
                      class="text-muted"
                      href="https://adminkit.io/"
                      target="_blank"
                      >Terms</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <script src="js/app.js"></script>
  </body>
</html>
