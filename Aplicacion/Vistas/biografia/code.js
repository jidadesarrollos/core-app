import {React} from '../../../htdocs/modules/libs/react.development.js';
import {ReactDOM} from '../../../htdocs/modules/libs/react-dom.development.js';
const App = () => {
  return React.createElement("div", null, React.createElement("h1", null, "Biografia"), React.createElement(Second, null));
};

const Second = () => {
  return React.createElement("div", null, React.createElement("h3", null, "Second file biografia"));
};
(() => {
    ReactDOM.render(React.createElement(App, null), document.getElementById('app'));
})();

