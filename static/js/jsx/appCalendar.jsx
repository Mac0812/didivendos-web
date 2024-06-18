import React, { Component } from "react";
import { Calendar, momentLocalizer } from "react-big-calendar";
import moment from "moment";
import Modal from "react-modal";
import "react-big-calendar/lib/css/react-big-calendar.css";

// Set the Spanish locale for Moment.js
moment.locale("es");

// Create a localizer for BigCalendar
const localizer = momentLocalizer(moment);

// Define an array of events
const myEventsList = [
  {
    title: "Evento 1",
    start: new Date("2024-06-06 10:22:00"),
    end: new Date("2024-06-06 11:22:00"),
    description: "Descripción del evento 1",
  },
  {
    title: "Evento 2",
    start: new Date("2024-06-06 12:00:00"),
    end: new Date("2024-06-06 13:00:00"),
    description: "Descripción del evento 2",
  },
  {
    title: "Evento 3",
    start: new Date("2024-06-06 10:00:00"),
    end: new Date("2024-06-06 11:00:00"),
    description: "Descripción del evento 3",
  },
];

const customStyles = {
  content: {
    top: "50%",
    left: "50%",
    right: "auto",
    bottom: "auto",
    marginRight: "-50%",
    transform: "translate(-50%, -50%)",
    zIndex: 1000,
  },
  overlay: {
    zIndex: 999,
  },
};

class CalendarApp extends Component {
  constructor(props) {
    super(props);
    this.state = {
      selectedDay: null,
      selectedEvent: null,
      modalIsOpen: false,
    };
  }

  handleSelectDay = (day) => {
    this.setState({ selectedDay: day });
  };

  handleSelectEvent = (event) => {
    this.setState({ selectedEvent: event, modalIsOpen: true });
  };

  closeModal = () => {
    this.setState({ modalIsOpen: false });
  };

  render() {
    return (
      <div>
        <Calendar
          localizer={localizer}
          events={myEventsList}
          onSelectEvent={this.handleSelectEvent}
          onSelectDay={this.handleSelectDay}
          defaultView="month"
          views={["month", "week", "day"]}
          style={{ height: "100vh" }}
          messages={{
            next: "Siguiente",
            previous: "Anterior",
            today: "Hoy",
            month: "Mes",
            week: "Semana",
            day: "Día",
            agenda: "Agenda",
          }}
        />
        <Modal
          isOpen={this.state.modalIsOpen}
          onRequestClose={this.closeModal}
          style={customStyles}
        >
          {this.state.selectedEvent && (
            <div>
              <h2>{this.state.selectedEvent.title}</h2>
              <p>{this.state.selectedEvent.description}</p>
            </div>
          )}
        </Modal>
      </div>
    );
  }
}

export default CalendarApp;