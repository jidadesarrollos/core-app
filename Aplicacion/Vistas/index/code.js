import {React} from '../../../htdocs/modules/libs/react.development.js';
import {ReactDOM} from '../../../htdocs/modules/libs/react-dom.development.js';
/**
* file: first.jsx
*/
class App extends React.Component {
  constructor() {
    super();
    this.state = {
      'showMore': 0
    };
    this.click = this.click.bind(this);
    this.remover = this.remover.bind(this);
  }

  click() {
    this.setState({
      'showMore': this.state.showMore + 1
    });
  }

  remover() {
    this.setState({
      'showMore': this.state.showMore - 1
    });
  }

  render() {
    let output = [];
    const {
      users
    } = this.props;
    users.map(user => output.push(React.createElement(User, {
      user: user,
      key: user.id
    })));
    return React.createElement("div", null, React.createElement(Second, null), React.createElement("hr", null), React.createElement("button", {
      onClick: this.click,
      className: "btn primary"
    }, "Cargar mas"), React.createElement("button", {
      onClick: this.remover,
      className: "btn primary"
    }, "Remover"), output);
  }

}
/**
* file: other.jsx
*/


const Button = () => {
  return React.createElement("button", {
    className: "btn primary"
  }, "Cargar mas ");
};
/**
* file: second.jsx
*/


const Second = () => {
  return React.createElement("div", null, React.createElement("h3", null, "Testing second ", React.createElement("small", null, "content below")));
};
/**
* file: user.jsx
*/


function User({
  user
}) {
  return React.createElement("section", null, React.createElement("h3", null, user.usuario), React.createElement("h4", null, "Ultima sesi\xF3n: ", user.ultima_sesion));
}
/**
* file: main.js
*/

(() => {
    'use strict';

    const app = document.getElementById('app');

    ReactDOM.render(React.createElement(App, {
        'users': JSON.parse(app.dataset.usuarios)
    }), app);
})();

/**
* file: test.js
*/

function Test() {
    
}
