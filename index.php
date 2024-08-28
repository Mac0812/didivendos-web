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
  <meta name="author" content="AdminKit" />
  <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link rel="shortcut icon" href="/static/assets/Iconos/logo.png" />
  <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />
  <title>Agenda de Dividendos</title>
  <link href="static/css/app.css" rel="stylesheet" />
  <link href="static/css/estilos.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,800;1,8009'&display=swap" rel="stylesheet">
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
  <div class="wrapper">
    <div class="main">
      <header>
        <img src="./static/assets/images/logo editable_page-0001.jpg" width="150px" />
        <button class="burger-button" onclick="toggleMenu()">&#9776;</button>
        <nav>
          <ul id="menu">
            <li><a href="./index.php">INVERSIONES</a></li>
            <li><a href="./static/Comunidad/comunidad.html">COMUNIDAD</a></li>
            <li><a href="#">EDUCACIÓN</a></li>
          </ul>
        </nav>
        <div class="user" id="user">
          <button class="switch" id="switch">
            <span><i class='bx bxs-moon'></i></span>
            <span><i class='bx bx-moon'></i></span>
          </button>
          <button class="notification-button" id="alertsDropdown" data-bs-toggle="dropdown">
            <span class="material-symbols-outlined"> notifications </span>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
              <div class="dropdown-menu-header">
                Nuevas Notificaciones
              </div>
              <!-- <div class="notifi-check">
                            <p class="title-notifi">¿Desea recibir notificaciones sobre nuevas publicaciones?</p>
                            <div class="container-button-not">
                              <button class="accept-button" onclick="aceptarNotificaciones()">Sí</button>
                              <button class="no-button">No</button>
                            </div>
                          </div> -->

              <div class="list-group" id="lista-notificaciones">
                <!-- Las notificaciones se cargarán aquí dinámicamente -->
              </div>

          </button>
          <div class="profile" id="profile">
            <img
              src="./assets/logo editable_page-0001.jpg"
              alt="Profile Picture" />
            <div class="container-info-perfil" id="container-info-perfil">
              <span>Karla Cardozo Ramirez</span>
              <span class="material-symbols-outlined" data-bs-toggle="dropdown"> stat_minus_1 </span>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="/static/php/cerrar_sesion.php">Editar Perfil</a>
                <a class="dropdown-item" href="/static/php/cerrar_sesion.php">Cerrar sesión</a>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- Botón de Chat -->
      <button class="chat-button" id="chatButton">
        <i class="bx bx-chat"></i> Ayuda
      </button>

      <!-- Modal de Formulario -->
      <div id="chatModal" class="modal">
        <div class="floating-form">
          <form id="offerForm" action="/static/php/formulario.php" method="post">
            <h2>Ayuda</h2>
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="email" name="email" placeholder="Correo" required>
            <textarea name="message" placeholder="Escribe el mensaje..." required></textarea>
            <button type="submit">Enviar</button>
          </form>
        </div>
      </div>


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
            <div id="modal-content" class="modal-content">
              <div class="content-title">
                <img id="dividendo-img" src="" alt="Dividendo Imagen" width="70" height="70">
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
            const contentModal = document.getElementById("modal-content");
            const eventChatModal = document.getElementById("chatModal");
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
                document.getElementById('dividendo-img').src = '';
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
              // Añade la clase de animación
              contentModal.classList.add('fade-out');
              eventChatModal.style.display = 'none';

              // Espera a que termine la animación antes de ocultar el elemento
              setTimeout(() => {
                eventModal.style.display = 'none';

                // Remueve la clase de animación para que pueda ser reutilizada
                contentModal.classList.remove('fade-out');
              }, 500); // La duración de la animación en milisegundos
            }

            window.onclick = function(event) {
              if (event.target == eventModal) {
                closeModal();
              } else if (event.target == eventChatModal) {
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

            function actualizarNotificaciones() {
              fetch("static/php/obtener_notificaciones.php")
                .then((response) => {
                  if (!response.ok) {
                    throw new Error('Error en la respuesta de la red');
                  }
                  return response.json();
                })
                .then((data) => {
                  console.log(data);
                  try {
                    const contadorNotificaciones = document.getElementById("contador-notificaciones");
                    if (contadorNotificaciones) {
                      contadorNotificaciones.textContent = data.contador;
                    } else {
                      console.error("Error: No se encontró el elemento 'contador-notificaciones' en el DOM.");
                    }

                    const listaNotificaciones = document.getElementById("lista-notificaciones");
                    if (listaNotificaciones) {
                      listaNotificaciones.innerHTML = "";

                      data.notificaciones.forEach((notificacion) => {
                        const itemNotificacion = document.createElement("div");
                        itemNotificacion.classList.add("notificacion");
                        itemNotificacion.textContent = notificacion.mensaje;
                        listaNotificaciones.appendChild(itemNotificacion);
                      });
                    } else {
                      console.error("Error: No se encontró el elemento 'lista-notificaciones' en el DOM.");
                    }
                  } catch (error) {
                    console.error("Error al procesar las notificaciones:", error);
                  }
                })
                .catch((error) => console.error("Error al obtener notificaciones:", error));
            }
            actualizarNotificaciones();
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
  <script src="static/js/main.js"></script>
</body>

</html>