import {React} from '../../../htdocs/modules/libs/react.development.js';
import {ReactDOM} from '../../../htdocs/modules/libs/react-dom.development.js';
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

/**
* file: bandeja.jsx
*/
class Bandeja extends React.Component {
  constructor(props) {
    super(props);
    const activities = new Activities();
    activities.registerBinder(this.setState.bind(this));
    this.setActividad = this.setActividad.bind(this);
    this.state = {};
  }

  setActividad(objActividad) {
    this.setState({
      'actividad': objActividad
    });
  }

  render() {
    let {
      statusActividades
    } = this.props;
    let {
      ready,
      actividades,
      actividad
    } = this.state;
    if (!ready) return null;
    return React.createElement("div", {
      className: "row"
    }, React.createElement("div", {
      className: "col-md-6"
    }, React.createElement("div", {
      className: "card"
    }, React.createElement("div", {
      className: "card-body"
    }, React.createElement("h2", {
      className: "mb-3"
    }, "Bandeja de Actividades"), React.createElement(ListaActividades, {
      actividades: actividades,
      setActividad: this.setActividad
    })))), React.createElement("div", {
      className: "col-md-6"
    }, !!actividad && React.createElement(DetalleActividad, {
      actividad: actividad,
      statusActividades: statusActividades
    })));
  }

}
/**
* file: control.jsx
*/


class Control extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    let {
      usuarios,
      prioridades
    } = this.props;
    return React.createElement("div", null, React.createElement("h2", {
      className: "mb-3"
    }, "Asignar Actividad"), React.createElement(Formulario, {
      users: usuarios,
      prioridades: prioridades
    }));
  }

}
/**
* file: detalle-actividad.jsx
*/


class DetalleActividad extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      'fecha_inicio': !props.actividad.fecha_inicio ? '' : props.actividad.fecha_inicio,
      'fecha_entrega': !props.actividad.fecha_entrega ? '' : props.actividad.fecha_entrega,
      'id_estatus': !props.actividad.id_estatus ? '' : props.actividad.id_estatus,
      'comentario': ''
    };
    this.listenStartDate = this.listenStartDate.bind(this);
    this.listenEndDate = this.listenEndDate.bind(this);
    this.listenStatus = this.listenStatus.bind(this);
    this.listenComment = this.listenComment.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  listenStartDate(event) {
    const target = event.currentTarget;
    this.setState({
      'fecha_inicio': target.value
    });
  }

  listenEndDate(event) {
    const target = event.currentTarget;
    this.setState({
      'fecha_entrega': target.value
    });
  }

  listenStatus(statusId) {
    this.setState({
      'id_estatus': statusId
    });
  }

  listenComment(event) {
    const target = event.currentTarget;
    this.setState({
      'comentario': target.value
    });
  }

  async handleSubmit(event) {
    try {
      event.preventDefault();
      const {
        fecha_inicio,
        fecha_entrega,
        id_estatus,
        comentario
      } = this.state;
      const target = event.currentTarget;
      const id = target.dataset.id;
      const url = '/jadmin/actividades/actualizar';
      const data = {
        'id_actividad': id,
        'fecha_inicio': fecha_inicio,
        'fecha_entrega': fecha_entrega,
        'id_estatus': id_estatus,
        'comentario': comentario
      };
      const response = await fetch(url, {
        method: 'post',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
      return response.json();
    } catch (e) {
      console.error(e);
    }
  }

  render() {
    let {
      actividad,
      statusActividades
    } = this.props;
    console.log(1, this.state, actividad);
    let statusClass = 'badge mb-2 p-2 ';

    switch (actividad.id_prioridad) {
      case '1':
        statusClass += 'badge-info';
        break;

      case '2':
        statusClass += 'badge-success';
        break;

      case '3':
        statusClass += 'badge-warning';
        break;

      case '4':
        statusClass += 'badge-danger';
        break;

      default:
        statusClass += 'badge-primary';
    }

    return React.createElement("div", {
      className: "card"
    }, React.createElement("div", {
      className: "card-body"
    }, React.createElement("span", {
      className: statusClass
    }, actividad.prioridad), React.createElement("h3", {
      className: "mb-3"
    }, actividad.actividad), React.createElement("p", null, actividad.descripcion), React.createElement("hr", {
      className: "my-2"
    }), React.createElement("div", {
      className: "row"
    }, React.createElement("div", {
      className: "col-md-6"
    }, React.createElement("label", {
      className: "text-primary"
    }, "Fecha de Inicio:"), React.createElement("input", {
      type: "date",
      className: "form-control mb-3",
      value: this.state.fecha_inicio,
      onChange: this.listenStartDate
    })), React.createElement("div", {
      className: "col-md-6"
    }, React.createElement("label", {
      className: "text-primary"
    }, "Fecha de Entrega:"), React.createElement("input", {
      type: "date",
      className: "form-control mb-3",
      value: this.state.fecha_entrega,
      onChange: this.listenEndDate
    })), React.createElement(StatusActividades, {
      statusList: statusActividades,
      statusSelected: this.state.id_estatus,
      listenStatus: this.listenStatus
    })), React.createElement("hr", {
      className: "my-2"
    }), React.createElement("label", {
      className: "text-primary"
    }, "Escriba un comentario:"), React.createElement("textarea", {
      className: "form-control mb-3",
      onChange: this.listenComment
    }), React.createElement("button", {
      className: "btn btn-primary",
      "data-id": actividad.id_actividad,
      onClick: this.handleSubmit
    }, "Actualizar")));
  }

}
/**
* file: formulario.jsx
*/


class Formulario extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      'actividad': '',
      'descripcion': '',
      'userId': '',
      'priorityId': '',
      'incompleto': true
    };
    this.activityValue = this.activityValue.bind(this);
    this.descriptionValue = this.descriptionValue.bind(this);
    this.listenUser = this.listenUser.bind(this);
    this.listenPriority = this.listenPriority.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  activityValue(event) {
    const target = event.currentTarget;
    this.setState({
      'actividad': target.value
    });
  }

  descriptionValue(event) {
    const target = event.currentTarget;
    this.setState({
      'descripcion': target.value
    });
  }

  listenUser(userId) {
    this.setState({
      'userId': userId
    });
  }

  listenPriority(priorityId) {
    this.setState({
      'priorityId': priorityId
    });
  }

  async handleSubmit(event) {
    try {
      event.preventDefault();
      let {
        actividad,
        userId,
        priorityId,
        descripcion
      } = this.state;
      let url = '/jadmin/actividades/procesar';
      let data = {
        'id_usuario': userId,
        'actividad': actividad,
        'descripcion': descripcion,
        'id_prioridad': priorityId
      };
      let response = await fetch(url, {
        method: 'post',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      });
      return response.json();
    } catch (e) {
      console.error(e);
    }
  }

  render() {
    let {
      users,
      prioridades
    } = this.props;
    let {
      actividad,
      userId,
      descripcion
    } = this.state;
    let properties = {};

    if (!actividad || !userId) {
      properties.disabled = true;
    }

    return React.createElement("form", {
      onSubmit: this.handleSubmit
    }, React.createElement("div", {
      className: "form-row"
    }, React.createElement("div", {
      className: "col-md-12"
    }, React.createElement("input", {
      type: "text",
      className: "form-control mb-3",
      value: actividad,
      placeholder: "Escriba el nombre de la actividad(*)",
      onChange: this.activityValue,
      required: true
    }))), React.createElement("div", {
      className: "form-row"
    }, React.createElement(Usuarios, {
      users: users,
      listenUser: this.listenUser
    }), React.createElement(Prioridades, {
      prioridades: prioridades,
      listenPriority: this.listenPriority
    })), React.createElement("div", {
      className: "form-row"
    }, React.createElement("div", {
      className: "col-md-12"
    }, React.createElement("textarea", {
      className: "form-control mb-3",
      placeholder: "Descripci\xF3n",
      onChange: this.descriptionValue,
      value: descripcion
    }))), React.createElement("button", _extends({
      className: "btn btn-primary"
    }, properties, {
      type: "submit"
    }), "Guardar Actividad"));
  }

}
/**
* file: lista-actividades.jsx
*/


