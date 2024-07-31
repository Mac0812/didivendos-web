// sw.js
self.addEventListener('push', event => {
    const data = event.data.json();
    self.registration.showNotification("Notificación de Dividendo", {
      body: "SE AGREGO UN NUEVO DIVIDENDO",
      icon: 'icon.png' // Cambia esto a la ruta de tu icono
    });
  });