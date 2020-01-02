import {React} from '../../../../htdocs/modules/libs/react.development.js';
import {ReactDOM} from '../../../../htdocs/modules/libs/react-dom.development.js';
/**
* file: bandeja.jsx
*/
class Test extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return React.createElement("h3", null, "Vista React");
  }

}
/**
* file: main.js
*/

(() => {
    'use strict';

    const test = document.getElementById('test');
    ReactDOM.render(React.createElement(Bandeja, {}), test);

})();
