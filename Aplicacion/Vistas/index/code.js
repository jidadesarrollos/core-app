import {React} from '../../../htdocs/modules/libs/react.development.js';
import {ReactDOM} from '../../../htdocs/modules/libs/react-dom.development.js';
const App = () => {
  return React.createElement("div", null, React.createElement("h1", null, "Vista 1", React.createElement("small", null, "Index")), React.createElement(Second, null));
};

const Second = () => {
  return React.createElement("div", null, React.createElement("h3", null, "Testing second ", React.createElement("small", null, "content below")));
};
(() => {
    ReactDOM.render(React.createElement(App, null), document.getElementById('app'));
})();