class ListaActividades extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
    this.listenActivity = this.listenActivity.bind(this);
  }

  listenActivity(event) {
    const target = event.currentTarget;
    const key = target.dataset.id;
    const {
      actividades
    } = this.props;
    this.props.setActividad(actividades[key]);
  }

  render() {
    let output = [];
    let {
      actividades
    } = this.props;
    actividades.forEach((actividad, key) => {
      const name = `${actividad.nombres} ${actividad.apellidos}`;
      output.push(React.createElement("li", {
        key: actividad.id_actividad,
        className: "list-group-item"
      }, React.createElement("p", {
        className: "m-0 d-flex align-items-center"
      }, React.createElement("span", null, name), React.createElement("span", {
        className: "badge badge-pill badge-primary ml-1 mr-1"
      }, !!actividad.centro_costo && actividad.centro_costo), React.createElement("span", {
        className: "flex-grow-1"
      }), React.createElement("span", {
        className: "text-small text-muted ml-auto"
      }, "Fecha: ", actividad.fecha_inicio)), React.createElement("h5", {
        className: "text-primary mt-3 mb-0"
      }, actividad.actividad), React.createElement("p", {
        className: "text-small text-muted"
      }, actividad.descripcion), React.createElement("button", {
        className: "btn btn-primary",
        "data-id": key,
        onClick: this.listenActivity
      }, "Ver detalle")));
    });
    return React.createElement("ul", {
      className: "list-group"
    }, output);
  }

}
/**
* file: lista-usuarios.jsx
*/


