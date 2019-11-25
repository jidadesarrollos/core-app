import {React} from '../../../htdocs/modules/libs/react.development.js';
import {ReactDOM} from '../../../htdocs/modules/libs/react-dom.development.js';
/**
* file: first.jsx
*/
const App = () => {
  return React.createElement("div", null, React.createElement("h1", null, "Biografia"), React.createElement(Second, null));
};
/**
* file: second.jsx
*/


const Second = () => {
  return React.createElement("div", null, React.createElement("h3", null, "Second file biografia"));
};
/**
* file: main.js
*/

(() => {
    ReactDOM.render(React.createElement(App, null), document.getElementById('app'));
})();