class ListaUsuarios extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
    this.selectUser = this.selectUser.bind(this);
  }

  selectUser(event) {
    const target = event.currentTarget;
    let {
      id,
      name
    } = target.dataset;
    this.setState({
      'selected': id,
      'name': name
    });
    this.props.bindUser(id, name);
  }

  render() {
    let output = [];
    let {
      selected
    } = this.state;
    let {
      searched,
      users
    } = this.props;
    users.forEach(user => {
      const name = `${user.nombres} ${user.apellidos}`;

      if (!name.toLowerCase().includes(searched.toLowerCase())) {
        return;
      }

      const cls = user.id_usuario === selected ? 'list-group-item active' : 'list-group-item';
      output.push(React.createElement("li", {
        key: user.id_usuario,
        "data-id": user.id_usuario,
        "data-name": name,
        className: cls,
        onClick: this.selectUser
      }, name));
    });
    return React.createElement("ul", {
      className: "list-group"
    }, output);
  }

}
/**
* file: prioridades.jsx
*/


class Prioridades extends React.Component {
  constructor(props) {
    super(props);
    this.priorityValue = this.priorityValue.bind(this);
  }

  priorityValue(event) {
    const target = event.currentTarget;
    this.props.listenPriority(target.value);
  }

  render() {
    let {
      prioridades
    } = this.props;
    return React.createElement("div", {
      className: "col-md-6"
    }, React.createElement("select", {
      className: "form-control mb-3",
      onChange: this.priorityValue
    }, React.createElement("option", null, "- Seleccione una Prioridad -"), prioridades.map(key => React.createElement("option", {
      key: key.id_prioridad,
      value: key.id_prioridad
    }, key.prioridad))));
  }

}
/**
* file: status-actividades.jsx
*/


class StatusActividades extends React.Component {
  constructor(props) {
    super(props);
    this.statusValue = this.statusValue.bind(this);
  }

  statusValue(event) {
    const target = event.currentTarget;
    this.props.listenStatus(target.value);
  }

  render() {
    let {
      statusList,
      statusSelected
    } = this.props;
    return React.createElement("div", {
      className: "col-md-6"
    }, React.createElement("label", {
      className: "text-primary"
    }, "Avance:"), React.createElement("select", {
      className: "form-control mb-3",
      value: statusSelected,
      onChange: this.statusValue
    }, statusList.map(status => React.createElement("option", {
      key: status.id_estatus_actividad,
      value: status.id_estatus_actividad
    }, status.descripcion))));
  }

}
/**
* file: usuarios.jsx
*/


class Usuarios extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      'searched': '',
      'user': {}
    };
    this.handleValue = this.handleValue.bind(this);
    this.setUser = this.setUser.bind(this);
    this.clean = this.clean.bind(this);
  }

  handleValue(event) {
    const target = event.currentTarget;
    this.setState({
      'searched': target.value
    });
  }

  setUser(id, name) {
    this.setState({
      'user': {
        'id': id,
        'name': name
      }
    });
    this.props.listenUser(id);
  }

  clean() {
    this.setState({
      'user': {}
    });
    this.props.listenUser(undefined);
  }

  render() {
    let {
      users
    } = this.props;
    let {
      id,
      name
    } = this.state.user;

    if (id) {
      return React.createElement("div", {
        className: "col-md-6"
      }, React.createElement("div", {
        className: "input-group mb-3"
      }, React.createElement("input", {
        type: "text",
        className: "form-control",
        value: name,
        readOnly: true
      }), React.createElement("div", {
        className: "input-group-append"
      }, React.createElement("button", {
        className: "btn btn-secondary",
        onClick: this.clean
      }, "\xD7"))));
    }

    return React.createElement("div", {
      className: "col-md-6"
    }, React.createElement("input", {
      type: "text",
      className: "form-control mb-3",
      placeholder: "Responsable(*)",
      value: this.state.searched,
      onChange: this.handleValue,
      required: true
    }), !!this.state.searched && React.createElement(ListaUsuarios, {
      searched: this.state.searched,
      users: users,
      bindUser: this.setUser
    }));
  }

}
/**
* file: activities.js
*/

function Activities() {
    'use strict';

    Object.defineProperty(this, 'ready', {'get': () => !!actividades});

    let actividades;
    Object.defineProperty(this, 'actividades', {'get': () => actividades});

    let binder;
    this.registerBinder = (callback) => binder = callback;

    const setState = () => {
        binder({
            'ready': this.ready,
            'actividades': actividades
        });
    };

    const loadActivities = async () => {

        try {

            let url = '/jadmin/actividades/obtbandeja';
            let data = {'getdata': true};

            const response = await fetch(url, {
                method: 'post',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            });

            data = await response.json();
            if (data.status === 'ok') actividades = data.data;
            setState();

        }
        catch (e) {
            console.error(e);
        }

    };

    loadActivities();

}

/**
* file: main.js
*/

(() => {
    'use strict';

    const asignar = document.getElementById('jadmin-actividades-asignar-page');

    if (asignar) {

        let usuarios = asignar.dataset.usuarios;
        let prioridades = asignar.dataset.prioridades;

        ReactDOM.render(React.createElement(Control, {
            'usuarios': JSON.parse(usuarios),
            'prioridades': JSON.parse(prioridades)
        }), asignar);

    }

    const bandeja = document.getElementById('jadmin-actividades-bandeja-page');

    if (bandeja) {

        let statusActividades = bandeja.dataset.status;

        ReactDOM.render(React.createElement(Bandeja, {
            'statusActividades': JSON.parse(statusActividades)
        }), bandeja);

    }

})();
